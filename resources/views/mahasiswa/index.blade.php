<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa - Sistem Alvin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    
    {{-- Navbar --}}
    <nav class="bg-gray-800 text-white">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <h1 class="text-xl font-bold">Sistem Mahasiswa Alvin</h1>
            <div class="flex items-center gap-4">
                <span>Halo, {{ auth()->user()->name }}</span>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="bg-red-600 hover:bg-red-700 px-3 py-1 rounded text-sm">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8">
        
        {{-- Notifikasi --}}
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-lg shadow-md p-6">
            
            {{-- Tombol Kembali ke Dashboard --}}
            <a href="{{ route('dashboard') }}" 
               class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-800 mb-4 font-medium transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali ke Dashboard
            </a>
            
            {{-- Header + Tombol --}}
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                <h3 class="text-2xl font-bold text-gray-800">Data Mahasiswa</h3>
                <div class="flex gap-2">
                    <a href="{{ route('mahasiswa.export.excel') }}" 
                       class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm font-medium">
                        Export Excel
                    </a>
                    <a href="{{ route('mahasiswa.create') }}" 
                       class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium">
                        + Tambah Data
                    </a>
                </div>
            </div>

            {{-- Form Search + Filter --}}
            <form method="GET" action="{{ route('mahasiswa.index') }}" class="mb-6">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-3">
                    <input type="text" name="search" value="{{ request('search') }}" 
                           placeholder="Cari NIM/Nama..." 
                           class="border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">

                    <select name="jurusan" class="border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
                        <option value="">Semua Jurusan</option>
                        @foreach($listJurusan ?? [] as $j)
                            <option value="{{ $j }}" {{ request('jurusan') == $j ? 'selected' : '' }}>
                                {{ $j }}
                            </option>
                        @endforeach
                    </select>

                    <select name="sort" class="border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
                        <option value="">Default</option>
                        <option value="nama_asc" {{ request('sort') == 'nama_asc' ? 'selected' : '' }}>
                            Pengurutan Gelembung - Nama A-Z
                        </option>
                        <option value="nim_desc" {{ request('sort') == 'nim_desc' ? 'selected' : '' }}>
                            Pencarian Linier - NIM Desc
                        </option>
                    </select>

                    <button type="submit" class="bg-gray-800 hover:bg-gray-900 text-white px-4 py-2 rounded-lg font-medium">
                        Filter
                    </button>
                </div>
            </form>

            {{-- Tabel --}}
            <div class="overflow-x-auto">
                <table class="min-w-full border-gray-200">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="px-4 py-3 text-left text-sm font-semibold">No</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold">NIM</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold">Nama</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold">Jurusan</th>
                            <th class="px-4 py-3 text-center text-sm font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($mahasiswas as $index => $m)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 text-sm">{{ $mahasiswas->firstItem() + $index }}</td>
                            <td class="px-4 py-3 text-sm font-medium">{{ $m->nim }}</td>
                            <td class="px-4 py-3 text-sm">{{ $m->nama }}</td>
                            <td class="px-4 py-3 text-sm">{{ $m->jurusan }}</td>
                            <td class="px-4 py-3 text-sm text-center">
                                <a href="{{ route('mahasiswa.edit', $m->id) }}" class="text-blue-600 hover:underline mr-3">Edit</a>
                                <form action="{{ route('mahasiswa.destroy', $m->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Yakin hapus?')" class="text-red-600 hover:underline">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-4 py-6 text-center text-gray-500">Data tidak ditemukan</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="mt-6">
                {{ $mahasiswas->appends(request()->query())->links() }}
            </div>

        </div>
    </div>
</body>
</html>