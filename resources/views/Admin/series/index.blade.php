@extends('layouts.admin')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-white tracking-wide">Kelola Series</h1>
        <a href="{{ route('series.create') }}" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg font-semibold text-sm shadow-md transition">
            + Tambah Series
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-600 text-white p-4 rounded-lg mb-6 shadow-md font-medium text-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-zinc-900 rounded-lg border border-zinc-800 shadow-xl overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-zinc-950 border-b border-zinc-800 text-red-500 uppercase text-xs font-bold tracking-wider">
                    <th class="p-4 w-20 text-center">Poster</th>
                    <th class="p-4">Judul Series</th>
                    <th class="p-4">Franchise</th>
                    <th class="p-4">Genres</th>
                    <th class="p-4 w-48 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-zinc-800 text-gray-300 text-sm">
                @forelse($series as $item)
                    <tr class="hover:bg-zinc-900/50 transition">
                        <td class="p-4 text-center">
                            <img src="{{ asset('storage/' . $item->poster) }}" class="w-12 h-16 object-cover rounded border border-zinc-700 shadow-md mx-auto" alt="Poster">
                        </td>
                        <td class="p-4 font-semibold text-white">{{ $item->title }}</td>
                        <td class="p-4"><span class="text-zinc-400 bg-zinc-950 px-2.5 py-1 rounded text-xs border border-zinc-800">{{ $item->franchise->name ?? '-' }}</span></td>
                        <td class="p-4">
                            <div class="flex flex-wrap gap-1">
                                @foreach($item->genres as $g)
                                    <span class="bg-red-950/40 text-red-400 border border-red-900 text-[10px] font-bold px-2 py-0.5 rounded">
                                        {{ $g->name }}
                                    </span>
                                @endforeach
                            </div>
                        </td>
                        <td class="p-4 text-center">
                            <div class="flex justify-center space-x-2">
                                <a href="{{ route('series.edit', $item->id) }}" class="bg-zinc-800 hover:bg-zinc-700 text-yellow-500 px-3 py-1.5 rounded-md text-xs font-semibold transition">
                                    EDIT
                                </a>
                                <form action="{{ route('series.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus series ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-zinc-800 hover:bg-red-900 text-red-500 px-3 py-1.5 rounded-md text-xs font-semibold transition">
                                        HAPUS
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-8 text-center text-gray-500 italic">
                            Belum ada data series. Silakan tambah baru!
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection