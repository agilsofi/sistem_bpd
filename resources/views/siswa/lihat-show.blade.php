@extends('layouts.app')

@section('title', 'Detail Siswa')
@section('page-title', 'Detail Siswa')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Card Utama -->
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
        
        <!-- Header Card -->
        <div class="bg-gray-50 px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <h3 class="text-lg font-bold text-gray-800">Informasi Siswa</h3>
            <!-- Status Badge -->
            <span class="px-3 py-1 text-xs font-semibold rounded-full 
                {{ $siswa->status == 'aktif' ? 'bg-green-100 text-green-700' : '' }}
                {{ $siswa->status == 'lulus' ? 'bg-blue-100 text-blue-700' : '' }}
                {{ $siswa->status == 'dropout' ? 'bg-red-100 text-red-700' : '' }}
                {{ $siswa->status == 'pindah' ? 'bg-gray-100 text-gray-700' : '' }}">
                {{ ucfirst($siswa->status) }}
            </span>
        </div>

        <div class="p-6">
            <!-- BAGIAN 1: DATA DIRI (Grid 2 Kolom) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div>
                    <p class="text-sm font-medium text-gray-500 mb-1">NIS</p>
                    <p class="text-base font-semibold text-gray-900">{{ $siswa->NIS }}</p>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500 mb-1">Nama Lengkap</p>
                    <p class="text-base font-semibold text-gray-900">{{ $siswa->nama }}</p>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500 mb-1">Jenis Kelamin</p>
                    <p class="text-base text-gray-900">{{ $siswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500 mb-1">Tanggal Lahir</p>
                    <p class="text-base text-gray-900">{{ $siswa->tanggal_lahir ? $siswa->tanggal_lahir->format('d/m/Y') : '-' }}</p>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500 mb-1">Kelas</p>
                    <p class="text-base text-gray-900">{{ $siswa->kelas->nama_kelas ?? '-' }}</p>
                </div>
                @if($siswa->kelas && $siswa->kelas->jurusan)
                <div>
                    <p class="text-sm font-medium text-gray-500 mb-1">Jurusan</p>
                    <p class="text-base text-gray-900">{{ $siswa->kelas->jurusan->nama_jurusan }}</p>
                </div>
                @endif
            </div>

            <hr class="border-gray-200 mb-8">

            <!-- BAGIAN 2: DATA ORANG TUA (Grid 2 Kolom) -->
            <h4 class="text-md font-bold text-gray-800 mb-4">Data Orang Tua / Wali</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div>
                    <p class="text-sm font-medium text-gray-500 mb-1">Nama Ayah</p>
                    <p class="text-base text-gray-900">{{ $siswa->nama_ayah ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500 mb-1">Pekerjaan Ayah</p>
                    <p class="text-base text-gray-900">{{ $siswa->pekerjaan_ayah ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500 mb-1">Nama Ibu</p>
                    <p class="text-base text-gray-900">{{ $siswa->nama_ibu ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500 mb-1">Pekerjaan Ibu</p>
                    <p class="text-base text-gray-900">{{ $siswa->pekerjaan_ibu ?? '-' }}</p>
                </div>
                <div class="md:col-span-2">
                    <p class="text-sm font-medium text-gray-500 mb-1">No. HP Orang Tua / Wali</p>
                    <p class="text-base text-gray-900">{{ $siswa->no_hp_orang_tua ?? '-' }}</p>
                </div>
            </div>

            <hr class="border-gray-200 mb-8">

            <!-- BAGIAN 3: ALAMAT -->
            <h4 class="text-md font-bold text-gray-800 mb-4">Alamat Domisili</h4>
            <div class="bg-gray-50 p-4 rounded-lg border border-gray-100">
                <p class="text-base text-gray-900 leading-relaxed">{{ $siswa->alamat ?? 'Belum ada data alamat.' }}</p>
            </div>

        </div>

        <!-- Footer: Tombol Kembali -->
        <div class="bg-gray-50 px-6 py-4 border-t border-gray-200 flex justify-end">
            <a href="{{ route('siswa.lihat') }}" class="px-5 py-2.5 bg-gray-600 text-white font-medium rounded-lg shadow-sm hover:bg-gray-700 transition">
                Kembali
            </a>
        </div>
    </div>
</div>
@endsection