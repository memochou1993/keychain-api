<?php

namespace App\Http\Controllers\Api;

use GuzzleHttp\Client;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use GuzzleHttp\Exception\ClientException;
use App\Http\Requests\AuthRequest as Request;

class AuthController extends Controller
{
    /**
     * @var \App\Http\Requests\AuthRequest
     */
    protected $request;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function register()
    {
        try {
            $client = new Client([
                'base_uri' => config('app.url'),
            ]);

            $response = $client->post('/api/users', [
                'headers' => [
                    'Accept' => 'application/json',
                ],
                'form_params' => $this->request->all(),
            ]);

            return response($response->getBody(), 200);
        } catch (ClientException $e) {
            return $e->getResponse();
        }
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        try {
            $client = new Client([
                'base_uri' => config('app.url'),
            ]);

            $response = $client->post('/oauth/token', [
                'headers' => [
                    'Accept' => 'application/json',
                ],
                'form_params' => $this->request->all(),
            ]);

            return response($response->getBody(), 200);
        } catch (ClientException $e) {
            return $e->getResponse();
        }
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        $this->auth('api')->user()->token()->revoke();

        return response(null, 204);
    }

    /**
     * @return \App\User
     */
    public function user()
    {
        $user = $this->auth('api')->user();

        return new UserResource($user);
    }

    /**
     * @return \App\User
     */
    public function resetPassword()
    {
        $user = $this->auth('api')->user();

        if (!Hash::check($this->request->old_password, $user->password)) {
            abort(401);
        }

        try {
            $client = new Client([
                'base_uri' => config('app.url'),
            ]);

            $response = $client->patch('/api/users/'.$user->id, [
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => $this->request->header('Authorization'),
                ],
                'form_params' => [
                    'name' => $this->request->name,
                    'username' => $this->request->username,
                    'password' => $this->request->new_password,
                ],
            ]);

            return response($response->getBody(), 200);
        } catch (ClientException $e) {
            return $e->getResponse();
        }
    }
}
