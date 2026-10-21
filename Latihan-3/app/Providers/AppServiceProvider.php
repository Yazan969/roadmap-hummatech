<?php

namespace App\Providers;

use App\Interfaces\SiswaRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use App\Repositories\SiswaRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            SiswaRepositoryInterface::class,
            SiswaRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
