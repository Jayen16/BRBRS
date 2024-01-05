<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::VERIFYEMAIL;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    // protected function validator(array $data)
    // {
    //     return Validator::make($data, [
    //         'name' => ['required', 'string', 'max:255'],
    //         'username' => ['required', 'string', 'max:255'],
    //         'password' => ['required', 'string', 'min:8', 'confirmed'],
    //     ]);
    // }


    // protected function create(array $data)
    // {
    //     $emailFromSession  = session('email');

    //     $user = User::where('email', $emailFromSession )->first();

    //     if ($user) {
    //         $user->name = $data['name'];
    //         $user->username = $data['username'];
    //         $user->password = Hash::make($data['password']);
    //         $user->save();
    //     }
    
    //     return $user;
    // }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
    
        $email = $request->input('email'); // Change 'email' to the field name for the user identifier
    
        $user = User::where('email', $email)->first();
    
        if ($user) {
            $user->name = $request->input('name');
            $user->username = $request->input('username');
            $user->password = Hash::make($request->input('password'));
            $user->save();
    
            return redirect('/dashboard')->with('success', 'User updated successfully');
        } else {
            // Handle if the user doesn't exist or other error scenarios
            return redirect()->back()->with('error', 'User not found or other error occurred');
        }
    }
    


    
}
