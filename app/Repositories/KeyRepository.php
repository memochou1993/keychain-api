<?php

namespace App\Repositories;

use App\Key;
use App\User;
use App\Contracts\KeyInterface;
use App\Http\Requests\KeyRequest as Request;

class KeyRepository implements KeyInterface
{
    /**
     * @var \App\Http\Requests\KeyRequest
     */
    protected $request;

    /**
     * @var \App\Key
     */
    protected $key;

    /**
     * Create a new repository instance.
     *
     * @param  \App\Key  $key
     * @return void
     */
    public function __construct(Request $request, Key $key)
    {
        $this->request = $request;

        $this->key = $key;
    }

    /**
     * @return \App\Key
     */
    public function getKeysByUser(User $user)
    {
        $q = $this->request->q;

        return $user->keys()
            ->where(function ($query) use ($q) {
                $query->where('title', 'like', "%{$q}%");
            })
            ->paginate();
    }
}
