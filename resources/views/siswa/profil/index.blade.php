@extends('layouts.app')

@section('title', 'Profil Siswa')
@section('page-title', 'Profil Saya')

@section('content')
<div class="max-w-4xl space-y-6">
    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg">
            <ul class="list-disc list-inside text-sm">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white rounded-lg border border-gray-200 p-6">
        <h3 class="text-lg font-medium text-gray-900 mb-4">Informasi Akun & Data Diri</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <p class="text-sm font-medium text-gray-500">Nomor Induk Siswa (NIS)</p>
                <p class="text-base font-semibold text-gray-900">{{ $siswa->NIS }}</p>
                <p class="text-xs text-gray-400 mt-1">NIS tidak dapat diubah sendiri. Hubungi admin jika ada kesalahan.</p>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500">Kelas</p>
                <p class="text-base font-semibold text-gray-900">{{ optional($siswa->kelas)->nama_kelas ?? '-' }}</p>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500">Status Siswa</p>
                <p class="text-base font-semibold text-gray-900">
                    <span class="px-2 py-1 text-xs rounded-full {{ $siswa->status == 'aktif' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                        {{ ucfirst($siswa->status) }}
                    </span>
                </p>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500">Jenis Kelamin</p>
                <p class="text-base font-semibold text-gray-900">{{ $siswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
            </div>
        </div>

        <hr class="my-6 border-gray-200">

        <h3 class="text-lg font-medium text-gray-900 mb-4">Edit Profil / Koreksi Data</h3>
        <form method="POST" action="{{ route('siswa.profil.update') }}" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                <input type="text" name="nama" value="{{ old('nama', $siswa->nama) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-blue-500 focus:border-blue-500" required>
                        <option value="L" {{ old('jenis_kelamin', $siswa->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ old('jenis_kelamin', $siswa->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', optional($siswa->tanggal_lahir)->format('Y-m-d')) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Username Login</label>
                <input type="text" name="username" value="{{ old('username', optional($siswa->user)->username) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Password Baru (Opsional)</label>
                    <input type="password" name="password" class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-blue-500 focus:border-blue-500" placeholder="Kosongkan jika tidak diubah">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password Baru</label>
                    <input type="password" name="password_confirmation" class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-blue-500 focus:border-blue-500" placeholder="Ulangi password baru">
                </div>
            </div>

            <hr class="my-6 border-gray-200">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Data Orang Tua & Alamat</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Ayah</label>
                    <input type="text" name="nama_ayah" value="{{ old('nama_ayah', $siswa->nama_ayah) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Pekerjaan Ayah</label>
                    <input type="text" name="pekerjaan_ayah" value="{{ old('pekerjaan_ayah', $siswa->pekerjaan_ayah) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Ibu</label>
                    <input type="text" name="nama_ibu" value="{{ old('nama_ibu', $siswa->nama_ibu) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Pekerjaan Ibu</label>
                    <input type="text" name="pekerjaan_ibu" value="{{ old('pekerjaan_ibu', $siswa->pekerjaan_ibu) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">No. HP Orang Tua</label>
                <input type="text" name="no_hp_orang_tua" value="{{ old('no_hp_orang_tua', $siswa->no_hp_orang_tua) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap</label>
                <textarea name="alamat" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-blue-500 focus:border-blue-500">{{ old('alamat', $siswa->alamat) }}</textarea>
            </div>

            <div class="flex justify-end pt-4">
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
