<?php

use Illuminate\Support\Facades\Route;
use App\Models\Series;
use App\Models\Franchise;
use App\Models\Genre;
use App\Models\Video;
use Illuminate\Http\Request; 
use App\Http\Controllers\Admin\FranchiseController;
use App\Http\Controllers\Admin\GenreController;
use App\Http\Controllers\Admin\SeriesController;
use App\Http\Controllers\Admin\VideoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes - Tokusatsuverse
|--------------------------------------------------------------------------
*/

// ==================== 1. SISI USER (PUBLIC) ====================

Route::get('/', function (Request $request) {
    $franchises = Franchise::all();
    $query = Series::with(['franchise', 'videos']);

    if ($request->has('search') && $request->search != '') {
        $query->where('title', 'like', '%' . $request->search . '%');
    }

    if ($request->has('franchise') && $request->franchise != '') {
        $query->where('franchise_id', $request->franchise);
    }

    $series = $query->latest()->get();
    return view('welcome', compact('series', 'franchises'));
})->name('home');

Route::get('/watch/{id}/{video_id?}', function ($id, $video_id = null) {
    $series = Series::with(['franchise', 'videos'])->findOrFail($id);
    $activeVideo = $video_id ? $series->videos->where('id', $video_id)->first() : $series->videos->first();
    return view('show', compact('series', 'activeVideo'));
})->name('watch.show');


// ==================== 2. SISTEM LOGIN & REGISTRASI ====================

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    
    // Pastikan form Blade Anda menggunakan @method('PUT')
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});


// ==================== 3. SISI ADMIN (CRUD PANEL) ====================

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard', [
            'totalFranchise' => Franchise::count(),
            'totalGenre'     => Genre::count(),
            'totalSeries'    => Series::count(),
            'totalVideo'     => Video::count(),
        ]);
    })->name('admin.dashboard');

    Route::resource('franchises', FranchiseController::class);
    Route::resource('genres', GenreController::class);
    Route::resource('series', SeriesController::class);
    Route::resource('videos', VideoController::class);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');