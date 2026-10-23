<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class GuruController extends Controller
{
    public function index(Request $request)
    {
        $query = Guru::query();
        
        if ($request->filled('search')) {
            $query->where('nama_guru', 'like', '%' . $request->search . '%')
                  ->orWhere('nuptk', 'like', '%' . $request->search . '%');
        }
        
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $guru = $query->latest()->get();
        return view('guru.index', compact('guru'));
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt'
        ]);

        $file = $request->file('file');
        $content = file_get_contents($file->getRealPath());
        
        // Remove UTF-8 BOM if present
        $content = preg_replace('/^\xEF\xBB\xBF/', '', $content);
        $lines = preg_split('/\r\n|\r|\n/', $content);
        
        $headerSkipped = false;
        $count = 0;

        foreach ($lines as $line) {
            if (trim($line) === '') continue;
            
            // Auto detect delimiter (, or ;)
            $delimiter = strpos($line, ';') !== false ? ';' : ',';
            $row = str_getcsv($line, $delimiter);

            if (!$headerSkipped) {
                $headerSkipped = true;
                continue; // Skip header
            }

            if (count($row) < 2) continue;
            
            $nuptk = trim($row[0]);
            $nama = trim($row[1]);
            if (empty($nuptk) || empty($nama)) continue;

            $guru = Guru::updateOrCreate(
                ['nuptk' => $nuptk],
                [
                    'nama_guru' => $nama,
                    'jenis_kelamin' => isset($row[2]) ? (strtoupper(trim($row[2])) == 'P' ? 'P' : 'L') : 'L',
                    'tempat_lahir' => $row[3] ?? null,
                    'tanggal_lahir' => !empty($row[4]) ? trim($row[4]) : null,
                    'no_telepon' => $row[5] ?? null,
                    'email' => $row[6] ?? null,
                    'alamat' => $row[7] ?? null,
                    'status' => 'aktif',
                ]
            );

            User::updateOrCreate(
                ['username' => $nuptk],
                [
                    'password' => Hash::make($nuptk),
                    'role' => 'guru',
                    'id_guru' => $guru->id_guru,
                    'status' => 'aktif',
                ]
            );
            $count++;
        }

        return redirect()->route('guru.index')->with('success', "$count data guru berhasil diimport. Username & Password default menggunakan NUPTK.");
    }

    public function create()
    {
        return view('guru.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nuptk' => 'required|string|max:20|unique:guru,nuptk',
            'nama_guru' => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:L,P',
            'tempat_lahir' => 'nullable|string|max:50',
            'tanggal_lahir' => 'nullable|date',
            'no_telepon' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:100',
            'alamat' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'status' => 'required|in:aktif,nonaktif',
            'status_wali_kelas' => 'required|in:ya,tidak',
            'username' => 'required|string|max:50|unique:users,username',
            'password' => 'required|string|min:6',
        ]);

        $data = $request->except(['foto', 'username', 'password']);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('guru', 'public');
        }

        $guru = Guru::create($data);

        User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => 'guru',
            'id_guru' => $guru->id_guru,
            'status' => $request->status,
        ]);

        return redirect()->route('guru.index')->with('success', 'Data guru berhasil ditambahkan.');
    }

    public function edit(Guru $guru)
    {
        return view('guru.edit', compact('guru'));
    }

    public function update(Request $request, Guru $guru)
    {
        $request->validate([
            'nuptk' => 'required|string|max:20|unique:guru,nuptk,' . $guru->id_guru . ',id_guru',
            'nama_guru' => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:L,P',
            'tempat_lahir' => 'nullable|string|max:50',
            'tanggal_lahir' => 'nullable|date',
            'no_telepon' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:100',
            'alamat' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'status' => 'required|in:aktif,nonaktif',
            'status_wali_kelas' => 'required|in:ya,tidak',
            'username' => 'required|string|max:50|unique:users,username,' . optional($guru->user)->id_user . ',id_user',
            'password' => 'nullable|string|min:6',
        ]);

        $data = $request->except(['foto', 'username', 'password']);

        if ($request->hasFile('foto')) {
            if ($guru->foto) {
                Storage::disk('public')->delete($guru->foto);
            }
            $data['foto'] = $request->file('foto')->store('guru', 'public');
        }

        $guru->update($data);

        if ($guru->user) {
            $userData = [
                'username' => $request->username,
                'status' => $request->status,
            ];
            
            if ($request->filled('password')) {
                $userData['password'] = Hash::make($request->password);
            }

            $guru->user->update($userData);
        }

        return redirect()->route('guru.index')->with('success', 'Data guru berhasil diperbarui.');
    }

    public function destroy(Guru $guru)
    {
        try {
            if ($guru->foto) {
                Storage::disk('public')->delete($guru->foto);
            }

            if ($guru->user) {
                $guru->user->delete();
            }

            $guru->delete();
            return redirect()->route('guru.index')->with('success', 'Data guru berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('guru.index')->with('error', 'Data guru tidak dapat dihapus karena masih digunakan.');
        }
    }
}
