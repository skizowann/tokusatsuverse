<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Series;
use App\Models\Franchise;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SeriesController extends Controller
{
    /**
     * Tampilkan Halaman Daftar Series
     */
    public function index()
    {
        $series = Series::with('franchise')->latest()->get();
        return view('admin.series.index', compact('series'));
    }

    /**
     * Tampilkan Form Tambah Series
     */
    public function create()
    {
        $franchises = Franchise::all();
        $genres = Genre::all();
        return view('admin.series.create', compact('franchises', 'genres'));
    }

    /**
     * Simpan Data Series Baru ke Database (SUDAH ANTI-EROR TAHUN RILIS)
     */
    public function store(Request $request)
    {
        // Validasi dasar agar inputan utama terjaga
        $request->validate([
            'title' => 'required|string|max:255',
            'franchise_id' => 'required',
        ]);

        // Proses unggah file poster
        $posterPath = null;
        if ($request->hasFile('poster')) {
            $file = $request->file('poster');
            $filename = time() . '_' . Str::slug($request->title) . '.' . $file->getClientOriginalExtension();
            $posterPath = $file->storeAs('posters', $filename, 'public');
        }

        /**
         * TRIK ANTI EROR:
         * Jika $request->release_year kosong / tidak terkirim dari form HTML,
         * sistem akan otomatis mengisinya dengan tahun saat ini (2026) agar database tidak menolak.
         */
        $tahunRilis = $request->release_year ? $request->release_year : date('Y');

        // Proses simpan data ke database
        $singleSeries = Series::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'franchise_id' => $request->franchise_id,
            'poster' => $posterPath,
            'release_year' => $tahunRilis,
            'synopsis' => $request->synopsis ?? 'Sinopsis belum ditambahkan.',
        ]);

        // Sinkronisasi genre jika ada yang dipilih
        if ($request->has('genres')) {
            $singleSeries->genres()->sync($request->genres);
        }

        return redirect()->route('series.index')->with('success', 'Series baru berhasil disimpan!');
    }

    /**
     * Tampilkan Form Edit Series
     */
    public function edit($id)
    {
        $series = Series::findOrFail($id);
        $franchises = Franchise::all();
        $genres = Genre::all();
        return view('admin.series.edit', compact('series', 'franchises', 'genres'));
    }

    /**
     * Update Data Series
     */
    public function update(Request $request, $id)
    {
        $series = Series::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'franchise_id' => 'required',
        ]);

        $posterPath = $series->poster;
        if ($request->hasFile('poster')) {
            $file = $request->file('poster');
            $filename = time() . '_' . Str::slug($request->title) . '.' . $file->getClientOriginalExtension();
            $posterPath = $file->storeAs('posters', $filename, 'public');
        }

        $tahunRilis = $request->release_year ? $request->release_year : $series->release_year;

        $series->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'franchise_id' => $request->franchise_id,
            'poster' => $posterPath,
            'release_year' => $tahunRilis,
            'synopsis' => $request->synopsis ?? $series->synopsis,
        ]);

        if ($request->has('genres')) {
            $series->genres()->sync($request->genres);
        }

        return redirect()->route('series.index')->with('success', 'Series berhasil diperbarui!');
    }

    /**
     * Hapus Data Series
     */
    public function destroy($id)
    {
        $series = Series::findOrFail($id);
        $series->delete();

        return redirect()->route('series.index')->with('success', 'Series berhasil dihapus!');
    }
}