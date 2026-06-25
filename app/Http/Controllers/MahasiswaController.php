<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\MahasiswaExport;

class MahasiswaController extends Controller
{
    public function index(Request $request)
{
    $search = $request->input('search');
    $jurusan = $request->input('jurusan');

$sort = $request->input('sort'); // <-- TAMBAH INI

$mahasiswas = Mahasiswa::query()
    ->when($search, function ($query, $search) {
        return $query->where(function($q) use ($search){
            $q->where('nim', 'like', "%{$search}%")
              ->orWhere('nama', 'like', "%{$search}%");
        });
    })
    ->when($jurusan, function ($query, $jurusan) {
        return $query->where('jurusan', $jurusan);
    })
    ->when($sort, function ($query, $sort) { // <-- TAMBAH BLOCK INI
        if($sort == 'nama_asc') {
            return $query->orderBy('nama', 'asc'); // Pengurutan Gelembung = Bubble Sort
        }
        if($sort == 'nim_desc') {
            return $query->orderBy('nim', 'desc'); // Pencarian Linier = default/acak
        }
    })
    ->paginate(10);

    $listJurusan = Mahasiswa::select('jurusan')->distinct()->pluck('jurusan');

    return view('mahasiswa.index', compact('mahasiswas', 'listJurusan', 'search', 'jurusan'));
}

    public function create()
    {
    $listJurusan = ['Teknik Informatika', 'Sistem Informasi', 'Teknik Industri', 'Manajemen'];
    return view('mahasiswa.create', compact('listJurusan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required|numeric|digits:12|unique:mahasiswas,nim',
            'nama' => 'required|string|min:3|max:100',
            'jurusan' => 'required|string|max:50'
        ], [
            'nim.required' => 'NIM wajib diisi bro',
            'nim.numeric' => 'NIM harus angka semua',
            'nim.digits' => 'NIM harus 12 digit',
            'nim.unique' => 'NIM ini udah ada yg pake',
            'nama.required' => 'Nama jangan kosong',
            'nama.min' => 'Nama minimal 3 huruf',
            'jurusan.required' => 'Jurusan wajib pilih'
        ]);

 
        Mahasiswa::create($request->all());
        return redirect()->route('mahasiswa.index')->with('success', 'Data berhasil ditambah! ✅');
    }

    public function exportExcel()
    {
    return Excel::download(new MahasiswaExport, 'data-mahasiswa-'.date('Y-m-d').'.xlsx');
    }
    
    public function edit(Mahasiswa $mahasiswa)
    {
    $listJurusan = ['Teknik Informatika', 'Sistem Informasi', 'Teknik Industri', 'Manajemen'];
    return view('mahasiswa.edit', compact('mahasiswa', 'listJurusan'));
    }

    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $request->validate([
            'nim' => 'required|numeric|digits:12|unique:mahasiswas,nim,'.$mahasiswa->id,
            'nama' => 'required|string|min:3|max:100',
            'jurusan' => 'required|string|max:50'
        ], [
            'nim.required' => 'NIM wajib diisi bro',
            'nim.numeric' => 'NIM harus angka semua',
            'nim.digits' => 'NIM harus 12 digit',
            'nim.unique' => 'NIM ini udah ada yg pake',
            'nama.required' => 'Nama jangan kosong',
            'nama.min' => 'Nama minimal 3 huruf',
            'jurusan.required' => 'Jurusan wajib pilih'
        ]);

        $mahasiswa->update($request->all());
        return redirect()->route('mahasiswa.index')->with('success', 'Data berhasil diupdate! ✅');
    }

    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();
        return redirect()->route('mahasiswa.index')->with('success', 'Data berhasil dihapus! 🗑️');
    }
}