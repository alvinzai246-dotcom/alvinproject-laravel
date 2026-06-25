<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail; // 1. tambah ini
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail // 2. tambah implements ini
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'nim', 
        'name', 
        'jurusan', 
        'no_hp', 
        'email', 
        'password',
    ];

    protected $hidden = [
        'password', 
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}