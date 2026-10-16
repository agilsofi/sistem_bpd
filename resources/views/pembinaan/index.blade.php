@extends('layouts.app')

@section('title', 'Pembinaan')
@section('page-title', 'Data Pembinaan')

@section('content')
<div class="space-y-6">
    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex justify-between items-center">
        <h3 class="text-lg font-medium text-gray-900">Daftar Pembinaan</h3>
        <a href="{{ route('pembinaan.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
            Tambah Pembinaan
        </a>
    </div>

    <div class="bg-white rounded-lg border border-gray-200 p-4">
        <form method="GET" action="{{ route('pembinaan.index') }}" class="flex gap-4">
            <div class="flex-1">
                <label class="block text-sm font-medium text-gray-700 mb-1">Cari Siswa</label>
                <input type="text" name="id_siswa" placeholder="NIS atau nama siswa" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm" value="{{ request('id_siswa') }}">
            </div>
            <div class="flex-1">
                <label class="block text-sm font-medium text-gray-700 mb-1">Dari Tanggal</label>
                <input type="date" name="tanggal_dari" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm" value="{{ request('tanggal_dari') }}">
            </div>
            <div class="flex-1">
                <label class="block text-sm font-medium text-gray-700 mb-1">Sampai Tanggal</label>
                <input type="date" name="tanggal_sampai" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm" value="{{ request('tanggal_sampai') }}">
            </div>
            <div class="flex items-end gap-2">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm">Cari</button>
                <a href="{{ route('pembinaan.index') }}" class="px-4 py-2 bg-gray-300 text-gray-900 rounded-lg hover:bg-gray-400 text-sm">Reset</a>
            </div>
        </form>
    </div>

    <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Siswa</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jenis</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Alasan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Pembina</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($pembinaan as $item)
                <tr>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $item->tanggal->format('d/m/Y') }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">
                        {{ $item->siswa->nama }}
                        <p class="text-xs text-gray-500">{{ $item->siswa->NIS }} | {{ $item->siswa->kelas->nama_kelas ?? '-' }}</p>
                    </td>
                    <td class="px-6 py-4 text-sm">
                        <span class="px-2 py-1 text-xs rounded bg-blue-100 text-blue-800">{{ ucfirst($item->jenis_pembinaan) }}</span>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ Str::limit($item->alasan, 50) }}</td>
                    <td class="px-6 py-4 text-sm text-gray-600">{{ $item->pembina->nama_guru }}</td>
                    <td class="px-6 py-4 text-sm text-right space-x-2">
                        <a href="{{ route('pembinaan.show', $item->id_pembinaan) }}" class="text-blue-600 hover:text-blue-800">Lihat</a>
                        <a href="{{ route('pembinaan.edit', $item->id_pembinaan) }}" class="text-green-600 hover:text-green-800">Edit</a>
                        <form action="{{ route('pembinaan.destroy', $item->id_pembinaan) }}" method="POST" class="inline" onsubmit="return confirm('Hapus?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-8 text-center text-gray-500 text-sm">Tidak ada data pembinaan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $pembinaan->links() }}
    </div>
</div>
@endsection
