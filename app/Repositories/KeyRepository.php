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
     * @var array
     */
    protected $with;

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

        $this->with = $this->request->with
            ? explode(',', $this->request->with)
            : [];
    }

    /**
     * @param  int  $id
     * @return \App\Key
     */
    public function getKey(int $id)
    {
        return $this->key
            ->with($this->with)
            ->findOrFail($id);
    }

    /**
     * @param  \App\User  $user
     * @return \App\Key
     */
    public function getKeysByUser(User $user)
    {
        $q = $this->request->q;

        return $user
            ->keys()
            ->where(function ($query) use ($q) {
                $query->where('title', 'like', "%{$q}%");
            })
            ->with($this->with)
            ->paginate($this->request->paginate);
    }

    /**
     * @param  \App\User  $user
     * @param  int  $id
     * @return \App\Key
     */
    public function getKeyByUser(User $user, int $id)
    {
        return $user
            ->keys()
            ->with($this->with)
            ->findOrFail($id);
    }

    /**
     * @param  \App\User  $user
     * @return \App\Key
     */
    public function storeKeyByUser(User $user)
    {
        $key = $user
            ->keys()
            ->create($this->request->all());

        return $this->getKey($key->id);
    }

    /**
     * @param  \App\Key  $key
     * @return \App\Key
     */
    public function updateKey(Key $key)
    {
        $key->update($this->request->all());

        return $this->getKey($key->id);
    }

    /**
     * @param  \App\Key  $key
     * @return \App\Key
     */
    public function destroyKey(Key $key)
    {
        $key->delete();
    }
}
