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
     * @var int
     */
    protected $paginate;

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

        $this->paginate = (int) $this->request->paginate;
    }

    /**
     * @param  int  $id
     * @return \App\Key
     */
    public function getKey(int $id)
    {
        $key = $this->key
            ->with($this->with)
            ->findOrFail($id);

        return $key;
    }

    /**
     * @param  \App\User  $user
     * @return \App\Key
     */
    public function searchKeysByUser(User $user)
    {
        $q = $this->request->q;

        $keys = $this->key
            ->search($q)
            ->where('user_id', $user->id)
            ->paginate($this->paginate);

        return $keys;
    }

    /**
     * @param  \App\User  $user
     * @return \App\Key
     */
    public function getKeysByUser(User $user)
    {
        $q = $this->request->q;

        $keys = $user
            ->keys()
            ->where(function ($query) use ($q) {
                if (!$q) {
                    return;
                }
                $query
                    ->where('title', 'like', "%{$q}%")
                    ->orWhere('tags', 'like', "%{$q}%");
            })
            ->with($this->with)
            ->orderBy('id', 'desc')
            ->paginate($this->paginate);

        return $keys;
    }

    /**
     * @param  \App\User  $user
     * @param  int  $id
     * @return \App\Key
     */
    public function getKeyByUser(User $user, int $id)
    {
        $key = $user
            ->keys()
            ->with($this->with)
            ->findOrFail($id);

        return $key;
    }

    /**
     * @param  \App\User  $user
     * @param  array  $request
     * @return \App\Key
     */
    public function storeKeyByUser(User $user, array $request)
    {
        $key = $user
            ->keys()
            ->create($request);

        return $key;
    }

    /**
     * @param  \App\Key  $key
     * @param  array  $request
     * @return \App\Key
     */
    public function updateKey(Key $key, array $request)
    {
        $key->update($request);

        return $key;
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
