@extends('layouts.app')

@section('title', 'Data Siswa')
@section('page-title', 'Data Siswa')

@section('content')
<div class="space-y-6">
    <h3 class="text-lg font-medium text-gray-900">Daftar Siswa</h3>

    <div class="bg-white rounded-lg border border-gray-200 p-4">
        <form method="GET" action="{{ route('siswa.lihat') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari NIS atau Nama..." class="px-3 py-2 border border-gray-300 rounded-lg text-sm">
            
            <select name="id_kelas" class="px-3 py-2 border border-gray-300 rounded-lg text-sm">
                <option value="">Semua Kelas</option>
                @foreach($kelas as $k)
                <option value="{{ $k->id_kelas }}" {{ request('id_kelas') == $k->id_kelas ? 'selected' : '' }}>{{ $k->nama_kelas }}</option>
                @endforeach
            </select>

            <select name="status" class="px-3 py-2 border border-gray-300 rounded-lg text-sm">
                <option value="">Semua Status</option>
                <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="lulus" {{ request('status') == 'lulus' ? 'selected' : '' }}>Lulus</option>
                <option value="dropout" {{ request('status') == 'dropout' ? 'selected' : '' }}>Dropout</option>
                <option value="pindah" {{ request('status') == 'pindah' ? 'selected' : '' }}>Pindah</option>
            </select>

            <div class="flex gap-2">
                <a href="{{ route('siswa.lihat') }}" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 text-sm">Reset</a>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm">Filter</button>
            </div>
        </form>
    </div>

    <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">NIS</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kelas</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">JK</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($siswa as $index => $item)
                <tr>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $index + 1 }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $item->NIS }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $item->nama }}</td>
                    <td class="px-6 py-4 text-sm text-gray-600">{{ $item->kelas->nama_kelas ?? '-' }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $item->jenis_kelamin }}</td>
                    <td class="px-6 py-4 text-sm">
                        <span class="px-2 py-1 text-xs rounded 
                            {{ $item->status == 'aktif' ? 'bg-green-100 text-green-800' : '' }}
                            {{ $item->status == 'lulus' ? 'bg-blue-100 text-blue-800' : '' }}
                            {{ $item->status == 'dropout' ? 'bg-red-100 text-red-800' : '' }}
                            {{ $item->status == 'pindah' ? 'bg-gray-100 text-gray-800' : '' }}">
                            {{ ucfirst($item->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm text-right">
                        <a href="{{ route('siswa.lihat.show', $item->id_siswa) }}" class="text-blue-600 hover:text-blue-800">Lihat</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-8 text-center text-gray-500">Belum ada data siswa.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
