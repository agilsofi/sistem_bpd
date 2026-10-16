<?php

namespace App\Http\Controllers;

use App\Models\KreditReward;
use App\Models\JenisReward;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RewardController extends Controller
{
    public function index(Request $request)
    {
        $query = KreditReward::with(['siswa.kelas', 'jenisReward', 'pemberi']);

        // Siswa hanya lihat reward diri sendiri
        if (Auth::user()->role === 'siswa') {
            $idSiswa = optional(Auth::user()->siswa)->id_siswa;
            $query->where('id_siswa', $idSiswa);
        }
        // Guru hanya lihat reward yang ia buat sendiri
        elseif (Auth::user()->role === 'guru') {
            $idGuru = optional(Auth::user()->guru)->id_guru;
            $query->where('id_pemberi', $idGuru);
        }

        if ($request->filled('id_siswa')) {
            $query->where('id_siswa', $request->id_siswa);
        }
        if ($request->filled('id_jenis_reward')) {
            $query->where('id_jenis_reward', $request->id_jenis_reward);
        }
        if ($request->filled('tanggal_dari')) {
            $query->where('tanggal', '>=', $request->tanggal_dari);
        }
        if ($request->filled('tanggal_sampai')) {
            $query->where('tanggal', '<=', $request->tanggal_sampai);
        }

        $reward = $query->orderByDesc('tanggal')->paginate(20);
        $jenisReward = JenisReward::where('status', 'aktif')->get();

        return view('reward.index', compact('reward', 'jenisReward'));
    }

    public function create()
    {
        $jenisReward = JenisReward::where('status', 'aktif')->get();
        $guru = \App\Models\Guru::where('status', 'aktif')->orderBy('nama_guru')->get();
        return view('reward.create', compact('jenisReward', 'guru'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_siswa' => 'required|exists:siswa,id_siswa',
            'id_jenis_reward' => 'required|exists:jenis_reward,id_jenis_reward',
            'id_pemberi' => 'required|exists:guru,id_guru',
            'tanggal' => 'required|date',
            'alasan' => 'required|string',
        ]);

        $jenisReward = JenisReward::findOrFail($request->id_jenis_reward);

        KreditReward::create([
            'id_siswa' => $request->id_siswa,
            'id_jenis_reward' => $request->id_jenis_reward,
            'tanggal' => $request->tanggal,
            'alasan' => $request->alasan,
            'kredit_poin' => $jenisReward->kredit_poin,
            'id_pemberi' => $request->id_pemberi,
        ]);

        return redirect()->route('reward.index')->with('success', 'Reward berhasil ditambahkan.');
    }

    public function show(KreditReward $reward)
    {
        $reward->load(['siswa.kelas', 'jenisReward', 'pemberi']);
        return view('reward.show', compact('reward'));
    }

    public function destroy(KreditReward $reward)
    {
        $reward->delete();
        return redirect()->route('reward.index')->with('success', 'Reward berhasil dihapus.');
    }

    public function cariSiswa(Request $request)
    {
        $search = $request->get('q');
        $siswa = Siswa::with('kelas.jurusan')
            ->where('status', 'aktif')
            ->where(function($query) use ($search) {
                $query->where('NIS', 'like', "%{$search}%")
                    ->orWhere('nama', 'like', "%{$search}%");
            })
            ->limit(10)
            ->get();

        return response()->json($siswa);
    }
}
