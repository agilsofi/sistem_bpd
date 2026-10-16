<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - Sistem BPD</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-white border-r border-gray-200 flex flex-col">
            <div class="p-6 border-b border-gray-200">
                <h1 class="text-lg font-semibold text-gray-900">Sistem BPD</h1>
                <p class="text-xs text-gray-600 mt-1">SMK Pembangunan Jaya</p>
            </div>

            <nav class="flex-1 p-4 overflow-y-auto">
                <ul class="space-y-1">
                    <li>
                        <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-2 text-sm rounded-lg {{ request()->routeIs('dashboard') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-100' }}">
                            <span>Dashboard</span>
                        </a>
                    </li>

                    @if(auth()->user()->role === 'admin')
                        <li class="pt-4 pb-2">
                            <p class="px-4 text-xs font-medium text-gray-500 uppercase">Master Data</p>
                        </li>
                        <li>
                            <a href="{{ route('siswa.index') }}" class="flex items-center px-4 py-2 text-sm rounded-lg {{ request()->routeIs('siswa.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-100' }}">
                                <span>Data Siswa</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('guru.index') }}" class="flex items-center px-4 py-2 text-sm rounded-lg {{ request()->routeIs('guru.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-100' }}">
                                <span>Data Guru</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('kelas.index') }}" class="flex items-center px-4 py-2 text-sm rounded-lg {{ request()->routeIs('kelas.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-100' }}">
                                <span>Data Kelas</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('jurusan.index') }}" class="flex items-center px-4 py-2 text-sm rounded-lg {{ request()->routeIs('jurusan.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-100' }}">
                                <span>Data Jurusan</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('tahun-ajaran.index') }}" class="flex items-center px-4 py-2 text-sm rounded-lg {{ request()->routeIs('tahun-ajaran.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-100' }}">
                                <span>Tahun Ajaran</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('pengguna.index') }}" class="flex items-center px-4 py-2 text-sm rounded-lg {{ request()->routeIs('pengguna.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-100' }}">
                                <span>Pengguna</span>
                            </a>
                        </li>
                    @endif

                    @if(in_array(auth()->user()->role, ['admin', 'guru', 'bk']))
                        <li class="pt-4 pb-2">
                            <p class="px-4 text-xs font-medium text-gray-500 uppercase">Perilaku</p>
                        </li>
                        <li>
                            <a href="{{ route('laporan-perilaku.index') }}" class="flex items-center px-4 py-2 text-sm rounded-lg {{ request()->routeIs('laporan-perilaku.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-100' }}">
                                <span>Laporan Perilaku</span>
                            </a>
                        </li>
                        @if(auth()->user()->role === 'admin')
                        <li>
                            <a href="{{ route('kategori-perilaku.index') }}" class="flex items-center px-4 py-2 text-sm rounded-lg {{ request()->routeIs('kategori-perilaku.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-100' }}">
                                <span>Kategori Perilaku</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('jenis-perilaku.index') }}" class="flex items-center px-4 py-2 text-sm rounded-lg {{ request()->routeIs('jenis-perilaku.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-100' }}">
                                <span>Jenis Perilaku</span>
                            </a>
                        </li>
                        @endif
                    @endif

                    @if(in_array(auth()->user()->role, ['admin', 'bk']))
                        <li class="pt-4 pb-2">
                            <p class="px-4 text-xs font-medium text-gray-500 uppercase">Bimbingan</p>
                        </li>
                        <li>
                            <a href="{{ route('pembinaan.index') }}" class="flex items-center px-4 py-2 text-sm rounded-lg {{ request()->routeIs('pembinaan.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-100' }}">
                                <span>Pembinaan</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 rounded-lg hover:bg-gray-100">
                                <span>Surat Peringatan</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 rounded-lg hover:bg-gray-100">
                                <span>Surat Panggilan</span>
                            </a>
                        </li>
                    @endif

                    @if(in_array(auth()->user()->role, ['admin', 'guru', 'kesiswaan']))
                        <li class="pt-4 pb-2">
                            <p class="px-4 text-xs font-medium text-gray-500 uppercase">Penghargaan</p>
                        </li>
                        <li>
                            <a href="{{ route('reward.index') }}" class="flex items-center px-4 py-2 text-sm rounded-lg {{ request()->routeIs('reward.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-100' }}">
                                <span>Reward</span>
                            </a>
                        </li>
                        @if(auth()->user()->role === 'admin')
                        <li>
                            <a href="{{ route('jenis-reward.index') }}" class="flex items-center px-4 py-2 text-sm rounded-lg {{ request()->routeIs('jenis-reward.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-100' }}">
                                <span>Jenis Reward</span>
                            </a>
                        </li>
                        @endif
                    @endif
                    
                    @if(in_array(auth()->user()->role, ['guru', 'bk', 'kesiswaan']))
                        @php
                            $userGuru = auth()->user()->guru;
                            $isWali = $userGuru && $userGuru->is_wali_kelas;
                        @endphp
                        @if($isWali || auth()->user()->role !== 'guru')
                        <li class="pt-4 pb-2">
                            <p class="px-4 text-xs font-medium text-gray-500 uppercase">Data</p>
                        </li>
                        @if(auth()->user()->role === 'guru' && $isWali)
                        <li>
                            <a href="{{ route('siswa.wali-kelas') }}" class="flex items-center px-4 py-2 text-sm rounded-lg {{ request()->routeIs('siswa.wali-kelas') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-100' }}">
                                <span>Data Kelas</span>
                            </a>
                        </li>
                        @elseif(auth()->user()->role !== 'guru')
                        <li>
                            <a href="{{ route('siswa.lihat') }}" class="flex items-center px-4 py-2 text-sm rounded-lg {{ request()->routeIs('siswa.lihat*') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-100' }}">
                                <span>Data Siswa</span>
                            </a>
                        </li>
                        @endif
                        @endif
                    @endif

                    @if(auth()->user()->role === 'siswa')
                        <li class="pt-4 pb-2">
                            <p class="px-4 text-xs font-medium text-gray-500 uppercase">Data Saya</p>
                        </li>
                        <li>
                            <a href="{{ route('siswa.profil.index') }}" class="flex items-center px-4 py-2 text-sm rounded-lg {{ request()->routeIs('siswa.profil.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-100' }}">
                                <span>Profil</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('poin.index') }}" class="flex items-center px-4 py-2 text-sm rounded-lg {{ request()->routeIs('poin.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-100' }}">
                                <span>Poin Pelanggaran</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('kredit-reward.index') }}" class="flex items-center px-4 py-2 text-sm rounded-lg {{ request()->routeIs('kredit-reward.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-100' }}">
                                <span>Kredit Reward</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('riwayat-pembinaan.index') }}" class="flex items-center px-4 py-2 text-sm rounded-lg {{ request()->routeIs('riwayat-pembinaan.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-100' }}">
                                <span>Riwayat Pembinaan</span>
                            </a>
                        </li>
                    @endif

                    @if(in_array(auth()->user()->role, ['admin', 'bk', 'kesiswaan']))
                        <li class="pt-4 pb-2">
                            <p class="px-4 text-xs font-medium text-gray-500 uppercase">Laporan</p>
                        </li>
                        <li>
                            <a href="{{ route('rekap-poin.index') }}" class="flex items-center px-4 py-2 text-sm rounded-lg {{ request()->routeIs('rekap-poin.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-100' }}">
                                <span>Rekap Poin</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('rekap-reward.index') }}" class="flex items-center px-4 py-2 text-sm rounded-lg {{ request()->routeIs('rekap-reward.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-100' }}">
                                <span>Rekap Reward</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </nav>

            <div class="p-4 border-t border-gray-200">
                <div class="flex items-center justify-between mb-3">
                    <div>
                        <p class="text-sm font-medium text-gray-900">{{ auth()->user()->username }}</p>
                        <p class="text-xs text-gray-600">{{ ucfirst(auth()->user()->role) }}</p>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full px-4 py-2 text-sm text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200">
                        Keluar
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto">
            <!-- Header -->
            <header class="bg-white border-b border-gray-200 px-8 py-4">
                <h2 class="text-xl font-semibold text-gray-900">@yield('page-title', 'Dashboard')</h2>
            </header>

            <!-- Content -->
            <div class="p-8">
                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>
