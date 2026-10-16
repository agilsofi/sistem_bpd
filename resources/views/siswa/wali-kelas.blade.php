@extends('layouts.app')

@section('title', 'Data Kelas')
@section('page-title', 'Data Kelas')

@section('content')
<div class="space-y-6">
    @forelse($kelasWali as $kelas)
    <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 bg-blue-50">
            <h3 class="text-lg font-semibold text-gray-900">{{ $kelas->nama_kelas }}</h3>
            <div class="grid grid-cols-3 gap-4 mt-2 text-sm text-gray-600">
                <p><span class="font-medium">Jurusan:</span> {{ $kelas->jurusan->nama_jurusan ?? '-' }}</p>
                <p><span class="font-medium">Tahun Ajaran:</span> {{ $kelas->tahunAjaran->tahun_ajaran ?? '-' }}</p>
                <p><span class="font-medium">Kapasitas:</span> {{ $kelas->siswa->count() }} / {{ $kelas->kapasitas }}</p>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">NIS</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Siswa</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jenis Kelamin</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($kelas->siswa as $index => $siswa)
                    <tr>
                        <td class="px-6 py-4 text-sm text-gray-900">{{ $index + 1 }}</td>
                        <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $siswa->NIS }}</td>
                        <td class="px-6 py-4 text-sm text-gray-900">{{ $siswa->nama }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $siswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                        <td class="px-6 py-4 text-sm">
                            <span class="px-2 py-1 text-xs rounded-full {{ $siswa->status === 'aktif' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                {{ ucfirst($siswa->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm">
                            <a href="{{ route('siswa.lihat.show', $siswa->id_siswa) }}" class="text-blue-600 hover:text-blue-800">Lihat Detail</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-gray-500 text-sm">Belum ada siswa di kelas ini.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @empty
    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6">
        <p class="text-yellow-800">Anda belum ditugaskan sebagai wali kelas.</p>
    </div>
    @endforelse
</div>
@endsection
