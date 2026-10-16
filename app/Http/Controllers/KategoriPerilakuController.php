<?php

namespace App\Http\Controllers;

use App\Models\KategoriPerilaku;
use Illuminate\Http\Request;

class KategoriPerilakuController extends Controller
{
    public function index()
    {
        $kategori = KategoriPerilaku::all();
        return view('kategori-perilaku.index', compact('kategori'));
    }

    public function create()
    {
        return view('kategori-perilaku.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:50',
            'keterangan' => 'nullable|string',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        KategoriPerilaku::create($request->only(['nama_kategori', 'keterangan', 'status']));

        return redirect()->route('kategori-perilaku.index')->with('success', 'Kategori perilaku berhasil ditambahkan.');
    }

    public function edit(KategoriPerilaku $kategoriPerilaku)
    {
        return view('kategori-perilaku.edit', compact('kategoriPerilaku'));
    }

    public function update(Request $request, KategoriPerilaku $kategoriPerilaku)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:50',
            'keterangan' => 'nullable|string',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        $kategoriPerilaku->update($request->only(['nama_kategori', 'keterangan', 'status']));

        return redirect()->route('kategori-perilaku.index')->with('success', 'Kategori perilaku berhasil diperbarui.');
    }

    public function destroy(KategoriPerilaku $kategoriPerilaku)
    {
        try {
            $kategoriPerilaku->delete();
            return redirect()->route('kategori-perilaku.index')->with('success', 'Kategori perilaku berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('kategori-perilaku.index')->with('error', 'Kategori perilaku tidak dapat dihapus karena masih digunakan.');
        }
    }
}
