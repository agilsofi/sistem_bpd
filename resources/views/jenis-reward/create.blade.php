@extends('layouts.app')

@section('title', 'Tambah Jenis Reward')
@section('page-title', 'Tambah Jenis Reward')

@section('content')
<div class="max-w-2xl">
    <div class="bg-white rounded-lg border border-gray-200 p-6">
        <form method="POST" action="{{ route('jenis-reward.store') }}">
            @csrf

            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Reward <span class="text-red-600">*</span></label>
                    <input type="text" name="nama_reward" value="{{ old('nama_reward') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    @error('nama_reward') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kredit Poin <span class="text-red-600">*</span></label>
                    <input type="number" name="kredit_poin" value="{{ old('kredit_poin') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required min="1">
                    <p class="text-xs text-gray-500 mt-1">Nilai kredit yang diberikan (angka positif)</p>
                    @error('kredit_poin') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Keterangan</label>
                    <textarea name="keterangan" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('keterangan') }}</textarea>
                    @error('keterangan') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status <span class="text-red-600">*</span></label>
                    <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <option value="aktif" {{ old('status', 'aktif') === 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="nonaktif" {{ old('status') === 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                    @error('status') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="flex items-center justify-end space-x-3 pt-4 border-t border-gray-200">
                    <a href="{{ route('jenis-reward.index') }}" class="px-4 py-2 text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200">Batal</a>
                    <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
