<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Mockery\MockInterface;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
  use DatabaseTransactions;
  private User $user;


  protected function setUp(): void
  {
//    $this->mock(Auth::class, function (MockInterface $mock) {
//      $mock->shouldReceive('attempt')->andReturn(true);
//    });

  }

  public function testLoginSuccess()
  {

    self::markTestIncomplete();

//    $this->user = User::factory()->create([
//      'email' => 'test1@test.com',
//      'username' => "test1",
//      'password' => bcrypt('password'),
//    ]);
//
//
//    $this->post(route('admin.post.login'),[
//      "email" => "test1@test.com",
//      "password" => "password"
//    ])->assertRedirect(route('admin.dashboard'));
//
//    $this->assertEquals($this->user->id, Auth::id());
  }

}
