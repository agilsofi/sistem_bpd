@extends('layouts.app')

@section('title', 'Dashboard Kesiswaan')
@section('page-title', 'Dashboard Kesiswaan')

@section('content')
<div class="space-y-6">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white p-6 rounded-lg border border-gray-200">
            <p class="text-sm font-medium text-gray-600">Total Siswa Aktif</p>
            <p class="text-3xl font-semibold text-gray-900 mt-2">{{ $totalSiswa }}</p>
        </div>

        <div class="bg-white p-6 rounded-lg border border-gray-200">
            <p class="text-sm font-medium text-gray-600">Total Pelanggaran</p>
            <p class="text-3xl font-semibold text-gray-900 mt-2">{{ $totalLaporan }}</p>
        </div>

        <div class="bg-white p-6 rounded-lg border border-gray-200">
            <p class="text-sm font-medium text-gray-600">Pelanggaran Bulan Ini</p>
            <p class="text-3xl font-semibold text-red-600 mt-2">{{ $laporanBulanIni }}</p>
        </div>

        <div class="bg-white p-6 rounded-lg border border-gray-200">
            <p class="text-sm font-medium text-gray-600">Surat Peringatan Dikeluarkan</p>
            <p class="text-3xl font-semibold text-gray-900 mt-2">{{ $totalSP }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white rounded-lg border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">Jenis Pelanggaran Terbanyak</h3>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    @forelse($pelanggaranTerbanyak as $item)
                    <div>
                        <div class="flex justify-between items-center mb-1">
                            <span class="text-sm font-medium text-gray-700">{{ $item->jenisPerilaku->nama_perilaku }}</span>
                            <span class="text-sm font-medium text-gray-900">{{ $item->total }} kasus</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-blue-600 h-2 rounded-full" style="width: {{ min(($item->total / max($totalLaporan, 1)) * 100, 100) }}%"></div>
                        </div>
                    </div>
                    @empty
                    <p class="text-center text-gray-500 text-sm">Belum ada data pelanggaran.</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Siswa Berisiko (Poin Tinggi) -->
        <div class="bg-white rounded-lg border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">Siswa dengan Poin Pelanggaran Tinggi</h3>
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
