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
}
