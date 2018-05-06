<?php

namespace App\Repositories\Contracts;

use App\Repositories\Contracts\RepositoryInterface;

interface UserRepositoryInterface extends RepositoryInterface
{
    public function getAll();

    public function getAllUsers();

    public function getAllModerators();

    public function getAllBlockedUsers();

    public function getAllBlockedMods();
    
}
