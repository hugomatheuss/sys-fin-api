<?php

namespace App\Services;

use App\Builders\ContaBuilder;
use App\Models\Conta;
use App\Models\User;
use App\Repositories\ContaRepository;
use App\Validator\ContaValidator;
use Exception;
use Illuminate\Database\Eloquent\Collection;

class ContaService {

    protected $repository;
    protected $builder;
    protected $validator;

    public function __construct(
        ContaRepository $contaRepository,
        ContaBuilder $contaBuilder,
        ContaValidator $contaValidator
    )
    {
        $this->repository = $contaRepository;
        $this->builder = $contaBuilder;
        $this->validator = $contaValidator;
    }

    public function getAll(User $user): Collection
    {
        return $this->repository->getAll($user);
    }

    public function getOne(string $id, User $user): ?Conta
    {
        return $this->repository->getOne($id, $user);
    }

    public function search(array $fields, User $user): ?Collection
    {
        return $this->repository->search($fields, $user);
    }

    public function create(array $data, User $user): Conta
    {
        $data = $this->builder->build($data);
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

    public function pagarConta(string $id, User $user): bool
    {
        $conta = $this->getOne($id, $user);
        
        if ($this->validator->isPago($conta)) {
            throw new Exception('Conta já está paga.');
        }

        return $this->repository->pagar($conta, $user);
    }
}