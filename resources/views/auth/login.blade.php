<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - ZAIpunya</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&display=swap');
        body {
            font-family: 'Orbitron', sans-serif;
            background: linear-gradient(135deg, #0f0f23 0%, #1a1a2e 50%, #16213e 100%);
            background-image: 
                radial-gradient(circle at 20% 50%, rgba(120, 119, 198, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 80% 50%, rgba(255, 119, 198, 0.3) 0%, transparent 50%);
        }
        .glass {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
        }
        .neon-text {
            text-shadow: 0 0 10px #00d4ff, 0 0 20px #00d4ff, 0 0 30px #00d4ff;
        }
        .neon-border {
            box-shadow: 0 0 20px rgba(0, 212, 255, 0.5), inset 0 0 20px rgba(0, 212, 255, 0.1);
        }
        input:focus {
            box-shadow: 0 0 15px rgba(0, 212, 255, 0.6);
        }
        @keyframes glow {
            0%, 100% { box-shadow: 0 0 20px rgba(0, 212, 255, 0.5); }
            50% { box-shadow: 0 0 40px rgba(0, 212, 255, 0.8); }
        }
        .glow-button {
            animation: glow 2s ease-in-out infinite;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">
    
    <div class="w-full max-w-md">
        {{-- Logo + Judul --}}
        <div class="text-center mb-8">
            <div class="w-20 h-20 bg-gradient-to-br from-cyan-400 to-blue-600 rounded-2xl mx-auto flex items-center justify-center mb-4 neon-border">
                <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <h1 class="text-4xl font-black text-white neon-text mb-2">ZAIpunya</h1>
            <p class="text-cyan-300 text-sm tracking-widest">SYSTEM ACCESS</p>
        </div>

        {{-- Card Login Glass --}}
        <div class="glass rounded-2xl p-8 neon-border">
            
            {{-- Error --}}
            @if($errors->any())
                <div class="bg-red-500/20 border-red-500/50 text-red-300 p-3 rounded-lg mb-4 text-sm">
                    {{ $errors->first() }}
                </div>
            @endif

            <h2 class="text-2xl font-bold text-white text-center mb-6">LOGIN</h2>

            <form method="POST" action="{{ route('login.post') }}">
                @csrf
                
                {{-- Email --}}
                <div class="mb-5">
                    <label class="block text-cyan-300 text-sm font-semibold mb-2 uppercase tracking-wide">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus
                           class="w-full bg-gray-900/50 border-2 border-cyan-500/30 rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:border-cyan-400 focus:outline-none transition"
                           placeholder="enter@email.com">
                </div>

                {{-- Password --}}
                <div class="mb-6">
                    <label class="block text-cyan-300 text-sm font-semibold mb-2 uppercase tracking-wide">Password</label>
                    <input type="password" name="password" required
                           class="w-full bg-gray-900/50 border-2 border-cyan-500/30 rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:border-cyan-400 focus:outline-none transition"
                           placeholder="••••">
                </div>

                {{-- Button --}}
                <button type="submit" 
                        class="w-full glow-button bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-400 hover:to-blue-500 text-white font-bold py-3 rounded-lg uppercase tracking-wider transition transform hover:scale-105">
                    Masuk Sistem
                </button>
            </form>

            {{-- Register Link --}}
            <p class="text-center text-gray-400 text-sm mt-6">
                Belum punya akses? 
                <a href="{{ route('daftar') }}" class="text-cyan-400 hover:text-cyan-300 font-bold underline">Daftar Sekarang</a>
            </p>
        </div>

        {{-- Footer --}}
        <p class="text-center text-gray-600 text-xs mt-6">
            © 2026 ZAIpunya | Powered by Alvin Zai
        </p>
    </div>

</body>
</html>