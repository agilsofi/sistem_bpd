@extends('layouts.app')

@section('title', 'Pembinaan')
@section('page-title', 'Data Pembinaan')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">

    <!-- Notifikasi Session -->
    @if(session('success'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-xl shadow-sm flex items-center">
            <svg class="w-5 h-5 mr-3 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            {{ session('success') }}
        </div>
    @endif

    <!-- Header Halaman -->
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Daftar Pembinaan</h1>
            <p class="text-sm text-slate-500 mt-2">Kelola catatan pembinaan dan tindak lanjut siswa.</p>
        </div>
        
        <!-- Tombol Aksi -->
        <div class="flex items-center gap-3">
            <a href="{{ route('pembinaan.create') }}" class="inline-flex items-center px-4 py-2.5 text-sm font-semibold text-white bg-blue-600 rounded-xl hover:bg-blue-700 transition-all shadow-md shadow-blue-500/20">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Tambah Pembinaan
            </a>
        </div>
    </div>

    <!-- Card Filter Pencarian -->
    <form action="{{ route('pembinaan.index') }}" method="GET" class="bg-slate-50/80 rounded-2xl border border-slate-200 p-6 shadow-sm backdrop-blur-sm">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-5 items-end">
            
            <!-- Input Pencarian Siswa -->
            <div class="md:col-span-4">
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Cari Siswa</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <input type="text" name="id_siswa" value="{{ request('id_siswa') }}" placeholder="NIS atau nama siswa..." class="w-full pl-11 pr-4 h-[46px] text-sm border border-slate-300 rounded-xl focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all bg-white shadow-sm">
                </div>
            </div>
            
            <!-- Filter Tanggal Dari -->
            <div class="md:col-span-3">
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Dari Tanggal</label>
                <input type="date" name="tanggal_dari" value="{{ request('tanggal_dari') }}" class="w-full px-4 h-[46px] text-sm border border-slate-300 rounded-xl focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all bg-white shadow-sm cursor-pointer">
            </div>

            <!-- Filter Tanggal Sampai -->
            <div class="md:col-span-3">
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Sampai Tanggal</label>
                <input type="date" name="tanggal_sampai" value="{{ request('tanggal_sampai') }}" class="w-full px-4 h-[46px] text-sm border border-slate-300 rounded-xl focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all bg-white shadow-sm cursor-pointer">
            </div>
            
            <!-- Tombol Aksi Filter -->
            <div class="md:col-span-2 flex justify-end gap-2">
                <button type="submit" class="px-5 h-[46px] flex items-center justify-center text-sm font-semibold text-white bg-blue-600 rounded-xl hover:bg-blue-700 transition-all shadow-md shadow-blue-500/20">
                    Cari
                </button>
                <a href="{{ route('pembinaan.index') }}" class="px-5 h-[46px] flex items-center justify-center text-sm font-semibold text-slate-600 bg-white border border-slate-300 rounded-xl hover:bg-slate-50 transition-all shadow-sm">
                    Reset
                </a>
            </div>
        </div>
    </form>

    <!-- Card Tabel -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
                        <table class="w-full text-center border-collapse">
                <thead>
                    <tr class="bg-slate-50 text-slate-500 text-[11px] uppercase tracking-wider border-b border-slate-200">
                        <th class="px-4 py-4 font-bold w-16">No</th>
                        <th class="px-4 py-4 font-bold w-32">Tanggal</th>
                        <th class="px-4 py-4 font-bold">Siswa</th>
                        <th class="px-4 py-4 font-bold">Jenis</th>
                        <th class="px-4 py-4 font-bold">Alasan</th>
                        <th class="px-4 py-4 font-bold">Pembina</th>
                        <th class="px-4 py-4 font-bold w-56">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($pembinaan as $index => $item)
                    <tr class="hover:bg-slate-50/80 transition-colors group">
                        
                        <!-- No -->
                        <td class="px-4 py-4 text-sm text-slate-400">
                            {{ $index + 1 }}
                        </td>
                        
                        <!-- Tanggal -->
                        <td class="px-4 py-4 text-sm font-medium text-slate-700 whitespace-nowrap">
                            {{ $item->tanggal->format('d/m/Y') }}
                        </td>
                        
                        <!-- Siswa (Nama dan NIS di tengah) -->
                        <td class="px-4 py-4">
                            <div class="flex flex-col items-center justify-center">
                                <span class="text-sm font-semibold text-slate-800">{{ $item->siswa->nama }}</span>
                                <span class="text-xs text-slate-500 mt-0.5">{{ $item->siswa->NIS }} | {{ $item->siswa->kelas->nama_kelas ?? '-' }}</span>
                            </div>
                        </td>
                        
                        <!-- Jenis -->
                        <td class="px-4 py-4">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-md text-[11px] font-bold tracking-wide bg-blue-50 text-blue-600 border border-blue-100">
                                {{ ucfirst($item->jenis_pembinaan) }}
                            </span>
                        </td>
                        
                        <!-- Alasan -->
                        <td class="px-4 py-4 text-sm text-slate-600">
                            {{ Str::limit($item->alasan, 50) }}
                        </td>
                        
                        <!-- Pembina -->
                        <td class="px-4 py-4 text-sm text-slate-600">
                            {{ $item->pembina->nama_guru }}
                        </td>
                        
                        <!-- Aksi -->
                        <td class="px-4 py-4">
                            <div class="inline-flex items-center bg-white border border-slate-200 rounded-lg shadow-sm overflow-hidden">
                                <a href="{{ route('pembinaan.show', $item->id_pembinaan) }}" class="flex items-center px-3 py-1.5 text-xs font-bold text-blue-700 bg-blue-50 hover:bg-blue-100 transition-colors" title="Lihat Detail">
                                    <svg class="w-3.5 h-3.5 mr-1.5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    Lihat
                                </a>
                                <div class="w-px h-5 bg-slate-200"></div>
                                <a href="{{ route('pembinaan.edit', $item->id_pembinaan) }}" class="flex items-center px-3 py-1.5 text-xs font-bold text-amber-700 bg-amber-50 hover:bg-amber-100 transition-colors" title="Edit Data">
                                    <svg class="w-3.5 h-3.5 mr-1.5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    Edit
                                </a>
                                <div class="w-px h-5 bg-slate-200"></div>
                                <form action="{{ route('pembinaan.destroy', $item->id_pembinaan) }}" method="POST" class="inline-block m-0" onsubmit="return confirm('Hapus data pembinaan ini?')">
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
                                <span class="text-base font-semibold text-slate-600">Tidak ada data pembinaan.</span>
                                <p class="text-sm text-slate-400 mt-1">Silakan tambah data pembinaan terlebih dahulu.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $pembinaan->links() }}
    </div>
</div>
@endsection