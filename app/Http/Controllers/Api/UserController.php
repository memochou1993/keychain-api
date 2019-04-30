<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest as Request;
use App\Contracts\UserInterface as Repository;
use App\Http\Resources\UserResource as Resource;

class UserController extends Controller
{
    /**
     * @var \App\User
     */
    protected $user;

    /**
     * @var \App\Http\Requests\UserRequest
     */
    protected $request;

    /**
     * @var \App\Contracts\UserInterface
     */
    protected $reposotory;

    /**
     * Create a new controller instance.
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\Contracts\UserInterface  $reposotory
     * @return void
     */
    public function __construct(Request $request, Repository $reposotory)
    {
        $this->user = config('api.debug.enabled')
            ? Passport::actingAs(User::find(config('api.debug.user.id')))
            : $this->auth('api')->user(); 

        $this->request = $request;

        $this->reposotory = $reposotory;

        $this->authorizeResource(User::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \App\Http\Resources\UserResource
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \App\Http\Resources\UserResource
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \App\Http\Resources\UserResource
     */
    public function show(User $user)
    {
        $user = $this->reposotory->getUser($user->id);

        return new Resource($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\User  $user
     * @return \App\Http\Resources\UserResource
     */
    public function update(User $user)
    {
        $user = $this->reposotory->updateUser($user->id);

        return new Resource($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
