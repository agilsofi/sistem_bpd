<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\PoinPelanggaran;

class PoinController extends Controller
{
    public function index()
    {
        $siswa = Auth::user()->siswa;
        
        $riwayatPoin = PoinPelanggaran::where('id_siswa', $siswa->id_siswa)
            ->whereHas('laporan', function ($query) {
                $query->where('status_verifikasi', 'disetujui');
            })
            ->with(['laporan.jenisPerilaku', 'pemberi'])
            ->orderByDesc('tanggal')
            ->get();

        $totalPoin = $riwayatPoin->sum('poin');

        return view('siswa.poin.index', compact('riwayatPoin', 'totalPoin'));
    }
}
