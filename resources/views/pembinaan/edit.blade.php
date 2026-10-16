@extends('layouts.app')

@section('title', 'Edit Pembinaan')
@section('page-title', 'Edit Pembinaan')

@section('content')
<div class="max-w-2xl">
    <div class="bg-white rounded-lg border border-gray-200 p-6">
        <form method="POST" action="{{ route('pembinaan.update', $pembinaan->id_pembinaan) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium text-gray-900 mb-2">Siswa</label>
                <input type="text" value="{{ $pembinaan->siswa->nama }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm bg-gray-100" disabled>
                <input type="hidden" name="id_siswa" value="{{ $pembinaan->id_siswa }}">
            </div>

            <div>
                <label for="tanggal" class="block text-sm font-medium text-gray-900 mb-2">Tanggal Pembinaan</label>
                <input type="date" id="tanggal" name="tanggal" class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm" value="{{ $pembinaan->tanggal->format('Y-m-d') }}" required>
                @error('tanggal') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="id_pembina" class="block text-sm font-medium text-gray-900 mb-2">Pembina</label>
                <select id="id_pembina" name="id_pembina" class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm" required>
                    @foreach($guru as $g)
                    <option value="{{ $g->id_guru }}" {{ $pembinaan->id_pembina == $g->id_guru ? 'selected' : '' }}>{{ $g->nama_guru }}</option>
                    @endforeach
                </select>
                @error('id_pembina') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="jenis_pembinaan" class="block text-sm font-medium text-gray-900 mb-2">Jenis Pembinaan</label>
                <select id="jenis_pembinaan" name="jenis_pembinaan" class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm" required>
                    <option value="verbal" {{ $pembinaan->jenis_pembinaan == 'verbal' ? 'selected' : '' }}>Verbal (Lisan)</option>
                    <option value="tertulis" {{ $pembinaan->jenis_pembinaan == 'tertulis' ? 'selected' : '' }}>Tertulis</option>
                    <option value="mediasi" {{ $pembinaan->jenis_pembinaan == 'mediasi' ? 'selected' : '' }}>Mediasi</option>
                    <option value="konseling" {{ $pembinaan->jenis_pembinaan == 'konseling' ? 'selected' : '' }}>Konseling</option>
                </select>
                @error('jenis_pembinaan') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="alasan" class="block text-sm font-medium text-gray-900 mb-2">Alasan Pembinaan</label>
                <textarea id="alasan" name="alasan" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm" required>{{ $pembinaan->alasan }}</textarea>
                @error('alasan') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="hasil" class="block text-sm font-medium text-gray-900 mb-2">Hasil Pembinaan</label>
                <textarea id="hasil" name="hasil" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm">{{ $pembinaan->hasil }}</textarea>
                @error('hasil') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="tindak_lanjut" class="block text-sm font-medium text-gray-900 mb-2">Tindak Lanjut</label>
                <textarea id="tindak_lanjut" name="tindak_lanjut" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm">{{ $pembinaan->tindak_lanjut }}</textarea>
                @error('tindak_lanjut') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="keterangan" class="block text-sm font-medium text-gray-900 mb-2">Keterangan</label>
                <textarea id="keterangan" name="keterangan" rows="2" class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm">{{ $pembinaan->keterangan }}</textarea>
            </div>

            <div class="flex gap-3">
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Simpan</button>
                <a href="{{ route('pembinaan.index') }}" class="px-6 py-2 bg-gray-300 text-gray-900 rounded-lg hover:bg-gray-400">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
