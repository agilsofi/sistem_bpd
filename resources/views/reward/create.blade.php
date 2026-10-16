@extends('layouts.app')

@section('title', 'Tambah Reward')
@section('page-title', 'Tambah Reward')

@section('content')
<div class="max-w-2xl">
    <div class="bg-white rounded-lg border border-gray-200 p-6">
        <form method="POST" action="{{ route('reward.store') }}" class="space-y-6">
            @csrf

            <div>
                <label for="id_siswa" class="block text-sm font-medium text-gray-900 mb-2">Siswa</label>
                <input type="text" id="search_siswa" placeholder="Cari NIS atau nama siswa..." class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm" autocomplete="off">
                <input type="hidden" id="id_siswa" name="id_siswa" required>
                <div id="siswa_list" class="mt-2 border border-gray-300 rounded-lg hidden max-h-64 overflow-y-auto"></div>
                @error('id_siswa')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="id_jenis_reward" class="block text-sm font-medium text-gray-900 mb-2">Jenis Reward</label>
                <select id="id_jenis_reward" name="id_jenis_reward" class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm" required onchange="updateKredit(this)">
                    <option value="">-- Pilih Jenis Reward --</option>
                    @foreach($jenisReward as $item)
                    <option value="{{ $item->id_jenis_reward }}" data-kredit="{{ $item->kredit_poin }}">{{ $item->nama_reward }} ({{ $item->kredit_poin }} poin)</option>
                    @endforeach
                </select>
                @error('id_jenis_reward')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="tanggal" class="block text-sm font-medium text-gray-900 mb-2">Tanggal</label>
                <input type="date" id="tanggal" name="tanggal" class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm" value="{{ date('Y-m-d') }}" required>
                @error('tanggal')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="id_pemberi" class="block text-sm font-medium text-gray-900 mb-2">Pemberi Reward</label>
                <select id="id_pemberi" name="id_pemberi" class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm" required>
                    <option value="">-- Pilih Pemberi --</option>
                    @foreach($guru as $g)
                    <option value="{{ $g->id_guru }}" {{ old('id_pemberi') == $g->id_guru ? 'selected' : '' }}>{{ $g->nama_guru }}</option>
                    @endforeach
                </select>
                @error('id_pemberi')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="alasan" class="block text-sm font-medium text-gray-900 mb-2">Alasan</label>
                <textarea id="alasan" name="alasan" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm" required></textarea>
                @error('alasan')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="kredit_poin" class="block text-sm font-medium text-gray-900 mb-2">Kredit Poin</label>
                <input type="number" id="kredit_poin" name="kredit_poin" class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm bg-gray-50" readonly required>
                <p class="text-xs text-gray-500 mt-1">Kredit poin otomatis terisi berdasarkan jenis reward yang dipilih</p>
                @error('kredit_poin')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-3">
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Simpan</button>
                <a href="{{ route('reward.index') }}" class="px-6 py-2 bg-gray-300 text-gray-900 rounded-lg hover:bg-gray-400">Batal</a>
            </div>
        </form>
    </div>
</div>

<script>
function updateKredit(selectElement) {
    const selectedOption = selectElement.options[selectElement.selectedIndex];
    const kredit = selectedOption.getAttribute('data-kredit');
    document.getElementById('kredit_poin').value = kredit || '';
}

document.getElementById('search_siswa').addEventListener('input', async (e) => {
    const query = e.target.value;
    if (query.length < 1) {
        document.getElementById('siswa_list').classList.add('hidden');
        return;
    }

    try {
        const res = await fetch(`{{ route('reward.cari-siswa') }}?q=${query}`);
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
                    document.getElementById('search_siswa').value = `${siswa.nama} (${siswa.NIS})`;
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
