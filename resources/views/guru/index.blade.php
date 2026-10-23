@extends('layouts.app')

@section('title', 'Data Guru')
@section('page-title', 'Data Guru')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">

    <!-- Notifikasi Session -->
    @if(session('success'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-xl shadow-sm flex items-center">
            <svg class="w-5 h-5 mr-3 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-rose-50 border border-rose-200 text-rose-800 px-4 py-3 rounded-xl shadow-sm flex items-center">
            <svg class="w-5 h-5 mr-3 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            {{ session('error') }}
        </div>
    @endif

    <!-- Header Halaman -->
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Daftar Guru</h1>
            <p class="text-sm text-slate-500 mt-2">Kelola data guru dan wali kelas SMK Pembangunan Jaya.</p>
        </div>
        
        <!-- Tombol Aksi -->
        <div class="flex items-center gap-3">
            <!-- Tombol Import (Memanggil Modal) -->
            <button onclick="document.getElementById('importModal').classList.remove('hidden')" class="inline-flex items-center px-4 py-2.5 text-sm font-semibold text-emerald-700 bg-emerald-50 rounded-xl border border-emerald-200 hover:bg-emerald-100 transition-all shadow-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                Import Excel
            </button>
            <!-- Tombol Tambah -->
            <a href="{{ route('guru.create') }}" class="inline-flex items-center px-4 py-2.5 text-sm font-semibold text-white bg-blue-600 rounded-xl hover:bg-blue-700 transition-all shadow-md shadow-blue-500/20">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Tambah Guru
            </a>
        </div>
    </div>

    <!-- Card Filter Pencarian (Sudah Berfungsi) -->
    <form action="{{ route('guru.index') }}" method="GET" class="bg-slate-50/80 rounded-2xl border border-slate-200 p-6 shadow-sm backdrop-blur-sm">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-5 items-end">
            
            <!-- Input Pencarian -->
            <div class="md:col-span-5">
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Cari Guru</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="NUPTK atau Nama Guru..." class="w-full pl-11 pr-4 h-[46px] text-sm border border-slate-300 rounded-xl focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all bg-white shadow-sm">
                </div>
            </div>
            
            <!-- Filter Status -->
            <div class="md:col-span-3">
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Status</label>
                <select name="status" class="w-full px-4 h-[46px] text-sm border border-slate-300 rounded-xl focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all bg-white shadow-sm cursor-pointer">
                    <option value="">Semua Status</option>
                    <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="nonaktif" {{ request('status') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                </select>
            </div>
                       <!-- Tombol Aksi Filter (Di Pojok Kanan) -->
            <div class="md:col-span-4 flex justify-end gap-3">
                <a href="{{ route('guru.index') }}" class="px-6 h-[46px] text-sm font-semibold text-slate-600 bg-white border border-slate-300 rounded-xl hover:bg-slate-50 transition-all shadow-sm flex items-center justify-center">
                    Reset
                </a>
                <button type="submit" class="px-8 h-[46px] text-sm font-semibold text-white bg-blue-600 rounded-xl hover:bg-blue-700 transition-all shadow-md shadow-blue-500/20">
                    Cari
                </button>
            </div>
        </div>
    </div>

    <!-- Modal Import Excel (Fungsi Tetap Sama) -->
    <div id="importModal" class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm hidden flex items-center justify-center z-50">
        <div class="bg-white rounded-2xl shadow-xl p-6 max-w-md w-full mx-4 border border-slate-200">
            <h3 class="text-lg font-bold text-slate-800 mb-4">Import Data Guru</h3>
            <form method="POST" action="{{ route('guru.import') }}" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">File CSV</label>
                    <input type="file" name="file" accept=".csv,.txt" class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                    <p class="text-xs text-slate-500 mt-2">Format kolom: NUPTK, Nama_Guru, Jenis_Kelamin (L/P), Tempat_Lahir, Tanggal_Lahir (YYYY-MM-DD), No_Telepon, Email, Alamat</p>
                </div>
                <div class="flex gap-3 justify-end pt-2">
                    <button type="button" onclick="document.getElementById('importModal').classList.add('hidden')" class="px-4 py-2 text-sm font-semibold text-slate-600 bg-slate-100 rounded-lg hover:bg-slate-200 transition-colors">
                        Batal
                    </button>
                    <button type="submit" class="px-4 py-2 text-sm font-semibold text-white bg-emerald-600 rounded-lg hover:bg-emerald-700 transition-colors shadow-sm">
                        Import
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Card Tabel -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 text-slate-500 text-[11px] uppercase tracking-wider border-b border-slate-200">
                        <th class="px-6 py-4 font-bold w-16 text-center">No</th>
                        <th class="px-6 py-4 font-bold">NUPTK</th>
                        <th class="px-6 py-4 font-bold">Nama Guru</th>
                        <th class="px-6 py-4 font-bold text-center">Jenis Kelamin</th>
                        <th class="px-6 py-4 font-bold text-center">Wali Kelas</th>
                        <th class="px-6 py-4 font-bold text-center">Status</th>
                        <th class="px-6 py-4 font-bold text-center w-48">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($guru as $index => $item)
                    <tr class="hover:bg-slate-50/80 transition-colors group">
                        <td class="px-6 py-4 text-sm text-slate-400 text-center">{{ $index + 1 }}</td>
                        <td class="px-6 py-4 text-sm font-semibold text-slate-700">{{ $item->nuptk }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="w-9 h-9 rounded-full bg-indigo-50 text-indigo-600 flex items-center justify-center text-sm font-bold mr-3 border border-indigo-100">
                                    {{ substr($item->nama_guru, 0, 1) }}
                                </div>
                                <span class="text-sm font-semibold text-slate-800">{{ $item->nama_guru }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-slate-600 text-center">{{ $item->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                        <td class="px-6 py-4 text-sm text-slate-600 text-center">
                            @if($item->status_wali_kelas == 'ya')
                                <span class="inline-flex items-center px-2.5 py-1 rounded-md text-[11px] font-bold tracking-wide bg-blue-50 text-blue-600 border border-blue-100">
                                    YA
                                </span>
                            @else
                                <span class="text-slate-400">-</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-md text-[11px] font-bold tracking-wide
                                {{ $item->status == 'aktif' ? 'bg-emerald-50 text-emerald-600 border border-emerald-100' : 'bg-slate-100 text-slate-500 border border-slate-200' }}">
                                {{ strtoupper($item->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="inline-flex items-center bg-white border border-slate-200 rounded-lg shadow-sm overflow-hidden">
                                <!-- Tombol Edit -->
                                <a href="{{ route('guru.edit', $item->id_guru) }}" class="flex items-center px-3 py-1.5 text-xs font-bold text-amber-700 bg-amber-50 hover:bg-amber-100 transition-colors" title="Edit Data">
                                    <svg class="w-3.5 h-3.5 mr-1.5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    Edit
                                </a>
                                <!-- Pemisah -->
                                <div class="w-px h-5 bg-slate-200"></div>
                                <!-- Tombol Hapus -->
                                <form action="{{ route('guru.destroy', $item->id_guru) }}" method="POST" class="inline-block m-0" onsubmit="return confirm('Hapus data guru ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="flex items-center px-3 py-1.5 text-xs font-bold text-rose-700 bg-rose-50 hover:bg-rose-100 transition-colors" title="Hapus Data">
                                        <svg class="w-3.5 h-3.5 mr-1.5 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-16 text-center text-slate-500">
                            <div class="flex flex-col items-center justify-center">
                                <svg class="w-16 h-16 text-slate-200 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                                <span class="text-base font-semibold text-slate-600">Belum ada data guru.</span>
                                <p class="text-sm text-slate-400 mt-1">Silakan tambah data guru terlebih dahulu.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection