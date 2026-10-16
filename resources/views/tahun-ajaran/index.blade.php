@extends('layouts.app')

@section('title', 'Tahun Ajaran')
@section('page-title', 'Tahun Ajaran')

@section('content')
<div class="space-y-6">
    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg">
            {{ session('error') }}
        </div>
    @endif

    <div class="flex justify-between items-center">
        <h3 class="text-lg font-medium text-gray-900">Daftar Tahun Ajaran</h3>
        <a href="{{ route('tahun-ajaran.create') }}" class="px-4 py-2 bg-blue-600 text-white text-sm rounded-lg hover:bg-blue-700">
            Tambah Tahun Ajaran
        </a>
    </div>

    <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tahun Ajaran</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Semester</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Periode</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($tahunAjaran as $index => $item)
                <tr>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $index + 1 }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $item->nama_tahun_ajaran }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ ucfirst($item->semester) }}</td>
                    <td class="px-6 py-4 text-sm text-gray-600">{{ date('d/m/Y', strtotime($item->tanggal_mulai)) }} - {{ date('d/m/Y', strtotime($item->tanggal_selesai)) }}</td>
                    <td class="px-6 py-4 text-sm">
                        <span class="px-2 py-1 text-xs rounded-full {{ $item->status === 'aktif' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                            {{ ucfirst(str_replace('_', ' ', $item->status)) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm text-right space-x-2">
                        <a href="{{ route('tahun-ajaran.edit', $item->id_tahun_ajaran) }}" class="text-blue-600 hover:text-blue-800">Edit</a>
                        <form action="{{ route('tahun-ajaran.destroy', $item->id_tahun_ajaran) }}" method="POST" class="inline" onsubmit="return confirm('Hapus data tahun ajaran ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-8 text-center text-gray-500">Belum ada data tahun ajaran.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
