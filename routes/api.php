<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "auth" middleware group. Enjoy building your API!
|
*/

$app->get('/user', function (Request $request) use ($app) {
    return response()->json($request->user());
});

$app->get('/users/user-followers', 'Api\UserFollowerController@all');
$app->get('/users/user-following', 'Api\UserFollowingController@all');
$app->post('/users/{user}/update-photo', 'Api\UserController@updatePhoto');
rest('/users', 'UserController', 'user', 'Api');
