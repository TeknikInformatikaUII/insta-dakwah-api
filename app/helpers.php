<?php

if (! function_exists('bcrypt')) {
    /**
     * Hash the given value.
     *
     * @param  string  $value
     * @param  array   $options
     * @return string
     */
    function bcrypt($value, $options = [])
    {
        return app('hash')->make($value, $options);
    }
}

if (! function_exists('rest')) {
    /**
     * Lumen RESTful route.
     *
     * @param  string  $path
     * @param  string  $controller
     * @param  string  $binding
     * @param  string  $namespace
     * @return void
     */
    function rest($path, $controller, $binding = 'id', $namespace = '')
    {
        global $app;

        $app->get($path, $namespace.'\\'.$controller.'@all');
        $app->get($path.'/{'.$binding.'}', $namespace.'\\'.$controller.'@get');
        $app->post($path, $namespace.'\\'.$controller.'@store');
        $app->put($path.'/{'.$binding.'}', $namespace.'\\'.$controller.'@update');
        $app->delete($path.'/{'.$binding.'}', $namespace.'\\'.$controller.'@destroy');
    }
}
