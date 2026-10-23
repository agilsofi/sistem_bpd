<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Surat Peringatan - {{ $nama_siswa ?? 'Siswa' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Pengaturan Kertas A4 */
        @page {
            size: A4;
            margin: 2cm;
        }
        body {
            background-color: #f3f4f6;
            font-family: 'Times New Roman', Times, serif; /* Font resmi surat */
        }
        /* Sembunyikan elemen saat di-print */
        @media print {
            body { background-color: white; }
            .no-print { display: none !important; }
            .print-area { box-shadow: none !important; margin: 0 !important; padding: 0 !important; }
        }
    </style>
</head>
<body class="p-8">

    <!-- Area Kertas A4 -->
    <div class="max-w-[21cm] mx-auto bg-white p-10 shadow-lg print-area min-h-[29.7cm] relative">
        
            <!-- Tombol Aksi (Hilang saat di-print, Posisi di Atas Kertas) -->
    <div class="max-w-[21cm] mx-auto mb-4 flex justify-end gap-3 no-print">
        <button onclick="window.print()" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-sans text-sm font-semibold shadow-md flex items-center">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
            Cetak Surat
        </button>
        <a href="{{ route('surat-peringatan.index') }}" class="px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 font-sans text-sm font-semibold shadow-sm">
            Kembali
        </a>
    </div>

    <!-- Area Kertas A4 -->
    <div class="max-w-[21cm] mx-auto bg-white p-10 shadow-lg print-area min-h-[29.7cm] relative">

        <!-- KOP SURAT -->
        <div class="flex items-center gap-4 border-b-4 border-double border-gray-800 pb-4 mb-8">
            <img src="{{ asset('images/logo-sekolah.png') }}" alt="Logo" class="w-24 h-24 object-contain">
            <div class="text-center flex-1">
                <h3 class="text-lg font-bold tracking-wide uppercase">Yayasan Akademi Administrasi Pembangunan Nan Indonesia</h3>
                <h1 class="text-2xl font-extrabold tracking-wider uppercase">SMK Pembangunan Jaya</h1>
                <p class="text-sm">Jl. Raya Pembangunan No. 123, Jakarta Selatan | Telp: (021) 1234567</p>
                <p class="text-sm">Email: info@smkpembangunanjaya.sch.id | Website: www.smkpembangunanjaya.sch.id</p>
            </div>
        </div>

        <!-- Judul Surat -->
        <div class="text-center mb-8">
            <h2 class="text-xl font-bold underline uppercase">Surat Peringatan Siswa</h2>
            <p class="text-base">Nomor: 421.3/SP-01/SMK-PJ/X/2026</p>
        </div>

        <!-- Isi Surat -->
        <div class="text-base leading-relaxed space-y-4">
            <p>Berdasarkan hasil pemantauan dan evaluasi dari Tim Bimbingan Konseling (BK) serta Kesiswaan, dengan ini kami memberikan <strong>Surat Peringatan 1 (SP 1)</strong> kepada:</p>
            
            <div class="pl-8 my-4 space-y-1">
                <table class="w-full">
                    <tr>
                        <td class="w-32 font-semibold">Nama Siswa</td>
                        <td class="w-4">:</td>
                        <td class="font-bold">{{ $nama_siswa ?? 'Faiz Akbar Rizqi' }}</td>
                    </tr>
                    <tr>
                        <td class="font-semibold">NIS</td>
                        <td>:</td>
                        <td>{{ $nis ?? '2026005' }}</td>
                    </tr>
                    <tr>
                        <td class="font-semibold">Kelas</td>
                        <td>:</td>
                        <td>{{ $kelas ?? 'XI PPLG 1' }}</td>
                    </tr>
                </table>
            </div>

            <p>Dikarenakan telah melakukan pelanggaran terhadap tata tertib sekolah berupa:</p>
            
            <div class="bg-gray-100 p-4 border-l-4 border-gray-800 italic my-2">
                "{{ $alasan ?? 'Terlambat masuk kelas lebih dari 3 kali dalam satu minggu' }}"
            </div>

            <p>Sehubungan dengan hal tersebut, kami menghimbau agar siswa yang bersangkutan dapat memperbaiki perilaku dan mematuhi tata tertib yang berlaku. Surat peringatan ini berlaku sebagai peringatan tertulis pertama.</p>
            
            <p>Demikian surat peringatan ini dibuat untuk dapat dipergunakan sebagaimana mestinya.</p>
        </div>

        <!-- Tanda Tangan -->
        <div class="mt-16 flex justify-between items-end">
            <div class="text-center">
                <p>Siswa yang bersangkutan,</p>
                <div class="h-24"></div>
                <p class="font-bold underline">{{ $nama_siswa ?? 'Faiz Akbar Rizqi' }}</p>
                <p>NIS: {{ $nis ?? '2026005' }}</p>
            </div>
            
            <div class="text-center">
                <p>Jakarta, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
                <p>Kepala Sekolah,</p>
                <div class="h-24"></div>
                <p class="font-bold underline">Nama Kepala Sekolah, S.Pd., M.M.</p>
                <p>NIP: 19700101 199501 1 001</p>
            </div>
        </div>

    </div>

    <!-- Script otomatis print saat halaman dibuka -->
    <script>
        // window.print(); // Uncomment baris ini jika ingin otomatis print saat dibuka
    </script>
</body>
</html>