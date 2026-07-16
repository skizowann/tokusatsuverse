@extends('layouts.admin')

@section('content')
<div class="p-6 max-w-3xl">
    <div class="mb-6">
        <a href="{{ route('videos.index') }}" class="text-sm text-zinc-400 hover:text-red-500 transition">
            ← Kembali ke Daftar
        </a>
        <h1 class="text-3xl font-black text-white tracking-wide uppercase mt-2">Edit Episode</h1>
    </div>

    <div class="bg-zinc-900 p-6 rounded-xl border border-zinc-800 shadow-xl">
        <form action="{{ route('videos.update', $video->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-5">
                <label class="block text-zinc-400 text-xs font-bold uppercase tracking-wider mb-2">Pilih Series</label>
                <select name="series_id" class="w-full bg-zinc-950 border border-zinc-800 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-red-600 transition" required>
                    @foreach($series as $s)
                        <option value="{{ $s->id }}" {{ $video->series_id == $s->id ? 'selected' : '' }}>{{ $s->title }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-5">
                <label class="block text-zinc-400 text-xs font-bold uppercase tracking-wider mb-2">Judul Episode</label>
                <input type="text" name="title" value="{{ $video->title }}" class="w-full bg-zinc-950 border border-zinc-800 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-red-600 transition" required>
            </div>

            <div class="mb-6">
                <label class="block text-zinc-400 text-xs font-bold uppercase tracking-wider mb-2">URL Video Streaming</label>
                <input type="url" name="video_url" value="{{ $video->video_url }}" class="w-full bg-zinc-950 border border-zinc-800 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-red-600 transition" required>
            </div>

            <button type="submit" class="w-full bg-amber-600 hover:bg-amber-700 text-white font-bold py-2.5 rounded-lg shadow-md transition cursor-pointer uppercase tracking-wider text-sm">
                Perbarui Video
            </button>
        </form>
    </div>
</div>
@endsection