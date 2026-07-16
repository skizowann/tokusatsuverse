@extends('layouts.app')

@section('content')
<div class="min-h-[80vh] flex items-center justify-center bg-zinc-950 px-4 py-12">
    <div class="max-w-md w-full space-y-8 bg-zinc-900 border border-zinc-800 p-8 rounded-2xl shadow-2xl">
        <div>
            <h2 class="text-center text-3xl font-black tracking-tighter uppercase text-white italic">
                RIDER <span class="text-red-600 font-bold">REGISTER</span>
            </h2>
            <p class="mt-2 text-center text-xs text-zinc-500 uppercase tracking-widest">
                Buat akun barumu sekarang
            </p>
        </div>

        @if($errors->any())
            <div class="bg-red-950/50 border border-red-800 text-red-400 p-3 rounded-lg text-xs space-y-1">
                @foreach ($errors->all() as $error)
                    <p>• {{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form class="mt-8 space-y-4" action="{{ route('register') }}" method="POST">
            @csrf
            <div>
                <label class="text-xs font-bold text-zinc-400 uppercase tracking-wider block mb-2">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name') }}" required 
                    class="w-full bg-zinc-950 border border-zinc-800 rounded-lg px-4 py-3 text-sm text-white focus:outline-none focus:border-red-500 transition" 
                    placeholder="Contoh: Muhammad Ridwan">
            </div>
            <div>
                <label class="text-xs font-bold text-zinc-400 uppercase tracking-wider block mb-2">Email Address</label>
                <input type="email" name="email" value="{{ old('email') }}" required 
                    class="w-full bg-zinc-950 border border-zinc-800 rounded-lg px-4 py-3 text-sm text-white focus:outline-none focus:border-red-500 transition" 
                    placeholder="nama@email.com">
            </div>
            <div>
                <label class="text-xs font-bold text-zinc-400 uppercase tracking-wider block mb-2">Password (Min. 6 Karakter)</label>
                <input type="password" name="password" required 
                    class="w-full bg-zinc-950 border border-zinc-800 rounded-lg px-4 py-3 text-sm text-white focus:outline-none focus:border-red-500 transition" 
                    placeholder="••••••••">
            </div>
            <div>
                <label class="text-xs font-bold text-zinc-400 uppercase tracking-wider block mb-2">Ulangi Password</label>
                <input type="password" name="password_confirmation" required 
                    class="w-full bg-zinc-950 border border-zinc-800 rounded-lg px-4 py-3 text-sm text-white focus:outline-none focus:border-red-500 transition" 
                    placeholder="••••••••">
            </div>

            <div class="pt-2">
                <button type="submit" 
                    class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-black rounded-lg text-white bg-red-600 hover:bg-red-700 focus:outline-none transition-all uppercase tracking-wider">
                    CREATE ACCOUNT
                </button>
            </div>
        </form>

        <div class="text-center pt-2">
            <p class="text-xs text-zinc-500">
                Sudah punya akun? 
                <a href="{{ route('login') }}" class="text-red-500 hover:text-red-400 font-bold transition">Login Di Sini →</a>
            </p>
        </div>
    </div>
</div>
@endsection