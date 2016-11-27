<?php

namespace App\Services;

use App\User;

interface UserService
{
    /**
     * Attach ability to the appropriate user.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function attachAbility(User $user);
}
