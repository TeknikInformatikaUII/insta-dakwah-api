<?php

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

$app->get('/', function () use ($app) {
    return $app->version();
});

$app->get('/users', function () use ($app) {
    return response()->json(\App\User::all());
});
