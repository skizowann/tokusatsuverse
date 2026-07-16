@extends('layouts.admin')

@section('content')
<div class="p-6 max-w-3xl">
    <div class="mb-6">
        <a href="{{ route('videos.index') }}" class="text-sm text-zinc-400 hover:text-red-500 transition">
            ← Kembali ke Daftar
        </a>
        <h1 class="text-3xl font-black text-white tracking-wide uppercase mt-2">Tambah Episode</h1>
    </div>

    <div class="bg-zinc-900 p-6 rounded-xl border border-zinc-800 shadow-xl">
        <form action="{{ route('videos.store') }}" method="POST">
            @csrf
            
            <div class="mb-5">
                <label class="block text-zinc-400 text-xs font-bold uppercase tracking-wider mb-2">Pilih Series</label>
                <select name="series_id" class="w-full bg-zinc-950 border border-zinc-800 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-red-600 transition" required>
                    <option value="">-- Pilih Judul Series --</option>
                    @foreach($series as $s)
                        <option value="{{ $s->id }}">{{ $s->title }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-5">
                <label class="block text-zinc-400 text-xs font-bold uppercase tracking-wider mb-2">Judul Episode</label>
                <input type="text" name="title" class="w-full bg-zinc-950 border border-zinc-800 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-red-600 transition" placeholder="Contoh: Episode 01" required>
            </div>

            <div class="mb-6">
                <label class="block text-zinc-400 text-xs font-bold uppercase tracking-wider mb-2">URL Video Streaming</label>
                <input type="url" name="video_url" class="w-full bg-zinc-950 border border-zinc-800 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-red-600 transition" placeholder="Contoh: https://www.youtube.com/embed/xxxxxx" required>
            </div>

            <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-2.5 rounded-lg shadow-md transition cursor-pointer uppercase tracking-wider text-sm">
                Simpan Video
            </button>
        </form>
    </div>
</div>
@endsection