<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - ZAIpunya</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Orbitron', sans-serif;
            background: linear-gradient(135deg, #0f0f23 0%, #1a1a2e 50%, #16213e 100%);
        }
        .glass {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        .neon-text {
            text-shadow: 0 0 10px #00d4ff, 0 0 20px #00d4ff;
        }
    </style>
    
    @yield('styles')
</head>
<body class="bg-gray-950 text-white">
    
    <div class="flex min-h-screen">
        
        {{-- SIDEBAR --}}
        <aside class="w-64 glass border-r border-cyan-500/20 flex-shrink-0">
            {{-- Logo --}}
            <div class="p-6 border-b border-cyan-500/20">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-cyan-400 to-blue-600 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-xl font-black text-white neon-text">ZAIpunya</h1>
                        <p class="text-xs text-cyan-300">Dashboard Akademik</p>
                    </div>
                </div>
            </div>

            {{-- User Profile --}}
            <div class="p-4 border-b border-gray-800">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-cyan-500 to-blue-600 rounded-full flex items-center justify-center text-white font-bold">
                        {{ substr(Auth::user()->name ?? 'U', 0, 1) }}
                    </div>
                    <div>
                        <p class="text-white font-semibold text-sm">{{ Auth::user()->name ?? 'User' }}</p>
                        <p class="text-cyan-300 text-xs">Administrator</p>
                    </div>
                </div>
            </div>

            {{-- Menu --}}
            <nav class="p-4">
                <p class="text-gray-500 text-xs uppercase mb-3 tracking-widest">MENU</p>
                
                <a href="{{ route('dashboard') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-lg mb-2 transition {{ request()->routeIs('dashboard') ? 'bg-cyan-600 text-white' : 'text-gray-400 hover:bg-gray-800/50' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Dashboard
                </a>

                <a href="{{ route('mahasiswa.index') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-lg mb-2 transition {{ request()->routeIs('mahasiswa.*') ? 'bg-cyan-600 text-white' : 'text-gray-400 hover:bg-gray-800/50' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                    Mahasiswa
                </a>

                <form method="POST" action="{{ route('logout') }}" class="mt-4">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 rounded-lg text-red-400 hover:bg-red-500/10 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        Keluar
                    </button>
                </form>
            </nav>
        </aside>

        {{-- CONTENT --}}
        <main class="flex-1 p-8">
            @if(session('success'))
                <div class="bg-green-500/20 border-green-500/50 text-green-300 p-4 rounded-lg mb-6">
                    {{ session('success') }}
                </div>
            @endif
            
            @yield('content')
        </main>
    </div>

</body>
</html>