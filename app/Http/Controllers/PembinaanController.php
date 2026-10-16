<?php

namespace App\Http\Controllers;

use App\Models\Pembinaan;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PembinaanController extends Controller
{
    public function index(Request $request)
    {
        $query = Pembinaan::with(['siswa.kelas', 'pembina']);

        if ($request->filled('id_siswa')) {
            $query->where('id_siswa', $request->id_siswa);
        }
        if ($request->filled('tanggal_dari')) {
            $query->where('tanggal', '>=', $request->tanggal_dari);
        }
        if ($request->filled('tanggal_sampai')) {
            $query->where('tanggal', '<=', $request->tanggal_sampai);
        }

        $pembinaan = $query->latest('tanggal')->paginate(20);

        return view('pembinaan.index', compact('pembinaan'));
    }

    public function create()
    {
        $guru = \App\Models\Guru::where('status', 'aktif')->orderBy('nama_guru')->get();
        return view('pembinaan.create', compact('guru'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_siswa' => 'required|exists:siswa,id_siswa',
            'id_pembina' => 'required|exists:guru,id_guru',
            'tanggal' => 'required|date',
            'alasan' => 'required|string',
            'jenis_pembinaan' => 'required|in:verbal,tertulis,mediasi,konseling',
            'hasil' => 'nullable|string',
            'tindak_lanjut' => 'nullable|string',
            'keterangan' => 'nullable|string',
        ]);

        Pembinaan::create([
            'id_siswa' => $request->id_siswa,
            'id_pembina' => $request->id_pembina,
            'tanggal' => $request->tanggal,
            'alasan' => $request->alasan,
            'jenis_pembinaan' => $request->jenis_pembinaan,
            'hasil' => $request->hasil,
            'tindak_lanjut' => $request->tindak_lanjut,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('pembinaan.index')->with('success', 'Data pembinaan berhasil disimpan.');
    }

    public function show(Pembinaan $pembinaan)
    {
        $pembinaan->load(['siswa.kelas', 'pembina']);
        return view('pembinaan.show', compact('pembinaan'));
    }

    public function edit(Pembinaan $pembinaan)
    {
        $guru = \App\Models\Guru::where('status', 'aktif')->orderBy('nama_guru')->get();
        return view('pembinaan.edit', compact('pembinaan', 'guru'));
    }

    public function update(Request $request, Pembinaan $pembinaan)
    {
        $request->validate([
            'id_siswa' => 'required|exists:siswa,id_siswa',
            'id_pembina' => 'required|exists:guru,id_guru',
            'tanggal' => 'required|date',
            'alasan' => 'required|string',
            'jenis_pembinaan' => 'required|in:verbal,tertulis,mediasi,konseling',
            'hasil' => 'nullable|string',
            'tindak_lanjut' => 'nullable|string',
            'keterangan' => 'nullable|string',
        ]);

        $pembinaan->update($request->all());

        return redirect()->route('pembinaan.index')->with('success', 'Data pembinaan berhasil diperbarui.');
    }

    public function destroy(Pembinaan $pembinaan)
    {
        $pembinaan->delete();
        return redirect()->route('pembinaan.index')->with('success', 'Data pembinaan berhasil dihapus.');
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
