@extends('layouts.app')

@section('title', 'Buat Surat Peringatan')
@section('page-title', 'Buat Surat Peringatan')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <!-- Header Halaman -->
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Buat Surat Peringatan</h1>
            <p class="text-sm text-slate-500 mt-2">Isi form di bawah ini untuk membuat surat peringatan baru.</p>
        </div>
        <a href="{{ route('surat-peringatan.index') }}" class="inline-flex items-center px-4 py-2.5 text-sm font-semibold text-slate-600 bg-white border border-slate-300 rounded-xl hover:bg-slate-50 transition-all shadow-sm">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali
        </a>
    </div>

    <!-- Card Form -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <form action="#" method="POST">
            @csrf
            
            <div class="p-6 space-y-6">
                
                <!-- Pilih Siswa -->
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Pilih Siswa <span class="text-rose-500">*</span></label>
                    <select name="id_siswa" class="w-full px-4 py-3 text-sm border border-slate-300 rounded-xl focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all bg-slate-50 focus:bg-white cursor-pointer" required>
                        <option value="">-- Pilih Siswa --</option>
                        <!-- Nanti diisi dengan data siswa dari database -->
                        <option value="1">Faiz Akbar Rizqi (2026005 - XI PPLG 1)</option>
                        <option value="2">Andi Pratama (2026001)</option>
                    </select>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Tingkat SP -->
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Tingkat SP <span class="text-rose-500">*</span></label>
                        <select name="tingkat_sp" class="w-full px-4 py-3 text-sm border border-slate-300 rounded-xl focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all bg-slate-50 focus:bg-white cursor-pointer" required>
                            <option value="">-- Pilih Tingkat --</option>
                            <option value="SP 1">Surat Peringatan 1 (SP 1)</option>
                            <option value="SP 2">Surat Peringatan 2 (SP 2)</option>
                            <option value="SP 3">Surat Peringatan 3 (SP 3)</option>
                        </select>
                    </div>

                    <!-- Tanggal -->
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Tanggal Surat <span class="text-rose-500">*</span></label>
                        <input type="date" name="tanggal" class="w-full px-4 py-3 text-sm border border-slate-300 rounded-xl focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all bg-slate-50 focus:bg-white" required>
                    </div>
                </div>

                <!-- Alasan / Pelanggaran -->
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Alasan / Pelanggaran <span class="text-rose-500">*</span></label>
                    <textarea name="alasan" rows="4" class="w-full px-4 py-3 text-sm border border-slate-300 rounded-xl focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all bg-slate-50 focus:bg-white" placeholder="Tuliskan detail pelanggaran..." required></textarea>
                </div>

                <!-- Catatan Tambahan (Opsional) -->
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Catatan Tambahan (Opsional)</label>
                    <textarea name="catatan" rows="3" class="w-full px-4 py-3 text-sm border border-slate-300 rounded-xl focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all bg-slate-50 focus:bg-white" placeholder="Tambahkan catatan jika ada..."></textarea>
                </div>

            </div>

            <!-- Footer Form -->
            <div class="px-6 py-4 bg-slate-50 border-t border-slate-200 flex justify-end gap-3">
                <a href="{{ route('surat-peringatan.index') }}" class="px-6 py-2.5 text-sm font-semibold text-slate-600 bg-white border border-slate-300 rounded-xl hover:bg-slate-50 transition-all shadow-sm">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2.5 text-sm font-semibold text-white bg-blue-600 rounded-xl hover:bg-blue-700 transition-all shadow-md shadow-blue-500/20">
                    Simpan Surat Peringatan
                </button>

                <!-- Tambahkan tombol ini di sebelah tombol Simpan -->
                <a href="{{ route('surat-peringatan.cetak') }}" target="_blank" class="px-6 py-2.5 text-sm font-semibold text-emerald-700 bg-emerald-50 border border-emerald-200 rounded-xl hover:bg-emerald-100 transition-all shadow-sm flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                    Cetak Surat
                </a>
            </div>
        </form>
    </div>
</div>
@endsection