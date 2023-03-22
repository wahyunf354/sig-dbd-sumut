<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session as FacadesSession;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('admin.pages.auth.login');
    }

    public function showRegister()
    {
        return view('admin.pages.auth.register');
    }

    public function doRegister(Request $request)
    {
        // do validated
        Validator::make($request->all(), [
            'name' => ['required'],
            'username' => ['required', 'unique:users'],
            'email' => ['required', 'unique:users', 'email:rfc,dns'],
            'password' => ['required', 'min:6'],
            'confim-password' => ['required', 'same:password'],
        ])->validate();

        // Save data to database
        $newUser = new User;

        $newUser->name = $request->name;
        $newUser->username = $request->username;
        $newUser->email = $request->email;
        $newUser->password = Hash::make($request->password);
        $newUser->role = 1;

        $newUser->save();

        return redirect()->route('admin.login');
    }

    public function doLogin(Request $request)
    {
        // Melakukan validasi
        Validator::make($request->all(), [
            'email' => ['required', 'email:rfc,dns'],
            'password' => ['required'],
        ])->validate();
        // Melakukan login
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->route('admin.dashboard')->withSuccess('Logged-in');
        }
        return redirect()->route('admin.login')->withSuccess('Credentials are wrong.');
    }

    public function logout()
    {
        FacadesSession::flush();
        Auth::logout();
        return redirect()->route('admin.login');
    }
}
