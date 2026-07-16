@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    
    <div class="mb-6">
        <a href="/" class="text-sm text-zinc-400 hover:text-red-500 transition">← Kembali ke Beranda</a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-zinc-900 rounded-xl overflow-hidden border border-zinc-800 shadow-xl aspect-video relative">
                @if($activeVideo)
                    @if(str_contains($activeVideo->video_url, 'bilibili.tv') || str_contains($activeVideo->video_url, 'bilibili.com'))
                        @php
                            $idVideo = basename(parse_url($activeVideo->video_url, PHP_URL_PATH));
                            $embedUrl = "https://www.bilibili.tv/id/space/videos/embed/" . $idVideo;
                        @endphp
                        <iframe src="{{ $embedUrl }}" class="w-full h-full border-0" allowfullscreen="true" scrolling="no" allow="encrypted-media; picture-in-picture"></iframe>
                    @elseif(str_contains($activeVideo->video_url, 'youtube.com') || str_contains($activeVideo->video_url, 'youtu.be'))
                        @php
                            if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $activeVideo->video_url, $match)) {
                                $embedUrl = "https://www.youtube.com/embed/" . $match[1];
                            } else {
                                $embedUrl = $activeVideo->video_url;
                            }
                        @endphp
                        <iframe src="{{ $embedUrl }}" class="w-full h-full border-0" allowfullscreen></iframe>
                    @else
                        <iframe src="{{ $activeVideo->video_url }}" class="w-full h-full border-0" allowfullscreen></iframe>
                    @endif
                @else
                    <div class="w-full h-full flex flex-col items-center justify-center text-zinc-500 p-6 text-center">
                        <svg class="w-16 h-16 text-zinc-700 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <p class="text-sm font-semibold">Belum Ada Video Terbuka untuk Series Ini</p>
                    </div>
                @endif
            </div>

            <div class="bg-zinc-900 border border-zinc-800 p-5 rounded-xl flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h1 class="text-xl sm:text-2xl font-bold text-white">
                        {{ $series->title }} - {{ $activeVideo ? $activeVideo->title : 'Belum Ada Episode' }}
                    </h1>
                </div>
                
                <div class="flex items-center gap-2 bg-zinc-950 px-4 py-2 rounded-lg border border-zinc-800 w-fit">
                    <span class="text-xs font-bold text-zinc-400 uppercase tracking-widest">Rate:</span>
                    <div class="flex gap-1">
                        @for ($i = 1; $i <= 5; $i++)
                            <button onclick="setRating({{ $i }})" id="star-{{ $i }}" class="text-zinc-600 hover:text-yellow-500 transition-colors focus:outline-none">
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                    <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                                </svg>
                            </button>
                        @endfor
                    </div>
                    <span id="rating-value" class="text-xs font-black text-yellow-500">0.0</span>
                </div>
            </div>

            <div class="bg-zinc-900 border border-zinc-800 p-5 rounded-xl space-y-4">
                <h3 class="text-lg font-bold text-white border-b border-zinc-800 pb-3 flex items-center gap-2">
                    <svg class="w-5 h-5 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.907c.961 0 1.36 1.252.588 1.81l-3.974 2.89a1 1 0 00-.364 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.89a1 1 0 00-1.176 0l-3.976 2.89c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.364-1.118L2.98 10.425c-.772-.558-.372-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                    </svg>
                    Tulis Review Kamu
                </h3>
                
                <form id="reviewForm" onsubmit="submitReview(event)" class="space-y-3">
                    <textarea id="reviewText" required class="w-full bg-zinc-950 border border-zinc-800 rounded-lg p-3 text-sm text-white placeholder-zinc-600 focus:outline-none focus:border-red-500" rows="3" placeholder="Bagikan opini kamu tentang series atau episode ini..."></textarea>
                    <div class="flex justify-end">
                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold text-xs px-4 py-2 rounded-lg uppercase tracking-wider transition-all">Kirim Ulasan</button>
                    </div>
                </form>

                <div id="reviewsList" class="space-y-3 pt-4 border-t border-zinc-800/50">
                    </div>
            </div>

            <div class="bg-zinc-900 border border-zinc-800 p-5 rounded-xl space-y-4">
                <h3 class="text-lg font-bold text-white border-b border-zinc-800 pb-3 flex items-center gap-2">
                    <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"/>
                    </svg>
                    Diskusi Disqus Fans
                </h3>
                <div id="disqus_thread" class="mt-4"></div>
            </div>
        </div>

        <div class="space-y-6">
            <div class="bg-zinc-900 border border-zinc-800 p-5 rounded-xl">
                <span class="text-xs font-bold text-red-500 uppercase tracking-wider">{{ $series->franchise->name ?? 'Tokusatsu' }}</span>
                <h2 class="text-lg font-black text-white mt-1 uppercase">{{ $series->title }}</h2>
                <p class="text-zinc-400 text-xs mt-3 leading-relaxed">
                    {{ $series->synopsis ?? 'Tidak ada sinopsis resmi.' }}
                </p>
            </div>

            <div class="bg-zinc-900 border border-zinc-800 rounded-xl overflow-hidden">
                <div class="bg-zinc-950 px-4 py-3 border-b border-zinc-800">
                    <h3 class="text-xs font-bold text-white uppercase tracking-wider">Daftar Semua Episode</h3>
                </div>
                <div class="divide-y divide-zinc-800 max-h-[300px] overflow-y-auto">
                    @if($series->videos && $series->videos->count() > 0)
                        @foreach($series->videos as $v)
                            <a href="{{ route('watch.show', ['id' => $series->id, 'video_id' => $v->id]) }}" 
                               class="block px-4 py-3.5 text-sm transition flex justify-between items-center {{ $activeVideo && $activeVideo->id == $v->id ? 'bg-red-950/40 text-red-400 border-l-4 border-red-600 font-bold' : 'text-zinc-300 hover:bg-zinc-800/50' }}">
                                <span>{{ $v->title }}</span>
                                @if($activeVideo && $activeVideo->id == $v->id)
                                    <span class="text-[10px] bg-red-600 text-white px-2 py-0.5 rounded uppercase tracking-wider">Memutar</span>
                                @else
                                    <span class="text-zinc-600 text-xs">Tonton →</span>
                                @endif
                            </a>
                        @endforeach
                    @else
                        <div class="p-4 text-center text-zinc-500 italic text-xs">Belum ada data episode video yang diinput.</div>
                    @endif
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    const seriesId = "{{ $series->id }}";
    const ratingKey = `toku_rating_series_${seriesId}`;
    const reviewsKey = `toku_reviews_series_${seriesId}`;

    function loadSavedRating() {
        const savedRating = localStorage.getItem(ratingKey);
        if (savedRating) {
            updateStarsVisual(parseInt(savedRating));
        }
    }

    function setRating(ratingValue) {
        localStorage.setItem(ratingKey, ratingValue);
        updateStarsVisual(ratingValue);
    }

    function updateStarsVisual(rating) {
        document.getElementById('rating-value').textContent = rating.toFixed(1);
        for (let i = 1; i <= 5; i++) {
            const star = document.getElementById(`star-${i}`);
            if (i <= rating) {
                star.classList.add('text-yellow-500');
                star.classList.remove('text-zinc-600');
            } else {
                star.classList.add('text-zinc-600');
                star.classList.remove('text-yellow-500');
            }
        }
    }

    function loadReviews() {
        const reviewsContainer = document.getElementById('reviewsList');
        const savedReviews = JSON.parse(localStorage.getItem(reviewsKey)) || [];
        
        if (savedReviews.length === 0) {
            reviewsContainer.innerHTML = `<p class="text-xs text-zinc-600 italic">Belum ada ulasan untuk series ini. Jadilah yang pertama memberikan ulasan!</p>`;
            return;
        }

        reviewsContainer.innerHTML = savedReviews.map(rev => `
            <div class="bg-zinc-950 p-4 rounded-lg border border-zinc-900 space-y-2">
                <div class="flex justify-between items-center">
                    <span class="text-xs font-black text-red-500 uppercase tracking-wide">${rev.username}</span>
                    <div class="flex text-yellow-500 text-[10px] gap-0.5">
                        ${'⭐'.repeat(rev.rating)}
                    </div>
                </div>
                <p class="text-zinc-300 text-xs leading-relaxed">${rev.text}</p>
                <span class="text-[9px] text-zinc-600 block">${rev.date}</span>
            </div>
        `).join('');
    }

    function submitReview(event) {
        event.preventDefault();
        const reviewText = document.getElementById('reviewText').value;
        const currentRating = localStorage.getItem(ratingKey) || 5;
        
        const newReview = {
            username: "@auth {{ Auth::user()->name }} @else Viewer Toku @endauth",
            rating: parseInt(currentRating),
            text: reviewText,
            date: new Date().toLocaleDateString('id-ID', {day: 'numeric', month: 'short', year: 'numeric'})
        };

        const savedReviews = JSON.parse(localStorage.getItem(reviewsKey)) || [];
        savedReviews.unshift(newReview);
        localStorage.setItem(reviewsKey, JSON.stringify(savedReviews));

        document.getElementById('reviewText').value = '';
        loadReviews();
    }

    document.addEventListener("DOMContentLoaded", () => {
        loadSavedRating();
        loadReviews();
    });

    var disqus_config = function () {
        this.page.url = "{{ Request::url() }}";  
        this.page.identifier = "series-{{ $series->id }}-video-{{ $activeVideo->id ?? 0 }}"; 
    };

    (function() { 
        var d = document, s = d.createElement('script');
        s.src = 'https://tokusatsuverse.disqus.com/embed.js'; 
        s.setAttribute('data-timestamp', +new Date());
        (d.head || d.body).appendChild(s);
    })();
</script>
@endsection