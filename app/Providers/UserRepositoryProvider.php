<?php

namespace App\Providers;

use App\Repository\Impl\UserRepositoryImpl;
use App\Repository\UserRepository;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class UserRepositoryProvider extends ServiceProvider implements DeferrableProvider
{
  public array $singletons = [
    UserRepository::class => UserRepositoryImpl::class
  ];

  public function provides()
  {
    return [UserRepository::class];
  }
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
