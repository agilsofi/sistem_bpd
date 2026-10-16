@extends('layouts.app')

@section('title', 'Data Kelas')
@section('page-title', 'Data Kelas')

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
        <h3 class="text-lg font-medium text-gray-900">Daftar Kelas</h3>
        <a href="{{ route('kelas.create') }}" class="px-4 py-2 bg-blue-600 text-white text-sm rounded-lg hover:bg-blue-700">
            Tambah Kelas
        </a>
    </div>

    <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Kelas</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jurusan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Wali Kelas</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tahun Ajaran</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kapasitas</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($kelas as $index => $item)
                <tr>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $index + 1 }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $item->nama_kelas }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $item->jurusan->nama_jurusan ?? '-' }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $item->waliKelas->nama_guru ?? '-' }}</td>
                    <td class="px-6 py-4 text-sm text-gray-600">{{ $item->tahunAjaran->tahun_ajaran ?? '-' }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $item->kapasitas }}</td>
                    <td class="px-6 py-4 text-sm text-right space-x-2">
                        <a href="{{ route('kelas.edit', $item->id_kelas) }}" class="text-blue-600 hover:text-blue-800">Edit</a>
                        <form action="{{ route('kelas.destroy', $item->id_kelas) }}" method="POST" class="inline" onsubmit="return confirm('Hapus data kelas ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-8 text-center text-gray-500">Belum ada data kelas.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
