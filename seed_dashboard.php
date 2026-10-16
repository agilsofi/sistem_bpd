$laporan = App\Models\LaporanPerilaku::create([
    'id_siswa' => 1,
    'id_guru' => 1,
    'id_jenis_perilaku' => 1,
    'tanggal_kejadian' => '2026-10-12',
    'keterangan' => 'Datang terlambat 15 menit.',
    'status_verifikasi' => 'disetujui',
]);
App\Models\PoinPelanggaran::create([
    'id_siswa' => 1,
    'id_laporan' => $laporan->id_laporan,
    'tanggal' => '2026-10-12',
    'keterangan' => 'Terlambat masuk sekolah.',
    'poin' => 1,
    'id_pemberi' => 1,
]);
