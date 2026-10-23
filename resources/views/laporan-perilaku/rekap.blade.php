<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Rekap Laporan - {{ $siswa->nama }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Pengaturan khusus untuk hasil cetak (Print) */
        @media print {
            @page { margin: 1.5cm; }
            body { -webkit-print-color-adjust: exact; print-color-adjust: exact; }
            .print\:hidden { display: none !important; }
        }
    </style>
</head>
<body class="bg-gray-50 p-8 text-gray-800 font-sans">

    <!-- Area Kertas A4 -->
    <div class="max-w-4xl mx-auto bg-white p-10 shadow-lg print:shadow-none print:p-0">
        
        <!-- Header Cetak -->
        <div class="text-center border-b-2 border-gray-800 pb-4 mb-6">
            <h1 class="text-2xl font-bold tracking-wider">SISTEM BPD</h1>
            <h2 class="text-lg text-gray-600">SMK Pembangunan Jaya</h2>
            <p class="text-sm text-gray-500 mt-1">Rekapitulasi Perilaku Siswa</p>
        </div>

        <!-- Info Siswa -->
        <div class="mb-8 bg-gray-50 p-4 rounded-lg border border-gray-200 print:bg-transparent print:border-none print:p-0 print:mb-6">
            <div class="grid grid-cols-3 gap-4 text-sm">
                <div>
                    <span class="text-gray-500 block">Nama Siswa</span>
                    <span class="font-bold text-gray-900">{{ $siswa->nama }}</span>
                </div>
                <div>
                    <span class="text-gray-500 block">NIS</span>
                    <span class="font-bold text-gray-900">{{ $siswa->NIS }}</span>
                </div>
                <div>
                    <span class="text-gray-500 block">Kelas</span>
                    <span class="font-bold text-gray-900">{{ $siswa->kelas->nama_kelas ?? '-' }}</span>
                </div>
            </div>
        </div>

        <!-- Tabel Pelanggaran -->
        <h3 class="text-lg font-bold mb-3 border-l-4 border-red-500 pl-3">Riwayat Pelanggaran</h3>
        <table class="w-full border-collapse mb-8 text-sm">
            <thead>
                <tr class="bg-gray-100 text-gray-700 text-left">
                    <th class="border-b-2 border-gray-300 px-4 py-3 w-12 text-center">No</th>
                    <th class="border-b-2 border-gray-300 px-4 py-3 w-32">Tanggal</th>
                    <th class="border-b-2 border-gray-300 px-4 py-3">Jenis Pelanggaran</th>
                    <th class="border-b-2 border-gray-300 px-4 py-3 w-20 text-center">Poin</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pelanggaran as $index => $p)
                <tr class="hover:bg-gray-50 print:hover:bg-transparent">
                    <td class="border-b border-gray-200 px-4 py-3 text-center">{{ $index + 1 }}</td>
                    <td class="border-b border-gray-200 px-4 py-3">{{ \Carbon\Carbon::parse($p->tanggal)->format('d/m/Y') }}</td>
                    <td class="border-b border-gray-200 px-4 py-3">{{ $p->keterangan }}</td>
                    <td class="border-b border-gray-200 px-4 py-3 text-center text-red-600 font-bold">{{ $p->poin }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="border-b border-gray-200 px-4 py-6 text-center text-gray-500 italic">Tidak ada data pelanggaran.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Tabel Reward -->
        <h3 class="text-lg font-bold mb-3 border-l-4 border-green-500 pl-3">Riwayat Reward / Penghargaan</h3>
        <table class="w-full border-collapse mb-8 text-sm">
            <thead>
                <tr class="bg-gray-100 text-gray-700 text-left">
                    <th class="border-b-2 border-gray-300 px-4 py-3 w-12 text-center">No</th>
                    <th class="border-b-2 border-gray-300 px-4 py-3 w-32">Tanggal</th>
                    <th class="border-b-2 border-gray-300 px-4 py-3">Jenis Reward</th>
                    <th class="border-b-2 border-gray-300 px-4 py-3 w-20 text-center">Poin</th>
                </tr>
            </thead>
            <tbody>
                            @forelse($rewards as $index => $r)
            <tr class="hover:bg-gray-50 print:hover:bg-transparent">
                <td class="border-b border-gray-200 px-4 py-3 text-center">{{ $index + 1 }}</td>
                
                <!-- Ambil dari kolom tanggal (sesuaikan jika namanya tanggal_reward) -->
                <td class="border-b border-gray-200 px-4 py-3">{{ \Carbon\Carbon::parse($r->tanggal)->format('d/m/Y') }}</td>
                
                <!-- Ambil dari relasi jenisReward, atau dari kolom keterangan -->
                <td class="border-b border-gray-200 px-4 py-3">{{ $r->jenisReward->nama_reward ?? $r->keterangan ?? '-' }}</td>
                
                <!-- Ambil poin -->
                <!-- Mengambil poin dari kolom kredit/jumlah -->
<td class="border-b border-gray-200 px-4 py-3 text-center text-green-600 font-bold">{{ $r->kredit_poin ?? 0 }}</td>
            @empty
                <tr>
                    <td colspan="4" class="border-b border-gray-200 px-4 py-6 text-center text-gray-500 italic">Tidak ada data reward.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Kesimpulan / Total -->
        <div class="flex justify-end mt-6">
            <div class="border border-gray-300 rounded-lg p-5 bg-gray-50 w-72 print:bg-transparent print:border-gray-400">
                <div class="flex justify-between items-center mb-2">
                    <span class="text-gray-600">Total Pelanggaran</span>
                    <span class="text-red-600 font-bold text-lg">{{ $total_pelanggaran }} Poin</span>
                </div>
                <div class="flex justify-between items-center border-t border-gray-300 pt-2">
                    <span class="text-gray-600">Total Reward</span>
                   <span class="text-green-600 font-bold text-lg">{{ $total_reward }} Poin</span>
                </div>
            </div>
        </div>

        <!-- Tanda Tangan (Opsional, untuk print) -->
        <div class="mt-16 flex justify-end hidden print:block">
            <div class="text-center">
                <p class="mb-16">Jakarta, {{ date('d F Y') }}</p>
                <p class="font-bold underline">(_______________________)</p>
                <p class="text-sm text-gray-600">Guru BK / Kesiswaan</p>
            </div>
        </div>

    </div>

    <!-- Tombol Aksi (Hilang saat di-print) -->
    <div class="max-w-4xl mx-auto mt-6 flex space-x-4 print:hidden">
        <button onclick="window.print()" class="px-5 py-2.5 bg-blue-600 text-white font-medium rounded-lg shadow hover:bg-blue-700 transition">Cetak Halaman</button>
        <a href="{{ url()->previous() }}" class="px-5 py-2.5 bg-white border border-gray-300 text-gray-700 font-medium rounded-lg shadow-sm hover:bg-gray-50 transition">Kembali</a>
    </div>

</body>
</html>