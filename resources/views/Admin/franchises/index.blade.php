@extends('layouts.admin')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-white tracking-wide">Kelola Franchise</h1>
        <a href="{{ route('franchises.create') }}" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg font-semibold text-sm shadow-md transition">
            + Tambah Franchise
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
                    <th class="p-4 w-20 text-center">No</th>
                    <th class="p-4">Nama Franchise</th>
                    <th class="p-4 w-48 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-zinc-800 text-gray-300 text-sm">
                @forelse($franchises as $index => $franchise)
                    <tr class="hover:bg-zinc-900/50 transition">
                        <td class="p-4 text-center font-medium">{{ $index + 1 }}</td>
                        <td class="p-4 font-semibold text-white">{{ $franchise->name }}</td>
                        <td class="p-4 text-center">
                            <div class="flex justify-center space-x-2">
                                <a href="{{ route('franchises.edit', $franchise->id) }}" class="bg-zinc-800 hover:bg-zinc-700 text-yellow-500 px-3 py-1.5 rounded-md text-xs font-semibold transition">
                                    EDIT
                                </a>
                                <form action="{{ route('franchises.destroy', $franchise->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus franchise ini?')">
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
                        <td colspan="3" class="p-8 text-center text-gray-500 italic">
                            Belum ada data franchise. Silakan tambah baru!
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection