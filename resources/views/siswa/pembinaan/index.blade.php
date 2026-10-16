@extends('layouts.app')

@section('title', 'Riwayat Pembinaan')
@section('page-title', 'Riwayat Pembinaan')

@section('content')
<div class="space-y-6">
    <div class="bg-white rounded-lg border border-gray-200 p-6">
        <h3 class="text-lg font-medium text-gray-900">Total Pembinaan</h3>
        <p class="text-4xl font-bold text-blue-600">{{ $totalPembinaan }}</p>
    </div>

    <div class="bg-white rounded-lg border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">Daftar Pembinaan</h3>
        </div>
        <ul class="divide-y divide-gray-200">
            @forelse($riwayatPembinaan as $item)
            <li class="p-6 hover:bg-gray-50">
                <div class="flex justify-between items-start mb-2">
                    <div>
                        <p class="text-sm font-medium text-gray-900">{{ ucfirst($item->jenis_pembinaan) }}</p>
                        <p class="text-xs text-gray-500">
                            {{ $item->tanggal->format('d/m/Y') }}
                            • Pembina: {{ $item->pembina->nama_guru ?? '-' }}
                        </p>
                    </div>
                </div>
                <p class="text-sm text-gray-600 mt-2"><span class="font-medium">Alasan:</span> {{ $item->alasan }}</p>
                @if($item->hasil)
                <p class="text-sm text-gray-600 mt-1"><span class="font-medium">Hasil:</span> {{ $item->hasil }}</p>
                @endif
                @if($item->tindak_lanjut)
                <p class="text-sm text-gray-600 mt-1"><span class="font-medium">Tindak Lanjut:</span> {{ $item->tindak_lanjut }}</p>
                @endif
                @if($item->keterangan)
                <p class="text-sm text-gray-600 mt-1"><span class="font-medium">Keterangan:</span> {{ $item->keterangan }}</p>
                @endif
            </li>
            @empty
            <li class="p-6 text-center text-gray-500 text-sm">Belum ada riwayat pembinaan.</li>
            @endforelse
        </ul>
    </div>
</div>
@endsection
