<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Video;
use App\Models\Series;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::with('series')->latest()->get();
        return view('admin.videos.index', compact('videos'));
    }

    public function create()
    {
        return view('admin.videos.create', ['series' => Series::all()]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'series_id' => 'required|exists:series,id',
            'title' => 'required|string|max:255',
            'video_url' => 'required|url',
        ]);

        $validated['slug'] = Str::slug($request->title) . '-' . time();
        Video::create($validated);

        return redirect()->route('admin.videos.index')->with('success', 'Episode video berhasil ditambahkan!');
    }

    public function edit(Video $video)
    {
        return view('admin.videos.edit', ['video' => $video, 'series' => Series::all()]);
    }

    public function update(Request $request, Video $video)
    {
        $validated = $request->validate([
            'series_id' => 'required|exists:series,id',
            'title' => 'required|string|max:255',
            'video_url' => 'required|url',
        ]);

        $validated['slug'] = Str::slug($request->title) . '-' . time();
        $video->update($validated);

        return redirect()->route('admin.videos.index')->with('success', 'Episode video berhasil diperbarui!');
    }

    public function destroy(Video $video)
    {
        $video->delete();
        return redirect()->route('admin.videos.index')->with('success', 'Episode video berhasil dihapus!');
    }
}