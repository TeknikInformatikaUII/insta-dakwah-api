<?php

namespace App\Providers;

use mmghv\LumenRouteBinding\RouteBindingServiceProvider as ServiceProvider;

class RouteBindingServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $binder = $this->binder;

        // Here we define All the route model bindings
        $binder->bind('user', \App\User::class);
    }
}
