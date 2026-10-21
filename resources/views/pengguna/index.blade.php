@extends('layouts.app')

@section('title', 'Manajemen Pengguna')
@section('page-title', 'Manajemen Pengguna')

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
        <h3 class="text-lg font-medium text-gray-900">Daftar Pengguna</h3>
        <a href="{{ route('pengguna.create') }}" class="px-4 py-2 bg-blue-600 text-white text-sm rounded-lg hover:bg-blue-700">
            Tambah Pengguna
        </a>
    </div>

    <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Role</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Pemilik Akun</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($users as $index => $u)
                <tr>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $index + 1 }}</td>
                    <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $u->nama_tampil }}</td>
                    <td class="px-6 py-4 text-sm text-gray-600">
                        <span class="px-2 py-1 text-xs rounded-full 
                            {{ $u->role === 'admin' ? 'bg-purple-100 text-purple-800' : '' }}
                            {{ $u->role === 'guru' ? 'bg-blue-100 text-blue-800' : '' }}
                            {{ $u->role === 'bk' ? 'bg-yellow-100 text-yellow-800' : '' }}
                            {{ $u->role === 'kesiswaan' ? 'bg-indigo-100 text-indigo-800' : '' }}
                            {{ $u->role === 'siswa' ? 'bg-green-100 text-green-800' : '' }}">
                            {{ strtoupper($u->role) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600">
                        @if($u->guru)
                            {{ $u->guru->nama_guru }} (Guru)
                        @elseif($u->siswa)
                            {{ $u->siswa->nama }} (Siswa - {{ $u->siswa->NIS }})
                        @else
                            -
                        @endif
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600">
                        <span class="px-2 py-1 text-xs rounded-full {{ $u->status === 'aktif' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ ucfirst($u->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm text-right space-x-2">
                        <a href="{{ route('pengguna.edit', $u->id_user) }}" class="text-blue-600 hover:text-blue-800">Edit</a>
                        @if($u->id_user !== auth()->id())
                        <form action="{{ route('pengguna.destroy', $u->id_user) }}" method="POST" class="inline" onsubmit="return confirm('Hapus pengguna ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800">Hapus</button>
                        </form>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-8 text-center text-gray-500">Belum ada pengguna.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
