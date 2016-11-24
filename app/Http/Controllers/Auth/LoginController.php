<?php

namespace App\Http\Controllers\Auth;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);

        $credentials = [
            'username' => $request->username,
            'password' => $request->password,
        ];

        return $this->access('password', $credentials);
    }

    /**
     * Handle a refresh token request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function refreshToken(Request $request)
    {
        $crypt = app()->make('encrypter');
        $request = app()->make('request');

        return $this->access('refresh_token', [
            'refresh_token' => $crypt->decrypt($request->cookie('refresh_token'))
        ]);
    }

    /**
     * Send request to the laravel passport.
     *
     * @param  string  $grantType
     * @param  array  $data
     * @return \Illuminate\Http\Response
     */
    private function access($grantType, array $data = [])
    {
        try {
            $config = app()->make('config');

            $data = array_merge([
                'client_id'     => $config->get('secrets.client_id'),
                'client_secret' => $config->get('secrets.client_secret'),
                'grant_type'    => $grantType
            ], $data);

            $http = new Client();

            $guzzleResponse = $http->post($config->get('app.url').'/oauth/token', [
                'form_params' => $data
            ]);
        } catch(\GuzzleHttp\Exception\BadResponseException $e) {
            $guzzleResponse = $e->getResponse();
        }

        $response = json_decode($guzzleResponse->getBody());

        if (property_exists($response, "access_token")) {
            $cookie = app()->make('cookie');
            $crypt  = app()->make('encrypter');

            $encryptedToken = $crypt->encrypt($response->refresh_token);

            // Set the refresh token as an encrypted HttpOnly cookie
            $cookie->queue('refresh_token',
                $encryptedToken,
                604800, // expiration, should be moved to a config file
                null,
                null,
                false,
                true // HttpOnly
            );

            $response = [
                'token_type'    => $response->token_type,
                'expires_in'    => $response->expires_in,
                'access_token'   => $response->access_token,
            ];
        }

        $response = response()->json($response);
        $response->setStatusCode($guzzleResponse->getStatusCode());

        $headers = $guzzleResponse->getHeaders();
        foreach($headers as $headerType => $headerValue) {
            $response->header($headerType, $headerValue);
        }

        return $response;
    }

}
