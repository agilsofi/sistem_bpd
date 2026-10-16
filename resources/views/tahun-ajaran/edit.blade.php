@extends('layouts.app')

@section('title', 'Edit Tahun Ajaran')
@section('page-title', 'Edit Tahun Ajaran')

@section('content')
<div class="max-w-2xl">
    <div class="bg-white rounded-lg border border-gray-200 p-6">
        <form method="POST" action="{{ route('tahun-ajaran.update', $tahunAjaran->id_tahun_ajaran) }}">
            @csrf
            @method('PUT')

            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tahun Ajaran <span class="text-red-600">*</span></label>
                    <input type="text" name="nama_tahun_ajaran" value="{{ old('nama_tahun_ajaran', $tahunAjaran->nama_tahun_ajaran) }}" placeholder="2024/2025" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    @error('nama_tahun_ajaran') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Semester <span class="text-red-600">*</span></label>
                    <select name="semester" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <option value="">Pilih Semester</option>
                        <option value="ganjil" {{ old('semester', $tahunAjaran->semester) === 'ganjil' ? 'selected' : '' }}>Ganjil</option>
                        <option value="genap" {{ old('semester', $tahunAjaran->semester) === 'genap' ? 'selected' : '' }}>Genap</option>
                    </select>
                    @error('semester') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Mulai <span class="text-red-600">*</span></label>
                        <input type="date" name="tanggal_mulai" value="{{ old('tanggal_mulai', $tahunAjaran->tanggal_mulai) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        @error('tanggal_mulai') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Selesai <span class="text-red-600">*</span></label>
                        <input type="date" name="tanggal_selesai" value="{{ old('tanggal_selesai', $tahunAjaran->tanggal_selesai) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        @error('tanggal_selesai') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status <span class="text-red-600">*</span></label>
                    <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <option value="aktif" {{ old('status', $tahunAjaran->status) === 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="tidak_aktif" {{ old('status', $tahunAjaran->status) === 'tidak_aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                    </select>
                    @error('status') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="flex items-center justify-end space-x-3 pt-4 border-t border-gray-200">
                    <a href="{{ route('tahun-ajaran.index') }}" class="px-4 py-2 text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200">Batal</a>
                    <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700">Perbarui</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
