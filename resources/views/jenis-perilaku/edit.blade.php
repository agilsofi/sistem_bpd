@extends('layouts.app')

@section('title', 'Edit Jenis Perilaku')
@section('page-title', 'Edit Jenis Perilaku')

@section('content')
<div class="max-w-2xl">
    <div class="bg-white rounded-lg border border-gray-200 p-6">
        <form method="POST" action="{{ route('jenis-perilaku.update', $jenisPerilaku->id_jenis_perilaku) }}">
            @csrf
            @method('PUT')

            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kategori <span class="text-red-600">*</span></label>
                    <select name="id_kategori" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <option value="">Pilih Kategori</option>
                        @foreach($kategori as $k)
                        <option value="{{ $k->id_kategori }}" {{ old('id_kategori', $jenisPerilaku->id_kategori) == $k->id_kategori ? 'selected' : '' }}>
                            {{ $k->nama_kategori }}
                        </option>
                        @endforeach
                    </select>
                    @error('id_kategori') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Perilaku <span class="text-red-600">*</span></label>
                    <input type="text" name="nama_perilaku" value="{{ old('nama_perilaku', $jenisPerilaku->nama_perilaku) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    @error('nama_perilaku') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Poin Pelanggaran <span class="text-red-600">*</span></label>
                    <input type="number" name="poin_pelanggaran" value="{{ old('poin_pelanggaran', $jenisPerilaku->poin_pelanggaran) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <p class="text-xs text-gray-500 mt-1">Jumlah poin pelanggaran untuk perilaku ini</p>
                    @error('poin_pelanggaran') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status <span class="text-red-600">*</span></label>
                    <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <option value="aktif" {{ old('status', $jenisPerilaku->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="nonaktif" {{ old('status', $jenisPerilaku->status) == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                    @error('status') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Keterangan</label>
                    <textarea name="keterangan" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('keterangan', $jenisPerilaku->keterangan) }}</textarea>
                    @error('keterangan') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="flex items-center justify-end space-x-3 pt-4 border-t border-gray-200">
                    <a href="{{ route('jenis-perilaku.index') }}" class="px-4 py-2 text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200">Batal</a>
                    <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700">Perbarui</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
