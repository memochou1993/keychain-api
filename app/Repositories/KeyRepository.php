<?php

namespace App\Repositories;

use App\Key;
use App\User;
use App\Contracts\KeyInterface;

class KeyRepository implements KeyInterface
{
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
    public function __construct(Key $key)
    {
        $this->key = $key;
    }

    /**
     * @return \App\Key
     */
    public function getKeysByUser(User $user)
    {
        return $user->keys()->paginate();
    }
}
