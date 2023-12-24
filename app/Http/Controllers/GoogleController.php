<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function redirectToRegister()
    {
        return view('selfregistration');
    }

    public function handleGoogleCallback(Request $request)
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to authenticate with Google'], 500);
        }

        $user = User::where('email', $googleUser->email)->first();

        if (!$user) {
            return redirect('/register')->with('error', 'Email is not recognized.');;
        }
     
        // if (auth()->check() && !$user->email) {
        //     return response('Forbidden - Access Denied', 403);
        // }

        if (auth()->check() && !$user->email) {
            return response()->json(['message' => 'Access Denied'], 403);
        }
        

        // Authenticate the user if not authenticated
        if (!auth()->check()) {
            auth()->login($user);
        }

        return redirect()->route('register.librarian');
    }

    public function logoutGoogle(){
        Auth::logout();
        return redirect('/login');
    }
}
