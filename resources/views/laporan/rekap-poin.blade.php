@extends('layouts.app')

@section('title', 'Rekap Poin Pelanggaran')
@section('page-title', 'Rekap Poin Pelanggaran')

@section('content')
<div class="space-y-6">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-lg border border-gray-200">
            <p class="text-sm font-medium text-gray-600">Total Poin (Semua Siswa)</p>
            <p class="text-3xl font-bold text-red-600 mt-2">{{ $totalPoin }}</p>
        </div>
        <div class="bg-white p-6 rounded-lg border border-gray-200">
            <p class="text-sm font-medium text-gray-600">Siswa dengan Poin ≥ 50</p>
            <p class="text-3xl font-bold text-orange-600 mt-2">{{ $siswaPoinTinggi }}</p>
        </div>
        <div class="bg-white p-6 rounded-lg border border-gray-200">
            <p class="text-sm font-medium text-gray-600">Total Siswa Terdata</p>
            <p class="text-3xl font-bold text-blue-600 mt-2">{{ $siswa->count() }}</p>
        </div>
    </div>

    <div class="bg-white rounded-lg border border-gray-200 p-4">
        <form method="GET" action="{{ route('rekap-poin.index') }}" class="flex gap-4">
            <div class="flex-1">
                <label class="block text-sm font-medium text-gray-700 mb-1">Kelas</label>
                <select name="id_kelas" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm">
                    <option value="">Semua Kelas</option>
                    @foreach($kelas as $k)
                    <option value="{{ $k->id_kelas }}" {{ request('id_kelas') == $k->id_kelas ? 'selected' : '' }}>
                        {{ $k->nama_kelas }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="flex-1">
                <label class="block text-sm font-medium text-gray-700 mb-1">Status Siswa</label>
                <select name="status" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm">
                    <option value="aktif" {{ request('status', 'aktif') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="">Semua Status</option>
                    <option value="lulus" {{ request('status') == 'lulus' ? 'selected' : '' }}>Lulus</option>
                    <option value="dropout" {{ request('status') == 'dropout' ? 'selected' : '' }}>Dropout</option>
                </select>
            </div>
            <div class="flex items-end gap-2">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm">Cari</button>
                <a href="{{ route('rekap-poin.index') }}" class="px-4 py-2 bg-gray-300 text-gray-900 rounded-lg hover:bg-gray-400 text-sm">Reset</a>
            </div>
        </form>
    </div>

    <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Siswa</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">NIS</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kelas</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Total Poin</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($siswa as $index => $item)
                <tr>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $index + 1 }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $item->nama }}</td>
                    <td class="px-6 py-4 text-sm text-gray-600">{{ $item->NIS }}</td>
                    <td class="px-6 py-4 text-sm text-gray-600">{{ $item->kelas->nama_kelas ?? '-' }}</td>
                    <td class="px-6 py-4 text-sm font-bold text-right">
                        <span class="{{ ($item->total_poin ?? 0) >= 50 ? 'text-red-600' : (($item->total_poin ?? 0) > 0 ? 'text-orange-600' : 'text-green-600') }}">
                            {{ $item->total_poin ?? 0 }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm">
                        <span class="px-2 py-1 text-xs rounded
                            {{ $item->status == 'aktif' ? 'bg-green-100 text-green-800' : '' }}
                            {{ $item->status == 'lulus' ? 'bg-blue-100 text-blue-800' : '' }}
                            {{ $item->status == 'dropout' ? 'bg-red-100 text-red-800' : '' }}">
                            {{ ucfirst($item->status) }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-8 text-center text-gray-500 text-sm">Tidak ada data siswa.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
