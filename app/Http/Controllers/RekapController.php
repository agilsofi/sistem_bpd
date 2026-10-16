<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\PoinPelanggaran;
use App\Models\KreditReward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RekapController extends Controller
{
    public function rekapPoin(Request $request)
    {
        $query = Siswa::with('kelas')
            ->withSum(['poinPelanggaran as total_poin' => function ($q) {
                $q->whereHas('laporan', function ($l) {
                    $l->where('status_verifikasi', 'disetujui');
                });
            }], 'poin');

        if ($request->filled('id_kelas')) {
            $query->where('id_kelas', $request->id_kelas);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        } else {
            $query->where('status', 'aktif');
        }

        $siswa = $query->orderByDesc('total_poin')->get();
        $kelas = Kelas::orderBy('nama_kelas')->get();

        $totalPoin = $siswa->sum('total_poin');
        $siswaPoinTinggi = $siswa->where('total_poin', '>=', 50)->count();

        return view('laporan.rekap-poin', compact('siswa', 'kelas', 'totalPoin', 'siswaPoinTinggi'));
    }

    public function rekapReward(Request $request)
    {
        $query = Siswa::with('kelas')
            ->withSum(['kreditReward as total_kredit'], 'kredit_poin');

        if ($request->filled('id_kelas')) {
            $query->where('id_kelas', $request->id_kelas);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        } else {
            $query->where('status', 'aktif');
        }

        $siswa = $query->orderByDesc('total_kredit')->get();
        $kelas = Kelas::orderBy('nama_kelas')->get();

        $totalKredit = $siswa->sum('total_kredit');
        $siswaReward = $siswa->where('total_kredit', '>', 0)->count();

        return view('laporan.rekap-reward', compact('siswa', 'kelas', 'totalKredit', 'siswaReward'));
    }
}
