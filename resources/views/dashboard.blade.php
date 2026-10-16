@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="space-y-6">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white p-6 rounded-lg border border-gray-200">
            <p class="text-sm font-medium text-gray-600">Total Siswa</p>
            <p class="text-3xl font-semibold text-gray-900 mt-2">0</p>
        </div>

        <div class="bg-white p-6 rounded-lg border border-gray-200">
            <p class="text-sm font-medium text-gray-600">Total Guru</p>
            <p class="text-3xl font-semibold text-gray-900 mt-2">0</p>
        </div>

        <div class="bg-white p-6 rounded-lg border border-gray-200">
            <p class="text-sm font-medium text-gray-600">Laporan Baru</p>
            <p class="text-3xl font-semibold text-gray-900 mt-2">0</p>
        </div>

        <div class="bg-white p-6 rounded-lg border border-gray-200">
            <p class="text-sm font-medium text-gray-600">Surat Peringatan</p>
            <p class="text-3xl font-semibold text-gray-900 mt-2">0</p>
        </div>
    </div>

    <div class="bg-white rounded-lg border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">Statistik Singkat</h3>
        </div>
        <div class="p-6">
            <p class="text-gray-600">Dashboard akan menampilkan ringkasan data berdasarkan peran pengguna.</p>
        </div>
    </div>
</div>
@endsection
