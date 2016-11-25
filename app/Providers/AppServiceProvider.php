<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\User;
use App\Observers\UserObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerEloquentObservers();
    }

    /**
     * Register observers with the Models.
     */
    protected function registerEloquentObservers()
    {
        User::observe(UserObserver::class);
    }
}
