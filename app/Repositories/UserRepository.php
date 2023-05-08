<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository {
    
    protected $entity;

    public function __construct(User $user)
    {
        $this->entity = $user;
    }

    public function getOne(string $id): User
    {
        return $this->entity->findOrFail($id);
    }

    public function create(array $data): User
    {
        return User::create([
            'name' => $data['name'],
            'cnpj' => $data['cnpj'],
            'razaoSocial' => $data['razaoSocial'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function update(array $data, string $id): bool
    {
        $this->entity = $this->getOne($id);
        return $this->entity->update($data);
    }

    public function updatePassword(string $password, string $id): bool
    {
        return (bool) User::whereId($id)->update([
            'password' => Hash::make($password)
        ]);
    }
}