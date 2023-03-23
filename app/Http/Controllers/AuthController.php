<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session as FacadesSession;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{

  private UserService $userService;

  /**
   * @param UserService $userService
   */
  public function __construct(UserService $userService)
  {
    $this->userService = $userService;
  }

  public function showLogin()
  {
    return view('admin.pages.auth.login');
  }

  public function showRegister()
  {
    return view('admin.pages.auth.register');
  }

  public function doRegister(Request $request): RedirectResponse|Response
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
    $result = $this->userService->register($request);
    if ($result) {
      return redirect()->route('admin.login');
    } else {
      return redirect()->route('admin.register');
    }
  }

  public function doLogin(Request $request): Response|RedirectResponse
  {
    // Melakukan validasi
    Validator::make($request->all(), [
      'email' => ['required', 'email:rfc,dns'],
      'password' => ['required'],
    ])->validate();

    // Melakukan login
    if ($this->userService->login($request->email, $request->password)) {
      Alert::success('Berhasil', 'Berhasil Login');
      return redirect()->route('admin.dashboard')->withSuccess("Berhasil login");
    }
    return redirect()->route('admin.login')->withSuccess('Credentials are wrong.');
  }

  public function logout(): Response|RedirectResponse
  {
    $isLogout = $this->userService->logout();

    if ($isLogout) {
      return redirect()->route('admin.login');
    } else {
      return redirect()->route('admin.dashboard');
    }
  }
}
