@extends('layouts.app')

@section('content')
<div class="min-h-[80vh] flex items-center justify-center bg-zinc-950 px-4 py-12">
    <div class="max-w-md w-full space-y-8 bg-zinc-900 border border-zinc-800 p-8 rounded-2xl shadow-2xl">
        <div>
            <h2 class="text-center text-3xl font-black tracking-tighter uppercase text-white italic">
                RIDER <span class="text-red-600 font-bold">LOGIN</span>
            </h2>
            <p class="mt-2 text-center text-xs text-zinc-500 uppercase tracking-widest">
                Masuk ke akun TokusatsuVerse kamu
            </p>
        </div>

        @if($errors->any())
            <div class="bg-red-950/50 border border-red-800 text-red-400 p-3 rounded-lg text-xs">
                {{ $errors->first() }}
            </div>
        @endif

        <form class="mt-8 space-y-6" action="{{ route('login') }}" method="POST">
            @csrf
            <div class="rounded-md space-y-4">
                <div>
                    <label class="text-xs font-bold text-zinc-400 uppercase tracking-wider block mb-2">Email Address</label>
                    <input type="email" name="email" value="{{ old('email') }}" required 
                        class="w-full bg-zinc-950 border border-zinc-800 rounded-lg px-4 py-3 text-sm text-white focus:outline-none focus:border-red-500 transition" 
                        placeholder="nama@email.com">
                </div>
                <div>
                    <label class="text-xs font-bold text-zinc-400 uppercase tracking-wider block mb-2">Password</label>
                    <input type="password" name="password" required 
                        class="w-full bg-zinc-950 border border-zinc-800 rounded-lg px-4 py-3 text-sm text-white focus:outline-none focus:border-red-500 transition" 
                        placeholder="••••••••">
                </div>
            </div>

            <div>
                <button type="submit" 
                    class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-black rounded-lg text-white bg-red-600 hover:bg-red-700 focus:outline-none transition-all uppercase tracking-wider">
                    ACCESS GRANTED
                </button>
            </div>
        </form>

        <div class="text-center pt-4">
            <p class="text-xs text-zinc-500">
                Belum punya akun? 
                <a href="{{ route('register') }}" class="text-red-500 hover:text-red-400 font-bold transition">Daftar Di Sini →</a>
            </p>
        </div>
    </div>
</div>
@endsection