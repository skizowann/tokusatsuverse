@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#09090b] text-white py-12 px-6">
    @if(session('success'))
        <div class="max-w-5xl mx-auto mb-8 bg-green-950/20 border border-green-500/20 text-green-400 p-4 rounded-xl text-center text-xs font-black uppercase tracking-widest">
            ⚡ {{ session('success') }}
        </div>
    @endif

    <div class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="md:col-span-2 space-y-6">
            <div class="bg-zinc-900/40 border border-zinc-800 rounded-3xl p-8 backdrop-blur-sm relative overflow-hidden">
                <div class="flex items-center gap-6">
                    <div class="relative w-24 h-24 rounded-2xl overflow-hidden border border-zinc-700">
                        <img src="{{ $user->avatar ? asset('uploads/avatars/' . $user->avatar) : 'https://ui-avatars.com/api/?name='.urlencode($user->name) }}" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <h1 class="text-3xl font-black uppercase">{{ $user->name }}</h1>
                        <p class="text-red-500 text-xs font-bold uppercase tracking-widest mt-1">{{ $user->role ?? 'Rider' }}</p>
                    </div>
                </div>

                <p class="mt-6 text-zinc-400 italic text-sm leading-relaxed border-l-2 border-red-900 pl-4">
                    "{{ $user->bio ?? 'Belum ada kutipan rider.' }}"
                </p>

                <div class="mt-6 flex flex-wrap gap-2">
                    {{-- Menampilkan data dari kolom favorite_rider --}}
                    @if($user->favorite_rider)
                        @foreach(explode(',', $user->favorite_rider) as $genre)
                            <span class="px-3 py-1 bg-zinc-800/50 rounded-full text-[10px] font-bold text-zinc-400 border border-zinc-700 uppercase">{{ trim($genre) }}</span>
                        @endforeach
                    @else
                        <span class="px-3 py-1 bg-zinc-800/50 rounded-full text-[10px] font-bold text-zinc-400 border border-zinc-700 uppercase">NO GENRE</span>
                    @endif
                </div>
            </div>
        </div>

        <div class="bg-zinc-900/40 border border-zinc-800 rounded-3xl p-8 flex flex-col justify-between">
            <div>
                <h3 class="text-xs font-black uppercase text-zinc-500">Rider Status</h3>
                <div class="mt-6 space-y-4">
                    <div class="flex justify-between text-xs font-bold mb-2">
                        <span>Rank: {{ $rank ?? 'Novice Rider' }}</span>
                        <span class="text-red-500">{{ $progressPercent ?? 0 }}%</span>
                    </div>
                    <div class="h-2 bg-zinc-800 rounded-full overflow-hidden">
                        <div class="h-full bg-red-600" style="width: {{ $progressPercent ?? 0 }}%"></div>
                    </div>
                </div>
            </div>
            <div class="mt-8 pt-6 border-t border-zinc-800 space-y-3">
                <button onclick="toggleModal()" class="w-full py-3 bg-white text-black rounded-xl text-[10px] font-black uppercase hover:bg-zinc-200 transition">Edit Profile</button>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full py-3 bg-zinc-800 hover:bg-red-600 rounded-xl text-[10px] font-black uppercase transition">Logout</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="editModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/70 backdrop-blur-sm p-4">
    <div class="bg-zinc-950 border border-zinc-800 w-full max-w-lg rounded-3xl p-8 shadow-2xl">
        <h2 class="text-xl font-black uppercase mb-6 text-white">Edit Profile</h2>
        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf 
            @method('PUT')
            
            <div class="space-y-1">
                <label class="text-[10px] font-bold text-zinc-500 uppercase">Nama</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full bg-zinc-900 p-3 rounded-xl border border-zinc-800 text-sm text-white" required>
            </div>
            <div class="space-y-1">
                <label class="text-[10px] font-bold text-zinc-500 uppercase">Ganti Foto Profil</label>
                <input type="file" name="avatar" class="w-full bg-zinc-900 p-3 rounded-xl border border-zinc-800 text-sm text-white">
            </div>
            <div class="space-y-1">
                <label class="text-[10px] font-bold text-zinc-500 uppercase">Genre Favorit (Pisahkan koma)</label>
                {{-- name="favorite_genres" agar sesuai dengan $request->validate --}}
                <input type="text" name="favorite_genres" value="{{ old('favorite_genres', $user->favorite_rider) }}" class="w-full bg-zinc-900 p-3 rounded-xl border border-zinc-800 text-sm text-white">
            </div>
            <div class="space-y-1">
                <label class="text-[10px] font-bold text-zinc-500 uppercase">Bio</label>
                <textarea name="bio" class="w-full bg-zinc-900 p-3 rounded-xl border border-zinc-800 text-sm h-20 text-white">{{ old('bio', $user->bio) }}</textarea>
            </div>
            
            <div class="flex gap-3 mt-6">
                <button type="button" onclick="toggleModal()" class="flex-1 py-3 bg-zinc-800 text-white rounded-xl text-[10px] font-black uppercase hover:bg-zinc-700">Batal</button>
                <button type="submit" class="flex-1 py-3 bg-red-600 text-white rounded-xl font-black uppercase text-[10px] hover:bg-red-700 transition">Update</button>
            </div>
        </form>
    </div>
</div>

<script>
    function toggleModal() { 
        const modal = document.getElementById('editModal');
        modal.classList.toggle('hidden');
        modal.classList.toggle('flex');
    }
</script>
@endsection