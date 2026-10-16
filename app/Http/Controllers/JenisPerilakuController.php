<?php

namespace App\Http\Controllers;

use App\Models\JenisPerilaku;
use App\Models\KategoriPerilaku;
use Illuminate\Http\Request;

class JenisPerilakuController extends Controller
{
    public function index()
    {
        $jenisPerilaku = JenisPerilaku::with('kategori')->get();
        return view('jenis-perilaku.index', compact('jenisPerilaku'));
    }

    public function create()
    {
        $kategori = KategoriPerilaku::all();
        return view('jenis-perilaku.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_kategori' => 'required|exists:kategori_perilaku,id_kategori',
            'nama_perilaku' => 'required|string|max:100',
            'poin_pelanggaran' => 'required|integer',
            'keterangan' => 'nullable|string',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        JenisPerilaku::create($request->all());

        return redirect()->route('jenis-perilaku.index')->with('success', 'Jenis perilaku berhasil ditambahkan.');
    }

    public function edit(JenisPerilaku $jenisPerilaku)
    {
        $kategori = KategoriPerilaku::all();
        return view('jenis-perilaku.edit', compact('jenisPerilaku', 'kategori'));
    }

    public function update(Request $request, JenisPerilaku $jenisPerilaku)
    {
        $request->validate([
            'id_kategori' => 'required|exists:kategori_perilaku,id_kategori',
            'nama_perilaku' => 'required|string|max:100',
            'poin_pelanggaran' => 'required|integer',
            'keterangan' => 'nullable|string',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        $jenisPerilaku->update($request->all());

        return redirect()->route('jenis-perilaku.index')->with('success', 'Jenis perilaku berhasil diperbarui.');
    }

    public function destroy(JenisPerilaku $jenisPerilaku)
    {
        try {
            $jenisPerilaku->delete();
            return redirect()->route('jenis-perilaku.index')->with('success', 'Jenis perilaku berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('jenis-perilaku.index')->with('error', 'Jenis perilaku tidak dapat dihapus karena masih digunakan.');
        }
    }
}
