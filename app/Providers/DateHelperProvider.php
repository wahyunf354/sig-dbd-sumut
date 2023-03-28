<?php

namespace App\Providers;

use App\Helper\DateHelper;
use App\Helper\Impl\DateHelperImpl;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class DateHelperProvider extends ServiceProvider implements DeferrableProvider
{
  public array $singletons = [
    DateHelper::class => DateHelperImpl::class
  ];

  public function provides()
  {
    return [DateHelper::class];
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
