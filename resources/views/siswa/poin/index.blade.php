@extends('layouts.app')

@section('title', 'Riwayat Poin Pelanggaran')
@section('page-title', 'Riwayat Poin Pelanggaran')

@section('content')
<div class="bg-white rounded-lg border border-gray-200 p-6 mb-6">
    <h3 class="text-lg font-medium text-gray-900">Total Poin Saat Ini</h3>
    <p class="text-4xl font-bold {{ $totalPoin > 50 ? 'text-red-600' : ($totalPoin > 0 ? 'text-yellow-600' : 'text-green-600') }}">
        {{ $totalPoin }}
    </p>
</div>

<div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jenis Pelanggaran</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Pemberi</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Poin</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($riwayatPoin as $item)
            <tr>
                <td class="px-6 py-4 text-sm text-gray-900">{{ $item->tanggal->format('d/m/Y') }}</td>
                <td class="px-6 py-4 text-sm text-gray-900">{{ $item->laporan->jenisPerilaku->nama_perilaku }}</td>
                <td class="px-6 py-4 text-sm text-gray-900">{{ $item->pemberi->nama_guru }}</td>
                <td class="px-6 py-4 text-sm font-medium text-red-600 text-right">+{{ $item->poin }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="px-6 py-8 text-center text-gray-500 text-sm">Belum ada riwayat poin.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
