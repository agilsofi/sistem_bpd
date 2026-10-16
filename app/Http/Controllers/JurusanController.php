<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    public function index()
    {
        $jurusan = Jurusan::latest()->get();
        return view('jurusan.index', compact('jurusan'));
    }

    public function create()
    {
        return view('jurusan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_jurusan' => 'required|string|max:10|unique:jurusan,kode_jurusan',
            'nama_jurusan' => 'required|string|max:100',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        Jurusan::create($request->all());

        return redirect()->route('jurusan.index')->with('success', 'Data jurusan berhasil ditambahkan.');
    }

    public function edit(Jurusan $jurusan)
    {
        return view('jurusan.edit', compact('jurusan'));
    }

    public function update(Request $request, Jurusan $jurusan)
    {
        $request->validate([
            'kode_jurusan' => 'required|string|max:10|unique:jurusan,kode_jurusan,' . $jurusan->id_jurusan . ',id_jurusan',
            'nama_jurusan' => 'required|string|max:100',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        $jurusan->update($request->all());

        return redirect()->route('jurusan.index')->with('success', 'Data jurusan berhasil diperbarui.');
    }

    public function destroy(Jurusan $jurusan)
    {
        try {
            $jurusan->delete();
            return redirect()->route('jurusan.index')->with('success', 'Data jurusan berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('jurusan.index')->with('error', 'Data jurusan tidak dapat dihapus karena masih digunakan.');
        }
    }
}
