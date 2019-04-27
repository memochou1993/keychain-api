<?php

namespace App\Repositories;

use App\User;
use App\Contracts\UserInterface;
use App\Http\Requests\UserRequest as Request;

class UserRepository implements UserInterface
{
    /**
     * @var \App\Http\Requests\UserRequest
     */
    protected $request;

    /**
     * @var \App\User
     */
    protected $user;

    /**
     * @var array
     */
    protected $with;

    /**
     * @var int
     */
    protected $paginate;

    /**
     * Create a new repository instance.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function __construct(Request $request, User $user)
    {
        $this->request = $request;

        $this->user = $user;

        $this->with = $this->request->with
            ? explode(',', $this->request->with)
            : [];

        $this->paginate = (int) $this->request->paginate;
    }

    /**
     * @param  int  $id
     * @return \App\User
     */
    public function getUser(int $id)
    {
        return $this->user
            ->with($this->with)
            ->findOrFail($id);
    }
}
