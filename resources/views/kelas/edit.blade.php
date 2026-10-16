@extends('layouts.app')

@section('title', 'Edit Kelas')
@section('page-title', 'Edit Kelas')

@section('content')
<div class="max-w-2xl">
    <div class="bg-white rounded-lg border border-gray-200 p-6">
        <form method="POST" action="{{ route('kelas.update', $kelas->id_kelas) }}">
            @csrf
            @method('PUT')

            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Kelas <span class="text-red-600">*</span></label>
                    <input type="text" name="nama_kelas" value="{{ old('nama_kelas', $kelas->nama_kelas) }}" placeholder="X-A, XI-B, XII-C" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    @error('nama_kelas') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tingkat <span class="text-red-600">*</span></label>
                    <select name="tingkat" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <option value="">Pilih Tingkat</option>
                        <option value="10" {{ old('tingkat', $kelas->tingkat) == '10' ? 'selected' : '' }}>10</option>
                        <option value="11" {{ old('tingkat', $kelas->tingkat) == '11' ? 'selected' : '' }}>11</option>
                        <option value="12" {{ old('tingkat', $kelas->tingkat) == '12' ? 'selected' : '' }}>12</option>
                    </select>
                    @error('tingkat') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Jurusan <span class="text-red-600">*</span></label>
                    <select name="id_jurusan" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <option value="">Pilih Jurusan</option>
                        @foreach($jurusan as $j)
                        <option value="{{ $j->id_jurusan }}" {{ old('id_jurusan', $kelas->id_jurusan) == $j->id_jurusan ? 'selected' : '' }}>{{ $j->nama_jurusan }}</option>
                        @endforeach
                    </select>
                    @error('id_jurusan') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tahun Ajaran <span class="text-red-600">*</span></label>
                    <select name="id_tahun_ajaran" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <option value="">Pilih Tahun Ajaran</option>
                        @foreach($tahunAjaran as $ta)
                        <option value="{{ $ta->id_tahun_ajaran }}" {{ old('id_tahun_ajaran', $kelas->id_tahun_ajaran) == $ta->id_tahun_ajaran ? 'selected' : '' }}>{{ $ta->tahun_ajaran }} - {{ ucfirst($ta->semester) }}</option>
                        @endforeach
                    </select>
                    @error('id_tahun_ajaran') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Wali Kelas</label>
                    <select name="id_wali_kelas" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">-- Tidak Ada --</option>
                        @foreach($guru as $g)
                        <option value="{{ $g->id_guru }}" {{ old('id_wali_kelas', $kelas->id_wali_kelas) == $g->id_guru ? 'selected' : '' }}>{{ $g->nama_guru }} ({{ $g->nip }})</option>
                        @endforeach
                    </select>
                    <p class="text-xs text-gray-500 mt-1">Hanya wali kelas yang dapat melihat data siswa kelas ini.</p>
                    @error('id_wali_kelas') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kapasitas <span class="text-red-600">*</span></label>
                    <input type="number" name="kapasitas" value="{{ old('kapasitas', $kelas->kapasitas) }}" min="1" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    @error('kapasitas') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status <span class="text-red-600">*</span></label>
                    <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <option value="aktif" {{ old('status', $kelas->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="nonaktif" {{ old('status', $kelas->status) == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                    @error('status') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="flex items-center justify-end space-x-3 pt-4 border-t border-gray-200">
                    <a href="{{ route('kelas.index') }}" class="px-4 py-2 text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200">Batal</a>
                    <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700">Perbarui</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
