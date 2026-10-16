@extends('layouts.app')

@section('title', 'Dashboard BK')
@section('page-title', 'Dashboard Bimbingan Konseling')

@section('content')
<div class="space-y-6">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-yellow-50 p-6 rounded-lg border border-yellow-200">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm font-medium text-yellow-800">Antrian Verifikasi Laporan</p>
                    <p class="text-3xl font-semibold text-yellow-900 mt-2">{{ $laporanMenunggu }}</p>
                </div>
                <a href="{{ route('laporan-perilaku.verifikasi-index') }}" class="px-3 py-1 bg-yellow-600 text-white text-sm rounded hover:bg-yellow-700">Verifikasi</a>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg border border-gray-200">
            <p class="text-sm font-medium text-gray-600">Laporan Bulan Ini</p>
            <p class="text-3xl font-semibold text-gray-900 mt-2">{{ $laporanBulanIni }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Antrian Verifikasi -->
        <div class="bg-white rounded-lg border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">Perlu Verifikasi (Terbaru)</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Siswa</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Perilaku</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($laporanMenungguList as $laporan)
                        <tr>
                            <td class="px-6 py-4 text-sm text-gray-900">
                                {{ $laporan->siswa->nama ?? '(Tidak disebutkan)' }}
                                <p class="text-xs text-gray-500">{{ $laporan->siswa?->kelas->nama_kelas ?? '-' }}</p>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900">
                                {{ $laporan->jenisPerilaku->nama_perilaku }}
                                <p class="text-xs text-gray-500 text-red-600">{{ $laporan->jenisPerilaku->poin_pelanggaran }} poin</p>
                            </td>
                            <td class="px-6 py-4 text-sm text-right">
                                <a href="{{ route('laporan-perilaku.verifikasi', $laporan->id_laporan) }}" class="text-blue-600 hover:text-blue-800">Verifikasi</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="px-6 py-4 text-center text-gray-500 text-sm">Tidak ada antrian verifikasi.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Siswa Berisiko (Poin Tinggi) -->
        <div class="bg-white rounded-lg border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">Siswa Butuh Perhatian (Poin > 50)</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Siswa</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kelas</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total Poin</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($siswaRisiko as $siswa)
                        <tr>
                            <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $siswa->nama }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $siswa->kelas->nama_kelas ?? '-' }}</td>
                            <td class="px-6 py-4 text-sm">
                                <span class="text-red-600 font-medium">{{ $siswa->poin_pelanggaran_sum_poin }} poin</span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="px-6 py-4 text-center text-gray-500 text-sm">Tidak ada siswa dengan poin tinggi.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
