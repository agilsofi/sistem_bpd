@extends('layouts.app')

@section('title', 'Kredit Reward')
@section('page-title', 'Kredit Reward')

@section('content')
<div class="space-y-6">
    <div class="bg-white rounded-lg border border-gray-200 p-6">
        <h3 class="text-lg font-medium text-gray-900">Total Kredit Reward</h3>
        <p class="text-4xl font-bold text-green-600">{{ $totalKredit }}</p>
        <p class="text-sm text-gray-600 mt-1">Dari {{ $totalReward }} reward</p>
    </div>

    <div class="bg-white rounded-lg border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">Riwayat Kredit</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jenis Reward</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Alasan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Pemberi</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Poin</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($kreditReward as $item)
                    <tr>
                        <td class="px-6 py-4 text-sm text-gray-900">{{ $item->tanggal->format('d/m/Y') }}</td>
                        <td class="px-6 py-4 text-sm text-gray-900">{{ $item->jenisReward->nama_reward ?? '-' }}</td>
                        <td class="px-6 py-4 text-sm text-gray-900">{{ $item->alasan }}</td>
                        <td class="px-6 py-4 text-sm text-gray-900">{{ $item->pemberi->nama_guru ?? '(Tidak diketahui)' }}</td>
                        <td class="px-6 py-4 text-sm font-medium text-green-600 text-right">+{{ $item->kredit_poin }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-gray-500 text-sm">Belum ada kredit reward.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
