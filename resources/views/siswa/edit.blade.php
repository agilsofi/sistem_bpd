@extends('layouts.app')

@section('title', 'Edit Siswa')
@section('page-title', 'Edit Siswa')

@section('content')
<div class="max-w-4xl">
    <div class="bg-white rounded-lg border border-gray-200 p-6">
        <form method="POST" action="{{ route('siswa.update', $siswa->id_siswa) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="space-y-6">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">NIS <span class="text-red-600">*</span></label>
                        <input type="text" name="NIS" value="{{ old('NIS', $siswa->NIS) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        @error('NIS') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Siswa <span class="text-red-600">*</span></label>
                        <input type="text" name="nama" value="{{ old('nama', $siswa->nama) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        @error('nama') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Kelamin <span class="text-red-600">*</span></label>
                        <select name="jenis_kelamin" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            <option value="">Pilih</option>
                            <option value="L" {{ old('jenis_kelamin', $siswa->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ old('jenis_kelamin', $siswa->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        @error('jenis_kelamin') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status <span class="text-red-600">*</span></label>
                        <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            <option value="aktif" {{ old('status', $siswa->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="lulus" {{ old('status', $siswa->status) == 'lulus' ? 'selected' : '' }}>Lulus</option>
                            <option value="dropout" {{ old('status', $siswa->status) == 'dropout' ? 'selected' : '' }}>Dropout</option>
                            <option value="pindah" {{ old('status', $siswa->status) == 'pindah' ? 'selected' : '' }}>Pindah</option>
                        </select>
                        @error('status') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $siswa->tanggal_lahir) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('tanggal_lahir') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kelas</label>
                        <select name="id_kelas" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Pilih Kelas</option>
                            @foreach($kelas as $k)
                            <option value="{{ $k->id_kelas }}" {{ old('id_kelas', $siswa->id_kelas) == $k->id_kelas ? 'selected' : '' }}>
                                {{ $k->nama_kelas }} - {{ $k->jurusan->nama_jurusan ?? '' }}
                            </option>
                            @endforeach
                        </select>
                        @error('id_kelas') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="border-t border-gray-200 pt-4">
                    <h4 class="text-sm font-medium text-gray-900 mb-4">Data Login</h4>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Username <span class="text-red-600">*</span></label>
                            <input type="text" name="username" value="{{ old('username', $siswa->user->username ?? '') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            @error('username') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                            <input type="password" name="password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <p class="text-xs text-gray-500 mt-1">Kosongkan jika tidak ingin mengubah password.</p>
                            @error('password') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-end space-x-3 pt-4 border-t border-gray-200">
                    <a href="{{ route('siswa.index') }}" class="px-4 py-2 text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200">Batal</a>
                    <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700">Perbarui</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection