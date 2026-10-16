@extends('layouts.app')

@section('title', 'Buat Laporan Perilaku')
@section('page-title', 'Buat Laporan Perilaku')

@section('content')
<div class="max-w-4xl">
    <div class="bg-white rounded-lg border border-gray-200 p-6">
        <form method="POST" action="{{ route('laporan-perilaku.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Cari Siswa (Opsional)</label>
                    <input type="text" id="search-siswa" placeholder="Ketik NIS atau nama siswa..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <input type="hidden" name="id_siswa" id="id_siswa">
                    <div id="siswa-results" class="mt-2 border border-gray-200 rounded-lg hidden max-h-48 overflow-y-auto"></div>
                    <div id="siswa-selected" class="mt-2 hidden">
                        <div class="p-3 bg-blue-50 border border-blue-200 rounded-lg">
                            <div class="flex justify-between items-center">
                                <div>
                                    <p class="font-medium text-gray-900" id="siswa-nama"></p>
                                    <p class="text-sm text-gray-600" id="siswa-detail"></p>
                                </div>
                                <button type="button" onclick="clearSiswa()" class="text-red-600 hover:text-red-800 text-sm">Hapus</button>
                            </div>
                        </div>
                    </div>
                    @error('id_siswa') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Perilaku <span class="text-red-600">*</span></label>
                    <select name="id_jenis_perilaku" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <option value="">Pilih Jenis Perilaku</option>
                        @foreach($jenisPerilaku->groupBy('kategori.nama_kategori') as $kategori => $items)
                        <optgroup label="{{ $kategori }}">
                            @foreach($items as $jp)
                            <option value="{{ $jp->id_jenis_perilaku }}" {{ old('id_jenis_perilaku') == $jp->id_jenis_perilaku ? 'selected' : '' }}>
                                {{ $jp->nama_perilaku }} ({{ $jp->poin_pelanggaran }} poin)
                            </option>
                            @endforeach
                        </optgroup>
                        @endforeach
                    </select>
                    @error('id_jenis_perilaku') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Kejadian <span class="text-red-600">*</span></label>
                    <input type="date" name="tanggal_kejadian" value="{{ old('tanggal_kejadian') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    @error('tanggal_kejadian') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Keterangan <span class="text-red-600">*</span></label>
                    <textarea name="keterangan" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>{{ old('keterangan') }}</textarea>
                    @error('keterangan') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Bukti Pendukung (Kamera)</label>
                    <div class="space-y-4">
                        <div id="camera-section" class="border-2 border-dashed border-gray-300 rounded-lg p-4">
                            <div class="text-center">
                                <video id="camera-feed" width="100%" height="auto" class="rounded-lg bg-black hidden" autoplay playsinline muted></video>
                                <canvas id="camera-canvas" class="hidden"></canvas>
                                <div id="camera-placeholder" class="py-8 text-gray-500">
                                    <p class="text-sm mb-2">📷 Kamera siap</p>
                                </div>
                            </div>
                            <div class="flex gap-2 justify-center mt-4">
                                <button type="button" id="btn-start-camera" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Nyalakan Kamera</button>
                                <button type="button" id="btn-stop-camera" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 hidden">Matikan Kamera</button>
                                <button type="button" id="btn-flip-camera" class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 hidden">🔄 Flip</button>
                                <button type="button" id="btn-capture" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 hidden">Ambil Foto</button>
                            </div>
                        </div>

                        <div id="preview-section" class="hidden space-y-2">
                            <p class="text-sm font-medium text-gray-700">Preview Foto:</p>
                            <img id="preview-image" class="w-full max-w-md rounded-lg border border-gray-300">
                            <p id="preview-timestamp" class="text-xs text-gray-600"></p>
                            <div class="flex gap-2">
                                <button type="button" id="btn-retake" class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700">Ulang</button>
                                <button type="button" id="btn-confirm" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">Gunakan Foto</button>
                            </div>
                        </div>

                        <input type="hidden" id="bukti-base64" name="bukti_base64">
                        <input type="hidden" id="bukti-timestamp" name="bukti_timestamp">
                    </div>
                    @error('bukti_base64') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="flex items-center justify-end space-x-3 pt-4 border-t border-gray-200">
                    <a href="{{ route('laporan-perilaku.index') }}" class="px-4 py-2 text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200">Batal</a>
                    <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700">Simpan Laporan</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
let debounceTimer;
const searchInput = document.getElementById('search-siswa');
const resultsDiv = document.getElementById('siswa-results');
const selectedDiv = document.getElementById('siswa-selected');
const idSiswaInput = document.getElementById('id_siswa');

searchInput.addEventListener('input', function() {
    clearTimeout(debounceTimer);
    const query = this.value.trim();
    
    if (query.length < 2) {
        resultsDiv.classList.add('hidden');
        return;
    }

    debounceTimer = setTimeout(() => {
        fetch(`{{ route('laporan-perilaku.cari-siswa') }}?q=${encodeURIComponent(query)}`)
            .then(response => response.json())
            .then(data => {
                if (data.length > 0) {
                    resultsDiv.innerHTML = data.map(siswa => `
                        <div class="p-3 hover:bg-gray-50 cursor-pointer border-b border-gray-100" onclick="selectSiswa(${siswa.id_siswa}, '${siswa.nama}', '${siswa.NIS}', '${siswa.kelas ? siswa.kelas.nama_kelas : '-'}')">
                            <p class="font-medium text-gray-900">${siswa.nama}</p>
                            <p class="text-sm text-gray-600">NIS: ${siswa.NIS} | Kelas: ${siswa.kelas ? siswa.kelas.nama_kelas : '-'}</p>
                        </div>
                    `).join('');
                    resultsDiv.classList.remove('hidden');
                } else {
                    resultsDiv.innerHTML = '<div class="p-3 text-center text-gray-500">Siswa tidak ditemukan</div>';
                    resultsDiv.classList.remove('hidden');
                }
            });
    }, 300);
});

function selectSiswa(id, nama, nis, kelas) {
    idSiswaInput.value = id;
    document.getElementById('siswa-nama').textContent = nama;
    document.getElementById('siswa-detail').textContent = `NIS: ${nis} | Kelas: ${kelas}`;
    selectedDiv.classList.remove('hidden');
    resultsDiv.classList.add('hidden');
    searchInput.value = '';
}

function clearSiswa() {
    idSiswaInput.value = '';
    selectedDiv.classList.add('hidden');
}

// Camera capture logic
const video = document.getElementById('camera-feed');
const canvas = document.getElementById('camera-canvas');
const ctx = canvas.getContext('2d');
const previewImg = document.getElementById('preview-image');
const previewTimestamp = document.getElementById('preview-timestamp');
const cameraSection = document.getElementById('camera-section');
const previewSection = document.getElementById('preview-section');
const cameraPlaceholder = document.getElementById('camera-placeholder');

let stream = null;
let capturedImageData = null;
let currentFacingMode = 'environment'; // default belakang

document.getElementById('btn-start-camera').addEventListener('click', async () => {
    if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
        alert('Browser tidak mendukung akses kamera, atau halaman tidak diakses via HTTPS/localhost.');
        return;
    }

    try {
        stream = await navigator.mediaDevices.getUserMedia({ 
            video: { facingMode: currentFacingMode, width: { ideal: 1280 }, height: { ideal: 720 } },
            audio: false 
        });

        video.srcObject = stream;
        video.classList.remove('hidden');
        cameraPlaceholder.classList.add('hidden');
        document.getElementById('btn-start-camera').classList.add('hidden');
        document.getElementById('btn-stop-camera').classList.remove('hidden');
        document.getElementById('btn-flip-camera').classList.remove('hidden');

        // Tunggu metadata lalu mainkan video
        video.onloadedmetadata = () => {
            video.play().catch(err => console.error('Play error:', err));
            document.getElementById('btn-capture').classList.remove('hidden');
        };
    } catch (err) {
        console.error('Camera error:', err);
        let msg = 'Tidak dapat mengakses kamera.';
        if (err.name === 'NotAllowedError') msg = 'Izin kamera ditolak. Beri izin kamera di browser lalu coba lagi.';
        else if (err.name === 'NotFoundError') msg = 'Kamera tidak ditemukan pada perangkat ini.';
        else if (err.name === 'NotReadableError') msg = 'Kamera sedang dipakai aplikasi lain. Tutup aplikasi tersebut lalu coba lagi.';
        else msg += ' (' + err.name + ': ' + err.message + ')';
        alert(msg);
    }
});

document.getElementById('btn-flip-camera').addEventListener('click', async () => {
    // Stop stream lama
    if (stream) {
        stream.getTracks().forEach(track => track.stop());
    }

    // Switch facingMode
    currentFacingMode = currentFacingMode === 'environment' ? 'user' : 'environment';

    try {
        stream = await navigator.mediaDevices.getUserMedia({ 
            video: { facingMode: currentFacingMode, width: { ideal: 1280 }, height: { ideal: 720 } },
            audio: false 
        });

        video.srcObject = stream;
        
        video.onloadedmetadata = () => {
            video.play().catch(err => console.error('Play error:', err));
        };
    } catch (err) {
        console.error('Flip error:', err);
        alert('Tidak dapat switch kamera: ' + err.message);
        currentFacingMode = currentFacingMode === 'environment' ? 'user' : 'environment'; // revert
    }
});

document.getElementById('btn-stop-camera').addEventListener('click', () => {
    if (stream) {
        stream.getTracks().forEach(track => track.stop());
    }
    video.classList.add('hidden');
    cameraPlaceholder.classList.remove('hidden');
    document.getElementById('btn-start-camera').classList.remove('hidden');
    document.getElementById('btn-stop-camera').classList.add('hidden');
    document.getElementById('btn-capture').classList.add('hidden');
});

document.getElementById('btn-capture').addEventListener('click', () => {
    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;
    
    // Draw video frame
    ctx.drawImage(video, 0, 0);
    
    // Add timestamp overlay
    const now = new Date();
    const timestamp = now.toLocaleString('id-ID', {
        year: 'numeric',
        month: '2-digit',
        day: '2-digit',
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit'
    });
    
    ctx.font = 'bold 24px Arial';
    ctx.fillStyle = 'rgba(255, 255, 255, 0.9)';
    ctx.strokeStyle = 'rgba(0, 0, 0, 0.5)';
    ctx.lineWidth = 3;
    ctx.strokeText(timestamp, 20, canvas.height - 20);
    ctx.fillText(timestamp, 20, canvas.height - 20);
    
    // Store image data
    capturedImageData = canvas.toDataURL('image/jpeg');
    document.getElementById('bukti-base64').value = capturedImageData;
    document.getElementById('bukti-timestamp').value = timestamp;
    
    // Show preview
    previewImg.src = capturedImageData;
    previewTimestamp.textContent = 'Waktu: ' + timestamp;
    previewSection.classList.remove('hidden');
    cameraSection.classList.add('hidden');
});

document.getElementById('btn-retake').addEventListener('click', () => {
    previewSection.classList.add('hidden');
    cameraSection.classList.remove('hidden');
    capturedImageData = null;
    document.getElementById('bukti-base64').value = '';
    document.getElementById('bukti-timestamp').value = '';
});

document.getElementById('btn-confirm').addEventListener('click', () => {
    previewSection.classList.add('hidden');
    const confirmMsg = document.createElement('div');
    confirmMsg.className = 'p-3 bg-green-50 border border-green-200 rounded-lg text-green-800 text-sm';
    confirmMsg.textContent = '✓ Foto berhasil ditangkap dengan timestamp. Silakan submit laporan.';
    cameraSection.parentNode.insertBefore(confirmMsg, cameraSection);
    cameraSection.classList.add('hidden');
});
</script>
@endsection
