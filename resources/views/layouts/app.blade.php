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
    <aside class="w-64 bg-[#1e293b] text-gray-300 flex flex-col shadow-xl z-20 flex-shrink-0">
        
        <!-- Header Sidebar -->
        <div class="p-6 border-b border-gray-700/50 bg-[#0f172a] flex items-center gap-3">
            <img src="{{ asset('images/logo-sekolah.png') }}" alt="Logo" class="h-10 w-auto object-contain bg-white rounded-full p-0.5">
            <div>
                <h1 class="text-lg font-bold text-white tracking-wide leading-tight">Sistem BPD</h1>
                <p class="text-xs text-gray-400 mt-0.5">SMK Pembangunan Jaya</p>
            </div>
        </div>

        <!-- Menu Navigasi -->
        <nav class="flex-1 p-4 overflow-y-auto">
            <ul class="space-y-1">
                <li>
                    <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('dashboard') ? 'bg-blue-600 text-white shadow-sm' : 'hover:bg-gray-700/50 hover:text-white' }}">
                        <span>Dashboard</span>
                    </a>
                </li>
                
                @if(auth()->user()->role === 'admin')
                    <li class="pt-5 pb-1">
                        <p class="px-4 text-[10px] font-bold text-gray-500 uppercase tracking-wider">Master Data</p>
                    </li>
                    <li><a href="{{ route('siswa.index') }}" class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('siswa.*') ? 'bg-blue-600 text-white shadow-sm' : 'hover:bg-gray-700/50 hover:text-white' }}"><span>Data Siswa</span></a></li>
                    <li><a href="{{ route('guru.index') }}" class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('guru.*') ? 'bg-blue-600 text-white shadow-sm' : 'hover:bg-gray-700/50 hover:text-white' }}"><span>Data Guru</span></a></li>
                    <li><a href="{{ route('kelas.index') }}" class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('kelas.*') ? 'bg-blue-600 text-white shadow-sm' : 'hover:bg-gray-700/50 hover:text-white' }}"><span>Data Kelas</span></a></li>
                    <li><a href="{{ route('jurusan.index') }}" class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('jurusan.*') ? 'bg-blue-600 text-white shadow-sm' : 'hover:bg-gray-700/50 hover:text-white' }}"><span>Data Jurusan</span></a></li>
                    <li><a href="{{ route('tahun-ajaran.index') }}" class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('tahun-ajaran.*') ? 'bg-blue-600 text-white shadow-sm' : 'hover:bg-gray-700/50 hover:text-white' }}"><span>Tahun Ajaran</span></a></li>
                    <li><a href="{{ route('pengguna.index') }}" class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('pengguna.*') ? 'bg-blue-600 text-white shadow-sm' : 'hover:bg-gray-700/50 hover:text-white' }}"><span>Pengguna</span></a></li>
                @endif

                @if(in_array(auth()->user()->role, ['admin', 'guru', 'bk']))
                    <li class="pt-5 pb-1"><p class="px-4 text-[10px] font-bold text-gray-500 uppercase tracking-wider">Perilaku</p></li>
                    <li><a href="{{ route('laporan-perilaku.index') }}" class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('laporan-perilaku.*') ? 'bg-blue-600 text-white shadow-sm' : 'hover:bg-gray-700/50 hover:text-white' }}"><span>Laporan Perilaku</span></a></li>
                    @if(auth()->user()->role === 'admin')
                    <li><a href="{{ route('kategori-perilaku.index') }}" class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('kategori-perilaku.*') ? 'bg-blue-600 text-white shadow-sm' : 'hover:bg-gray-700/50 hover:text-white' }}"><span>Kategori Perilaku</span></a></li>
                    <li><a href="{{ route('jenis-perilaku.index') }}" class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('jenis-perilaku.*') ? 'bg-blue-600 text-white shadow-sm' : 'hover:bg-gray-700/50 hover:text-white' }}"><span>Jenis Perilaku</span></a></li>
                    @endif
                @endif

                @if(in_array(auth()->user()->role, ['admin', 'bk']))
                    <li class="pt-5 pb-1"><p class="px-4 text-[10px] font-bold text-gray-500 uppercase tracking-wider">Bimbingan</p></li>
                    <li><a href="{{ route('pembinaan.index') }}" class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('pembinaan.*') ? 'bg-blue-600 text-white shadow-sm' : 'hover:bg-gray-700/50 hover:text-white' }}"><span>Pembinaan</span></a></li>
                    <li><a href="#" class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition-colors hover:bg-gray-700/50 hover:text-white"><span>Surat Peringatan</span></a></li>
                    <li><a href="#" class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition-colors hover:bg-gray-700/50 hover:text-white"><span>Surat Panggilan</span></a></li>
                @endif

                @if(in_array(auth()->user()->role, ['admin', 'guru', 'kesiswaan']))
                    <li class="pt-5 pb-1"><p class="px-4 text-[10px] font-bold text-gray-500 uppercase tracking-wider">Penghargaan</p></li>
                    <li><a href="{{ route('reward.index') }}" class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('reward.*') ? 'bg-blue-600 text-white shadow-sm' : 'hover:bg-gray-700/50 hover:text-white' }}"><span>Reward</span></a></li>
                    @if(auth()->user()->role === 'admin')
                    <li><a href="{{ route('jenis-reward.index') }}" class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('jenis-reward.*') ? 'bg-blue-600 text-white shadow-sm' : 'hover:bg-gray-700/50 hover:text-white' }}"><span>Jenis Reward</span></a></li>
                    @endif
                @endif
                
                @if(in_array(auth()->user()->role, ['guru', 'bk', 'kesiswaan']))
                    @php $userGuru = auth()->user()->guru; $isWali = $userGuru && $userGuru->is_wali_kelas; @endphp
                    @if($isWali || auth()->user()->role !== 'guru')
                    <li class="pt-5 pb-1"><p class="px-4 text-[10px] font-bold text-gray-500 uppercase tracking-wider">Data</p></li>
                    @if(auth()->user()->role === 'guru' && $isWali)
                    <li><a href="{{ route('siswa.wali-kelas') }}" class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('siswa.wali-kelas') ? 'bg-blue-600 text-white shadow-sm' : 'hover:bg-gray-700/50 hover:text-white' }}"><span>Data Kelas</span></a></li>
                    @elseif(auth()->user()->role !== 'guru')
                    <li><a href="{{ route('siswa.lihat') }}" class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('siswa.lihat*') ? 'bg-blue-600 text-white shadow-sm' : 'hover:bg-gray-700/50 hover:text-white' }}"><span>Data Siswa</span></a></li>
                    @endif
                    @endif
                @endif

                @if(auth()->user()->role === 'siswa')
                    <li class="pt-5 pb-1"><p class="px-4 text-[10px] font-bold text-gray-500 uppercase tracking-wider">Data Saya</p></li>
                    <li><a href="{{ route('siswa.profil.index') }}" class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('siswa.profil.*') ? 'bg-blue-600 text-white shadow-sm' : 'hover:bg-gray-700/50 hover:text-white' }}"><span>Profil</span></a></li>
                    <li><a href="{{ route('poin.index') }}" class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('poin.*') ? 'bg-blue-600 text-white shadow-sm' : 'hover:bg-gray-700/50 hover:text-white' }}"><span>Poin Pelanggaran</span></a></li>
                    <li><a href="{{ route('kredit-reward.index') }}" class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('kredit-reward.*') ? 'bg-blue-600 text-white shadow-sm' : 'hover:bg-gray-700/50 hover:text-white' }}"><span>Kredit Reward</span></a></li>
                    <li><a href="{{ route('riwayat-pembinaan.index') }}" class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('riwayat-pembinaan.*') ? 'bg-blue-600 text-white shadow-sm' : 'hover:bg-gray-700/50 hover:text-white' }}"><span>Riwayat Pembinaan</span></a></li>
                @endif

                @if(in_array(auth()->user()->role, ['admin', 'bk', 'kesiswaan']))
                    <li class="pt-5 pb-1"><p class="px-4 text-[10px] font-bold text-gray-500 uppercase tracking-wider">Laporan</p></li>
                    <li><a href="{{ route('rekap-poin.index') }}" class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('rekap-poin.*') ? 'bg-blue-600 text-white shadow-sm' : 'hover:bg-gray-700/50 hover:text-white' }}"><span>Rekap Poin</span></a></li>
                    <li><a href="{{ route('rekap-reward.index') }}" class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('rekap-reward.*') ? 'bg-blue-600 text-white shadow-sm' : 'hover:bg-gray-700/50 hover:text-white' }}"><span>Rekap Reward</span></a></li>
                @endif
            </ul>
        </nav>

        <!-- Profil & Logout -->
        <div class="p-4 border-t border-gray-700/50 bg-[#0f172a] flex-shrink-0">
            <div class="flex items-center gap-3 mb-4 px-2">
                <div class="w-9 h-9 rounded-full bg-blue-600 flex items-center justify-center text-white font-bold text-sm shadow-inner">
                    {{ substr(auth()->user()->username ?? 'A', 0, 1) }}
                </div>
                <div>
                    <p class="text-sm font-bold text-white leading-tight">{{ auth()->user()->username }}</p>
                    <p class="text-[11px] text-gray-400">{{ ucfirst(auth()->user()->role) }}</p>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center px-4 py-2 text-sm font-medium text-red-400 bg-red-400/10 rounded-lg hover:bg-red-500 hover:text-white transition-colors border border-red-500/20">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
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
        <header class="bg-white border-b border-gray-200 px-8 py-4 flex-shrink-0 z-10">
            <h2 class="text-xl font-semibold text-gray-900">@yield('page-title', 'Dashboard')</h2>
        </header>

        <!-- Area Konten (Bisa di-scroll) -->
        <div class="flex-1 overflow-y-auto p-8">
            @yield('content')
        </div>
    </main>

</body>
</html>