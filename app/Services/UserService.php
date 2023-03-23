<?php

namespace App\Services;

use Illuminate\Http\Request;

interface UserService
{
  function login(string $user, string $password): bool;
  function register(Request $request): bool;
  function logout():bool;
}
