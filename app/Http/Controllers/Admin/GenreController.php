<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Str; // Wajib import ini untuk membuat slug otomatis

class GenreController extends Controller
{
    public function index()
    {
        $genres = Genre::latest()->get();
        return view('admin.genres.index', compact('genres'));
    }

    public function create()
    {
        return view('admin.genres.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:genres,name',
        ]);

        // Ditambahkan otomatis 'slug' biar tidak error database lagi
        Genre::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name), 
        ]);

        return redirect()->route('genres.index')->with('success', 'Genre berhasil ditambahkan!');
    }

    public function edit(Genre $genre)
    {
        return view('admin.genres.edit', compact('genre'));
    }

    public function update(Request $request, Genre $genre)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:genres,name,' . $genre->id,
        ]);

        // Ditambahkan otomatis 'slug' saat update
        $genre->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return redirect()->route('genres.index')->with('success', 'Genre berhasil diperbarui!');
    }

    public function destroy(Genre $genre)
    {
        $genre->delete();
        return redirect()->route('genres.index')->with('success', 'Genre berhasil dihapus!');
    }
}