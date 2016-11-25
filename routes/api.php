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

$app->put('/user', function (Request $request) use ($app) {
    return response()->json($request->user());
});

$app->get('/user-followers', 'Api\UserFollowerController@all');

rest('/users', 'UserController', 'Api');




/*
 * Lumen RESTful Route.
 *
 */
function rest($path, $controller, $namespace='')
{
    global $app;

    $app->get($path, $namespace.'\\'.$controller.'@all');
    $app->get($path.'/{id}', $namespace.'\\'.$controller.'@get');
    $app->post($path, $namespace.'\\'.$controller.'@store');
    $app->put($path.'/{id}', $namespace.'\\'.$controller.'@update');
    $app->delete($path.'/{id}', $namespace.'\\'.$controller.'@destroy');
}
