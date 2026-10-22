@extends('layouts.app')

@section('title', 'Data Siswa')
@section('page-title', 'Data Siswa')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">

    <!-- Judul Halaman -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-800 tracking-tight">Daftar Siswa</h1>
            <p class="text-sm text-slate-500 mt-1">Kelola data siswa SMK Pembangunan Jaya.</p>
        </div>
        
        <!-- Tombol Aksi Utama (Kanan Atas) -->
        <div class="flex items-center gap-3">
            <a href="#" class="inline-flex items-center px-4 py-2 text-sm font-semibold text-emerald-700 bg-emerald-50 rounded-lg border border-emerald-200 hover:bg-emerald-100 transition-colors shadow-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                Import Excel
            </a>
            <a href="{{ route('siswa.create') }}" class="inline-flex items-center px-4 py-2 text-sm font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-colors shadow-sm shadow-blue-500/30">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Tambah Siswa
            </a>
        </div>
    </div>

    <!-- CARD 1: Toolbar Filter Pencarian -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-5">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">
            
            <!-- Input Pencarian -->
            <div class="md:col-span-4">
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Cari Siswa</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <input type="text" placeholder="NIS atau Nama..." class="w-full pl-10 pr-4 py-2.5 text-sm border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all bg-slate-50 focus:bg-white">
                </div>
            </div>
            
            <!-- Filter Kelas -->
            <div class="md:col-span-3">
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Kelas</label>
                <select class="w-full px-4 py-2.5 text-sm border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all bg-slate-50 focus:bg-white">
                    <option>Semua Kelas</option>
                </select>
            </div>
            
            <!-- Filter Status -->
            <div class="md:col-span-3">
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Status</label>
                <select class="w-full px-4 py-2.5 text-sm border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all bg-slate-50 focus:bg-white">
                    <option>Semua Status</option>
                    <option>Aktif</option>
                    <option>Lulus</option>
                </select>
            </div>
            
            <!-- Tombol Cari & Reset -->
            <div class="md:col-span-2 flex gap-2">
                <button type="button" class="w-full px-4 py-2.5 text-sm font-medium text-slate-600 bg-slate-100 rounded-lg hover:bg-slate-200 transition-colors border border-transparent">
                    Reset
                </button>
                <button type="button" class="w-full px-4 py-2.5 text-sm font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-colors shadow-sm">
                    Cari
                </button>
            </div>
        </div>
    </div>

    <!-- CARD 2: Tabel Data -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 text-slate-500 text-[11px] uppercase tracking-wider border-b border-slate-200">
                        <th class="px-6 py-4 font-bold w-16 text-center">No</th>
                        <th class="px-6 py-4 font-bold">NIS</th>
                        <th class="px-6 py-4 font-bold">Nama Siswa</th>
                        <th class="px-6 py-4 font-bold">Kelas</th>
                        <th class="px-6 py-4 font-bold text-center">JK</th>
                        <th class="px-6 py-4 font-bold text-center">Status</th>
                        <th class="px-6 py-4 font-bold text-center w-48">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($siswa as $index => $s)
                    <tr class="hover:bg-slate-50/80 transition-colors group">
                        <td class="px-6 py-4 text-sm text-slate-400 text-center">{{ $index + 1 }}</td>
                        <td class="px-6 py-4 text-sm font-semibold text-slate-700">{{ $s->NIS }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="w-9 h-9 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center text-sm font-bold mr-3 border border-blue-100">
                                    {{ substr($s->nama, 0, 1) }}
                                </div>
                                <span class="text-sm font-semibold text-slate-800">{{ $s->nama }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-slate-600">{{ $s->kelas->nama_kelas ?? '-' }}</td>
                        <td class="px-6 py-4 text-sm font-medium text-slate-600 text-center">{{ $s->jenis_kelamin }}</td>
                        <td class="px-6 py-4 text-center">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-md text-[11px] font-bold tracking-wide
                                {{ $s->status == 'aktif' ? 'bg-emerald-50 text-emerald-600 border border-emerald-100' : 'bg-slate-100 text-slate-500 border border-slate-200' }}">
                                {{ strtoupper($s->status) }}
                            </span>
                        </td>
                                                <td class="px-6 py-4 text-center">
                            <!-- Segmented Action Group (Langsung Berwarna) -->
                            <div class="inline-flex items-center bg-white border border-slate-200 rounded-lg shadow-sm overflow-hidden">
                                
                                <!-- Tombol Lihat (Biru) -->
                                <a href="{{ route('siswa.show', $s->id_siswa) }}" class="flex items-center px-3 py-1.5 text-xs font-bold text-blue-700 bg-blue-50 hover:bg-blue-100 transition-colors" title="Lihat Detail">
                                    <svg class="w-3.5 h-3.5 mr-1.5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    Lihat
                                </a>

                                <!-- Garis Pemisah -->
                                <div class="w-px h-6 bg-slate-200"></div>

                                <!-- Tombol Edit (Kuning) -->
                                <a href="{{ route('siswa.edit', $s->id_siswa) }}" class="flex items-center px-3 py-1.5 text-xs font-bold text-amber-700 bg-amber-50 hover:bg-amber-100 transition-colors" title="Edit Data">
                                    <svg class="w-3.5 h-3.5 mr-1.5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    Edit
                                </a>

                                <!-- Garis Pemisah -->
                                <div class="w-px h-6 bg-slate-200"></div>

                                <!-- Tombol Hapus (Merah) -->
                                <form action="{{ route('siswa.destroy', $s->id_siswa) }}" method="POST" class="inline-block m-0" onsubmit="return confirm('Yakin ingin menghapus data siswa ini?');">
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
                        <td colspan="7" class="px-6 py-12 text-center text-slate-500">
                            <div class="flex flex-col items-center justify-center">
                                <svg class="w-12 h-12 text-slate-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                                <span class="text-sm font-medium">Belum ada data siswa.</span>
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