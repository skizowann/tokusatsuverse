@extends('layouts.admin')

@section('content')
<div class="p-6 max-w-4xl mx-auto">
    
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-white tracking-wide uppercase">Tambah Series Baru</h1>
        <p class="text-zinc-400 text-sm mt-1">Silakan isi formulir di bawah ini untuk menambahkan data series tokusatsu baru.</p>
    </div>

    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-950/80 border border-red-700 text-red-200 rounded-xl text-sm shadow-lg">
            <div class="flex items-center gap-2 mb-2">
                <svg class="w-5 h-5 text-red-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
                <strong class="font-bold text-base text-red-400">Gagal Menyimpan Data, Bos! Periksa Kolom Ini:</strong>
            </div>
            <ul class="list-disc list-inside space-y-1 pl-2 text-red-300">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-zinc-900 p-6 rounded-xl border border-zinc-800 shadow-xl">
        <form action="{{ route('series.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf

            <div>
                <label for="title" class="block text-zinc-300 text-sm font-medium mb-2">Judul Series</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" 
                    class="w-full bg-zinc-950 border border-zinc-800 rounded-lg px-4 py-2.5 text-white placeholder-zinc-600 focus:outline-none focus:border-red-500 transition-colors" 
                    placeholder="Contoh: Kamen Rider Geats" required>
            </div>

            <div>
                <label for="franchise_id" class="block text-zinc-300 text-sm font-medium mb-2">Franchise Tokusatsu</label>
                <select name="franchise_id" id="franchise_id" 
                    class="w-full bg-zinc-950 border border-zinc-800 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-red-500 transition-colors" required>
                    <option value="" disabled selected>-- Pilih Franchise --</option>
                    @foreach($franchises as $franchise)
                        <option value="{{ $franchise->id }}" {{ old('franchise_id') == $franchise->id ? 'selected' : '' }}>
                            {{ $franchise->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="release_year" class="block text-zinc-300 text-sm font-medium mb-2">Tahun Rilis</label>
                <input type="number" name="release_year" id="release_year" value="{{ old('release_year') }}" 
                    class="w-full bg-zinc-950 border border-zinc-800 rounded-lg px-4 py-2.5 text-white placeholder-zinc-600 focus:outline-none focus:border-red-500 transition-colors" 
                    placeholder="Contoh: 2022" min="1900" max="{{ date('Y') }}" required>
            </div>

            <div>
                <label class="block text-zinc-300 text-sm font-medium mb-3">Genre</label>
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3 bg-zinc-950 p-4 rounded-lg border border-zinc-800">
                    @foreach($genres as $genre)
                        <label class="flex items-center space-x-3 text-sm text-zinc-400 hover:text-white cursor-pointer transition-colors">
                            <input type="checkbox" name="genres[]" value="{{ $genre->id }}" 
                                {{ is_array(old('genres')) && in_array($genre->id, old('genres')) ? 'checked' : '' }}
                                class="rounded bg-zinc-900 border-zinc-700 text-red-600 focus:ring-0 focus:ring-offset-0">
                            <span>{{ $genre->name }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            <div>
                <label for="poster" class="block text-zinc-300 text-sm font-medium mb-2">Gambar Poster (Maksimal 2MB)</label>
                <input type="file" name="poster" id="poster" 
                    class="w-full bg-zinc-950 border border-zinc-800 rounded-lg px-4 py-2 text-zinc-400 file:mr-4 file:py-1.5 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-zinc-800 file:text-white hover:file:bg-zinc-700 cursor-pointer focus:outline-none focus:border-red-500 transition-colors" required>
            </div>

            <div>
                <label for="synopsis" class="block text-zinc-300 text-sm font-medium mb-2">Sinopsis</label>
                <textarea name="synopsis" id="synopsis" rows="4" 
                    class="w-full bg-zinc-950 border border-zinc-800 rounded-lg px-4 py-2.5 text-white placeholder-zinc-600 focus:outline-none focus:border-red-500 transition-colors resize-none" 
                    placeholder="Masukkan sinopsis resmi jalan cerita series..." required>{{ old('synopsis') }}</textarea>
            </div>

            <div class="flex items-center justify-end space-x-3 pt-4 border-t border-zinc-800/60">
                <a href="{{ route('series.index') }}" 
                    class="bg-zinc-800 text-zinc-300 px-5 py-2.5 rounded-lg text-sm font-medium hover:bg-zinc-700 hover:text-white transition-colors">
                    Batal
                </a>
                <button type="submit" 
                    class="bg-red-600 text-white px-6 py-2.5 rounded-lg text-sm font-medium hover:bg-red-500 shadow-md shadow-red-950/20 transition-colors">
                    Simpan Series
                </button>
            </div>

        </form>
    </div>

</div>
@endsection