<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        $kelas = Kelas::with(['jurusan', 'tahunAjaran', 'waliKelas'])->latest()->get();
        return view('kelas.index', compact('kelas'));
    }

    public function create()
    {
        $jurusan = \App\Models\Jurusan::all();
        $tahunAjaran = \App\Models\TahunAjaran::where('status', 'aktif')->get();
        $guru = \App\Models\Guru::where('status', 'aktif')->where('status_wali_kelas', 'ya')->orderBy('nama_guru')->get();
        return view('kelas.create', compact('jurusan', 'tahunAjaran', 'guru'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:10',
            'tingkat' => 'required|integer|in:10,11,12',
            'id_jurusan' => 'required|exists:jurusan,id_jurusan',
            'id_tahun_ajaran' => 'required|exists:tahun_ajaran,id_tahun_ajaran',
            'id_wali_kelas' => 'nullable|exists:guru,id_guru',
            'kapasitas' => 'required|integer|min:1',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        Kelas::create($request->only(['nama_kelas', 'tingkat', 'id_jurusan', 'id_tahun_ajaran', 'id_wali_kelas', 'kapasitas', 'status']));

        return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil ditambahkan.');
    }

    public function edit(Kelas $kelas)
    {
        $jurusan = \App\Models\Jurusan::all();
        $tahunAjaran = \App\Models\TahunAjaran::where('status', 'aktif')->get();
        $guru = \App\Models\Guru::where('status', 'aktif')->where('status_wali_kelas', 'ya')->orderBy('nama_guru')->get();
        return view('kelas.edit', compact('kelas', 'jurusan', 'tahunAjaran', 'guru'));
    }

    public function update(Request $request, Kelas $kelas)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:10',
            'tingkat' => 'required|integer|in:10,11,12',
            'id_jurusan' => 'required|exists:jurusan,id_jurusan',
            'id_tahun_ajaran' => 'required|exists:tahun_ajaran,id_tahun_ajaran',
            'id_wali_kelas' => 'nullable|exists:guru,id_guru',
            'kapasitas' => 'required|integer|min:1',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        $kelas->update($request->only(['nama_kelas', 'tingkat', 'id_jurusan', 'id_tahun_ajaran', 'id_wali_kelas', 'kapasitas', 'status']));

        return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil diperbarui.');
    }

    public function destroy(Kelas $kelas)
    {
        try {
            $kelas->delete();
            return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('kelas.index')->with('error', 'Data kelas tidak dapat dihapus karena masih digunakan.');
        }
    }
}
