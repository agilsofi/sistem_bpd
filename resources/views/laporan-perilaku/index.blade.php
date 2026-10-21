@extends('layouts.app')

@section('title', 'Laporan Perilaku')
@section('page-title', 'Laporan Perilaku')

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
        <h3 class="text-lg font-medium text-gray-900">Daftar Laporan Perilaku</h3>
        <a href="{{ route('laporan-perilaku.create') }}" class="px-4 py-2 bg-blue-600 text-white text-sm rounded-lg hover:bg-blue-700">
            Buat Laporan
        </a>
    </div>

    <div class="bg-white rounded-lg border border-gray-200 p-4">
        <form method="GET" action="{{ route('laporan-perilaku.index') }}" class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-6 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Cari Siswa</label>
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari NIS atau nama..." class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Dari</label>
                <input type="date" name="tanggal_dari" value="{{ request('tanggal_dari') }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Sampai</label>
                <input type="date" name="tanggal_sampai" value="{{ request('tanggal_sampai') }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm">
            </div>
            <div>
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
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Perilaku</label>
                <select name="id_jenis_perilaku" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm">
                    <option value="">Semua Jenis</option>
                    @foreach($jenisPerilaku as $jp)
                    <option value="{{ $jp->id_jenis_perilaku }}" {{ request('id_jenis_perilaku') == $jp->id_jenis_perilaku ? 'selected' : '' }}>
                        {{ $jp->nama_perilaku }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select name="status_verifikasi" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm">
                    <option value="">Semua Status</option>
                    <option value="menunggu" {{ request('status_verifikasi') == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                    <option value="disetujui" {{ request('status_verifikasi') == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                    <option value="ditolak" {{ request('status_verifikasi') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                </select>
            </div>
            <div class="md:col-span-3 lg:col-span-6 flex justify-end space-x-2">
                <a href="{{ route('laporan-perilaku.index') }}" class="px-4 py-2 text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 text-sm">Reset</a>
                <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700 text-sm">Cari</button>
            </div>
        </form>
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
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
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
                    <td class="px-6 py-4 text-sm">
                        <span class="px-2 py-1 text-xs rounded 
                            {{ $item->status_verifikasi == 'menunggu' ? 'bg-yellow-100 text-yellow-800' : '' }}
                            {{ $item->status_verifikasi == 'disetujui' ? 'bg-green-100 text-green-800' : '' }}
                            {{ $item->status_verifikasi == 'ditolak' ? 'bg-red-100 text-red-800' : '' }}">
                            {{ ucfirst($item->status_verifikasi) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm text-right space-x-2">
                        <a href="{{ route('laporan-perilaku.show', $item->id_laporan) }}" class="text-blue-600 hover:text-blue-800">Detail</a>
                        @if(Auth::user()->role === 'admin' || ($item->status_verifikasi == 'menunggu' && Auth::user()->guru && $item->id_guru == Auth::user()->guru->id_guru))
                        <form action="{{ route('laporan-perilaku.destroy', $item->id_laporan) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus laporan ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800">Hapus</button>
                        </form>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="px-6 py-8 text-center text-gray-500">Belum ada laporan perilaku.</td>
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
