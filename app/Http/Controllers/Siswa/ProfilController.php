<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
{
    public function index()
    {
        $siswa = Auth::user()->siswa;
        return view('siswa.profil.index', compact('siswa'));
    }

    public function update(Request $request)
    {
        $siswa = Auth::user()->siswa;
        $user = Auth::user();

        $request->validate([
            'nama' => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:L,P',
            'tanggal_lahir' => 'nullable|date',
            'username' => 'required|string|max:50|unique:users,username,' . $user->id_user . ',id_user',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $siswa->update([
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tanggal_lahir' => $request->tanggal_lahir,
        ]);

        $userData = [
            'username' => $request->username,
        ];

        if ($request->filled('password')) {
            $userData['password'] = Hash::make($request->password);
        }

        $user->update($userData);

        return redirect()->route('siswa.profil.index')->with('success', 'Profil berhasil diperbarui.');
    }
}
