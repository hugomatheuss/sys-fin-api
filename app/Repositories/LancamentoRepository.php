<?php

namespace App\Repositories;

use App\Models\Lancamento;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class LancamentoRepository {
    protected $entity;

    public function __construct(Lancamento $lancamento)
    {
        $this->entity = $lancamento;
    }

    public function getAll(User $user): ?Collection
    {
        return $user->lancamentos()->get();
    }

    public function getOne(string $id, User $user): ?Lancamento
    {
        return $user->lancamentos()->find($id);
    }

    public function search()
    {
        //
    }

    public function create(array $data, User $user): Lancamento
    {
        return $user->lancamentos()->create($data);
    }

    public function update(array $data, string $id, User $user): bool
    {
        $this->entity = $this->getOne($id, $user);
        if (is_null($this->entity)) {
            return false;
        }
        return $this->entity->update($data);
    }

    public function delete(string $id, User $user): bool
    {
        $this->entity = $this->getOne($id, $user);
        if (is_null($this->entity)) {
            return false;
        }
        return $this->entity->delete();
    }
}