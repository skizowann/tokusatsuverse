@extends('layouts.admin')

@section('content')
<div class="p-6">
    <div class="mb-8">
        <h1 class="text-3xl font-black text-white tracking-wide uppercase">Dashboard Admin</h1>
        <p class="text-zinc-400 text-sm mt-1">Selamat datang kembali! Berikut ringkasan data situs streaming Tokusatsuverse kamu saat ini.</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        
        <div class="bg-zinc-900 border border-zinc-800 rounded-xl p-5 shadow-lg flex flex-col justify-between hover:border-red-600/50 transition">
            <div>
                <span class="text-xs font-bold text-red-500 uppercase tracking-wider">Total Franchise</span>
                <h3 class="text-4xl font-black text-white mt-2">{{ $totalFranchise }}</h3>
            </div>
            <div class="mt-4 pt-3 border-t border-zinc-800/60 flex justify-between items-center text-xs">
                <span class="text-zinc-500">Kamen Rider, Metal Hero, dll</span>
                <a href="{{ route('franchises.index') }}" class="text-red-500 hover:underline font-semibold">Kelola →</a>
            </div>
        </div>

        <div class="bg-zinc-900 border border-zinc-800 rounded-xl p-5 shadow-lg flex flex-col justify-between hover:border-red-600/50 transition">
            <div>
                <span class="text-xs font-bold text-red-500 uppercase tracking-wider">Total Genre</span>
                <h3 class="text-4xl font-black text-white mt-2">{{ $totalGenre }}</h3>
            </div>
            <div class="mt-4 pt-3 border-t border-zinc-800/60 flex justify-between items-center text-xs">
                <span class="text-zinc-500">Kategori Tokusatsu</span>
                <a href="{{ route('genres.index') }}" class="text-red-500 hover:underline font-semibold">Kelola →</a>
            </div>
        </div>

        <div class="bg-zinc-900 border border-zinc-800 rounded-xl p-5 shadow-lg flex flex-col justify-between hover:border-red-600/50 transition">
            <div>
                <span class="text-xs font-bold text-red-500 uppercase tracking-wider">Total Series</span>
                <h3 class="text-4xl font-black text-white mt-2">{{ $totalSeries }}</h3>
            </div>
            <div class="mt-4 pt-3 border-t border-zinc-800/60 flex justify-between items-center text-xs">
                <span class="text-zinc-500">Judul Film / Series</span>
                <a href="{{ route('series.index') }}" class="text-red-500 hover:underline font-semibold">Kelola →</a>
            </div>
        </div>

        <div class="bg-zinc-900 border border-zinc-800 rounded-xl p-5 shadow-lg flex flex-col justify-between hover:border-red-600/50 transition">
            <div>
                <span class="text-xs font-bold text-red-500 uppercase tracking-wider">Total Episode Video</span>
                <h3 class="text-4xl font-black text-white mt-2">{{ $totalVideo }}</h3>
            </div>
            <div class="mt-4 pt-3 border-t border-zinc-800/60 flex justify-between items-center text-xs">
                <span class="text-zinc-500">Streaming Ter-upload</span>
                <a href="{{ route('videos.index') }}" class="text-red-500 hover:underline font-semibold">Kelola →</a>
            </div>
        </div>

    </div>

    <div class="mt-8 bg-zinc-900/40 border border-zinc-800 rounded-xl p-6">
        <h2 class="text-lg font-bold text-white mb-2">Status System CRUD</h2>
        <p class="text-zinc-400 text-sm leading-relaxed">
            Semua modul panel admin (<span class="text-white font-medium">Franchise</span>, <span class="text-white font-medium">Genre</span>, <span class="text-white font-medium">Series</span>, dan <span class="text-white font-medium">Video</span>) sekarang sudah terhubung penuh ke database lokal Laragon. Silakan tambahkan episode baru lewat menu Kelola Video untuk melihat pembaruan angka statistik di atas secara langsung!
        </p>
    </div>
</div>
@endsection