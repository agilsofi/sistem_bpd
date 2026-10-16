<?php

namespace App\Http\Controllers;

use App\Models\JenisReward;
use Illuminate\Http\Request;

class JenisRewardController extends Controller
{
    public function index()
    {
        $jenisReward = JenisReward::all();
        return view('jenis-reward.index', compact('jenisReward'));
    }

    public function create()
    {
        return view('jenis-reward.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_reward' => 'required|string|max:100',
            'kredit_poin' => 'required|integer',
            'keterangan' => 'nullable|string',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        JenisReward::create($request->only(['nama_reward', 'kredit_poin', 'keterangan', 'status']));

        return redirect()->route('jenis-reward.index')->with('success', 'Jenis reward berhasil ditambahkan.');
    }

    public function edit(JenisReward $jenisReward)
    {
        return view('jenis-reward.edit', compact('jenisReward'));
    }

    public function update(Request $request, JenisReward $jenisReward)
    {
        $request->validate([
            'nama_reward' => 'required|string|max:100',
            'kredit_poin' => 'required|integer',
            'keterangan' => 'nullable|string',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        $jenisReward->update($request->only(['nama_reward', 'kredit_poin', 'keterangan', 'status']));

        return redirect()->route('jenis-reward.index')->with('success', 'Jenis reward berhasil diperbarui.');
    }

    public function destroy(JenisReward $jenisReward)
    {
        try {
            $jenisReward->delete();
            return redirect()->route('jenis-reward.index')->with('success', 'Jenis reward berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('jenis-reward.index')->with('error', 'Jenis reward tidak dapat dihapus karena masih digunakan.');
        }
    }
}
