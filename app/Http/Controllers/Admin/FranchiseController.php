<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Franchise;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FranchiseController extends Controller
{
    /**
     * Tampilkan Halaman Daftar Franchise
     */
    public function index()
    {
        $franchises = Franchise::latest()->get();
        return view('admin.franchises.index', compact('franchises'));
    }

    /**
     * Tampilkan Form Tambah Franchise
     */
    public function create()
    {
        return view('admin.franchises.create');
    }

    /**
     * Simpan Data Franchise Baru ke Database (SUDAH FIXED SLUG AUTOMATIC)
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:franchises,name',
        ]);

        // Membuat data dengan generating slug otomatis dari nama franchise
        Franchise::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name), 
        ]);

        return redirect()->route('franchises.index')->with('success', 'Franchise berhasil ditambahkan!');
    }

    /**
     * Tampilkan Form Edit Franchise
     */
    public function edit($id)
    {
        $franchise = Franchise::findOrFail($id);
        return view('admin.franchises.edit', compact('franchise'));
    }

    /**
     * Update Data Franchise
     */
    public function update(Request $request, $id)
    {
        $franchise = Franchise::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255|unique:franchises,name,' . $id,
        ]);

        $franchise->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return redirect()->route('franchises.index')->with('success', 'Franchise berhasil diperbarui!');
    }

    /**
     * Hapus Data Franchise
     */
    public function destroy($id)
    {
        $franchise = Franchise::findOrFail($id);
        $franchise->delete();

        return redirect()->route('franchises.index')->with('success', 'Franchise berhasil dihapus!');
    }
}