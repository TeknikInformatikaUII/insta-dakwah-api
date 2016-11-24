<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\User;

class UserFollowerController extends Controller
{
    use ApiResponse;

    public function all(Request $request)
    {
        $user = $request->user();

        return $this->response(Response::HTTP_OK, $user->followers);
    }
}
