@extends('layouts.app')

@section('title', 'Tambah Pembinaan')
@section('page-title', 'Tambah Pembinaan')

@section('content')
<div class="max-w-2xl">
    <div class="bg-white rounded-lg border border-gray-200 p-6">
        <form method="POST" action="{{ route('pembinaan.store') }}" class="space-y-6">
            @csrf

            <div>
                <label for="search_siswa" class="block text-sm font-medium text-gray-900 mb-2">Cari Siswa</label>
                <input type="text" id="search_siswa" placeholder="Ketik NIS atau nama siswa..." class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm" autocomplete="off">
                <input type="hidden" id="id_siswa" name="id_siswa" required>
                <div id="siswa_list" class="mt-2 border border-gray-300 rounded-lg hidden max-h-64 overflow-y-auto"></div>
                <div id="siswa_selected" class="mt-2 hidden">
                    <div class="p-3 bg-blue-50 border border-blue-200 rounded-lg">
                        <p class="font-medium text-gray-900" id="siswa_nama"></p>
                        <p class="text-sm text-gray-600" id="siswa_detail"></p>
                    </div>
                </div>
                @error('id_siswa') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="tanggal" class="block text-sm font-medium text-gray-900 mb-2">Tanggal Pembinaan</label>
                <input type="date" id="tanggal" name="tanggal" class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm" value="{{ date('Y-m-d') }}" required>
                @error('tanggal') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="id_pembina" class="block text-sm font-medium text-gray-900 mb-2">Pembina</label>
                <select id="id_pembina" name="id_pembina" class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm" required>
                    <option value="">-- Pilih Pembina --</option>
                    @foreach($guru as $g)
                    <option value="{{ $g->id_guru }}">{{ $g->nama_guru }}</option>
                    @endforeach
                </select>
                @error('id_pembina') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="jenis_pembinaan" class="block text-sm font-medium text-gray-900 mb-2">Jenis Pembinaan</label>
                <select id="jenis_pembinaan" name="jenis_pembinaan" class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm" required>
                    <option value="">-- Pilih Jenis --</option>
                    <option value="verbal">Verbal (Lisan)</option>
                    <option value="tertulis">Tertulis</option>
                    <option value="mediasi">Mediasi</option>
                    <option value="konseling">Konseling</option>
                </select>
                @error('jenis_pembinaan') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="alasan" class="block text-sm font-medium text-gray-900 mb-2">Alasan Pembinaan</label>
                <textarea id="alasan" name="alasan" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm" required></textarea>
                @error('alasan') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="hasil" class="block text-sm font-medium text-gray-900 mb-2">Hasil Pembinaan</label>
                <textarea id="hasil" name="hasil" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm"></textarea>
                @error('hasil') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="tindak_lanjut" class="block text-sm font-medium text-gray-900 mb-2">Tindak Lanjut</label>
                <textarea id="tindak_lanjut" name="tindak_lanjut" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm"></textarea>
                @error('tindak_lanjut') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="keterangan" class="block text-sm font-medium text-gray-900 mb-2">Keterangan</label>
                <textarea id="keterangan" name="keterangan" rows="2" class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm"></textarea>
            </div>

            <div class="flex gap-3">
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Simpan</button>
                <a href="{{ route('pembinaan.index') }}" class="px-6 py-2 bg-gray-300 text-gray-900 rounded-lg hover:bg-gray-400">Batal</a>
            </div>
        </form>
    </div>
</div>

<script>
document.getElementById('search_siswa').addEventListener('input', async (e) => {
    const query = e.target.value;
    if (query.length < 1) {
        document.getElementById('siswa_list').classList.add('hidden');
        return;
    }

    try {
        const res = await fetch(`{{ route('pembinaan.cari-siswa') }}?q=${query}`);
        const data = await res.json();
        
        const list = document.getElementById('siswa_list');
        list.innerHTML = '';
        
        if (data.length === 0) {
            list.innerHTML = '<div class="p-3 text-gray-500">Tidak ada siswa ditemukan</div>';
        } else {
            data.forEach(siswa => {
                const item = document.createElement('div');
                item.className = 'p-3 border-b cursor-pointer hover:bg-blue-50';
                item.innerHTML = `<strong>${siswa.nama}</strong> (${siswa.NIS})<br><span class="text-xs text-gray-500">${siswa.kelas?.nama_kelas || ''}</span>`;
                item.onclick = () => {
                    document.getElementById('id_siswa').value = siswa.id_siswa;
                    document.getElementById('siswa_nama').textContent = siswa.nama;
                    document.getElementById('siswa_detail').textContent = `NIS: ${siswa.NIS} | Kelas: ${siswa.kelas?.nama_kelas || '-'}`;
                    document.getElementById('siswa_selected').classList.remove('hidden');
                    document.getElementById('search_siswa').value = '';
                    list.classList.add('hidden');
                };
                list.appendChild(item);
            });
        }
        
        list.classList.remove('hidden');
    } catch (err) {
        console.error(err);
    }
});
</script>
@endsection
