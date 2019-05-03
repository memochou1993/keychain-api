<?php

namespace App\Contracts;

use App\Key;
use App\User;

interface KeyInterface
{
    /**
     * @param  int  $id
     * @return \App\Key
     */
    public function getKey(int $id);

    /**
     * @param  \App\User  $user
     * @return \App\Key
     */
    public function searchKeysByUser(User $user);

    /**
     * @param  \App\User  $user
     * @return \App\Key
     */
    public function getKeysByUser(User $user);

    /**
     * @param  \App\User  $user
     * @param  int  $id
     * @return \App\Key
     */
    public function getKeyByUser(User $user, int $id);

    /**
     * @param  \App\User  $user
     * @param  array  $request
     * @return \App\Key
     */
    public function storeKeyByUser(User $user, array $request);

    /**
     * @param  \App\Key  $key
     * @param  array  $request
     * @return \App\Key
     */
    public function updateKey(Key $key, array $request);

    /**
     * @param  \App\Key  $key
     * @return \App\Key
     */
    public function destroyKey(Key $key);
}
