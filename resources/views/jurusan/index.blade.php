@extends('layouts.app')

@section('title', 'Data Jurusan')
@section('page-title', 'Data Jurusan')

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
        <h3 class="text-lg font-medium text-gray-900">Daftar Jurusan</h3>
        <a href="{{ route('jurusan.create') }}" class="px-4 py-2 bg-blue-600 text-white text-sm rounded-lg hover:bg-blue-700">
            Tambah Jurusan
        </a>
    </div>

    <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kode</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Jurusan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Deskripsi</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($jurusan as $index => $item)
                <tr>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $index + 1 }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $item->kode_jurusan }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $item->nama_jurusan }}</td>
                    <td class="px-6 py-4 text-sm text-gray-600">{{ $item->deskripsi ?? '-' }}</td>
                    <td class="px-6 py-4 text-sm text-right space-x-2">
                        <a href="{{ route('jurusan.edit', $item->id_jurusan) }}" class="text-blue-600 hover:text-blue-800">Edit</a>
                        <form action="{{ route('jurusan.destroy', $item->id_jurusan) }}" method="POST" class="inline" onsubmit="return confirm('Hapus data jurusan ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-gray-500">Belum ada data jurusan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
