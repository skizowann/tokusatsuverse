<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tokusatsuverse - Situs Streaming Tokusatsu Lokal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Desain Scrollbar Gelap Premium */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #09090b;
        }
        ::-webkit-scrollbar-thumb {
            background: #27272a;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #dc2626;
        }
    </style>
</head>
<body class="bg-zinc-950 text-zinc-100 font-sans min-h-screen flex flex-col">

    <nav class="bg-zinc-900 border-b border-zinc-800 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center h-16">
            
            <div class="flex items-center space-x-3">
                <a href="/" class="text-2xl font-black text-red-600 tracking-wider uppercase italic">
                    Tokusatsu<span class="text-white">verse</span>
                </a>
            </div>
            
            <div class="flex items-center space-x-6 text-sm font-medium">
                <a href="/" class="text-white hover:text-red-500 transition">Beranda</a>
                
                @auth
                    <a href="{{ route('profile.index') }}" class="text-zinc-400 hover:text-white transition-all flex items-center gap-1.5">
                        <span>Halo, <span class="text-red-500 font-bold uppercase">{{ Auth::user()->name }}</span></span>
                    </a>

                    @if(Auth::user()->role === 'Admin')
                        <a href="{{ route('admin.dashboard') }}" class="bg-zinc-800 border border-zinc-700 hover:border-red-600 text-zinc-300 px-3 py-1.5 rounded-lg text-xs transition">
                            Panel Admin →
                        </a>
                    @endif
                    
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="bg-zinc-800 hover:bg-red-600 border border-zinc-700 hover:border-red-600 text-white text-xs font-black px-3 py-1.5 rounded-lg transition-all uppercase tracking-wider">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-zinc-400 hover:text-white text-xs font-bold uppercase tracking-wider transition-all">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="bg-red-600 hover:bg-red-700 text-white text-xs font-black px-4 py-2 rounded-md uppercase tracking-wider transition-all">
                        Register
                    </a>
                @endauth
            </div>

        </div>
    </nav>

    <main class="flex-grow">
        @yield('content')
    </main>

    <footer class="bg-zinc-900 border-t border-zinc-800 py-6 text-center text-xs text-zinc-500">
        <p>&copy; 2026 Tokusatsuverse. Dibuat dengan penuh semangat pahlawan.</p>
    </footer>

</body>
</html>