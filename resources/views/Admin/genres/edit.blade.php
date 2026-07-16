@extends('layouts.admin')

@section('content')
<div class="p-6 max-w-2xl">
    <div class="mb-6">
        <a href="{{ route('genres.index') }}" class="text-sm text-gray-400 hover:text-red-500 transition">
            ← Kembali ke Daftar
        </a>
        <h1 class="text-3xl font-bold text-white tracking-wide mt-2">Edit Genre</h1>
    </div>

    <div class="bg-zinc-900 p-6 rounded-lg border border-zinc-800 shadow-xl">
        <form action="{{ route('genres.update', $genre->id) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="mb-5">
                <label for="name" class="block text-gray-400 text-sm font-medium mb-2">Nama Genre</label>
                <input type="text" name="name" id="name" class="w-full bg-zinc-950 border border-zinc-800 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-red-600 transition @error('name') border-red-500 @enderror" value="{{ old('name', $genre->name) }}" required>
                @error('name')
                    <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-2.5 rounded-lg shadow-md transition">
                Perbarui Genre
            </button>
        </form>
    </div>
</div>
@endsection