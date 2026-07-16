<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    // Menampilkan halaman profil dan menghitung rank
    public function index(): View
    {
        $user = Auth::user();
        $watched = $user->watched_count ?? 0;
        
        $rank = 'Novice Rider';
        $progressPercent = 0;
        
        if ($watched >= 20) {
            $rank = 'Ohma Zi-O';
            $progressPercent = 100;
        } elseif ($watched >= 10) {
            $rank = 'Heisei Legend';
            $progressPercent = min(100, intval(($watched / 20) * 100));
        } elseif ($watched >= 5) {
            $rank = 'S.H.Figuarts Collector';
            $progressPercent = min(100, intval(($watched / 10) * 100));
        } elseif ($watched >= 1) {
            $rank = 'Active Henshin Fighter';
            $progressPercent = min(100, intval(($watched / 5) * 100));
        }

        return view('profile.index', compact('user', 'rank', 'progressPercent'));
    }

    // Memproses update data profil
    public function update(Request $request): RedirectResponse
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string|max:500',
            'favorite_genres' => 'nullable|string|max:255', // Input dari form
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user->name = $request->name;
        $user->bio = $request->bio;
        // PENTING: Menyimpan input 'favorite_genres' ke kolom 'favorite_rider' di database
        $user->favorite_rider = $request->favorite_genres;

        if ($request->hasFile('avatar')) {
            // Hapus avatar lama jika ada
            if ($user->avatar && file_exists(public_path('uploads/avatars/' . $user->avatar))) {
                unlink(public_path('uploads/avatars/' . $user->avatar));
            }
            $file = $request->file('avatar');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/avatars'), $filename);
            $user->avatar = $filename;
        }

        $user->save();

        return redirect()->route('profile.index')->with('success', 'Rider Card berhasil di-update!');
    }

    // Menampilkan halaman edit (opsional jika menggunakan modal di index)
    public function edit(Request $request): View
    {
        return view('profile.edit', ['user' => $request->user()]);
    }

    // Menghapus akun user
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();
        Auth::logout();
        $user->delete();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}