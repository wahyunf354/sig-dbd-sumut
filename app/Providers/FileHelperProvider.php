<?php

namespace App\Providers;

use App\Helper\FileHelper;
use App\Helper\Impl\FileHelperImpl;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class FileHelperProvider extends ServiceProvider implements DeferrableProvider
{
    public array $singletons = [
        FileHelper::class => FileHelperImpl::class
    ];

    public function provides()
    {
    return [FileHelper::class];
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
