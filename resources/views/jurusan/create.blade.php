@extends('layouts.app')

@section('title', 'Tambah Jurusan')
@section('page-title', 'Tambah Jurusan')

@section('content')
<div class="max-w-2xl">
    <div class="bg-white rounded-lg border border-gray-200 p-6">
        <form method="POST" action="{{ route('jurusan.store') }}">
            @csrf

            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kode Jurusan <span class="text-red-600">*</span></label>
                    <input type="text" name="kode_jurusan" value="{{ old('kode_jurusan') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    @error('kode_jurusan') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Jurusan <span class="text-red-600">*</span></label>
                    <input type="text" name="nama_jurusan" value="{{ old('nama_jurusan') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    @error('nama_jurusan') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                    <textarea name="deskripsi" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="flex items-center justify-end space-x-3 pt-4 border-t border-gray-200">
                    <a href="{{ route('jurusan.index') }}" class="px-4 py-2 text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200">Batal</a>
                    <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
