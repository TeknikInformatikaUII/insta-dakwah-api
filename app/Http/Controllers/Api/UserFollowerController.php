<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UserFollowerController extends Controller
{
    use ApiResponse;

    /**
     * Display a listing of the user followers.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function all(Request $request)
    {
        $this->authorize('user_followers.view');

        $user = $request->user();

        return $this->ok($user->followers);
    }
}
