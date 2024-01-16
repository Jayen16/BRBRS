<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
 
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::DASHBOARD;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function username(){

        return 'username';
    }


    
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');
    
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
    
            if ($user->email_verified_at !== null) {
    
                $token = $user->createToken('authToken')->plainTextToken;
                
                return response()->json([
                    'message' => 'Login successful',
                    'dashboard_url' => '/dashboard',
                    'user' => $user,
                    'bearer_token' => $token  
                ], 200);
    
            } else {
                // pag email not verified
                return response()->json([
                    'message' => 'Email not yet verified',
                    'dashboard_url' => '/login',
                ], 401);
            }
        }
    
        // Unsuccessful login attempts
        return response()->json([
            'message' => 'Invalid credentials',
            'dashboard_url' => '/login',
        ], 401);
    }


    // public function logout(Request $request)
    // {
    //     $this->guard()->logout();
    
    //     $request->session()->invalidate();
    
    //     $request->session()->regenerateToken();
    
    //     if ($request->expectsJson() || $request->ajax()) {
    //         return response()->json(['message' => 'Logout successful'], 204);
    //     }
    
    //     return redirect('/');
    // }
    

    // public function logout(Request $request)
    // {
    
    //     if (Auth::check()) {
    
    //             Auth::guard('web')->logout();
    //             return redirect()->route('login');
            
    //     } else {
    //         return redirect()->route('login');
 
    //     }
    // }


  
    
    public function logout(Request $request)
        {
            if (Auth::check()) {
                $user = Auth::user();

                // Revoke all tokens associated with the user
                $user->tokens->each(function ($token, $key) {
                    $token->delete();
                });

                if ($request->expectsJson()) {
                    return response()->json(['message' => 'Logout successful']);
                }
                Auth::guard('web')->logout();
                return redirect()->route('login');
                
            } else {
                return response()->json(['message' => 'Unauthenticated.'], 401);
            }
        }
    

}
        
// }

