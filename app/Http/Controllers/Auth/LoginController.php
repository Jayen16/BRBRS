<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
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

    // public function login(Request $request)
    // {
    //     $this->validateLogin($request);

    //     if (Auth::attempt($this->credentials($request))) {

    //         $user = Auth::user(); 

    //             if ($user->email_verified_at !==null) {

    //                 return redirect()->route('dashboard');
    //             } else{
    //                 return redirect()->route('login');
    //             }
    //     }

    //     // Handle unsuccessful login attempts
    //     return $this->sendFailedLoginResponse($request);
    // }

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
                    'token' => $token 
                ], 200);
                
            } else {

                // pag email not verified
                return response()->json([
                    'message' => 'Email not yet verified',
                    'dashboard_url' => '/login',
                ], 401);
            }
        }
    
         //unsuccessful login attempts to

        return response()->json([
            'message' => 'Invalid credentials',
            'dashboard_url' => '/login',
        ], 401);

    }

    // public function login(Request $request)
    // {

    //     if(Auth::attempt(['username' => $request->username, 'password' => $request->password]))
    //     { 
    //         $user = Auth::user(); 
    //         $success['token'] =  $user->createToken('BRBRS-Token')->plainTextToken; 
    //         $success['name'] =  $user->name;
    //         return $this->sendResponse($success, 'User login successfully.');
    //     } else { 
    //         return $this->sendError('Unauthorised.', ['error'=>'Unauthorized']);
    //     } 


        // $credentials = $request->only('username', 'password');

        // if (Auth::attempt($credentials)) {
        //     $user = Auth::user();

        //     if ($user->email_verified_at !== null) {
        //         $token = $user->createToken('authToken')->plainTextToken;

        //         if ($user->tokens->isEmpty()) {
        //             return response()->json([
        //                 'message' => 'Login successful. Token created.',
        //                 'dashboard_url' => '/dashboard',
        //                 'user' => $user,
        //                 'token' => $token 
        //             ], 200);
        //         } else {
        //             return response()->json([
        //                 'message' => 'Login successful',
        //                 'dashboard_url' => '/dashboard',
        //                 'user' => $user,
        //                 'token' => $token 
        //             ], 200);
        //         }
        //     } else {
        //         // If the email is not verified, return an appropriate response
        //         return response()->json([
        //             'message' => 'Email not yet verified',
        //             'dashboard_url' => '/login',
        //         ], 401);
        //     }
        // }

        // // Unsuccessful login attempts
        // return response()->json([
        //     'message' => 'Invalid credentials',
        //     'dashboard_url' => '/login',
        // ], 401);
    }
        
// }

