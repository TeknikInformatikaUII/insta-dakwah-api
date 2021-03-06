<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get('/', function () use ($app) {
    $contents = [
        'message' => 'You need to contact informatics.uii.club@gmail.com if you wan\'t to use the API',
    ];

    return response()->json($contents);
});


$app->post('/login', 'Auth\LoginController@login');
$app->post('/refresh-token', 'Auth\LoginController@refreshToken');
