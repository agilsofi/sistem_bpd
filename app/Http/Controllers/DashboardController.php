<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\LaporanPerilaku;
use App\Models\PoinPelanggaran;
use App\Models\SP;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        switch ($user->role) {
            case 'admin':
                return $this->dashboardAdmin();
            case 'guru':
                return $this->dashboardGuru();
            case 'bk':
                return $this->dashboardBK();
            case 'kesiswaan':
                return $this->dashboardKesiswaan();
            case 'siswa':
                return $this->dashboardSiswa();
            default:
                return view('dashboard.default');
        }
    }

    private function dashboardAdmin()
    {
        $data = [
            'totalSiswa' => Siswa::count(),
            'totalGuru' => Guru::count(),
            'totalKelas' => Kelas::count(),
            'totalLaporan' => LaporanPerilaku::count(),
            'siswaAktif' => Siswa::where('status', 'aktif')->count(),
            'laporanMenunggu' => LaporanPerilaku::where('status_verifikasi', 'menunggu')->count(),
            'laporanBulanIni' => LaporanPerilaku::whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->count(),
            'laporanTerbaru' => LaporanPerilaku::with(['siswa.kelas', 'jenisPerilaku', 'guru'])->latest()->take(5)->get(),
        ];

        return view('dashboard.admin', $data);
    }

    private function dashboardGuru()
    {
        $guru = Auth::user()->guru;

        $data = [
            'totalLaporanSaya' => LaporanPerilaku::where('id_guru', $guru->id_guru)->count(),
            'laporanMenunggu' => LaporanPerilaku::where('id_guru', $guru->id_guru)->where('status_verifikasi', 'menunggu')->count(),
            'laporanDisetujui' => LaporanPerilaku::where('id_guru', $guru->id_guru)->where('status_verifikasi', 'disetujui')->count(),
            'kelasWali' => $guru->kelasAsWali()->with(['siswa', 'jurusan', 'tahunAjaran'])->first(),
            'laporanTerbaru' => LaporanPerilaku::with(['siswa.kelas', 'jenisPerilaku'])
                ->where('id_guru', $guru->id_guru)
                ->latest()
                ->take(5)
                ->get(),
        ];

        return view('dashboard.guru', $data);
    }

    private function dashboardBK()
    {
        $data = [
            'laporanMenunggu' => LaporanPerilaku::where('status_verifikasi', 'menunggu')->count(),
            'laporanBulanIni' => LaporanPerilaku::whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->count(),
            'siswaRisiko' => Siswa::withSum('poinPelanggaran', 'poin')
                ->having('poin_pelanggaran_sum_poin', '>=', 50)
                ->with('kelas')
                ->orderBy('poin_pelanggaran_sum_poin', 'desc')
                ->take(10)
                ->get(),
            'laporanMenungguList' => LaporanPerilaku::with(['siswa.kelas', 'jenisPerilaku', 'guru'])
                ->where('status_verifikasi', 'menunggu')
                ->latest()
                ->take(10)
                ->get(),
        ];

        return view('dashboard.bk', $data);
    }

    private function dashboardKesiswaan()
    {
        $data = [
            'totalSiswa' => Siswa::where('status', 'aktif')->count(),
            'totalLaporan' => LaporanPerilaku::count(),
            'laporanBulanIni' => LaporanPerilaku::whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->count(),
            'totalSP' => SP::count(),
            'pelanggaranTerbanyak' => LaporanPerilaku::with('jenisPerilaku')
                ->selectRaw('id_jenis_perilaku, COUNT(*) as total')
                ->groupBy('id_jenis_perilaku')
                ->orderBy('total', 'desc')
                ->take(5)
                ->get(),
            'siswaRisiko' => Siswa::withSum('poinPelanggaran', 'poin')
                ->having('poin_pelanggaran_sum_poin', '>=', 50)
                ->with('kelas')
                ->orderBy('poin_pelanggaran_sum_poin', 'desc')
                ->take(10)
                ->get(),
        ];

        return view('dashboard.kesiswaan', $data);
    }

    private function dashboardSiswa()
    {
       $user = Auth::user();

       $siswa = $user->siswa;

       $siswa->load('kelas');
           
       $totalPoin = PoinPelanggaran::where('id_siswa', $siswa->id_siswa)
        ->whereHas('laporan', function ($query) {
            $query->where('status_verifikasi', 'disetujui');
        })
        ->sum('poin');

        $poinPelanggaran = PoinPelanggaran::where('id_siswa', $siswa->id_siswa)
        ->whereHas('laporan', function ($query) {
            $query->where('status_verifikasi', 'disetujui');
        })
        ->orderByDesc('tanggal')
        ->take(10)
        ->get();
        
        $totalLaporan = LaporanPerilaku::where(
        'id_siswa',
        $siswa->id_siswa
        )->count();

        $laporanTerbaru = LaporanPerilaku::with([ 
            'jenisPerilaku.kategori',
            'guru'
        ])
        ->where('id_siswa', $siswa->id_siswa)
        ->orderByDesc('tanggal_kejadian')
        ->take(5)
        ->get();
    
    return view('dashboard.siswa', compact(
        'siswa',
        'totalPoin',
        'totalLaporan',
        'laporanTerbaru',
        'poinPelanggaran'
    ));
    }
}
