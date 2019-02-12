<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $auth = Auth::attempt([
            'username' => $request->username, 
            'password' => $request->password]);

        if (! $auth) {
            $user = User::where('username', $request->username)->first();
            
            if ($user === null) {
                $this->register($request);
            } else {
                return redirect()->route('index')->withInput();
            }
        }

        return redirect()->route('index');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('index');
    }

    private function register($request)
    {
        $data = $request->validate([
            'username' => ['required', 'string', 'max:100', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'max:100'],
        ]);

        $user = User::create([
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
        ]);

        Auth::login($user);
    }
}