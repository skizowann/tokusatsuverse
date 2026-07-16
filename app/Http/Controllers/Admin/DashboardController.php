<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Import semua Model database agar bisa dihitung jumlah datanya
use App\Models\Franchise;
use App\Models\Genre;
use App\Models\Series;

class DashboardController extends Controller
{
    public function index()
    {
        // Menghitung jumlah baris data dari masing-masing tabel di database
        $totalFranchises = Franchise::count();
        $totalGenres = Genre::count();
        $totalSeries = Series::count();

        // Lempar data hitungan tersebut ke dalam file view dashboard
        return view('admin.dashboard', compact('totalFranchises', 'totalGenres', 'totalSeries'));
    }
}