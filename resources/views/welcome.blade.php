@extends('layouts.app')

@section('content')
<style>
    /* Style Carousel Super Smooth */
    .carousel-container {
        position: relative;
    }
    .carousel-item { 
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        visibility: hidden;
        transition: opacity 1.2s ease-in-out, visibility 1.2s ease-in-out;
        z-index: 1;
    }
    .carousel-item.active { 
        opacity: 1;
        visibility: visible;
        z-index: 10;
    }
    .line-clamp-2 { 
        display: -webkit-box; 
        -webkit-line-clamp: 2; 
        -webkit-box-orient: vertical; 
        overflow: hidden; 
    }
</style>

<div class="bg-zinc-950 min-h-screen text-white">
    
    <div class="carousel-container relative w-full h-[350px] sm:h-[500px] bg-black overflow-hidden border-b border-zinc-800">
        @forelse($series->take(5) as $index => $hero)
            <div class="carousel-item h-full w-full {{ $index == 0 ? 'active' : '' }} relative">
                <img src="{{ asset('storage/' . $hero->poster) }}" class="absolute inset-0 w-full h-full object-cover blur-xl opacity-30">
                
                <div class="relative max-w-7xl mx-auto h-full px-6 flex items-center gap-8 z-10">
                    <div class="hidden md:block w-64 h-80 shrink-0 shadow-2xl rounded-lg overflow-hidden border border-zinc-700">
                        <img src="{{ asset('storage/' . $hero->poster) }}" class="w-full h-full object-cover">
                    </div>
                    
                    <div class="flex flex-col space-y-4">
                        <span class="bg-red-600 text-white text-[10px] font-bold px-3 py-1 rounded-full w-fit uppercase tracking-tighter">
                            Featured {{ $hero->franchise->name ?? '' }}
                        </span>
                        <h2 class="text-4xl sm:text-6xl font-black uppercase tracking-tighter italic">
                            {{ $hero->title }}
                        </h2>
                        <p class="text-zinc-400 text-sm sm:text-base max-w-xl line-clamp-2">
                            {{ $hero->synopsis ?? 'Tidak ada sinopsis resmi.' }}
                        </p>
                        <div class="pt-4">
                            @if($hero->videos->count() > 0)
                                <a href="{{ route('watch.show', ['id' => $hero->id, 'video_id' => $hero->videos->first()->id]) }}" 
                                   class="bg-white text-black px-8 py-3 rounded-md font-bold text-sm hover:bg-red-600 hover:text-white transition-all flex items-center gap-2 w-fit">
                                   <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                                   TONTON SEKARANG
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="h-full flex items-center justify-center text-zinc-700 uppercase font-bold">Belum Ada Banner</div>
        @endforelse

        <div class="absolute bottom-6 right-6 flex gap-2 z-20">
            <button onclick="prevSlide()" class="p-2 bg-white/10 hover:bg-white/20 rounded-full transition-all border border-white/10">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </button>
            <button onclick="nextSlide()" class="p-2 bg-white/10 hover:bg-white/20 rounded-full transition-all border border-white/10">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </button>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="flex flex-wrap gap-2 order-2 md:order-1">
                <a href="{{ url('/') }}" class="px-5 py-2 rounded-md text-xs font-bold uppercase transition-all {{ !request('franchise') ? 'bg-red-600 text-white' : 'bg-zinc-900 text-zinc-500 hover:text-white' }}">
                    Semua
                </a>
                @foreach($franchises as $fran)
                    <a href="{{ url('/?franchise=' . $fran->id) }}" class="px-5 py-2 rounded-md text-xs font-bold uppercase transition-all {{ request('franchise') == $fran->id ? 'bg-red-600 text-white' : 'bg-zinc-900 text-zinc-500 hover:text-white' }}">
                        {{ $fran->name }}
                    </a>
                @endforeach
            </div>

            <form action="{{ url('/') }}" method="GET" class="w-full md:w-80 order-1 md:order-2">
                <div class="relative">
                    <input type="text" name="search" value="{{ request('search') }}" 
                        class="w-full bg-zinc-900 border border-zinc-800 rounded-lg pl-10 pr-4 py-2.5 text-sm focus:outline-none focus:border-red-500 text-white" 
                        placeholder="Cari Judul Toku...">
                    <svg class="w-5 h-5 absolute left-3 top-2.5 text-zinc-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
            </form>
        </div>

        <hr class="my-8 border-zinc-900">

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
            @forelse($series as $item)
                <div class="bg-zinc-900/50 border border-zinc-800 rounded-lg overflow-hidden group hover:border-red-600 transition-all duration-300 relative">
                    
                    <div class="absolute top-2 right-2 z-10">
                        <span class="bg-green-600 text-[9px] font-black px-2 py-0.5 rounded shadow-lg uppercase">Ongoing</span>
                    </div>

                    <div class="aspect-[3/4] overflow-hidden relative">
                        <img src="{{ asset('storage/' . $item->poster) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-zinc-950 via-transparent opacity-80"></div>
                    </div>

                    <div class="p-4 space-y-2">
                        <span class="text-[10px] text-red-500 font-bold uppercase tracking-widest">
                            {{ $item->franchise->name ?? '' }}
                        </span>
                        <h3 class="font-bold text-sm sm:text-base line-clamp-1 group-hover:text-red-500 transition-colors">
                            {{ $item->title }}
                        </h3>
                        <p class="text-zinc-500 text-[10px] font-medium">{{ $item->release_year }}</p>
                        
                        @if($item->videos->count() > 0)
                            <a href="{{ route('watch.show', ['id' => $item->id, 'video_id' => $item->videos->first()->id]) }}" 
                               class="block w-full text-center bg-zinc-800 hover:bg-red-600 text-white text-[11px] font-bold py-2 rounded mt-4 transition-all">
                               NONTON
                            </a>
                        @endif
                    </div>
                </div>
            @empty
                <div class="col-span-full py-20 text-center text-zinc-600 uppercase font-bold tracking-widest">Data Tidak Ditemukan, Bos!</div>
            @endforelse
        </div>
    </div>

</div>

<script>
    let currentSlide = 0;
    const slides = document.querySelectorAll('.carousel-item');
    let slideInterval;

    function showSlide(n) {
        if (slides.length === 0) return;
        
        slides[currentSlide].classList.remove('active');
        currentSlide = (n + slides.length) % slides.length;
        slides[currentSlide].classList.add('active');
    }

    function nextSlide() {
        showSlide(currentSlide + 1);
        resetTimer();
    }

    function prevSlide() {
        showSlide(currentSlide - 1);
        resetTimer();
    }

    function startTimer() {
        slideInterval = setInterval(nextSlide, 5000);
    }

    function resetTimer() {
        clearInterval(slideInterval);
        startTimer();
    }

    if (slides.length > 0) {
        startTimer();
    }
</script>
@endsection