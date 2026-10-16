<?php

namespace App\Http\Controllers;

use App\Models\LaporanPerilaku;
use App\Models\Siswa;
use App\Models\JenisPerilaku;
use App\Models\BuktiLaporan;
use App\Models\PoinPelanggaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class LaporanPerilakuController extends Controller
{
    public function index(Request $request)
    {
        $query = LaporanPerilaku::with(['siswa.kelas', 'jenisPerilaku.kategori', 'guru', 'bkVerifikator']);

        // Guru hanya melihat laporan yang ia buat sendiri
        if (Auth::user()->role === 'guru') {
            $idGuru = optional(Auth::user()->guru)->id_guru;
            $query->where('id_guru', $idGuru);
        }

        if ($request->filled('tanggal_dari')) {
            $query->where('tanggal_kejadian', '>=', $request->tanggal_dari);
        }
        if ($request->filled('tanggal_sampai')) {
            $query->where('tanggal_kejadian', '<=', $request->tanggal_sampai);
        }
        if ($request->filled('id_kelas')) {
            $query->whereHas('siswa', function($q) use ($request) {
                $q->where('id_kelas', $request->id_kelas);
            });
        }
        if ($request->filled('id_jenis_perilaku')) {
            $query->where('id_jenis_perilaku', $request->id_jenis_perilaku);
        }
        if ($request->filled('status_verifikasi')) {
            $query->where('status_verifikasi', $request->status_verifikasi);
        }

        $laporan = $query->latest()->paginate(20);
        
        $kelas = \App\Models\Kelas::with('jurusan')->get();
        $jenisPerilaku = JenisPerilaku::with('kategori')->where('status', 'aktif')->get();

        return view('laporan-perilaku.index', compact('laporan', 'kelas', 'jenisPerilaku'));
    }

    public function create()
    {
        $jenisPerilaku = JenisPerilaku::with('kategori')->where('status', 'aktif')->get();
        return view('laporan-perilaku.create', compact('jenisPerilaku'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_siswa' => 'nullable|exists:siswa,id_siswa',
            'id_jenis_perilaku' => 'required|exists:jenis_perilaku,id_jenis_perilaku',
            'tanggal_kejadian' => 'required|date',
            'keterangan' => 'required|string',
            'bukti_base64' => 'nullable|string',
        ]);

        $laporan = LaporanPerilaku::create([
            'id_siswa' => $request->id_siswa,
            'id_guru' => Auth::user()->guru->id_guru,
            'id_jenis_perilaku' => $request->id_jenis_perilaku,
            'tanggal_kejadian' => $request->tanggal_kejadian,
            'keterangan' => $request->keterangan,
            'status_verifikasi' => 'menunggu',
        ]);

        if ($request->hasFile('bukti')) {
            foreach ($request->file('bukti') as $file) {
                $path = $file->store('bukti_laporan', 'public');
                
                BuktiLaporan::create([
                    'id_laporan' => $laporan->id_laporan,
                    'nama_file' => $file->getClientOriginalName(),
                    'lokasi_file' => $path,
                    'tipe_file' => $file->getClientOriginalExtension(),
                    'ukuran_file' => $file->getSize(),
                    'tanggal_upload' => now(),
                    'status' => 'aktif',
                ]);
            }
        }

        if ($request->filled('bukti_base64')) {
            $imageData = $request->bukti_base64;
            $imageData = str_replace('data:image/jpeg;base64,', '', $imageData);
            $imageData = base64_decode($imageData);
            $filename = 'camera_' . time() . '.jpg';
            $path = 'bukti_laporan/' . $filename;
            Storage::disk('public')->put($path, $imageData);
            
            BuktiLaporan::create([
                'id_laporan' => $laporan->id_laporan,
                'nama_file' => $filename,
                'lokasi_file' => $path,
                'tipe_file' => 'jpg',
                'ukuran_file' => strlen($imageData),
                'tanggal_upload' => now(),
                'status' => 'aktif',
            ]);
        }

        return redirect()->route('laporan-perilaku.index')->with('success', 'Laporan perilaku berhasil dibuat.');
    }

    public function show($id)
    {
        $laporanPerilaku = LaporanPerilaku::with(['siswa.kelas', 'jenisPerilaku.kategori', 'guru', 'bkVerifikator', 'buktiLaporan', 'poinPelanggaran'])->findOrFail($id);
        
        // Guru tidak boleh melihat detail laporan milik guru lain
        if (Auth::user()->role === 'guru') {
            $idGuru = optional(Auth::user()->guru)->id_guru;
            if ($laporanPerilaku->id_guru != $idGuru) {
                abort(403, 'Anda tidak memiliki hak untuk melihat laporan ini.');
            }
        }

        return view('laporan-perilaku.show', compact('laporanPerilaku'));
    }

    public function verifikasi($id)
    {
        $laporan = LaporanPerilaku::with(['siswa.kelas', 'jenisPerilaku.kategori', 'guru', 'buktiLaporan'])->findOrFail($id);
        return view('laporan-perilaku.verifikasi', compact('laporan'));
    }

    public function prosesVerifikasi(Request $request, $id)
    {
        $request->validate([
            'status_verifikasi' => 'required|in:disetujui,ditolak',
            'catatan_verifikasi' => 'nullable|string',
        ]);

        $laporan = LaporanPerilaku::findOrFail($id);
        
        $laporan->update([
            'status_verifikasi' => $request->status_verifikasi,
            'id_bk_verifikator' => optional(Auth::user()->guru)->id_guru,
            'tanggal_verifikasi' => now(),
            'catatan_verifikasi' => $request->catatan_verifikasi,
        ]);

        if ($request->status_verifikasi === 'disetujui') {
            PoinPelanggaran::create([
                'id_siswa' => $laporan->id_siswa,
                'id_laporan' => $laporan->id_laporan,
                'tanggal' => now(),
                'keterangan' => $laporan->jenisPerilaku->nama_perilaku,
                'poin' => $laporan->jenisPerilaku->poin_pelanggaran,
                'id_pemberi' => $laporan->id_guru,
            ]);
        }

        return redirect()->route('laporan-perilaku.verifikasi-index')->with('success', 'Laporan berhasil diverifikasi.');
    }

    public function verifikasiIndex()
    {
        $laporan = LaporanPerilaku::with(['siswa.kelas', 'jenisPerilaku.kategori', 'guru'])
            ->where('status_verifikasi', 'menunggu')
            ->latest()
            ->paginate(20);

        return view('laporan-perilaku.verifikasi-index', compact('laporan'));
    }

    public function destroy($id)
    {
        try {
            $laporanPerilaku = LaporanPerilaku::findOrFail($id);

            foreach ($laporanPerilaku->buktiLaporan as $bukti) {
                Storage::disk('public')->delete($bukti->lokasi_file);
                $bukti->delete();
            }

            $laporanPerilaku->delete();
            return redirect()->route('laporan-perilaku.index')->with('success', 'Laporan berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('laporan-perilaku.index')->with('error', 'Laporan tidak dapat dihapus karena masih digunakan.');
        }
    }

    public function cariSiswa(Request $request)
    {
        $search = $request->get('q');
        $siswa = Siswa::with('kelas.jurusan')
            ->where('status', 'aktif')
            ->where(function($query) use ($search) {
                $query->where('NIS', 'like', "%{$search}%")
                    ->orWhere('nama', 'like', "%{$search}%");
            })
            ->limit(10)
            ->get();

        return response()->json($siswa);
    }
}
