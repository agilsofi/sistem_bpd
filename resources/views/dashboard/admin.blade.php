@extends('layouts.app')

@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard Administrator')

@section('content')
<div class="space-y-6">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white p-6 rounded-lg border border-gray-200">
            <p class="text-sm font-medium text-gray-600">Total Siswa Aktif</p>
            <p class="text-3xl font-semibold text-gray-900 mt-2">{{ $siswaAktif }}</p>
            <p class="text-sm text-gray-500 mt-1">Dari total {{ $totalSiswa }} siswa</p>
        </div>

        <div class="bg-white p-6 rounded-lg border border-gray-200">
            <p class="text-sm font-medium text-gray-600">Total Guru</p>
            <p class="text-3xl font-semibold text-gray-900 mt-2">{{ $totalGuru }}</p>
        </div>

        <div class="bg-white p-6 rounded-lg border border-gray-200">
            <p class="text-sm font-medium text-gray-600">Total Kelas</p>
            <p class="text-3xl font-semibold text-gray-900 mt-2">{{ $totalKelas }}</p>
        </div>

        <div class="bg-white p-6 rounded-lg border border-gray-200">
            <p class="text-sm font-medium text-gray-600">Laporan Menunggu</p>
            <p class="text-3xl font-semibold text-red-600 mt-2">{{ $laporanMenunggu }}</p>
            <p class="text-sm text-gray-500 mt-1">Dari {{ $laporanBulanIni }} laporan bulan ini</p>
        </div>
    </div>

    <div class="bg-white rounded-lg border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <h3 class="text-lg font-medium text-gray-900">Laporan Perilaku Terbaru</h3>
            <a href="{{ route('laporan-perilaku.index') }}" class="text-sm text-blue-600 hover:text-blue-800">Lihat Semua</a>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Siswa</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jenis Perilaku</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($laporanTerbaru as $laporan)
                    <tr>
                        <td class="px-6 py-4 text-sm text-gray-900">{{ $laporan->tanggal_kejadian->format('d/m/Y') }}</td>
                        <td class="px-6 py-4 text-sm text-gray-900">{{ $laporan->siswa->nama ?? '(Tidak disebutkan)' }}</td>
                        <td class="px-6 py-4 text-sm text-gray-900">{{ $laporan->jenisPerilaku->nama_perilaku }}</td>
                        <td class="px-6 py-4 text-sm">
                            <span class="px-2 py-1 text-xs rounded 
                                {{ $laporan->status_verifikasi == 'menunggu' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                {{ $laporan->status_verifikasi == 'disetujui' ? 'bg-green-100 text-green-800' : '' }}
                                {{ $laporan->status_verifikasi == 'ditolak' ? 'bg-red-100 text-red-800' : '' }}">
                                {{ ucfirst($laporan->status_verifikasi) }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-gray-500 text-sm">Belum ada laporan</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection