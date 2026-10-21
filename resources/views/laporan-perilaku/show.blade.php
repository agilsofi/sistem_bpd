@extends('layouts.app')

@section('title', 'Detail Laporan')
@section('page-title', 'Detail Laporan Perilaku')

@section('content')
<div class="max-w-4xl">
    <div class="bg-white rounded-lg border border-gray-200 p-6 space-y-6">
        <div>
            <h3 class="text-lg font-medium text-gray-900 mb-4">Informasi Laporan</h3>
            
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <p class="text-sm text-gray-600">Siswa</p>
                    <p class="font-medium">{{ $laporanPerilaku->siswa->nama ?? '(Tidak disebutkan)' }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">NIS</p>
                    <p class="font-medium">{{ $laporanPerilaku->siswa->NIS ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Kelas</p>
                    <p class="font-medium">{{ $laporanPerilaku->siswa?->kelas->nama_kelas ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Tanggal Kejadian</p>
                    <p class="font-medium">{{ $laporanPerilaku->tanggal_kejadian->format('d/m/Y') }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Jenis Perilaku</p>
                    <p class="font-medium">{{ $laporanPerilaku->jenisPerilaku->nama_perilaku }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Poin Pelanggaran</p>
                    <p class="font-medium text-red-600">{{ $laporanPerilaku->jenisPerilaku->poin_pelanggaran }} poin</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Kategori</p>
                    <p class="font-medium">{{ $laporanPerilaku->jenisPerilaku->kategori->nama_kategori }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Pelapor</p>
                    <p class="font-medium">{{ $laporanPerilaku->guru->nama_guru }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Status</p>
                    <p class="font-medium">
                        <span class="px-2 py-1 text-xs rounded 
                            {{ $laporanPerilaku->status_verifikasi == 'menunggu' ? 'bg-yellow-100 text-yellow-800' : '' }}
                            {{ $laporanPerilaku->status_verifikasi == 'disetujui' ? 'bg-green-100 text-green-800' : '' }}
                            {{ $laporanPerilaku->status_verifikasi == 'ditolak' ? 'bg-red-100 text-red-800' : '' }}">
                            {{ ucfirst($laporanPerilaku->status_verifikasi) }}
                        </span>
                    </p>
                </div>
            </div>

            <div class="mt-4">
                <p class="text-sm text-gray-600 mb-1">Keterangan</p>
                <p class="text-gray-900 bg-gray-50 p-3 rounded border border-gray-200">{{ $laporanPerilaku->keterangan }}</p>
            </div>
        </div>

        @if($laporanPerilaku->buktiLaporan->count() > 0)
        <div class="border-t border-gray-200 pt-6">
            <p class="text-sm font-medium text-gray-900 mb-3">Bukti Pendukung</p>
            <div class="grid grid-cols-3 gap-4">
                @foreach($laporanPerilaku->buktiLaporan as $bukti)
                <a href="{{ Storage::url($bukti->lokasi_file) }}" target="_blank" class="block border border-gray-200 rounded-lg p-4 hover:bg-gray-50">
                    @if(in_array(strtolower($bukti->tipe_file), ['jpg', 'jpeg', 'png']))
                    <img src="{{ Storage::url($bukti->lokasi_file) }}" class="w-full h-40 object-cover rounded mb-2">
                    @else
                    <div class="w-full h-40 bg-gray-100 rounded mb-2 flex items-center justify-center">
                        <span class="text-gray-400 text-sm">{{ strtoupper($bukti->tipe_file) }}</span>
                    </div>
                    @endif
                    <p class="text-sm text-gray-600 truncate">{{ $bukti->nama_file }}</p>
                    <p class="text-xs text-gray-400 mt-1">{{ number_format($bukti->ukuran_file / 1024, 1) }} KB</p>
                </a>
                @endforeach
            </div>
        </div>
        @endif

        <div class="border-t border-gray-200 pt-6">
            <h4 class="text-sm font-medium text-gray-900 mb-3">Catatan Verifikasi</h4>
            @if($laporanPerilaku->catatan_verifikasi)
            <div class="p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                <p class="text-sm text-gray-900 mb-2"><span class="font-medium">Verifikator:</span> {{ $laporanPerilaku->bkVerifikator ? $laporanPerilaku->bkVerifikator->nama_guru : 'BK' }}</p>
                <p class="text-sm text-gray-900"><span class="font-medium">Tanggal:</span> {{ $laporanPerilaku->tanggal_verifikasi ? $laporanPerilaku->tanggal_verifikasi->format('d/m/Y H:i') : '-' }}</p>
                <p class="text-sm text-gray-700 mt-2">{{ $laporanPerilaku->catatan_verifikasi }}</p>
            </div>
            @else
            <p class="text-sm text-gray-500">Belum ada catatan verifikasi.</p>
            @endif
        </div>

        <div class="border-t border-gray-200 pt-6">
            <h4 class="text-sm font-medium text-gray-900 mb-3">Poin Pelanggaran</h4>
            @if($laporanPerilaku->poinPelanggaran)
            <div class="p-4 bg-green-50 border border-green-200 rounded-lg">
                <p class="text-sm text-gray-900">Poin telah dicatat sebesar <strong class="text-green-700">{{ $laporanPerilaku->poinPelanggaran->poin }} poin</strong> untuk siswa ini.</p>
            </div>
            @else
            <p class="text-sm text-gray-500">Belum ada poin yang dicatat untuk laporan ini.</p>
            @endif
        </div>

        <div class="flex items-center justify-between pt-6 border-t border-gray-200">
            <a href="{{ route('laporan-perilaku.index') }}" class="px-4 py-2 text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200">Kembali</a>

            <a href="{{ route('laporan-perilaku.rekap', $laporanPerilaku->id_siswa) }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                Lihat Seluruh Rekap Laporan Siswa
            </a>
        </div>
    </div>
</div>
@endsection
