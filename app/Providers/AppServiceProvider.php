<?php

namespace App\Providers;

use App\Http\Controllers\FindUserByEmailController;
use App\Services\EloquentFindUserByEmailService;
use App\Services\FindUserByEmailService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->when(FindUserByEmailController::class)
            ->needs(FindUserByEmailService::class)
            ->give(function () {
                return $this->app->make(EloquentFindUserByEmailService::class);
            });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        //
    }
}
