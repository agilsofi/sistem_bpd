@extends('layouts.app')

@section('title', 'Dashboard Guru')
@section('page-title', 'Dashboard Guru')

@section('content')
<div class="space-y-6">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-lg border border-gray-200">
            <p class="text-sm font-medium text-gray-600">Laporan Saya</p>
            <p class="text-3xl font-semibold text-gray-900 mt-2">{{ $totalLaporanSaya }}</p>
        </div>

        <div class="bg-white p-6 rounded-lg border border-gray-200">
            <p class="text-sm font-medium text-gray-600">Menunggu Verifikasi</p>
            <p class="text-3xl font-semibold text-yellow-600 mt-2">{{ $laporanMenunggu }}</p>
        </div>

        <div class="bg-white p-6 rounded-lg border border-gray-200">
            <p class="text-sm font-medium text-gray-600">Laporan Disetujui</p>
            <p class="text-3xl font-semibold text-green-600 mt-2">{{ $laporanDisetujui }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-lg border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                    <h3 class="text-lg font-medium text-gray-900">Laporan Terbaru Anda</h3>
                    <a href="{{ route('laporan-perilaku.index') }}" class="text-sm text-blue-600 hover:text-blue-800">Lihat Semua</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Siswa</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($laporanTerbaru as $laporan)
                            <tr>
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $laporan->tanggal_kejadian->format('d/m/Y') }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900">
                                    {{ $laporan->siswa->nama ?? '(Tidak disebutkan)' }}
                                    <p class="text-xs text-gray-500">{{ $laporan->jenisPerilaku->nama_perilaku }}</p>
                                </td>
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
                                <td colspan="3" class="px-6 py-4 text-center text-gray-500 text-sm">Belum ada laporan yang Anda buat.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="space-y-6">
            <div class="bg-blue-50 rounded-lg border border-blue-200 p-6">
                <h3 class="text-lg font-medium text-blue-900 mb-2">Tindakan Cepat</h3>
                <p class="text-sm text-blue-700 mb-4">Laporkan perilaku siswa untuk menjaga kedisiplinan dan ketertiban sekolah.</p>
                <a href="{{ route('laporan-perilaku.create') }}" class="block w-full text-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    Buat Laporan Baru
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
