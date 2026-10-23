<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - Sistem BPD</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 flex h-screen overflow-hidden">

    <!-- ========================================== -->
    <!-- SIDEBAR (Hanya satu, warna gelap)          -->
    <!-- ========================================== -->
    
        <!-- SIDEBAR MODERN (Clean Light Mode) -->
    <aside class="w-64 bg-white text-slate-600 flex flex-col shadow-lg z-20 flex-shrink-0 border-r border-slate-200">
        
                <!-- Header Sidebar -->
        <div class="h-[73px] px-4 border-b border-slate-200 bg-white flex items-center gap-3">
            <!-- Logo (Ukuran Tetap) -->
            <div class="bg-slate-50 p-1 rounded-full border border-slate-200 shadow-sm flex-shrink-0">
                <img src="{{ asset('images/logo-sekolah.png') }}" alt="Logo" class="h-9 w-9 object-contain">
            </div>
            
            <!-- Teks (Otomatis Menyesuaikan) -->
            <div class="flex flex-col justify-center min-w-0">
                <h1 class="text-sm font-bold text-slate-800 tracking-tight leading-tight truncate">
                    Sistem Buku Peserta Didik
                </h1>
                <p class="text-[10px] text-slate-500 mt-0.5 truncate">SMK Pembangunan Jaya</p>
            </div>
        </div>

        <!-- Menu Navigasi -->
        <nav class="flex-1 p-4 overflow-y-auto custom-scrollbar">
            <ul class="space-y-1.5">
                <li>
                    <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('dashboard') ? 'bg-blue-50 text-blue-700 shadow-sm border border-blue-100' : 'hover:bg-slate-50 hover:text-slate-900' }}">
                        <span>Dashboard</span>
                    </a>
                </li>
                
                @if(auth()->user()->role === 'admin')
                    <li>
                        <button type="button" onclick="toggleMenu('menu-master')" class="w-full flex items-center justify-between px-4 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 hover:bg-slate-50 hover:text-slate-900">
                            <span>Master Data</span>
                            <svg class="w-4 h-4 transition-transform {{ request()->routeIs('siswa.*') || request()->routeIs('guru.*') || request()->routeIs('kelas.*') || request()->routeIs('jurusan.*') || request()->routeIs('tahun-ajaran.*') || request()->routeIs('pengguna.*') ? 'rotate-180' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <ul id="menu-master" class="mt-1 ml-4 pl-3 border-l border-slate-200 space-y-1 {{ request()->routeIs('siswa.*') || request()->routeIs('guru.*') || request()->routeIs('kelas.*') || request()->routeIs('jurusan.*') || request()->routeIs('tahun-ajaran.*') || request()->routeIs('pengguna.*') ? '' : 'hidden' }}">
                            <li><a href="{{ route('siswa.index') }}" class="block px-3 py-2 text-sm font-medium rounded-lg transition-all {{ request()->routeIs('siswa.*') ? 'bg-blue-50 text-blue-700' : 'hover:bg-slate-50 hover:text-slate-900' }}">Data Siswa</a></li>
                            <li><a href="{{ route('guru.index') }}" class="block px-3 py-2 text-sm font-medium rounded-lg transition-all {{ request()->routeIs('guru.*') ? 'bg-blue-50 text-blue-700' : 'hover:bg-slate-50 hover:text-slate-900' }}">Data Guru</a></li>
                            <li><a href="{{ route('kelas.index') }}" class="block px-3 py-2 text-sm font-medium rounded-lg transition-all {{ request()->routeIs('kelas.*') ? 'bg-blue-50 text-blue-700' : 'hover:bg-slate-50 hover:text-slate-900' }}">Data Kelas</a></li>
                            <li><a href="{{ route('jurusan.index') }}" class="block px-3 py-2 text-sm font-medium rounded-lg transition-all {{ request()->routeIs('jurusan.*') ? 'bg-blue-50 text-blue-700' : 'hover:bg-slate-50 hover:text-slate-900' }}">Data Jurusan</a></li>
                            <li><a href="{{ route('tahun-ajaran.index') }}" class="block px-3 py-2 text-sm font-medium rounded-lg transition-all {{ request()->routeIs('tahun-ajaran.*') ? 'bg-blue-50 text-blue-700' : 'hover:bg-slate-50 hover:text-slate-900' }}">Tahun Ajaran</a></li>
                            <li><a href="{{ route('pengguna.index') }}" class="block px-3 py-2 text-sm font-medium rounded-lg transition-all {{ request()->routeIs('pengguna.*') ? 'bg-blue-50 text-blue-700' : 'hover:bg-slate-50 hover:text-slate-900' }}">Pengguna</a></li>
                        </ul>
                    </li>

                    <li>
                        <button type="button" onclick="toggleMenu('menu-perilaku-admin')" class="w-full flex items-center justify-between px-4 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 hover:bg-slate-50 hover:text-slate-900">
                            <span>Perilaku</span>
                            <svg class="w-4 h-4 transition-transform {{ request()->routeIs('laporan-perilaku.*') || request()->routeIs('kategori-perilaku.*') || request()->routeIs('jenis-perilaku.*') ? 'rotate-180' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <ul id="menu-perilaku-admin" class="mt-1 ml-4 pl-3 border-l border-slate-200 space-y-1 {{ request()->routeIs('laporan-perilaku.*') || request()->routeIs('kategori-perilaku.*') || request()->routeIs('jenis-perilaku.*') ? '' : 'hidden' }}">
                            <li><a href="{{ route('laporan-perilaku.index') }}" class="block px-3 py-2 text-sm font-medium rounded-lg transition-all {{ request()->routeIs('laporan-perilaku.*') ? 'bg-blue-50 text-blue-700' : 'hover:bg-slate-50 hover:text-slate-900' }}">Laporan Perilaku</a></li>
                            <li><a href="{{ route('kategori-perilaku.index') }}" class="block px-3 py-2 text-sm font-medium rounded-lg transition-all {{ request()->routeIs('kategori-perilaku.*') ? 'bg-blue-50 text-blue-700' : 'hover:bg-slate-50 hover:text-slate-900' }}">Kategori Perilaku</a></li>
                            <li><a href="{{ route('jenis-perilaku.index') }}" class="block px-3 py-2 text-sm font-medium rounded-lg transition-all {{ request()->routeIs('jenis-perilaku.*') ? 'bg-blue-50 text-blue-700' : 'hover:bg-slate-50 hover:text-slate-900' }}">Jenis Perilaku</a></li>
                        </ul>
                    </li>

                    <li>
                        <button type="button" onclick="toggleMenu('menu-bimbingan-admin')" class="w-full flex items-center justify-between px-4 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 hover:bg-slate-50 hover:text-slate-900">
                            <span>Bimbingan</span>
                            <svg class="w-4 h-4 transition-transform {{ request()->routeIs('pembinaan.*') ? 'rotate-180' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <ul id="menu-bimbingan-admin" class="mt-1 ml-4 pl-3 border-l border-slate-200 space-y-1 {{ request()->routeIs('pembinaan.*') ? '' : 'hidden' }}">
                            <li><a href="{{ route('pembinaan.index') }}" class="block px-3 py-2 text-sm font-medium rounded-lg transition-all {{ request()->routeIs('pembinaan.*') ? 'bg-blue-50 text-blue-700' : 'hover:bg-slate-50 hover:text-slate-900' }}">Pembinaan</a></li>
                            
                            <!-- TAMBAHAN UNTUK ADMIN: Surat Peringatan & Panggilan -->
                            <li><a href="{{ route('surat-peringatan.index') }}" class="block px-3 py-2 text-sm font-medium rounded-lg transition-all hover:bg-slate-50 hover:text-slate-900">Surat Peringatan</a></li>
                            <li><a href="#" class="block px-3 py-2 text-sm font-medium rounded-lg transition-all hover:bg-slate-50 hover:text-slate-900">Surat Panggilan</a></li>
                            <!-- AKHIR TAMBAHAN -->

                        </ul>
                    </li>

                    <li>
                        <button type="button" onclick="toggleMenu('menu-penghargaan-admin')" class="w-full flex items-center justify-between px-4 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 hover:bg-slate-50 hover:text-slate-900">
                            <span>Penghargaan</span>
                            <svg class="w-4 h-4 transition-transform {{ request()->routeIs('reward.*') || request()->routeIs('jenis-reward.*') ? 'rotate-180' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <ul id="menu-penghargaan-admin" class="mt-1 ml-4 pl-3 border-l border-slate-200 space-y-1 {{ request()->routeIs('reward.*') || request()->routeIs('jenis-reward.*') ? '' : 'hidden' }}">
                            <li><a href="{{ route('reward.index') }}" class="block px-3 py-2 text-sm font-medium rounded-lg transition-all {{ request()->routeIs('reward.*') ? 'bg-blue-50 text-blue-700' : 'hover:bg-slate-50 hover:text-slate-900' }}">Reward</a></li>
                            <li><a href="{{ route('jenis-reward.index') }}" class="block px-3 py-2 text-sm font-medium rounded-lg transition-all {{ request()->routeIs('jenis-reward.*') ? 'bg-blue-50 text-blue-700' : 'hover:bg-slate-50 hover:text-slate-900' }}">Jenis Reward</a></li>
                        </ul>
                    </li>

                    <li>
                        <button type="button" onclick="toggleMenu('menu-laporan-admin')" class="w-full flex items-center justify-between px-4 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 hover:bg-slate-50 hover:text-slate-900">
                            <span>Laporan</span>
                            <svg class="w-4 h-4 transition-transform {{ request()->routeIs('rekap-poin.*') || request()->routeIs('rekap-reward.*') ? 'rotate-180' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <ul id="menu-laporan-admin" class="mt-1 ml-4 pl-3 border-l border-slate-200 space-y-1 {{ request()->routeIs('rekap-poin.*') || request()->routeIs('rekap-reward.*') ? '' : 'hidden' }}">
                            <li><a href="{{ route('rekap-poin.index') }}" class="block px-3 py-2 text-sm font-medium rounded-lg transition-all {{ request()->routeIs('rekap-poin.*') ? 'bg-blue-50 text-blue-700' : 'hover:bg-slate-50 hover:text-slate-900' }}">Rekap Poin</a></li>
                            <li><a href="{{ route('rekap-reward.index') }}" class="block px-3 py-2 text-sm font-medium rounded-lg transition-all {{ request()->routeIs('rekap-reward.*') ? 'bg-blue-50 text-blue-700' : 'hover:bg-slate-50 hover:text-slate-900' }}">Rekap Reward</a></li>
                        </ul>
                    </li>
                @endif

                @if(auth()->user()->role === 'guru')
                    @php 
                        $userGuru = auth()->user()->guru; 
                        $isWali = $userGuru && $userGuru->is_wali_kelas; 
                    @endphp
                    <li class="pt-5 pb-1 px-4"><p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Menu Utama</p></li>
                    <li>
                        <a href="{{ route('laporan-perilaku.index') }}" class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('laporan-perilaku.*') ? 'bg-blue-50 text-blue-700 shadow-sm border border-blue-100' : 'hover:bg-slate-50 hover:text-slate-900' }}">
                            <span>Laporan Perilaku</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('reward.index') }}" class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('reward.*') ? 'bg-blue-50 text-blue-700 shadow-sm border border-blue-100' : 'hover:bg-slate-50 hover:text-slate-900' }}">
                            <span>Reward Siswa</span>
                        </a>
                    </li>
                    @if($isWali)
                    <li>
                        <a href="{{ route('siswa.wali-kelas') }}" class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('siswa.wali-kelas') ? 'bg-blue-50 text-blue-700 shadow-sm border border-blue-100' : 'hover:bg-slate-50 hover:text-slate-900' }}">
                            <span>Data Kelas</span>
                        </a>
                    </li>
                    @endif
                @endif

                @if(auth()->user()->role === 'bk')
                    <li>
                        <button type="button" onclick="toggleMenu('menu-perilaku-bk')" class="w-full flex items-center justify-between px-4 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 hover:bg-slate-50 hover:text-slate-900">
                            <span>Perilaku</span>
                            <svg class="w-4 h-4 transition-transform {{ request()->routeIs('laporan-perilaku.*') ? 'rotate-180' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <ul id="menu-perilaku-bk" class="mt-1 ml-4 pl-3 border-l border-slate-200 space-y-1 {{ request()->routeIs('laporan-perilaku.*') ? '' : 'hidden' }}">
                            <li><a href="{{ route('laporan-perilaku.index') }}" class="block px-3 py-2 text-sm font-medium rounded-lg transition-all {{ request()->routeIs('laporan-perilaku.*') ? 'bg-blue-50 text-blue-700' : 'hover:bg-slate-50 hover:text-slate-900' }}">Laporan Perilaku</a></li>
                        </ul>
                    </li>

                    <li>
                        <button type="button" onclick="toggleMenu('menu-bimbingan-bk')" class="w-full flex items-center justify-between px-4 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 hover:bg-slate-50 hover:text-slate-900">
                            <span>Bimbingan</span>
                            <svg class="w-4 h-4 transition-transform {{ request()->routeIs('pembinaan.*') ? 'rotate-180' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <ul id="menu-bimbingan-bk" class="mt-1 ml-4 pl-3 border-l border-slate-200 space-y-1 {{ request()->routeIs('pembinaan.*') ? '' : 'hidden' }}">
                            <li><a href="{{ route('pembinaan.index') }}" class="block px-3 py-2 text-sm font-medium rounded-lg transition-all {{ request()->routeIs('pembinaan.*') ? 'bg-blue-50 text-blue-700' : 'hover:bg-slate-50 hover:text-slate-900' }}">Pembinaan</a></li>
                            <li><a href="#" class="block px-3 py-2 text-sm font-medium rounded-lg transition-all hover:bg-slate-50 hover:text-slate-900">Surat Peringatan</a></li>
                            <li><a href="#" class="block px-3 py-2 text-sm font-medium rounded-lg transition-all hover:bg-slate-50 hover:text-slate-900">Surat Panggilan</a></li>
                        </ul>
                    </li>

                    <li>
                        <button type="button" onclick="toggleMenu('menu-data-bk')" class="w-full flex items-center justify-between px-4 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 hover:bg-slate-50 hover:text-slate-900">
                            <span>Data</span>
                            <svg class="w-4 h-4 transition-transform {{ request()->routeIs('siswa.lihat*') ? 'rotate-180' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <ul id="menu-data-bk" class="mt-1 ml-4 pl-3 border-l border-slate-200 space-y-1 {{ request()->routeIs('siswa.lihat*') ? '' : 'hidden' }}">
                            <li><a href="{{ route('siswa.lihat') }}" class="block px-3 py-2 text-sm font-medium rounded-lg transition-all {{ request()->routeIs('siswa.lihat*') ? 'bg-blue-50 text-blue-700' : 'hover:bg-slate-50 hover:text-slate-900' }}">Data Siswa</a></li>
                        </ul>
                    </li>

                    <li>
                        <button type="button" onclick="toggleMenu('menu-laporan-bk')" class="w-full flex items-center justify-between px-4 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 hover:bg-slate-50 hover:text-slate-900">
                            <span>Laporan</span>
                            <svg class="w-4 h-4 transition-transform {{ request()->routeIs('rekap-poin.*') || request()->routeIs('rekap-reward.*') ? 'rotate-180' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <ul id="menu-laporan-bk" class="mt-1 ml-4 pl-3 border-l border-slate-200 space-y-1 {{ request()->routeIs('rekap-poin.*') || request()->routeIs('rekap-reward.*') ? '' : 'hidden' }}">
                            <li><a href="{{ route('rekap-poin.index') }}" class="block px-3 py-2 text-sm font-medium rounded-lg transition-all {{ request()->routeIs('rekap-poin.*') ? 'bg-blue-50 text-blue-700' : 'hover:bg-slate-50 hover:text-slate-900' }}">Rekap Poin</a></li>
                            <li><a href="{{ route('rekap-reward.index') }}" class="block px-3 py-2 text-sm font-medium rounded-lg transition-all {{ request()->routeIs('rekap-reward.*') ? 'bg-blue-50 text-blue-700' : 'hover:bg-slate-50 hover:text-slate-900' }}">Rekap Reward</a></li>
                        </ul>
                    </li>
                @endif

                @if(auth()->user()->role === 'kesiswaan')
                    <li class="pt-5 pb-1 px-4"><p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Penghargaan</p></li>
                    <li><a href="{{ route('reward.index') }}" class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('reward.*') ? 'bg-blue-50 text-blue-700 shadow-sm border border-blue-100' : 'hover:bg-slate-50 hover:text-slate-900' }}"><span>Reward</span></a></li>

                    <li class="pt-5 pb-1 px-4"><p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Data</p></li>
                    <li><a href="{{ route('siswa.lihat') }}" class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('siswa.lihat*') ? 'bg-blue-50 text-blue-700 shadow-sm border border-blue-100' : 'hover:bg-slate-50 hover:text-slate-900' }}"><span>Data Siswa</span></a></li>
                @endif

                @if(auth()->user()->role === 'siswa')
                    <li class="pt-5 pb-1 px-4"><p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Menu Utama</p></li>
                    <li><a href="{{ route('poin.index') }}" class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('poin.*') ? 'bg-blue-50 text-blue-700 shadow-sm border border-blue-100' : 'hover:bg-slate-50 hover:text-slate-900' }}"><span>Poin Pelanggaran</span></a></li>
                    <li><a href="{{ route('kredit-reward.index') }}" class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('kredit-reward.*') ? 'bg-blue-50 text-blue-700 shadow-sm border border-blue-100' : 'hover:bg-slate-50 hover:text-slate-900' }}"><span>Kredit Reward</span></a></li>
                    <li><a href="{{ route('riwayat-pembinaan.index') }}" class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('riwayat-pembinaan.*') ? 'bg-blue-50 text-blue-700 shadow-sm border border-blue-100' : 'hover:bg-slate-50 hover:text-slate-900' }}"><span>Riwayat Pembinaan</span></a></li>
                @endif

                @if(auth()->user()->role === 'kesiswaan')
                    <li>
                        <button type="button" onclick="toggleMenu('menu-laporan-kesiswaan')" class="w-full flex items-center justify-between px-4 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 hover:bg-slate-50 hover:text-slate-900">
                            <span>Laporan</span>
                            <svg class="w-4 h-4 transition-transform {{ request()->routeIs('rekap-poin.*') || request()->routeIs('rekap-reward.*') ? 'rotate-180' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <ul id="menu-laporan-kesiswaan" class="mt-1 ml-4 pl-3 border-l border-slate-200 space-y-1 {{ request()->routeIs('rekap-poin.*') || request()->routeIs('rekap-reward.*') ? '' : 'hidden' }}">
                            <li><a href="{{ route('rekap-poin.index') }}" class="block px-3 py-2 text-sm font-medium rounded-lg transition-all {{ request()->routeIs('rekap-poin.*') ? 'bg-blue-50 text-blue-700' : 'hover:bg-slate-50 hover:text-slate-900' }}">Rekap Poin</a></li>
                            <li><a href="{{ route('rekap-reward.index') }}" class="block px-3 py-2 text-sm font-medium rounded-lg transition-all {{ request()->routeIs('rekap-reward.*') ? 'bg-blue-50 text-blue-700' : 'hover:bg-slate-50 hover:text-slate-900' }}">Rekap Reward</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </nav>

        <!-- Profil & Logout -->
                <!-- Profil & Logout (Bagian Bawah - Modern) -->
        <div class="p-4 border-t border-slate-200 bg-slate-50/50 flex-shrink-0">
            
            <!-- Card Profil -->
                        <!-- Card Profil Modern (Horizontal + Indikator Online) -->
            <div class="bg-white rounded-xl p-3 shadow-sm border border-slate-200/60 mb-3 flex items-center gap-3 hover:shadow-md transition-shadow duration-200 cursor-default">
                
                <!-- Avatar dengan Indikator Online -->
                <div class="relative">
                    @if(auth()->user()->role === 'siswa')
                    <a href="{{ route('siswa.profil.index') }}" class="block w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-blue-700 flex items-center justify-center text-white font-bold text-sm shadow-md hover:from-blue-600 hover:to-blue-800 transition-all">
                        {{ substr(auth()->user()->nama_tampil ?? 'A', 0, 1) }}
                    </a>
                    @else
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-blue-700 flex items-center justify-center text-white font-bold text-sm shadow-md">
                        {{ substr(auth()->user()->nama_tampil ?? 'A', 0, 1) }}
                    </div>
                    @endif
                    
                    <!-- Titik Hijau (Online) -->
                    <span class="absolute bottom-0 right-0 block h-3 w-3 rounded-full bg-green-500 ring-2 ring-white"></span>
                </div>
                
                <!-- Teks Nama & Role Sejajar -->
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-bold text-slate-800 truncate leading-tight">{{ auth()->user()->nama_tampil }}</p>
                    <p class="text-[11px] font-semibold text-slate-500 mt-0.5 uppercase tracking-wider flex items-center gap-1">
                        {{ auth()->user()->role }}
                        <span class="text-green-500 text-[10px]">&bull; Online</span>
                    </p>
                </div>
            </div>

            <!-- Tombol Logout -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center px-4 py-2.5 text-sm font-semibold text-rose-600 bg-white rounded-xl hover:bg-rose-50 hover:text-rose-700 transition-all duration-200 border border-slate-200 hover:border-rose-200 shadow-sm group">
                    <svg class="w-4 h-4 mr-2 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    Keluar Sistem
                </button>
            </form>
        </div>
    </aside>

    <!-- ========================================== -->
    <!-- KONTEN UTAMA (Kanan)                       -->
    <!-- ========================================== -->
    <main class="flex-1 flex flex-col h-screen overflow-hidden">
        <!-- Header Atas -->
                <!-- Header Atas (Diselaraskan dengan Sidebar) -->
        <header class="h-[73px] bg-white border-b border-slate-200 px-8 flex items-center flex-shrink-0 z-10">
            <h2 class="text-xl font-semibold text-slate-900">@yield('page-title', 'Dashboard')</h2>
        </header>

        <!-- Area Konten (Bisa di-scroll) -->
        <div class="flex-1 overflow-y-auto p-8">
            @yield('content')
        </div>
    </main>

    <script>
        // Dropdown menu state management
        const dropdownState = JSON.parse(localStorage.getItem('dropdownState')) || {};

        function toggleMenu(menuId) {
            const menu = document.getElementById(menuId);
            const button = event.currentTarget;
            const icon = button.querySelector('svg');
            
            if (menu) {
                menu.classList.toggle('hidden');
                dropdownState[menuId] = !menu.classList.contains('hidden');
                localStorage.setItem('dropdownState', JSON.stringify(dropdownState));
                
                // Animate icon
                icon?.classList.toggle('rotate-180');
            }
        }

        // Restore dropdown state on page load
        document.addEventListener('DOMContentLoaded', function() {
            Object.keys(dropdownState).forEach(menuId => {
                const menu = document.getElementById(menuId);
                const button = document.querySelector(`[onclick="toggleMenu('${menuId}')"]`);
                const icon = button?.querySelector('svg');
                
                if (menu && dropdownState[menuId]) {
                    menu.classList.remove('hidden');
                    icon?.classList.add('rotate-180');
                }
            });
        });
    </script>
</body>
</html>