<?php

namespace repository;

use domain\entities\EntUser;
use models\User;

interface UserRepositoryInterface
{
    function getUserById(int $userId): array;

    public function save(EntUser $user): array;
}

class UserRepository implements UserRepositoryInterface
{
    private User $user;
    function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return array
     */
    public function getUserById(int $userId): array
    {
        $user = $this->user->find($userId);
        if (!$user) return [];
        return $user->toArray();
    }


    public function save(EntUser $user): array
    {
        return $this->user->create($user->records())->toArray();
    }

    static function builder(): UserRepositoryInterface
    {
        return new static(new User());
    }
}