<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Franchise;
use App\Models\Genre;
use App\Models\Series;
use App\Models\Video;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // Mengambil jumlah total data dari masing-masing tabel database
        $totalFranchise = Franchise::count();
        $totalGenre = Genre::count();
        $totalSeries = Series::count();
        $totalVideo = Video::count();

        // Mengirimkan variabel data ke halaman view dashboard
        return view('admin.dashboard', compact('totalFranchise', 'totalGenre', 'totalSeries', 'totalVideo'));
    }
}