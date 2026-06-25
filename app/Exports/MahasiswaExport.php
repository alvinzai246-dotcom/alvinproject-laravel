<?php

namespace App\Exports;

use App\Models\Mahasiswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MahasiswaExport implements FromCollection, WithHeadings
{
   public function collection()
    {
    return Mahasiswa::select('nim', 'nama', 'jurusan')->get();
    }

public function headings(): array
    {
    return ['NIM', 'Nama', 'Jurusan'];
    }
}