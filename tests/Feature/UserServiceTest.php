<?php

namespace Tests\Feature;

use App\Models\User;
use App\Repository\UserRepository;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserServiceTest extends TestCase
{

  private UserService $userService;
  private UserRepository $userRepository;
  private Auth $auth;

  protected function setUp(): void
  {
    parent::setUp();
    $this->userRepository = $this->createMock(UserRepository::class);
    $this->userService = $this->app->make(UserService::class);
  }

  public function testLoginUserSucess()
  {
    self::markTestIncomplete();
  }

  public function testRegisterSuccess() {
    self::markTestIncomplete();
  }
}
