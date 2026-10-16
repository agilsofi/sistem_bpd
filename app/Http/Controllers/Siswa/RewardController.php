<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Reward;
use App\Models\KreditReward;

class RewardController extends Controller
{
    public function index()
    {
        $siswa = Auth::user()->siswa;
        
        $kreditReward = KreditReward::where('id_siswa', $siswa->id_siswa)
            ->with(['jenisReward', 'pemberi'])
            ->orderByDesc('tanggal')
            ->get();

        $totalReward = $kreditReward->count();
        $totalKredit = $kreditReward->sum('kredit_poin');

        return view('siswa.reward.index', compact('kreditReward', 'totalReward', 'totalKredit'));
    }
}
