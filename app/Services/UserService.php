<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;

class UserService {

    protected $repository;

    public function __construct(UserRepository $userRepository)
    {
        $this->repository = $userRepository;
    }

    public function create(array $data): User
    {
        return $this->repository->create($data);
    }

    public function update(array $data, string $id): bool
    {
        return $this->repository->update($data, $id);
    }

    public function updatePassword(string $password, string $id): bool
    {
        return $this->repository->updatePassword($password, $id);
    }
}