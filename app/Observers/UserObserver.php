<?php

namespace App\Observers;

use App\User;
use App\UserStatus;
use App\Services\UserService;

class UserObserver
{
    /**
     * @var \App\Services\UserService
     */
    protected $userService;

    /**
     * Constructor.
     *
     * @param  \App\Services\UserService  $userService
     * @return void
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

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
        $this->userService->attachAbility($user);
    }
}
