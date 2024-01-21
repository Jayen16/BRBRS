<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{

    public function register(Request $request)
    {
        $email = Session::get('email');
        
        $existingUser = User::where('email', $email)->first();

        $user = $existingUser;
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:2|max:100',
            'password' => 'required|min:6|max:100',
            'password_confirmation' => 'required|same:password',
            'username' => 'required|unique:users,username',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 400);
        }

        if($user){
            $user->name = $request->input('name');
            $user->password = Hash::make($request->input('password'));
            $user->email = $email;
            $user->username = $request->input('username');

            $user->save();

            Auth::login($user);

            return response()->json([
                'message' => 'User Registered Successfully',
                'user' => $user,
            ]);
        }

    }



    public function login(Request $request)
    {

       $validator = Validator::make($request->all(), [
            'username' => 'required|username',
            'password' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation fails',
                'errors' => $validator->errors(),
            ], 422);
        }
    
        $user = User::where('username', $request->username)->first();
    
        if ($user && Hash::check($request->password, $user->password)) {
            $token = $user->createToken('auth-token')->plainTextToken;
            // session()->put('name', $user->name);

    
            return response()->json([
                'message' => 'Login Successful',
                'token' => $token,
                'data' => $user,
            ], 200);
        }
    
        return response()->json([
            'message' => 'Incorrect credentials',
        ], 400);
    }



    public function user(Request $request)
    {     
        return response()->json([
            'message' => 'User successfully fetched',
            'data'=>$request->user()
        ], 200);
    }

    public function logout(Request $request)
    {
      
        $request->user()->currentAccessToken()->delete();

        session()->flush();
        session()->regenerate();
        
        return response()->json([
            'message' => 'User successfully logged out',
        ], 200);
    }
    
}
