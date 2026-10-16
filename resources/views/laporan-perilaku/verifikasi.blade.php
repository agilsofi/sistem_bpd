@extends('layouts.app')

@section('title', 'Verifikasi Laporan')
@section('page-title', 'Verifikasi Laporan Perilaku')

@section('content')
<div class="max-w-4xl">
    <div class="bg-white rounded-lg border border-gray-200 p-6 space-y-6">
        <div>
            <h3 class="text-lg font-medium text-gray-900 mb-4">Detail Laporan</h3>
            
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <p class="text-sm text-gray-600">Siswa</p>
                    <p class="font-medium">{{ $laporan->siswa->nama ?? '(Tidak disebutkan)' }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">NIS</p>
                    <p class="font-medium">{{ $laporan->siswa->NIS ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Kelas</p>
                    <p class="font-medium">{{ $laporan->siswa?->kelas->nama_kelas ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Tanggal Kejadian</p>
                    <p class="font-medium">{{ $laporan->tanggal_kejadian->format('d/m/Y') }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Jenis Perilaku</p>
                    <p class="font-medium">{{ $laporan->jenisPerilaku->nama_perilaku }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Poin Pelanggaran</p>
                    <p class="font-medium text-red-600">{{ $laporan->jenisPerilaku->poin_pelanggaran }} poin</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Kategori</p>
                    <p class="font-medium">{{ $laporan->jenisPerilaku->kategori->nama_kategori }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Pelapor</p>
                    <p class="font-medium">{{ $laporan->guru->nama_guru }}</p>
                </div>
            </div>

            <div class="mt-4">
                <p class="text-sm text-gray-600 mb-1">Keterangan</p>
                <p class="text-gray-900 bg-gray-50 p-3 rounded border border-gray-200">{{ $laporan->keterangan }}</p>
            </div>

            @if($laporan->buktiLaporan->count() > 0)
            <div class="mt-4">
                <p class="text-sm text-gray-600 mb-2">Bukti Pendukung ({{ $laporan->buktiLaporan->count() }} file)</p>
                <div class="grid grid-cols-3 gap-3">
                    @foreach($laporan->buktiLaporan as $bukti)
                    <a href="{{ asset('storage/' . $bukti->lokasi_file) }}" target="_blank" class="block border border-gray-200 rounded-lg p-3 hover:bg-gray-50">
                        @if(in_array($bukti->tipe_file, ['jpg', 'jpeg', 'png']))
                        <img src="{{ asset('storage/' . $bukti->lokasi_file) }}" class="w-full h-32 object-cover rounded mb-2">
                        @else
                        <div class="w-full h-32 bg-gray-100 rounded mb-2 flex items-center justify-center">
                            <span class="text-gray-400 text-sm">PDF</span>
                        </div>
                        @endif
                        <p class="text-xs text-gray-600 truncate">{{ $bukti->nama_file }}</p>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif
        </div>

        <form method="POST" action="{{ route('laporan-perilaku.proses-verifikasi', $laporan->id_laporan) }}" class="border-t border-gray-200 pt-6">
            @csrf

            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Keputusan <span class="text-red-600">*</span></label>
                    <div class="flex space-x-4">
                        <label class="flex items-center">
                            <input type="radio" name="status_verifikasi" value="disetujui" class="mr-2" required>
                            <span class="text-sm">Setujui</span>
                        </label>
                        <label class="flex items-center">
                            <input type="radio" name="status_verifikasi" value="ditolak" class="mr-2" required>
                            <span class="text-sm">Tolak</span>
                        </label>
                    </div>
                    @error('status_verifikasi') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Catatan Verifikasi</label>
                    <textarea name="catatan_verifikasi" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('catatan_verifikasi') }}</textarea>
                    @error('catatan_verifikasi') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="flex items-center justify-end space-x-3 mt-6">
                <a href="{{ route('laporan-perilaku.verifikasi-index') }}" class="px-4 py-2 text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200">Batal</a>
                <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700">Simpan Verifikasi</button>
            </div>
        </form>
    </div>
</div>
@endsection
