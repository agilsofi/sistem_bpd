<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - Sistem BPD</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <!-- Mobile Backdrop -->
    <div id="sidebar-backdrop" class="fixed inset-0 bg-black/50 z-30 hidden md:hidden" onclick="document.getElementById('sidebar').classList.add('-translate-x-full'); this.classList.add('hidden')"></div>

    <div class="flex h-screen overflow-hidden">
        <!-- SIDEBAR (Drawer on mobile) -->
        <aside id="sidebar" class="w-64 bg-white text-slate-600 flex flex-col shadow-lg z-40 border-r border-slate-200 fixed md:static h-screen transition-transform -translate-x-full md:translate-x-0 overflow-y-auto">
            
            <!-- Header Sidebar -->
            <div class="h-[73px] px-4 border-b border-slate-200 bg-white flex items-center gap-3 flex-shrink-0">
                <div class="bg-slate-50 p-1 rounded-full border border-slate-200 shadow-sm flex-shrink-0">
                    <img src="{{ asset('images/logo-sekolah.png') }}" alt="Logo" class="h-9 w-9 object-contain">
                </div>
                <div class="flex flex-col justify-center min-w-0">
                    <h1 class="text-sm font-bold text-slate-800 tracking-tight leading-tight truncate">Sistem Buku Peserta Didik</h1>
                    <p class="text-[10px] text-slate-500 mt-0.5 truncate">SMK Pembangunan Jaya</p>
                </div>
            </div>

            <!-- Menu Navigasi -->
            <nav class="flex-1 p-4 overflow-y-auto">
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
                                <li><a href="{{ route('laporan-perilaku.index') }}" class="block px-3 py-2 text-sm font-medium rounded-lg transition-all {{ request()->routeIs('laporan-perilaku.index') ? 'bg-blue-50 text-blue-700' : 'hover:bg-slate-50 hover:text-slate-900' }}">Daftar Laporan</a></li>
                                <li><a href="{{ route('laporan-perilaku.verifikasi-index') }}" class="block px-3 py-2 text-sm font-medium rounded-lg transition-all {{ request()->routeIs('laporan-perilaku.verifikasi*') ? 'bg-blue-50 text-blue-700' : 'hover:bg-slate-50 hover:text-slate-900' }}">Verifikasi Laporan</a></li>
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
                                <li><a href="{{ route('surat-peringatan.index') }}" class="block px-3 py-2 text-sm font-medium rounded-lg transition-all hover:bg-slate-50 hover:text-slate-900">Surat Peringatan</a></li>
                                <li><a href="#" class="block px-3 py-2 text-sm font-medium rounded-lg transition-all hover:bg-slate-50 hover:text-slate-900">Surat Panggilan</a></li>
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
                        <li><a href="{{ route('laporan-perilaku.index') }}" class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('laporan-perilaku.*') ? 'bg-blue-50 text-blue-700 shadow-sm border border-blue-100' : 'hover:bg-slate-50 hover:text-slate-900' }}"><span>Laporan Perilaku</span></a></li>
                        <li><a href="{{ route('reward.index') }}" class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('reward.*') ? 'bg-blue-50 text-blue-700 shadow-sm border border-blue-100' : 'hover:bg-slate-50 hover:text-slate-900' }}"><span>Reward Siswa</span></a></li>
                        @if($isWali)
                        <li><a href="{{ route('siswa.wali-kelas') }}" class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('siswa.wali-kelas') ? 'bg-blue-50 text-blue-700 shadow-sm border border-blue-100' : 'hover:bg-slate-50 hover:text-slate-900' }}"><span>Data Kelas</span></a></li>
                        @endif
                    @endif

                    @if(auth()->user()->role === 'bk')
                        <li>
                            <button type="button" onclick="toggleMenu('menu-perilaku-bk')" class="w-full flex items-center justify-between px-4 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 hover:bg-slate-50 hover:text-slate-900">
                                <span>Perilaku</span>
                                <svg class="w-4 h-4 transition-transform {{ request()->routeIs('laporan-perilaku.*') ? 'rotate-180' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            <ul id="menu-perilaku-bk" class="mt-1 ml-4 pl-3 border-l border-slate-200 space-y-1 {{ request()->routeIs('laporan-perilaku.*') ? '' : 'hidden' }}">
                                <li><a href="{{ route('laporan-perilaku.index') }}" class="block px-3 py-2 text-sm font-medium rounded-lg transition-all {{ request()->routeIs('laporan-perilaku.index') ? 'bg-blue-50 text-blue-700' : 'hover:bg-slate-50 hover:text-slate-900' }}">Daftar Laporan</a></li>
                                <li><a href="{{ route('laporan-perilaku.verifikasi-index') }}" class="block px-3 py-2 text-sm font-medium rounded-lg transition-all {{ request()->routeIs('laporan-perilaku.verifikasi*') ? 'bg-blue-50 text-blue-700' : 'hover:bg-slate-50 hover:text-slate-900' }}">Verifikasi Laporan</a></li>
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
                        <li class="pt-5 pb-1 px-4"><p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Menu Utama</p></li>
                        <li><a href="{{ route('laporan-perilaku.index') }}" class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('laporan-perilaku.*') ? 'bg-blue-50 text-blue-700 shadow-sm border border-blue-100' : 'hover:bg-slate-50 hover:text-slate-900' }}"><span>Laporan Perilaku</span></a></li>
                        <li><a href="{{ route('reward.index') }}" class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('reward.*') ? 'bg-blue-50 text-blue-700 shadow-sm border border-blue-100' : 'hover:bg-slate-50 hover:text-slate-900' }}"><span>Reward Siswa</span></a></li>
                        <li><a href="{{ route('siswa.lihat') }}" class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('siswa.lihat*') ? 'bg-blue-50 text-blue-700 shadow-sm border border-blue-100' : 'hover:bg-slate-50 hover:text-slate-900' }}"><span>Data Siswa</span></a></li>
                        <li><a href="{{ route('rekap-poin.index') }}" class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('rekap-poin.*') ? 'bg-blue-50 text-blue-700 shadow-sm border border-blue-100' : 'hover:bg-slate-50 hover:text-slate-900' }}"><span>Rekap Poin</span></a></li>
                        <li><a href="{{ route('rekap-reward.index') }}" class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('rekap-reward.*') ? 'bg-blue-50 text-blue-700 shadow-sm border border-blue-100' : 'hover:bg-slate-50 hover:text-slate-900' }}"><span>Rekap Reward</span></a></li>
                    @endif

                    @if(auth()->user()->role === 'siswa')
                        <li class="pt-5 pb-1 px-4"><p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Menu Utama</p></li>
                        <li><a href="{{ route('poin.index') }}" class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('poin.*') ? 'bg-blue-50 text-blue-700 shadow-sm border border-blue-100' : 'hover:bg-slate-50 hover:text-slate-900' }}"><span>Poin Pelanggaran</span></a></li>
                        <li><a href="{{ route('kredit-reward.index') }}" class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('kredit-reward.*') ? 'bg-blue-50 text-blue-700 shadow-sm border border-blue-100' : 'hover:bg-slate-50 hover:text-slate-900' }}"><span>Kredit Reward</span></a></li>
                        <li><a href="{{ route('riwayat-pembinaan.index') }}" class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('riwayat-pembinaan.*') ? 'bg-blue-50 text-blue-700 shadow-sm border border-blue-100' : 'hover:bg-slate-50 hover:text-slate-900' }}"><span>Riwayat Pembinaan</span></a></li>
                    @endif
                </ul>
            </nav>

            <!-- Profil & Logout -->
            <div class="p-4 border-t border-slate-200 bg-slate-50/50 flex-shrink-0">
                <div class="bg-white rounded-xl p-3 shadow-sm border border-slate-200/60 mb-3 flex items-center gap-3 hover:shadow-md transition-shadow duration-200">
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
                        <span class="absolute bottom-0 right-0 block h-3 w-3 rounded-full bg-green-500 ring-2 ring-white"></span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-bold text-slate-800 truncate leading-tight">{{ auth()->user()->nama_tampil }}</p>
                        <p class="text-[11px] font-semibold text-slate-500 mt-0.5 uppercase tracking-wider flex items-center gap-1">
                            {{ auth()->user()->role }}
                            <span class="text-green-500 text-[10px]">&bull; Online</span>
                        </p>
                    </div>
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center px-4 py-2.5 text-sm font-semibold text-rose-600 bg-white rounded-xl hover:bg-rose-50 hover:text-rose-700 transition-all duration-200 border border-slate-200 hover:border-rose-200 shadow-sm group">
                        <svg class="w-4 h-4 mr-2 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        Keluar
                    </button>
                </form>
            </div>
        </aside>

        <!-- MAIN CONTENT -->
        <div class="flex-1 flex flex-col overflow-hidden md:ml-0">
            <!-- Header dengan Hamburger -->
            <header class="h-[73px] bg-white border-b border-slate-200 px-4 sm:px-6 md:px-8 flex items-center justify-between z-20 flex-shrink-0">
                <div class="flex items-center gap-3 min-w-0">
                    <button type="button" onclick="document.getElementById('sidebar').classList.toggle('-translate-x-full'); document.getElementById('sidebar-backdrop').classList.toggle('hidden')" class="md:hidden p-2 text-slate-600 hover:text-slate-900 focus:outline-none flex-shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    </button>
                    <h2 class="text-base sm:text-lg font-bold text-slate-800 tracking-tight truncate">@yield('page-title', 'Dashboard')</h2>
                </div>
            </header>

            <!-- Content Area -->
            <main class="flex-1 overflow-y-auto bg-gray-50 p-4 sm:p-6 md:p-8">
                @yield('content')
            </main>
        </div>
    </div>

    <script>
        const dropdownState = JSON.parse(localStorage.getItem('dropdownState')) || {};

        function toggleMenu(menuId) {
            const menu = document.getElementById(menuId);
            const button = event.currentTarget;
            const icon = button.querySelector('svg');
            
            if (menu) {
                menu.classList.toggle('hidden');
                dropdownState[menuId] = !menu.classList.contains('hidden');
                localStorage.setItem('dropdownState', JSON.stringify(dropdownState));
                icon?.classList.toggle('rotate-180');
            }
        }

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
