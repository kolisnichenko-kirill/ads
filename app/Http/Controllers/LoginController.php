<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserPost;
use App\User;
use Auth;

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
    protected $redirectTo = '/';
    

    public function __construct(UserPost $request)
    {
        if ($request->username !== null) {
            $user = User::where('username', $request->username)->first();
            
            if ($user === null) {
                $data = $request->validated();
        
                $user = User::create([
                    'username' => $data['username'],
                    'password' => Hash::make($data['password']),
                ]);
        
                Auth::login($user);
            }
        }
    }

    public function username()
    {
        return 'username';
    }
}
