@extends('layouts.app')

@section('title', 'Surat Peringatan')
@section('page-title', 'Surat Peringatan')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">

    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Daftar Surat Peringatan</h1>
            <p class="text-sm text-slate-500 mt-2">Kelola data surat peringatan siswa SMK Pembangunan Jaya.</p>
        </div>
        
        <div class="flex items-center gap-3">
            <!-- TOMBOL INI SUDAH DIUBAH AGAR BISA DIKLIK -->
            <a href="{{ route('surat-peringatan.create') }}" class="inline-flex items-center px-4 py-2.5 text-sm font-semibold text-white bg-blue-600 rounded-xl hover:bg-blue-700 transition-all shadow-md shadow-blue-500/20">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Buat Surat Peringatan
            </a>
        </div>
    </div>

    <form action="#" method="GET" class="bg-slate-50/80 rounded-2xl border border-slate-200 p-6 shadow-sm backdrop-blur-sm">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-5 items-end">
            <div class="md:col-span-5">
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Cari Siswa</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <input type="text" name="search" placeholder="NIS atau nama siswa..." class="w-full pl-11 pr-4 h-[46px] text-sm border border-slate-300 rounded-xl focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all bg-white shadow-sm">
                </div>
            </div>
            
            <div class="md:col-span-3">
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Tingkat SP</label>
                <select name="tingkat" class="w-full px-4 h-[46px] text-sm border border-slate-300 rounded-xl focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all bg-white shadow-sm cursor-pointer">
                    <option value="">Semua Tingkat</option>
                    <option value="SP1">SP 1</option>
                    <option value="SP2">SP 2</option>
                    <option value="SP3">SP 3</option>
                </select>
            </div>
            
            <div class="md:col-span-4 flex justify-end gap-3">
                <a href="{{ route('surat-peringatan.index') }}" class="px-6 h-[46px] flex items-center justify-center text-sm font-semibold text-slate-600 bg-white border border-slate-300 rounded-xl hover:bg-slate-50 transition-all shadow-sm">
                    Reset
                </a>
                <button type="submit" class="px-8 h-[46px] flex items-center justify-center text-sm font-semibold text-white bg-blue-600 rounded-xl hover:bg-blue-700 transition-all shadow-md shadow-blue-500/20">
                    Cari
                </button>
            </div>
        </div>
    </form>

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-center border-collapse">
                <thead>
                    <tr class="bg-slate-50 text-slate-500 text-[11px] uppercase tracking-wider border-b border-slate-200">
                        <th class="px-4 py-4 font-bold w-16">No</th>
                        <th class="px-4 py-4 font-bold">Tanggal</th>
                        <th class="px-4 py-4 font-bold">Siswa</th>
                        <th class="px-4 py-4 font-bold">Tingkat SP</th>
                        <th class="px-4 py-4 font-bold">Alasan / Pelanggaran</th>
                        <th class="px-4 py-4 font-bold w-56">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <tr class="hover:bg-slate-50/80 transition-colors group">
                        <td class="px-4 py-4 text-sm text-slate-400">1</td>
                        <td class="px-4 py-4 text-sm font-medium text-slate-700">23/10/2026</td>
                        <td class="px-4 py-4">
                            <div class="flex flex-col items-center justify-center">
                                <span class="text-sm font-semibold text-slate-800">Faiz Akbar Rizqi</span>
                                <span class="text-xs text-slate-500 mt-0.5">2026005 | XI PPLG 1</span>
                            </div>
                        </td>
                        <td class="px-4 py-4">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-md text-[11px] font-bold tracking-wide bg-rose-50 text-rose-600 border border-rose-100">
                                SP 1
                            </span>
                        </td>
                        <td class="px-4 py-4 text-sm text-slate-600">Terlambat masuk kelas lebih dari 3 kali</td>
                        <td class="px-4 py-4">
                            <div class="inline-flex items-center bg-white border border-slate-200 rounded-lg shadow-sm overflow-hidden">
                                <a href="#" class="flex items-center px-3 py-1.5 text-xs font-bold text-blue-700 bg-blue-50 hover:bg-blue-100 transition-colors">
                                    <svg class="w-3.5 h-3.5 mr-1.5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    Lihat
                                </a>
                                <div class="w-px h-5 bg-slate-200"></div>
                                <a href="#" class="flex items-center px-3 py-1.5 text-xs font-bold text-rose-700 bg-rose-50 hover:bg-rose-100 transition-colors">
                                    <svg class="w-3.5 h-3.5 mr-1.5 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    Hapus
                                </a>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection