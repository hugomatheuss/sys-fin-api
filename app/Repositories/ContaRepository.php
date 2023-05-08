<?php

namespace App\Repositories;

use App\Models\Conta;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class ContaRepository {
    
    protected $entity;

    public function __construct(Conta $conta)
    {
        $this->entity = $conta;
    }

    public function getAll(User $user): ?Collection
    {
        return $user->contas()->get();
    }

    public function getOne(string $id, User $user): ?Conta
    {
        return $user->contas()->find($id);
    }

    public function search(array $fields, User $user): ?Collection
    {
        $numeroDocumento = $fields['numDocumento'] ?? null;
        $fornecedor = $fields['fornecedor'] ?? null;
        $valor = $fields['valor'] ?? null;
        $dataInicial = $fields['dataInicial'] ?? null;
        $dataFinal = $fields['dataFinal'] ?? null;

        $contas = $user->contas();

        if (!is_null($numeroDocumento)) {
            $contas = $contas->where('numeroDocumento');
        }

        if (!is_null($fornecedor)) {
            $contas = $contas->where('fornecedor', $fornecedor);
        }

        if (!is_null($valor)) {
            $contas = $contas->where('valor', $valor);
        }

        if (!is_null($dataInicial) && !is_null($dataFinal)) {
            $contas = $contas->whereBetween('created_at', [$dataInicial, $dataFinal]);
        }
        
        if (!is_null($dataInicial) && is_null($dataFinal)) {
            $contas = $contas->where('created_at', '>=', $dataInicial);
        }

        if (is_null($dataInicial) && !is_null($dataFinal)) {
            $contas = $contas->where('created_at', '<=', $dataFinal);
        }
        
        return $contas->get();
    }

    public function create(array $data, User $user): Conta
    {
        return $user->contas()->create($data);
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