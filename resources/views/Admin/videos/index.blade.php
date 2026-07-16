@extends('layouts.admin')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-black text-white tracking-wide uppercase">Kelola Video / Episode</h1>
        <a href="{{ route('videos.create') }}" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm font-bold shadow transition cursor-pointer">
            + Tambah Episode
        </a>
    </div>

    @if(session('success'))
        <div class="bg-emerald-950/80 border border-emerald-500 text-emerald-400 px-4 py-3 rounded-lg mb-6 text-sm font-medium">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-zinc-900 border border-zinc-800 rounded-xl overflow-hidden shadow-xl">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b border-zinc-800 bg-zinc-950 text-zinc-400 text-xs font-bold uppercase tracking-wider">
                    <th class="p-4">Series</th>
                    <th class="p-4">Judul Episode</th>
                    <th class="p-4">URL Video</th>
                    <th class="p-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-zinc-800/60 text-zinc-300 text-sm">
                @forelse($videos as $video)
                    <tr class="hover:bg-zinc-800/30 transition">
                        <td class="p-4 font-semibold text-white">{{ $video->series->title ?? 'Tidak Ada' }}</td>
                        <td class="p-4">{{ $video->title }}</td>
                        <td class="p-4 text-zinc-500 truncate max-w-xs">{{ $video->video_url }}</td>
                        <td class="p-4 text-center space-x-2">
                            <a href="{{ route('videos.edit', $video->id) }}" class="text-amber-500 hover:underline font-semibold">EDIT</a>
                            <form action="{{ route('videos.destroy', $video->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus episode ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline font-semibold bg-transparent border-none p-0 cursor-pointer">HAPUS</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="p-8 text-center text-zinc-500 italic bg-zinc-900/40">
                            Belum ada episode video yang diupload. Silakan tambah baru!
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection