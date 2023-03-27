<?php

namespace App\Services\Impl;

use App\Models\User;
use App\Repository\UserRepository;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session as FacadesSession;

class UserServiceImpl implements UserService
{
  function login(string $user, string $password): bool
  {
    $credentials = ["email" => $user, "password" => $password];
    if (Auth::attempt($credentials)) {
      return true;
    } else {
      return false;
    }
  }

  function logout(): bool
  {
    FacadesSession::flush();
    Auth::logout();
    if(Auth::check()){
      return false;
    } else {
      return true;
    }
  }

  function register(Request $request): bool
  {
    $newUser = new User;

    $newUser->name = $request->name;
    $newUser->username = $request->username;
    $newUser->email = $request->email;
    $newUser->password = Hash::make($request->password);
    $newUser->role = 1;

    $result = $newUser->save();

    if($result) {
      return false;
    } else {
      return true;
    }
  }
}
