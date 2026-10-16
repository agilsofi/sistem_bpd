@extends('layouts.app')

@section('title', 'Reward Siswa')
@section('page-title', 'Reward Siswa')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h3 class="text-lg font-semibold text-gray-900">Daftar Reward</h3>
        <a href="{{ route('reward.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Tambah Reward</a>
    </div>

    <div class="bg-white rounded-lg border border-gray-200 p-4">
        <form method="GET" action="{{ route('reward.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <input type="text" name="id_siswa" placeholder="Cari NIS/Nama Siswa" class="px-3 py-2 border border-gray-300 rounded-lg text-sm" value="{{ request('id_siswa') }}">
            <select name="id_jenis_reward" class="px-3 py-2 border border-gray-300 rounded-lg text-sm">
                <option value="">Semua Jenis Reward</option>
                @foreach($jenisReward as $item)
                <option value="{{ $item->id_jenis_reward }}" {{ request('id_jenis_reward') == $item->id_jenis_reward ? 'selected' : '' }}>{{ $item->nama_reward }}</option>
                @endforeach
            </select>
            <input type="date" name="tanggal_dari" class="px-3 py-2 border border-gray-300 rounded-lg text-sm" value="{{ request('tanggal_dari') }}">
            <button type="submit" class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700">Cari</button>
        </form>
    </div>

    <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Siswa</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jenis Reward</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Alasan</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Poin</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($reward as $item)
                <tr>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $item->tanggal->format('d/m/Y') }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">
                        {{ $item->siswa->nama }}
                        <p class="text-xs text-gray-500">{{ $item->siswa->NIS }}</p>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $item->jenisReward->nama_reward }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ Str::limit($item->alasan, 50) }}</td>
                    <td class="px-6 py-4 text-sm font-medium text-green-600 text-right">+{{ $item->kredit_poin }}</td>
                    <td class="px-6 py-4 text-sm">
                        <a href="{{ route('reward.show', $item->id_kredit_reward) }}" class="text-blue-600 hover:text-blue-800 mr-3">Lihat</a>
                        <form method="POST" action="{{ route('reward.destroy', $item->id_kredit_reward) }}" style="display:inline;" onsubmit="return confirm('Yakin?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-8 text-center text-gray-500 text-sm">Belum ada reward.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $reward->links() }}
    </div>
</div>
@endsection
