@extends('layouts.app')

@section('title', 'Verifikasi Laporan')
@section('page-title', 'Verifikasi Laporan Perilaku')

@section('content')
<div class="space-y-6">
    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex justify-between items-center">
        <h3 class="text-lg font-medium text-gray-900">Antrian Verifikasi</h3>
    </div>

    <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Siswa</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kelas</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jenis Perilaku</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Poin</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Pelapor</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($laporan as $item)
                <tr>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $item->tanggal_kejadian->format('d/m/Y') }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $item->siswa->nama ?? '(Tidak disebutkan)' }}</td>
                    <td class="px-6 py-4 text-sm text-gray-600">{{ $item->siswa?->kelas->nama_kelas ?? '-' }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $item->jenisPerilaku->nama_perilaku }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $item->jenisPerilaku->poin_pelanggaran }}</td>
                    <td class="px-6 py-4 text-sm text-gray-600">{{ $item->guru->nama_guru }}</td>
                    <td class="px-6 py-4 text-sm text-right">
                        <a href="{{ route('laporan-perilaku.verifikasi', $item->id_laporan) }}" class="text-blue-600 hover:text-blue-800">Verifikasi</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-8 text-center text-gray-500">Tidak ada laporan yang menunggu verifikasi.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $laporan->links() }}
    </div>
</div>
@endsection
