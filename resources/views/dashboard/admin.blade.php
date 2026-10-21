@extends('layouts.app')

@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard Administrator')

@section('content')
<div class="space-y-6">

    <div class="bg-gradient-to-r from-blue-800 to-blue-600 rounded-2xl shadow-lg p-8 flex items-center justify-between text-white relative overflow-hidden">
        <div class="absolute -top-10 -right-10 w-40 h-40 bg-white opacity-10 rounded-full"></div>
        <div class="absolute -bottom-10 right-20 w-32 h-32 bg-white opacity-10 rounded-full"></div>

        <div class="relative z-10 flex items-center gap-6">
            <div class="bg-white p-2 rounded-full shadow-md hidden md:block">
                <img class="h-20 w-auto object-contain" src="{{ asset('images/logo-sekolah.png') }}" alt="Logo Sekolah">
            </div>
            
            <div>
                <h1 class="text-3xl font-bold tracking-tight">Selamat Datang, Admin!</h1>
                <p class="text-blue-100 mt-2 text-lg">Sistem Informasi Bimbingan Penyuluhan & Kesiswaan</p>
                <p class="text-blue-200 text-sm mt-1">SMK Pembangunan Jaya – YAKAPI</p>
            </div>
        </div>

        <div class="relative z-10 text-right hidden lg:block">
            <p class="text-sm text-blue-200 uppercase tracking-wider font-semibold">Hari Ini</p>
            <p class="text-2xl font-bold">{{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        
        <div class="bg-indigo-600 p-6 rounded-xl shadow-md hover:shadow-lg transition-shadow duration-300 text-white relative overflow-hidden">
            <div class="relative z-10">
                <p class="text-sm font-medium text-indigo-200 uppercase tracking-wide">Total Siswa Aktif</p>
                <div class="mt-2 flex items-baseline">
                    <p class="text-4xl font-bold">{{ $siswaAktif }}</p>
                    <p class="ml-2 text-sm text-indigo-300">/ {{ $totalSiswa }}</p>
                </div>
            </div>
            <div class="absolute top-4 right-4 text-indigo-800 opacity-40 pointer-events-none transform scale-150">
                <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 20 20"><path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"></path></svg>
            </div>
        </div>

        <div class="bg-amber-500 p-6 rounded-xl shadow-md hover:shadow-lg transition-shadow duration-300 text-white relative overflow-hidden">
            <div class="relative z-10">
                <p class="text-sm font-medium text-amber-100 uppercase tracking-wide">Total Guru</p>
                <div class="mt-2 flex items-baseline">
                    <p class="text-4xl font-bold">{{ $totalGuru }}</p>
                    <p class="ml-2 text-sm text-amber-200">Orang</p>
                </div>
            </div>
            <div class="absolute top-4 right-4 text-amber-700 opacity-40 pointer-events-none transform scale-150">
                <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 20 20"><path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.666 8.666 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"></path></svg>
            </div>
        </div>

        <div class="bg-purple-600 p-6 rounded-xl shadow-md hover:shadow-lg transition-shadow duration-300 text-white relative overflow-hidden">
            <div class="relative z-10">
                <p class="text-sm font-medium text-purple-100 uppercase tracking-wide">Total Kelas</p>
                <div class="mt-2 flex items-baseline">
                    <p class="text-4xl font-bold">{{ $totalKelas }}</p>
                    <p class="ml-2 text-sm text-purple-200">Kelas</p>
                </div>
            </div>
            <div class="absolute top-4 right-4 text-purple-800 opacity-40 pointer-events-none transform scale-150">
                <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 20 20"><path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z"></path><path fill-rule="evenodd" d="M3 5a2 2 0 012-2h10a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V5zm11 1H6v8h8V6z" clip-rule="evenodd"></path></svg>
            </div>
        </div>

        <div class="bg-rose-600 p-6 rounded-xl shadow-md hover:shadow-lg transition-shadow duration-300 text-white relative overflow-hidden">
            <div class="relative z-10">
                <p class="text-sm font-medium text-rose-100 uppercase tracking-wide">Laporan Menunggu</p>
                <div class="mt-2 flex items-baseline">
                    <p class="text-4xl font-bold">{{ $laporanMenunggu }}</p>
                    <p class="ml-2 text-sm text-rose-200">/ {{ $laporanBulanIni }} Bln ini</p>
                </div>
            </div>
            <div class="absolute top-4 right-4 text-rose-800 opacity-40 pointer-events-none transform scale-150">
                <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <div class="lg:col-span-2 bg-white rounded-lg border border-gray-200 shadow-sm p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-4">Tren Laporan Perilaku (6 Bulan Terakhir)</h3>
            <div class="relative h-72 w-full">
                <canvas id="barChart"></canvas>
            </div>
        </div>

        <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-4">Perbandingan Kasus</h3>
            <div class="relative h-72 w-full flex justify-center">
                <canvas id="doughnutChart"></canvas>
            </div>
        </div>

    </div>

    <div class="bg-white rounded-lg border border-gray-200 shadow-sm">
        <div class="px-6 py-5 border-b border-gray-200 flex justify-between items-center">
            <h3 class="text-lg font-bold text-gray-900">Laporan Perilaku Terbaru</h3>
            <a href="{{ route('laporan-perilaku.index') }}" class="text-sm font-semibold text-blue-600 hover:text-blue-800 transition-colors">Lihat Semua</a>
        </div>
        
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Nama Siswa</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Jenis Perilaku</th>
                        <th class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @forelse($laporanTerbaru as $laporan)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $laporan->tanggal_kejadian->format('d/m/Y') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">{{ $laporan->siswa->nama ?? '-' }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $laporan->jenisPerilaku->nama_perilaku }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <span class="inline-flex items-center px-2.5 py-1 rounded text-xs font-semibold
                                {{ $laporan->status_verifikasi == 'menunggu' ? 'bg-amber-100 text-amber-800 border border-amber-200' : '' }}
                                {{ $laporan->status_verifikasi == 'disetujui' ? 'bg-emerald-100 text-emerald-800 border border-emerald-200' : '' }}
                                {{ $laporan->status_verifikasi == 'ditolak' ? 'bg-rose-100 text-rose-800 border border-rose-200' : '' }}">
                                {{ ucfirst($laporan->status_verifikasi) }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="px-6 py-8 text-center text-gray-500 text-sm">Belum ada laporan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctxBar = document.getElementById('barChart').getContext('2d');
        new Chart(ctxBar, {
            type: 'bar',
            data: {
                labels: {!! json_encode($bulanLabels) !!},
                datasets: [{
                    label: 'Jumlah Laporan',
                    data: {!! json_encode($dataPelanggaran) !!},
                    backgroundColor: '#3b82f6',
                    borderRadius: 4,
                    barThickness: 30
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { stepSize: 1 },
                        grid: { borderDash: [2, 4], color: '#e5e7eb' }
                    },
                    x: {
                        grid: { display: false }
                    }
                }
            }
        });

        const ctxDoughnut = document.getElementById('doughnutChart').getContext('2d');
        new Chart(ctxDoughnut, {
            type: 'doughnut',
            data: {
                labels: ['Pelanggaran', 'Reward'],
                datasets: [{
                    data: [{{ $totalPelanggaran }}, {{ $totalReward }}],
                    backgroundColor: ['#f43f5e', '#10b981'],
                    borderWidth: 0,
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '70%',
                plugins: {
                    legend: { position: 'bottom' }
                }
            }
        });
    });
</script>
@endsection