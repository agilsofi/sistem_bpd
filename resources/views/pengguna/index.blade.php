@extends('layouts.app')

@section('title', 'Manajemen Pengguna')
@section('page-title', 'Manajemen Pengguna')

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
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Daftar Pengguna</h1>
            <p class="text-sm text-slate-500 mt-2">Kelola akun pengguna, role, dan hak akses sistem.</p>
        </div>
        
        <!-- Tombol Aksi -->
        <div class="flex items-center gap-3">
            <a href="{{ route('pengguna.create') }}" class="inline-flex items-center px-4 py-2.5 text-sm font-semibold text-white bg-blue-600 rounded-xl hover:bg-blue-700 transition-all shadow-md shadow-blue-500/20">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Tambah Pengguna
            </a>
        </div>
    </div>

    <!-- Card Filter Pencarian -->
    <form action="{{ route('pengguna.index') }}" method="GET" class="bg-slate-50/80 rounded-2xl border border-slate-200 p-6 shadow-sm backdrop-blur-sm">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-5 items-end">
            
            <!-- Input Pencarian -->
            <div class="md:col-span-5">
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Cari Pengguna</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Nama pengguna..." class="w-full pl-11 pr-4 h-[46px] text-sm border border-slate-300 rounded-xl focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all bg-white shadow-sm">
                </div>
            </div>
            
            <!-- Filter Role -->
            <div class="md:col-span-3">
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Role</label>
                <select name="role" class="w-full px-4 h-[46px] text-sm border border-slate-300 rounded-xl focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all bg-white shadow-sm cursor-pointer">
                    <option value="">Semua Role</option>
                    <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="guru" {{ request('role') == 'guru' ? 'selected' : '' }}>Guru</option>
                    <option value="bk" {{ request('role') == 'bk' ? 'selected' : '' }}>BK</option>
                    <option value="kesiswaan" {{ request('role') == 'kesiswaan' ? 'selected' : '' }}>Kesiswaan</option>
                    <option value="siswa" {{ request('role') == 'siswa' ? 'selected' : '' }}>Siswa</option>
                </select>
            </div>
            
            <!-- Tombol Aksi Filter -->
            <div class="md:col-span-4 flex justify-end gap-3">
                <a href="{{ route('pengguna.index') }}" class="px-6 h-[46px] flex items-center justify-center text-sm font-semibold text-slate-600 bg-white border border-slate-300 rounded-xl hover:bg-slate-50 transition-all shadow-sm">
                    Reset
                </a>
                <button type="submit" class="px-8 h-[46px] flex items-center justify-center text-sm font-semibold text-white bg-blue-600 rounded-xl hover:bg-blue-700 transition-all shadow-md shadow-blue-500/20">
                    Cari
                </button>
            </div>
        </div>
    </form>

    <!-- Card Tabel -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 text-slate-500 text-[11px] uppercase tracking-wider border-b border-slate-200">
                        <th class="px-6 py-4 font-bold w-16 text-center">No</th>
                        <th class="px-6 py-4 font-bold">Nama Pengguna</th>
                        <th class="px-6 py-4 font-bold text-center">Role</th>
                        <th class="px-6 py-4 font-bold">Pemilik Akun</th>
                        <th class="px-6 py-4 font-bold text-center">Status</th>
                        <th class="px-6 py-4 font-bold text-center w-48">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($users as $index => $u)
                    <tr class="hover:bg-slate-50/80 transition-colors group">
                        <td class="px-6 py-4 text-sm text-slate-400 text-center">{{ $index + 1 }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="w-9 h-9 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center text-sm font-bold mr-3 border border-blue-100">
                                    {{ substr($u->nama_tampil, 0, 1) }}
                                </div>
                                <span class="text-sm font-semibold text-slate-800">{{ $u->nama_tampil }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-md text-[11px] font-bold tracking-wide
                                {{ $u->role === 'admin' ? 'bg-purple-50 text-purple-600 border border-purple-100' : '' }}
                                {{ $u->role === 'guru' ? 'bg-blue-50 text-blue-600 border border-blue-100' : '' }}
                                {{ $u->role === 'bk' ? 'bg-amber-50 text-amber-600 border border-amber-100' : '' }}
                                {{ $u->role === 'kesiswaan' ? 'bg-indigo-50 text-indigo-600 border border-indigo-100' : '' }}
                                {{ $u->role === 'siswa' ? 'bg-emerald-50 text-emerald-600 border border-emerald-100' : '' }}">
                                {{ strtoupper($u->role) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-slate-600">
                            @if($u->guru)
                                {{ $u->guru->nama_guru }} (Guru)
                            @elseif($u->siswa)
                                {{ $u->siswa->nama }} (Siswa - {{ $u->siswa->NIS }})
                            @else
                                -
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-md text-[11px] font-bold tracking-wide
                                {{ $u->status === 'aktif' ? 'bg-emerald-50 text-emerald-600 border border-emerald-100' : 'bg-rose-50 text-rose-600 border border-rose-100' }}">
                                {{ strtoupper($u->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="inline-flex items-center bg-white border border-slate-200 rounded-lg shadow-sm overflow-hidden">
                                <!-- Tombol Edit -->
                                <a href="{{ route('pengguna.edit', $u->id_user) }}" class="flex items-center px-3 py-1.5 text-xs font-bold text-amber-700 bg-amber-50 hover:bg-amber-100 transition-colors" title="Edit Data">
                                    <svg class="w-3.5 h-3.5 mr-1.5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    Edit
                                </a>
                                
                                @if($u->id_user !== auth()->id())
                                <!-- Pemisah -->
                                <div class="w-px h-5 bg-slate-200"></div>
                                <!-- Tombol Hapus -->
                                <form action="{{ route('pengguna.destroy', $u->id_user) }}" method="POST" class="inline-block m-0" onsubmit="return confirm('Hapus pengguna ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="flex items-center px-3 py-1.5 text-xs font-bold text-rose-700 bg-rose-50 hover:bg-rose-100 transition-colors" title="Hapus Data">
                                        <svg class="w-3.5 h-3.5 mr-1.5 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        Hapus
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-16 text-center text-slate-500">
                            <div class="flex flex-col items-center justify-center">
                                <svg class="w-16 h-16 text-slate-200 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                                <span class="text-base font-semibold text-slate-600">Belum ada pengguna.</span>
                                <p class="text-sm text-slate-400 mt-1">Silakan tambah pengguna terlebih dahulu.</p>
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