@extends('layouts.app')

@section('title', 'Jenis Reward')
@section('page-title', 'Jenis Reward')

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
        <h3 class="text-lg font-medium text-gray-900">Daftar Jenis Reward</h3>
        <a href="{{ route('jenis-reward.create') }}" class="px-4 py-2 bg-blue-600 text-white text-sm rounded-lg hover:bg-blue-700">
            Tambah Jenis Reward
        </a>
    </div>

    <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Reward</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kredit</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Keterangan</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($jenisReward as $index => $item)
                <tr>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $index + 1 }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $item->nama_reward }}</td>
                    <td class="px-6 py-4 text-sm">
                        <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">
                            {{ $item->kredit_poin }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600">{{ $item->keterangan ?? '-' }}</td>
                    <td class="px-6 py-4 text-sm text-right space-x-2">
                        <a href="{{ route('jenis-reward.edit', $item->id_jenis_reward) }}" class="text-blue-600 hover:text-blue-800">Edit</a>
                        <form action="{{ route('jenis-reward.destroy', $item->id_jenis_reward) }}" method="POST" class="inline" onsubmit="return confirm('Hapus jenis reward ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-gray-500">Belum ada data jenis reward.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
