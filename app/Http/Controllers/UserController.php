<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Guru;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with(['guru', 'siswa'])->latest('id_user')->get();
        return view('pengguna.index', compact('users'));
    }

    public function create()
    {
        $guru = Guru::where('status', 'aktif')->get();
        $siswa = Siswa::where('status', 'aktif')->get();
        return view('pengguna.create', compact('guru', 'siswa'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:50|unique:users,username',
            'password' => 'required|string|min:6',
            'role' => 'required|in:admin,guru,bk,kesiswaan,siswa',
            'status' => 'required|in:aktif,nonaktif',
            'id_guru' => 'nullable|required_if:role,guru,bk,kesiswaan|exists:guru,id_guru',
            'id_siswa' => 'nullable|required_if:role,siswa|exists:siswa,id_siswa',
        ]);

        User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'status' => $request->status,
            'id_guru' => $request->id_guru,
            'id_siswa' => $request->id_siswa,
        ]);

        return redirect()->route('pengguna.index')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    public function edit(User $pengguna)
    {
        $guru = Guru::where('status', 'aktif')->get();
        $siswa = Siswa::where('status', 'aktif')->get();
        return view('pengguna.edit', compact('pengguna', 'guru', 'siswa'));
    }

    public function update(Request $request, User $pengguna)
    {
        $request->validate([
            'username' => 'required|string|max:50|unique:users,username,' . $pengguna->id_user . ',id_user',
            'password' => 'nullable|string|min:6',
            'role' => 'required|in:admin,guru,bk,kesiswaan,siswa',
            'status' => 'required|in:aktif,nonaktif',
            'id_guru' => 'nullable|required_if:role,guru,bk,kesiswaan|exists:guru,id_guru',
            'id_siswa' => 'nullable|required_if:role,siswa|exists:siswa,id_siswa',
        ]);

        $data = [
            'username' => $request->username,
            'role' => $request->role,
            'status' => $request->status,
            'id_guru' => $request->id_guru,
            'id_siswa' => $request->id_siswa,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $pengguna->update($data);

        return redirect()->route('pengguna.index')->with('success', 'Pengguna berhasil diperbarui.');
    }

    public function destroy(User $pengguna)
    {
        if ($pengguna->id_user === auth()->id()) {
            return redirect()->route('pengguna.index')->with('error', 'Tidak dapat menghapus akun sendiri.');
        }

        $pengguna->delete();
        return redirect()->route('pengguna.index')->with('success', 'Pengguna berhasil dihapus.');
    }
}
