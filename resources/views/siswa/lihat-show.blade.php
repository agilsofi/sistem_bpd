@extends('layouts.app')

@section('title', 'Detail Siswa')
@section('page-title', 'Detail Siswa')

@section('content')
<div class="max-w-2xl bg-white rounded-lg border border-gray-200 p-6">
    <div class="space-y-4">
        <div>
            <p class="text-sm text-gray-500">NIS</p>
            <p class="font-medium text-gray-900">{{ $siswa->NIS }}</p>
        </div>
        <div>
            <p class="text-sm text-gray-500">Nama</p>
            <p class="font-medium text-gray-900">{{ $siswa->nama }}</p>
        </div>
        <div>
            <p class="text-sm text-gray-500">Jenis Kelamin</p>
            <p class="font-medium text-gray-900">{{ $siswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
        </div>
        <div>
            <p class="text-sm text-gray-500">Tanggal Lahir</p>
            <p class="font-medium text-gray-900">{{ $siswa->tanggal_lahir?->format('d/m/Y') ?? '-' }}</p>
        </div>
        <div>
            <p class="text-sm text-gray-500">Kelas</p>
            <p class="font-medium text-gray-900">{{ $siswa->kelas->nama_kelas ?? '-' }}</p>
        </div>
        @if($siswa->kelas && $siswa->kelas->jurusan)
        <div>
            <p class="text-sm text-gray-500">Jurusan</p>
            <p class="font-medium text-gray-900">{{ $siswa->kelas->jurusan->nama_jurusan }}</p>
        </div>
        @endif
        <div>
            <p class="text-sm text-gray-500">Status</p>
            <span class="px-2 py-1 text-xs rounded font-medium
                {{ $siswa->status == 'aktif' ? 'bg-green-100 text-green-800' : '' }}
                {{ $siswa->status == 'lulus' ? 'bg-blue-100 text-blue-800' : '' }}
                {{ $siswa->status == 'dropout' ? 'bg-red-100 text-red-800' : '' }}
                {{ $siswa->status == 'pindah' ? 'bg-gray-100 text-gray-800' : '' }}">
                {{ ucfirst($siswa->status) }}
            </span>
        </div>
    </div>
    <div class="mt-6">
        
    <!-- Garis Pembatas -->
<hr class="my-4 border-gray-200">

<!-- Section Data Orang Tua -->
<div class="space-y-4 mb-6">
    <!-- Label Judul -->
    <div class="text-sm font-medium text-gray-500">Data Orang Tua</div>

    <div>
        <div class="text-sm text-gray-500 mb-1">Nama Ayah</div>
        <div class="font-medium text-gray-900">{{ $siswa->nama_ayah ?? '-' }}</div>
    </div>

    <div>
        <div class="text-sm text-gray-500 mb-1">Pekerjaan Ayah</div>
        <div class="font-medium text-gray-900">{{ $siswa->pekerjaan_ayah ?? '-' }}</div>
    </div>

    <div>
        <div class="text-sm text-gray-500 mb-1">Nama Ibu</div>
        <div class="font-medium text-gray-900">{{ $siswa->nama_ibu ?? '-' }}</div>
    </div>

    <div>
        <div class="text-sm text-gray-500 mb-1">Pekerjaan Ibu</div>
        <div class="font-medium text-gray-900">{{ $siswa->pekerjaan_ibu ?? '-' }}</div>
    </div>

    <div>
        <div class="text-sm text-gray-500 mb-1">No. HP Orang Tua</div>
        <div class="font-medium text-gray-900">{{ $siswa->no_hp_orang_tua ?? '-' }}</div>
    </div>
</div>

<!-- Section Alamat -->
<div class="mb-6">
    <div class="text-sm text-gray-500 mb-1">Alamat</div>
    <div class="font-medium text-gray-900">{{ $siswa->alamat ?? '-' }}</div>
</div>


        <a href="{{ route('siswa.lihat') }}" class="px-4 py-2 bg-gray-600 text-white rounded-lg">Kembali</a>
    </div>
</div>
@endsection
