<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\user_profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    public function login_page()
    {
        // dd(Cookie::get());
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $remember = false;
        $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required',
        ]);

        $credential = [
            'email_address' => $request->email, 
            'password' => $request->password
        ];

        if($request->remember){
            $remember = $request->remember;
        }

        if(Auth::attempt($credential, $remember)) {
            $url = '';
            $request->session()->regenerate();
            $user_id = Auth::user()->user_id;
            $user = User::with('user_profile')->find($user_id);

            if(user_profile::where('user_id', $user_id)->exists()){
                $url = $user->user_profile->image_url;
            }

            session(['image_url' => $url]);

            return redirect()->intended(route('home'));
        }   

        $err = [
            'email' => 'The provided credentials do not match our records.'
        ];

        return back()->withErrors($err)->onlyInput('email');
    }

    public function register_page()
    {
        return view('auth.register');
    }

    public function register(StoreUserRequest $request)
    {
        $data = [
            "username" => $request->username,
            "email_address" => $request->email,
            "password" => Hash::make($request->password),
            "is_admin" => 0
        ];
        User::create($data);

        return redirect()->route('home');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        session_unset();

        return redirect()->route('login_page');
    }
}
