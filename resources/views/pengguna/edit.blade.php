@extends('layouts.app')

@section('title', 'Edit Pengguna')
@section('page-title', 'Edit Pengguna')

@section('content')
<div class="max-w-2xl">
    <div class="bg-white rounded-lg border border-gray-200 p-6">
        <form method="POST" action="{{ route('pengguna.update', $pengguna->id_user) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium text-gray-900 mb-2">Username <span class="text-red-600">*</span></label>
                <input type="text" name="username" value="{{ old('username', $pengguna->username) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-blue-500 focus:border-blue-500" required>
                @error('username') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-900 mb-2">Role <span class="text-red-600">*</span></label>
                <select name="role" id="role" class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-blue-500 focus:border-blue-500" required onchange="toggleRelasi()">
                    <option value="">-- Pilih Role --</option>
                    <option value="admin" {{ old('role', $pengguna->role) === 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="guru" {{ old('role', $pengguna->role) === 'guru' ? 'selected' : '' }}>Guru</option>
                    <option value="bk" {{ old('role', $pengguna->role) === 'bk' ? 'selected' : '' }}>BK (Bimbingan Konseling)</option>
                    <option value="kesiswaan" {{ old('role', $pengguna->role) === 'kesiswaan' ? 'selected' : '' }}>Kesiswaan</option>
                    <option value="siswa" {{ old('role', $pengguna->role) === 'siswa' ? 'selected' : '' }}>Siswa</option>
                </select>
                @error('role') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div id="guru_section" class="hidden">
                <label class="block text-sm font-medium text-gray-900 mb-2">Pilih Guru <span class="text-red-600">*</span></label>
                <select name="id_guru" class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="">-- Pilih Guru --</option>
                    @foreach($guru as $g)
                    <option value="{{ $g->id_guru }}" {{ old('id_guru', $pengguna->id_guru) == $g->id_guru ? 'selected' : '' }}>{{ $g->nama_guru }} ({{ $g->nuptk }})</option>
                    @endforeach
                </select>
                @error('id_guru') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div id="siswa_section" class="hidden">
                <label class="block text-sm font-medium text-gray-900 mb-2">Pilih Siswa <span class="text-red-600">*</span></label>
                <select name="id_siswa" class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="">-- Pilih Siswa --</option>
                    @foreach($siswa as $s)
                    <option value="{{ $s->id_siswa }}" {{ old('id_siswa', $pengguna->id_siswa) == $s->id_siswa ? 'selected' : '' }}>{{ $s->nama }} ({{ $s->NIS }})</option>
                    @endforeach
                </select>
                @error('id_siswa') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-900 mb-2">Password Baru (Kosongkan jika tidak diubah)</label>
                <input type="password" name="password" class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-blue-500 focus:border-blue-500" placeholder="Minimal 6 karakter">
                @error('password') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-900 mb-2">Status <span class="text-red-600">*</span></label>
                <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-blue-500 focus:border-blue-500" required>
                    <option value="aktif" {{ old('status', $pengguna->status) === 'aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="nonaktif" {{ old('status', $pengguna->status) === 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                </select>
                @error('status') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex gap-3 justify-end pt-4 border-t border-gray-200">
                <a href="{{ route('pengguna.index') }}" class="px-6 py-2 bg-gray-300 text-gray-900 rounded-lg hover:bg-gray-400">Batal</a>
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Perbarui</button>
            </div>
        </form>
    </div>
</div>

<script>
function toggleRelasi() {
    const role = document.getElementById('role').value;
    const guruSection = document.getElementById('guru_section');
    const siswaSection = document.getElementById('siswa_section');

    guruSection.classList.add('hidden');
    siswaSection.classList.add('hidden');

    if (['guru', 'bk', 'kesiswaan'].includes(role)) {
        guruSection.classList.remove('hidden');
    }
    if (role === 'siswa') {
        siswaSection.classList.remove('hidden');
    }
}

toggleRelasi();
</script>
@endsection
