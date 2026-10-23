<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        $query = Siswa::with('kelas');

        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function($sub) use ($q) {
                $sub->where('nama', 'like', "%{$q}%")
                    ->orWhere('NIS', 'like', "%{$q}%");
            });
        }

        if ($request->filled('id_kelas')) {
            $query->where('id_kelas', $request->id_kelas);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $siswa = $query->latest()->get();
        $kelas = Kelas::orderBy('nama_kelas')->get();

        return view('siswa.index', compact('siswa', 'kelas'));
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt'
        ]);

        $file = $request->file('file');
        $content = file_get_contents($file->getRealPath());
        
        $content = preg_replace('/^\xEF\xBB\xBF/', '', $content);
        $lines = preg_split('/\r\n|\r|\n/', $content);
        
        $headerSkipped = false;
        $count = 0;

        foreach ($lines as $line) {
            if (trim($line) === '') continue;

            $delimiter = strpos($line, ';') !== false ? ';' : ',';
            $row = str_getcsv($line, $delimiter);

            if (!$headerSkipped) {
                $headerSkipped = true;
                continue;
            }

            if (count($row) < 2) continue;

            $nis = trim($row[0]);
            $nama = trim($row[1]);
            $jk = isset($row[2]) ? (strtoupper(trim($row[2])) === 'P' ? 'P' : 'L') : 'L';
            $tglLahir = !empty($row[3]) ? trim($row[3]) : null;
            $namaKelas = isset($row[4]) ? trim($row[4]) : null;

            if (empty($nis) || empty($nama)) continue;

            $idKelas = null;
            if ($namaKelas) {
                $kelas = Kelas::where('nama_kelas', $namaKelas)->first();
                $idKelas = $kelas ? $kelas->id_kelas : null;
            }

            $siswa = Siswa::updateOrCreate(
                ['NIS' => $nis],
                [
                    'nama' => $nama,
                    'jenis_kelamin' => $jk,
                    'tanggal_lahir' => $tglLahir,
                    'id_kelas' => $idKelas,
                    'status' => 'aktif',
                ]
            );

            User::updateOrCreate(
                ['username' => $nis],
                [
                    'password' => Hash::make($nis),
                    'role' => 'siswa',
                    'id_siswa' => $siswa->id_siswa,
                    'status' => 'aktif',
                ]
            );

            $count++;
        }

        return redirect()->route('siswa.index')->with('success', "$count data siswa berhasil diimport. Username & Password default menggunakan NIS.");
    }

    public function show(Siswa $siswa)
    {
        $siswa->load(['kelas.jurusan', 'kelas.tahunAjaran']);
        return view('siswa.show', compact('siswa'));
    }

    public function lihatIndex(Request $request)
    {
        $user = auth()->user();
        
        $query = Siswa::with('kelas');

        if ($user->role === 'guru' && $user->guru) {
            $kelasIds = \App\Models\Kelas::where('id_wali_kelas', $user->guru->id_guru)->pluck('id_kelas');
            $query->whereIn('id_kelas', $kelasIds);
        }

        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function($sub) use ($q) {
                $sub->where('nama', 'like', "%{$q}%")
                    ->orWhere('NIS', 'like', "%{$q}%");
            });
        }

        if ($request->filled('id_kelas')) {
            $query->where('id_kelas', $request->id_kelas);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $siswa = $query->latest()->get();
        $kelas = \App\Models\Kelas::orderBy('nama_kelas')->get();

        return view('siswa.lihat-index', compact('siswa', 'kelas'));
    }

    public function lihatShow(Siswa $siswa)
    {
        $user = auth()->user();
        if ($user->role === 'guru' && $user->guru) {
            $kelasIds = \App\Models\Kelas::where('id_wali_kelas', $user->guru->id_guru)->pluck('id_kelas')->toArray();
            if (!in_array($siswa->id_kelas, $kelasIds)) {
                abort(403, 'Bukan siswa wali kelasmu.');
            }
        }
        $siswa->load(['kelas.jurusan', 'kelas.tahunAjaran']);
        return view('siswa.lihat-show', compact('siswa'));
    }

    public function waliKelasIndex()
    {
        $user = auth()->user();
        if (!$user->guru) {
            abort(403, 'Anda bukan guru.');
        }

        $kelasWali = Kelas::where('id_wali_kelas', $user->guru->id_guru)
            ->with(['jurusan', 'tahunAjaran', 'siswa.kelas'])
            ->get();

        return view('siswa.wali-kelas', compact('kelasWali'));
    }

    public function create()
    {
        $kelas = Kelas::with(['jurusan', 'tahunAjaran'])->get();
        return view('siswa.create', compact('kelas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'NIS' => 'required|string|max:20|unique:siswa,NIS',
            'nama' => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:L,P',
            'tanggal_lahir' => 'nullable|date',
            'id_kelas' => 'nullable|exists:kelas,id_kelas',
            'status' => 'required|in:aktif,lulus,dropout,pindah',
            'username' => 'required|string|max:50|unique:users,username',
            'password' => 'required|string|min:6',
            'nama_ayah' => 'nullable|string|max:255',
            'pekerjaan_ayah' => 'nullable|string|max:255',
            'nama_ibu' => 'nullable|string|max:255',
            'pekerjaan_ibu' => 'nullable|string|max:255',
            'no_hp_orang_tua' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
        ]);

        $siswa = Siswa::create([
            'NIS' => $request->NIS,
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tanggal_lahir' => $request->tanggal_lahir,
            'id_kelas' => $request->id_kelas,
            'status' => $request->status,
            'nama_ayah' => $request->nama_ayah,
            'pekerjaan_ayah' => $request->pekerjaan_ayah,
            'nama_ibu' => $request->nama_ibu,
            'pekerjaan_ibu' => $request->pekerjaan_ibu,
            'no_hp_orang_tua' => $request->no_hp_orang_tua,
            'alamat' => $request->alamat,
        ]);

        User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => 'siswa',
            'id_siswa' => $siswa->id_siswa,
            'status' => $request->status === 'aktif' ? 'aktif' : 'nonaktif',
        ]);

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil ditambahkan.');
    }

    public function edit(Siswa $siswa)
    {
        $kelas = Kelas::with(['jurusan', 'tahunAjaran'])->get();
        return view('siswa.edit', compact('siswa', 'kelas'));
    }

    public function update(Request $request, Siswa $siswa)
    {
        $request->validate([
            'NIS' => 'required|string|max:20|unique:siswa,NIS,' . $siswa->id_siswa . ',id_siswa',
            'nama' => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:L,P',
            'tanggal_lahir' => 'nullable|date',
            'id_kelas' => 'nullable|exists:kelas,id_kelas',
            'status' => 'required|in:aktif,lulus,dropout,pindah',
            'username' => 'required|string|max:50|unique:users,username,' . optional($siswa->user)->id_user . ',id_user',
            'password' => 'nullable|string|min:6',
            'nama_ayah' => 'nullable|string|max:255',
            'pekerjaan_ayah' => 'nullable|string|max:255',
            'nama_ibu' => 'nullable|string|max:255',
            'pekerjaan_ibu' => 'nullable|string|max:255',
            'no_hp_orang_tua' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
        ]);

        $siswa->update([
            'NIS' => $request->NIS,
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tanggal_lahir' => $request->tanggal_lahir,
            'id_kelas' => $request->id_kelas,
            'status' => $request->status,
            'nama_ayah' => $request->nama_ayah,
            'pekerjaan_ayah' => $request->pekerjaan_ayah,
            'nama_ibu' => $request->nama_ibu,
            'pekerjaan_ibu' => $request->pekerjaan_ibu,
            'no_hp_orang_tua' => $request->no_hp_orang_tua,
            'alamat' => $request->alamat,
        ]);

        if ($siswa->user) {
            $userData = [
                'username' => $request->username,
                'status' => $request->status === 'aktif' ? 'aktif' : 'nonaktif',
            ];
            
            if ($request->filled('password')) {
                $userData['password'] = Hash::make($request->password);
            }

            $siswa->user->update($userData);
        }

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil diperbarui.');
    }

    public function destroy(Siswa $siswa)
    {
        try {
            if ($siswa->user) {
                $siswa->user->delete();
            }

            $siswa->delete();
            return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('siswa.index')->with('error', 'Data siswa tidak dapat dihapus karena masih digunakan.');
        }
    }
}
