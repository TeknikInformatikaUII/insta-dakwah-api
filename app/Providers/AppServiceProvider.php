<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Silber\Bouncer\Bouncer;
use Symfony\Component\Finder\Finder;
use App\{Ability, Role, User};
use App\Observers\UserObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerRoles();
        $this->registerEloquentObservers();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Register observers with the Models.
     *
     * @return void
     */
    protected function registerEloquentObservers()
    {
        User::observe(UserObserver::class);
    }

    /**
     * Register the application's roles and permissions.
     *
     * @return void
     */
    protected function registerRoles()
    {
        if (! is_dir($path = resource_path('roles'))) {
            return;
        }

        Bouncer::useAbilityModel(Ability::class);
        Bouncer::useRoleModel(Role::class);

        $files = Finder::create()
            ->in($path)
            ->name('*.php')
            ->notName('defaults.php');

        $bouncer = app(Bouncer::class);
        $bouncer->seeder(function () use ($bouncer, $files) {
            collect($files)->each(function ($file) use ($bouncer) {
                $role = require $file->getRealPath();
                $name = $role['name'];
                $permissions = $role['permissions'];

                $bouncer->allow("$name")->to($permissions);
            });
        });
    }
}
