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
        $email = $request->input('email') ?? Session::get('email');

        $existingUser = User::where('email', $email)->first();
    
        $user = $existingUser;
    
        $validator = Validator::make($request->all(), [
            'email' => 'email',
            'name' => 'required|min:2|max:100',
            'password' => 'required|min:6|max:100',
            'password_confirmation' => 'required|same:password',
            'username' => 'required|unique:users,username',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error', 
                'code' => 400, 
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 400);
        }
        
        $user->name = $request->input('name');
        $user->password = Hash::make($request->input('password'));
        $user->email = $email;
        $user->username = $request->input('username');
    
        $user->save();
    
        Auth::login($user);
    
     
        return response()->json([
            'status' => 'success', 
            'code' => 200,
            'message' => 'User Registered Successfully',
            'user' => [
                'name' => $user->name,
                'username' => $user->username,
                'email' => $user->email,
            ],
        ]);
    }
    



    // public function login(Request $request)
    // {

    //    $validator = Validator::make($request->all(), [
    //         'username' => 'required|username',
    //         'password' => 'required',
    //     ]);
    
    //     if ($validator->fails()) {
    //         return response()->json([
    //             'message' => 'Validation fails',
    //             'errors' => $validator->errors(),
    //         ], 422);
    //     }
    
    //     $user = User::where('username', $request->username)->first();
    
    //     if ($user && Hash::check($request->password, $user->password)) {
    //         $token = $user->createToken('auth-token')->plainTextToken;
    //         session(['user_id' => $user->id]);

    //         return response()->json([
    //             'status' => 'success', 
    //             'code' => 200, 
    //             'message' => 'Login successful',
    //             'token' => $token,
    //             'data' => [
    //                 'name' => $user->name,
    //                 'username' => $user->username,
    //                 'email' => $user->email,
    //                 'email_verified' => !is_null($user->email_verified_at),
    //             ],
    //         ], 200);
            
    //     }
    //     return response()->json([
    //         'status' => 'error', 
    //         'code' => 400, 
    //         'message' => 'Incorrect credentials',
    //     ], 400);
        
    // }


    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');
    
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
    
            if ($user->email_verified_at !== null) {
                session(['user_id' => $user->id]);
                $token = $user->createToken('authToken')->plainTextToken;
    
                return response()->json([
                    'status' => 'success',
                    'code' => 200,
                    'message' => 'Login successful',
                    'token' => $token,
                    'data' => [
                        'name' => $user->name,
                        'username' => $user->username,
                        'email' => $user->email,
                        'email_verified' => !is_null($user->email_verified_at),
                    ],
                ], 200);
            } else {
                Auth::logout();

                // Email not verified
                return response()->json([
                    'status' => 'error',
                    'code' => 401,
                    'message' => 'Email not yet verified',
                ], 401);
            }
        }else{
            return response()->json([
                'status' => 'error',
                'code' => 401,
                'message' => 'Invalid credentials',
                'dashboard_url' => '/login',
            ], 401);
        }
    

    }
    
    

    public function user(Request $request)
    {
        $user = $request->user();
    
        if ($user) {
            $user->makeHidden(['created_at', 'updated_at']);
    
            $user->email_verified = !is_null($user->email_verified_at);

            unset($user->email_verified_at);

            return response()->json([
                'status' => 'success',
                'code' => 200,
                'message' => 'User successfully fetched',
                'data' => $user,
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'code' => 404,
                'error' => 'User not found',
            ], 404);
        }
    }
    


    public function logout(Request $request)
    {
        if ($request->user()) {
            $request->user()->currentAccessToken()->delete();
            session()->flush();
            session()->regenerate();
        
            return response()->json([
                'status' => 'success',
                'code' => 200,
                'message' => 'User successfully logged out',
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'code' => 401,
                'error' => 'User not authenticated',
            ], 401);
        }
        
    }
    
}
