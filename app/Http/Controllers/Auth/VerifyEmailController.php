<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerifyEmailController extends Controller
{
    public function __invoke(Request $request)
    {
        $user = $request->user();

        if ($user->hasVerifiedEmail()) {
            return redirect('/dashboard');
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
            
            Auth::login($user); // auto login
        }

        return redirect('/dashboard'); // langsung dashboard
    }
}