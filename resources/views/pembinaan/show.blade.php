@extends('layouts.app')

@section('title', 'Detail Pembinaan')
@section('page-title', 'Detail Pembinaan')

@section('content')
<div class="max-w-2xl bg-white rounded-lg border border-gray-200 p-6">
    <div class="space-y-4">
        <div class="grid grid-cols-2 gap-4">
            <div>
                <p class="text-sm text-gray-600">Siswa</p>
                <p class="font-medium text-gray-900">{{ $pembinaan->siswa->nama }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600">NIS</p>
                <p class="font-medium text-gray-900">{{ $pembinaan->siswa->NIS }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600">Kelas</p>
                <p class="font-medium text-gray-900">{{ $pembinaan->siswa->kelas->nama_kelas ?? '-' }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600">Tanggal Pembinaan</p>
                <p class="font-medium text-gray-900">{{ $pembinaan->tanggal->format('d/m/Y') }}</p>
            </div>
        </div>

        <div>
            <p class="text-sm text-gray-600">Jenis Pembinaan</p>
            <p class="font-medium">
                <span class="px-2 py-1 text-xs rounded bg-blue-100 text-blue-800">{{ ucfirst($pembinaan->jenis_pembinaan) }}</span>
            </p>
        </div>

        <div>
            <p class="text-sm text-gray-600">Pembina</p>
            <p class="font-medium text-gray-900">{{ $pembinaan->pembina->nama_guru }}</p>
        </div>

        <div>
            <p class="text-sm text-gray-600">Alasan Pembinaan</p>
            <p class="text-gray-900 bg-gray-50 p-3 rounded border border-gray-200">{{ $pembinaan->alasan }}</p>
        </div>

        @if($pembinaan->hasil)
        <div>
            <p class="text-sm text-gray-600">Hasil Pembinaan</p>
            <p class="text-gray-900 bg-gray-50 p-3 rounded border border-gray-200">{{ $pembinaan->hasil }}</p>
        </div>
        @endif

        @if($pembinaan->tindak_lanjut)
        <div>
            <p class="text-sm text-gray-600">Tindak Lanjut</p>
            <p class="text-gray-900 bg-gray-50 p-3 rounded border border-gray-200">{{ $pembinaan->tindak_lanjut }}</p>
        </div>
        @endif

        @if($pembinaan->keterangan)
        <div>
            <p class="text-sm text-gray-600">Keterangan</p>
            <p class="text-gray-900">{{ $pembinaan->keterangan }}</p>
        </div>
        @endif
    </div>

    <div class="mt-6 flex gap-2">
        <a href="{{ route('pembinaan.edit', $pembinaan->id_pembinaan) }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg">Edit</a>
        <a href="{{ route('pembinaan.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded-lg">Kembali</a>
    </div>
</div>
@endsection
