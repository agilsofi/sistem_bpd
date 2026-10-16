@extends('layouts.app')

@section('title', 'Data Guru')
@section('page-title', 'Data Guru')

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
        <h3 class="text-lg font-medium text-gray-900">Daftar Guru</h3>
        <div class="flex gap-2">
            <button onclick="document.getElementById('importModal').classList.remove('hidden')" class="px-4 py-2 bg-green-600 text-white text-sm rounded-lg hover:bg-green-700">
                Import Excel
            </button>
            <a href="{{ route('guru.create') }}" class="px-4 py-2 bg-blue-600 text-white text-sm rounded-lg hover:bg-blue-700">
                Tambah Guru
            </a>
        </div>
    </div>

    <!-- Import Modal -->
    <div id="importModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
        <div class="bg-white rounded-lg p-6 max-w-md w-full">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Import Data Guru</h3>
            <form method="POST" action="{{ route('guru.import') }}" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">File CSV</label>
                    <input type="file" name="file" accept=".csv,.txt" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm" required>
                    <p class="text-xs text-gray-500 mt-1">Format kolom: NIP, Nama_Guru, Jenis_Kelamin (L/P), Tempat_Lahir, Tanggal_Lahir (YYYY-MM-DD), No_Telepon, Email, Alamat</p>
                </div>
                <div class="flex gap-2 justify-end">
                    <button type="button" onclick="document.getElementById('importModal').classList.add('hidden')" class="px-4 py-2 bg-gray-300 text-gray-900 rounded-lg hover:bg-gray-400">
                        Batal
                    </button>
                    <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                        Import
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">NIP</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">JK</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Wali Kelas</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($guru as $index => $item)
                <tr>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $index + 1 }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $item->nip }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $item->nama_guru }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $item->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $item->status_wali_kelas == 'ya' ? 'Ya' : 'Tidak' }}</td>
                    <td class="px-6 py-4 text-sm">
                        <span class="px-2 py-1 text-xs rounded-full {{ $item->status == 'aktif' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                            {{ ucfirst($item->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm text-right space-x-2">
                        <a href="{{ route('guru.edit', $item->id_guru) }}" class="text-blue-600 hover:text-blue-800">Edit</a>
                        <form action="{{ route('guru.destroy', $item->id_guru) }}" method="POST" class="inline" onsubmit="return confirm('Hapus data guru ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-8 text-center text-gray-500">Belum ada data guru.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection