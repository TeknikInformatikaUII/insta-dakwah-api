<?php

namespace App\Services\Implementations;

use Bouncer;
use App\Services\UserService;
use App\User;

class UserServiceImplementation extends BaseService implements UserService
{
    /**
     * Attach ability to the appropriate user.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function attachAbility(User $user)
    {
        // Attach ability to the Administrator role.
        Bouncer::allow('Administrator')->toManage($user);

        // Attach ability to the user.
        Bouncer::allow($user)->toManage($user);
    }
}
