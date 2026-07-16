<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TV_ADMIN - Tokusatsuverse</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-zinc-950 text-gray-100 flex h-screen overflow-hidden">

    <div class="w-64 bg-zinc-900 border-r border-zinc-800 flex flex-col justify-between p-4 shrink-0">
        <div>
            <div class="mb-8 px-4">
                <h1 class="text-2xl font-black text-red-600 tracking-wider">TV_ADMIN</h1>
            </div>

            <nav class="space-y-2">
                <a href="{{ route('admin.dashboard') }}" 
                   class="block px-4 py-2.5 rounded-lg text-sm font-semibold transition {{ request()->routeIs('admin.dashboard') ? 'bg-red-600 text-white' : 'text-zinc-400 hover:bg-zinc-800 hover:text-white' }}">
                    Dashboard
                </a>
                
                <a href="{{ route('franchises.index') }}" 
                   class="block px-4 py-2.5 rounded-lg text-sm font-semibold transition {{ request()->routeIs('franchises.*') ? 'bg-red-600 text-white' : 'text-zinc-400 hover:bg-zinc-800 hover:text-white' }}">
                    Kelola Franchise
                </a>
                
                <a href="{{ route('genres.index') }}" 
                   class="block px-4 py-2.5 rounded-lg text-sm font-semibold transition {{ request()->routeIs('genres.*') ? 'bg-red-600 text-white' : 'text-zinc-400 hover:bg-zinc-800 hover:text-white' }}">
                    Kelola Genre
                </a>
                
                <a href="{{ route('series.index') }}" 
                   class="block px-4 py-2.5 rounded-lg text-sm font-semibold transition {{ request()->routeIs('series.*') ? 'bg-red-600 text-white' : 'text-zinc-400 hover:bg-zinc-800 hover:text-white' }}">
                    Kelola Series
                </a>

                <a href="{{ route('videos.index') }}" 
                   class="block px-4 py-2.5 rounded-lg text-sm font-semibold transition {{ request()->routeIs('videos.*') ? 'bg-red-600 text-white' : 'text-zinc-400 hover:bg-zinc-800 hover:text-white' }}">
                    Kelola Video
                </a>
            </nav>
        </div>

        <div class="pt-4 border-t border-zinc-800">
            <form action="{{ url('/logout') }}" method="POST" onsubmit="return confirm('Yakin ingin logout?')">
                @csrf
                <button type="submit" class="w-full text-left px-4 py-2.5 rounded-lg text-sm font-semibold text-zinc-400 hover:bg-red-950/40 hover:text-red-500 transition uppercase tracking-wider text-center bg-zinc-950 border border-zinc-800 cursor-pointer">
                    Logout
                </button>
            </form>
        </div>
    </div>

    <div class="flex-1 flex flex-col h-full overflow-y-auto bg-zinc-950">
        <main class="flex-1 p-2">
            @yield('content')
        </main>
    </div>

</body>
</html>