@extends('layouts.app')

@section('title', 'Dashboard Siswa')
@section('page-title', 'Dashboard Siswa')

@section('content')
<div class="space-y-6">
    <!-- Identitas Siswa -->
    <div class="bg-white rounded-lg border border-gray-200 p-6 flex items-center justify-between">
        <div class="flex items-center space-x-4">
            <div class="h-16 w-16 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 font-bold text-2xl">
                {{ substr($siswa->nama, 0, 1) }}
            </div>
            <div>
                <h2 class="text-xl font-bold text-gray-900">{{ $siswa->nama }}</h2>
                <p class="text-gray-600">NIS: {{ $siswa->NIS }} | Kelas: {{ $siswa->kelas->nama_kelas ?? '-' }}</p>
            </div>
        </div>
        <div class="text-right">
            <p class="text-sm font-medium text-gray-600">Total Poin Pelanggaran</p>
            <p class="text-4xl font-bold {{ $totalPoin > 50 ? 'text-red-600' : ($totalPoin > 0 ? 'text-yellow-600' : 'text-green-600') }}">
                {{ $totalPoin ?? 0 }}
            </p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Laporan Perilaku -->
        <div class="bg-white rounded-lg border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h3 class="text-lg font-medium text-gray-900">Catatan Perilaku Terbaru</h3>
                <span class="text-xs bg-gray-100 text-gray-800 px-2 py-1 rounded">{{ $totalLaporan }} Laporan</span>
            </div>
            <div class="p-0">
                <ul class="divide-y divide-gray-200">
                    @forelse($laporanTerbaru as $laporan)
                    <li class="p-6 hover:bg-gray-50">
                        <div class="flex justify-between items-start mb-2">
                            <div>
                                <p class="text-sm font-medium text-gray-900">{{ $laporan->jenisPerilaku->nama_perilaku }}</p>
                                <p class="text-xs text-gray-500">{{ $laporan->tanggal_kejadian->format('d/m/Y') }} • Dilaporkan oleh: {{ $laporan->guru->nama_guru ?? '(Tidak diketahui)' }}</p>
                            </div>
                            <span class="px-2 py-1 text-xs rounded 
                                {{ $laporan->status_verifikasi == 'menunggu' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                {{ $laporan->status_verifikasi == 'disetujui' ? 'bg-green-100 text-green-800' : '' }}
                                {{ $laporan->status_verifikasi == 'ditolak' ? 'bg-red-100 text-red-800' : '' }}">
                                {{ ucfirst($laporan->status_verifikasi) }}
                            </span>
                        </div>
                        <p class="text-sm text-gray-600 mt-2">{{ $laporan->keterangan }}</p>
                    </li>
                    @empty
                    <li class="p-6 text-center text-gray-500 text-sm">
                        Belum ada catatan perilaku. Terus pertahankan!
                    </li>
                    @endforelse
                </ul>
            </div>
        </div>

        <!-- Riwayat Poin -->
        <div class="bg-white rounded-lg border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">Riwayat Penambahan Poin</h3>
            </div>
            <div class="p-0">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Keterangan</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Poin</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($poinPelanggaran as $poin)
                        <tr>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $poin->tanggal->format('d/m/Y') }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $poin->keterangan }}</td>
                            <td class="px-6 py-4 text-sm font-medium text-red-600 text-right">+{{ $poin->poin }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="px-6 py-8 text-center text-gray-500 text-sm">Belum ada riwayat poin pelanggaran.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
