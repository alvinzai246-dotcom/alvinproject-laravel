<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegister() { 
        return view('auth.daftar'); 
    }
    
    public function register(Request $request) {
        $request->validate([
            'nim' => 'required|unique:users,nim|max:20',
            'name' => 'required|max:255',
            'jurusan' => 'required|max:100',
            'no_hp' => 'required|max:15',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);
        
        $user = User::create([ // 1. simpan ke variable $user
            'nim' => $request->nim,
            'name' => $request->name,
            'jurusan' => $request->jurusan,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        
        $user->sendEmailVerificationNotification(); // 2. kirim email verifikasi
        
        return redirect('/login')->with('success', 'Daftar berhasil! Cek email lu buat verifikasi dulu bro');
    }
    
    public function showLogin() { 
        return view('auth.login'); 
    }
    
    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email', 
            'password' => 'required'
        ]);
        
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            
            // 3. cek udah verifikasi email belum
            if (!$user->hasVerifiedEmail()) {
                Auth::logout();
                return back()->with('error', 'Verifikasi email dulu bro sebelum login')->onlyInput('email');
            }
            
            $request->session()->regenerate();
            return redirect('/dashboard');
        }
        
        return back()->with('error', 'Email atau password salah')->onlyInput('email');
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}