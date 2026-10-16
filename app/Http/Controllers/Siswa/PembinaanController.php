<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Pembinaan;

class PembinaanController extends Controller
{
    public function index()
    {
        $siswa = Auth::user()->siswa;
        
        $riwayatPembinaan = Pembinaan::where('id_siswa', $siswa->id_siswa)
            ->with(['pembina'])
            ->orderByDesc('tanggal')
            ->get();

        $totalPembinaan = $riwayatPembinaan->count();

        return view('siswa.pembinaan.index', compact('riwayatPembinaan', 'totalPembinaan'));
    }
}
