<?php

namespace App\Http\Controllers;

use App\Models\TahunAjaran;
use Illuminate\Http\Request;

class TahunAjaranController extends Controller
{
    public function index()
    {
        $tahunAjaran = TahunAjaran::latest()->get();
        return view('tahun-ajaran.index', compact('tahunAjaran'));
    }

    public function create()
    {
        return view('tahun-ajaran.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_tahun_ajaran' => 'required|string|max:9|unique:tahun_ajaran,nama_tahun_ajaran',
            'semester' => 'required|in:ganjil,genap',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        TahunAjaran::create($request->only(['nama_tahun_ajaran', 'semester', 'tanggal_mulai', 'tanggal_selesai', 'status']));

        return redirect()->route('tahun-ajaran.index')->with('success', 'Data tahun ajaran berhasil ditambahkan.');
    }

    public function edit(TahunAjaran $tahunAjaran)
    {
        return view('tahun-ajaran.edit', compact('tahunAjaran'));
    }

    public function update(Request $request, TahunAjaran $tahunAjaran)
    {
        $request->validate([
            'nama_tahun_ajaran' => 'required|string|max:9|unique:tahun_ajaran,nama_tahun_ajaran,' . $tahunAjaran->id_tahun_ajaran . ',id_tahun_ajaran',
            'semester' => 'required|in:ganjil,genap',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        $tahunAjaran->update($request->only(['nama_tahun_ajaran', 'semester', 'tanggal_mulai', 'tanggal_selesai', 'status']));

        return redirect()->route('tahun-ajaran.index')->with('success', 'Data tahun ajaran berhasil diperbarui.');
    }

    public function destroy(TahunAjaran $tahunAjaran)
    {
        try {
            $tahunAjaran->delete();
            return redirect()->route('tahun-ajaran.index')->with('success', 'Data tahun ajaran berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('tahun-ajaran.index')->with('error', 'Data tahun ajaran tidak dapat dihapus karena masih digunakan.');
        }
    }
}
