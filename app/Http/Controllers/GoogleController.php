<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Session;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function redirectToRegister()
    {
        return view('register');
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
            return redirect('/register')->with('error', 'Email is not recognized.');
        }

        if (empty($user->name) && empty($user->username)) {
            Session::put('email', $user->email);
            return redirect()->route('register.librarian');

        }else{
            return response()->json(['error' => 'User is already registered'], 409);
        }


    }

    public function logoutGoogle(){
        Auth::logout();
        return redirect('/login');
    }
}
