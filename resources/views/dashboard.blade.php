@extends('layouts.app')

@section('content')
<div>
    {{-- Header --}}
    <div class="mb-8">
        <p class="text-cyan-400 text-sm uppercase tracking-widest">DASHBOARD OVERVIEW</p>
        <h1 class="text-3xl font-bold text-white mt-1">Halo, {{ Auth::user()->name }} 👋</h1>
        <p class="text-gray-400 mt-2">Berikut ringkasan data akademik terpusat hari ini.</p>
    </div>

    {{-- Cards Statistik --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        
        {{-- Total Mahasiswa --}}
        <div class="glass rounded-2xl p-6 border-cyan-500/20 hover:border-cyan-400/40 transition">
            <div class="flex items-center justify-between mb-4">
                <p class="text-gray-400 text-sm uppercase">Total Mahasiswa</p>
                <div class="w-12 h-12 bg-gradient-to-br from-cyan-500 to-blue-600 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3A1 1 0 000 6v2a1 1 0 001 1h1v7a2 2 0 002 2h12a2 2 0 002-2V9h1a1 1 0 001-1V6a1 1 0 00-.606-.92l-7-3z"/>
                    </svg>
                </div>
            </div>
            <p class="text-4xl font-black text-white">{{ $totalMahasiswa ?? 12 }}</p>
        </div>

        {{-- Total Jurusan --}}
        <div class="glass rounded-2xl p-6 border-green-500/20 hover:border-green-400/40 transition">
            <div class="flex items-center justify-between mb-4">
                <p class="text-gray-400 text-sm uppercase">Total Jurusan</p>
                <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M4 3a2 2 0 100 4h12a2 2 0 100-4H4z"/>
                        <path fill-rule="evenodd" d="M3 8h14v7a2 2 0 01-2 2H5a2 2 0 01-2-2V8z" clip-rule="evenodd"/>
                    </svg>
                </div>
            </div>
            <p class="text-4xl font-black text-white">{{ $totalJurusan ?? 3 }}</p>
        </div>

        {{-- Total Dosen --}}
        <div class="glass rounded-2xl p-6 border-purple-500/20 hover:border-purple-400/40 transition">
            <div class="flex items-center justify-between mb-4">
                <p class="text-gray-400 text-sm uppercase">Total Dosen</p>
                <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-600 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0110 12a5 5 0 01-1.5-.33A6.97 6.97 0 007 16c0 .34.024.673.07 1h5.86z"/>
                    </svg>
                </div>
            </div>
            <p class="text-4xl font-black text-white">{{ $totalDosen ?? 0 }}</p>
        </div>
    </div>

    {{-- Tabel Mahasiswa Terbaru --}}
    <div class="glass rounded-2xl p-6 border-cyan-500/20">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h2 class="text-xl font-bold text-white">Mahasiswa Terbaru</h2>
                <p class="text-gray-400 text-sm">Baru ditambahkan ke sistem basis data</p>
            </div>
            <a href="{{ route('mahasiswa.index') }}" class="text-cyan-400 text-sm hover:text-cyan-300">5 Data Lihat →</a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-700">
                        <th class="text-left py-3 px-4 text-gray-400 text-sm uppercase">Mahasiswa</th>
                        <th class="text-left py-3 px-4 text-gray-400 text-sm uppercase">NIM</th>
                        <th class="text-left py-3 px-4 text-gray-400 text-sm uppercase">Jurusan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($mahasiswaTerbaru ?? [] as $m)
                    <tr class="border-b border-gray-800 hover:bg-gray-800/30 transition">
                        <td class="py-4 px-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 bg-gradient-to-br from-cyan-500 to-blue-600 rounded-full flex items-center justify-center text-white text-xs font-bold">
                                    {{ strtoupper(substr($m->name, 0, 1)) }}
                                </div>
                                <span class="text-white">{{ $m->name }}</span>
                            </div>
                        </td>
                        <td class="py-4 px-4 text-gray-300">{{ $m->nim }}</td>
                        <td class="py-4 px-4">
                            <span class="px-3 py-1 bg-gray-800 rounded-full text-gray-300 text-xs">{{ $m->jurusan }}</span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="py-8 text-center text-gray-500">Belum ada data mahasiswa</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection