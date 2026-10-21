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

        <hr class="my-4 border-gray-200">
        <h4 class="font-medium text-gray-900 mb-4">Data Orang Tua & Alamat</h4>

        <div>
            <p class="text-sm text-gray-500">Nama Ayah</p>
            <p class="font-medium text-gray-900">{{ $siswa->nama_ayah ?? '-' }}</p>
        </div>
        <div>
            <p class="text-sm text-gray-500">Pekerjaan Ayah</p>
            <p class="font-medium text-gray-900">{{ $siswa->pekerjaan_ayah ?? '-' }}</p>
        </div>
        <div>
            <p class="text-sm text-gray-500">Nama Ibu</p>
            <p class="font-medium text-gray-900">{{ $siswa->nama_ibu ?? '-' }}</p>
        </div>
        <div>
            <p class="text-sm text-gray-500">Pekerjaan Ibu</p>
            <p class="font-medium text-gray-900">{{ $siswa->pekerjaan_ibu ?? '-' }}</p>
        </div>
        <div>
            <p class="text-sm text-gray-500">No. HP Orang Tua</p>
            <p class="font-medium text-gray-900">{{ $siswa->no_hp_orang_tua ?? '-' }}</p>
        </div>
        <div>
            <p class="text-sm text-gray-500">Alamat Lengkap</p>
            <p class="font-medium text-gray-900">{{ $siswa->alamat ?? '-' }}</p>
        </div>
    </div>
    <div class="mt-6 flex gap-2">
        <a href="{{ route('siswa.edit', $siswa->id_siswa) }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg">Edit</a>
        <a href="{{ route('siswa.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded-lg">Kembali</a>
    </div>
</div>
@endsection
