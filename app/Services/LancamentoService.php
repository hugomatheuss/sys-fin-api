<?php

namespace App\Services;

use App\Models\Lancamento;
use App\Models\User;
use App\Repositories\LancamentoRepository;
use Illuminate\Database\Eloquent\Collection;

class LancamentoService {

    protected $repository;
    protected $builder;

    public function __construct(
        LancamentoRepository $lancamentoRepository,
    ) 
    {
        $this->repository = $lancamentoRepository;
    }

    public function getAll(User $user): Collection
    {
        return $this->repository->getAll($user);
    }

    public function getOne(string $id, User $user): ?Lancamento
    {
        return $this->repository->getOne($id, $user);
    }

    public function search()
    {
        //
    }

    public function create(array $data, User $user): Lancamento
    {
        return $this->repository->create($data, $user);
    }

    public function update(array $data, string $id, User $user): bool
    {
        return $this->repository->update($data, $id, $user);
    }

    public function delete(string $id, User $user): bool
    {
        return $this->repository->delete($id, $user);
    }
}