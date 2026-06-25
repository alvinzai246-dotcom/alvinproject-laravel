<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa; // Ganti dari User ke Mahasiswa

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Total Mahasiswa
        $totalMahasiswa = Mahasiswa::count();
        
        // 2. Total Jurusan unik
        $totalJurusan = Mahasiswa::distinct('jurusan')->count('jurusan');
        
        // 3. Total Dosen - lu belum ada tabel dosen, jadi 0 dulu
        $totalDosen = 0;
        
        // 4. Ambil 5 mahasiswa terbaru buat tabel bawah
        $mahasiswaTerbaru = Mahasiswa::latest()->take(5)->get();

        return view('dashboard', compact(
            'totalMahasiswa', 
            'totalJurusan', 
            'totalDosen', 
            'mahasiswaTerbaru'
        ));
    }
}