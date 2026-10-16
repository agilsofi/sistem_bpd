@extends('layouts.app')

@section('title', 'Detail Reward')
@section('page-title', 'Detail Reward')

@section('content')
<div class="max-w-2xl bg-white rounded-lg border border-gray-200 p-6">
    <div class="space-y-4">
        <div>
            <p class="text-sm text-gray-500">Siswa</p>
            <p class="font-medium text-gray-900">{{ $reward->siswa->nama }} ({{ $reward->siswa->NIS }})</p>
        </div>
        <div>
            <p class="text-sm text-gray-500">Jenis Reward</p>
            <p class="font-medium text-gray-900">{{ $reward->jenisReward->nama_reward }}</p>
        </div>
        <div>
            <p class="text-sm text-gray-500">Tanggal</p>
            <p class="font-medium text-gray-900">{{ $reward->tanggal->format('d/m/Y') }}</p>
        </div>
        <div>
            <p class="text-sm text-gray-500">Alasan</p>
            <p class="text-gray-900">{{ $reward->alasan }}</p>
        </div>
        <div>
            <p class="text-sm text-gray-500">Poin</p>
            <p class="font-bold text-green-600">+{{ $reward->kredit_poin }}</p>
        </div>
        <div>
            <p class="text-sm text-gray-500">Diberikan Oleh</p>
            <p class="font-medium text-gray-900">{{ $reward->pemberi->nama_guru }}</p>
        </div>
    </div>
    <div class="mt-6">
        <a href="{{ route('reward.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded-lg">Kembali</a>
    </div>
</div>
@endsection
