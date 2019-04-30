<?php

namespace App\Contracts;

interface UserInterface
{
    /**
     * @param  int  $id
     * @return \App\User
     */
    public function getUser(int $id);

    /**
     * @param  int  $id
     * @return \App\User
     */
    public function updateUser(int $id);
}
