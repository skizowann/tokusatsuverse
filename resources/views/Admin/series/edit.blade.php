@extends('layouts.admin')

@section('content')
<div class="p-6 max-w-3xl">
    <div class="mb-6">
        <a href="{{ route('series.index') }}" class="text-sm text-gray-400 hover:text-red-500 transition">
            ← Kembali ke Daftar
        </a>
        <h1 class="text-3xl font-bold text-white tracking-wide mt-2">Edit Series</h1>
    </div>

    <div class="bg-zinc-900 p-6 rounded-lg border border-zinc-800 shadow-xl">
        <form action="{{ route('series.update', $series->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            
            <div class="mb-5">
                <label for="title" class="block text-gray-400 text-sm font-medium mb-2">Judul Series</label>
                <input type="text" name="title" id="title" class="w-full bg-zinc-950 border border-zinc-800 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-red-600 transition" value="{{ old('title', $series->title) }}" required>
            </div>

            <div class="mb-5">
                <label for="franchise_id" class="block text-gray-400 text-sm font-medium mb-2">Franchise</label>
                <select name="franchise_id" id="franchise_id" class="w-full bg-zinc-950 border border-zinc-800 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-red-600 transition" required>
                    @foreach($franchises as $f)
                        <option value="{{ $f->id }}" {{ $series->franchise_id == $f->id ? 'selected' : '' }}>{{ $f->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-5">
                <label for="release_year" class="block text-gray-400 text-sm font-medium mb-2">Tahun Rilis</label>
                <input type="number" name="release_year" id="release_year" class="w-full bg-zinc-950 border border-zinc-800 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-red-600 transition" value="{{ old('release_year', $series->release_year) }}" min="1900" max="2100" required>
            </div>

            <div class="mb-5">
                <label class="block text-gray-400 text-sm font-medium mb-2">Pilih Genre</label>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-3 bg-zinc-950 p-4 rounded-lg border border-zinc-800">
                    @foreach($genres as $g)
                        <label class="flex items-center space-x-2 text-sm text-gray-300 cursor-pointer hover:text-white">
                            <input type="checkbox" name="genres[]" value="{{ $g->id }}" class="rounded text-red-600 focus:ring-0 bg-zinc-900 border-zinc-700 w-4 h-4" {{ $series->genres->contains($g->id) ? 'checked' : '' }}>
                            <span>{{ $g->name }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            <div class="mb-5">
                <label for="poster" class="block text-gray-400 text-sm font-medium mb-2">Ubah Poster (Biarkan kosong jika tidak diganti)</label>
                <input type="file" name="poster" id="poster" class="w-full text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-zinc-800 file:text-white hover:file:bg-zinc-700 cursor-pointer">
            </div>

            <div class="mb-6">
                <label for="synopsis" class="block text-gray-400 text-sm font-medium mb-2">Sinopsis</label>
                <textarea name="synopsis" id="synopsis" rows="4" class="w-full bg-zinc-950 border border-zinc-800 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-red-600 transition">{{ old('synopsis', $series->synopsis) }}</textarea>
            </div>

            <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-2.5 rounded-lg shadow-md transition">
                Perbarui Series
            </button>
        </form>
    </div>
</div>
@endsection