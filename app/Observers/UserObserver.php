<?php

namespace App\Observers;

use App\User;
use App\UserStatus;

class UserObserver
{
    /**
     * Listen to the User creating event.
     *
     * @param  User $user
     * @return void
     */
    public function creating(User $user)
    {
        $user->user_status_id = UserStatus::ACTIVE;
    }

    /**
     * Listen to the User created event.
     *
     * @param  User $user
     * @return void
     */
    public function created(User $user)
    {
        $permissions = require resource_path('roles/defaults.php');

        $user->allow($permissions[get_class($user)]);
    }
}
