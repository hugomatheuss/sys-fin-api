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

    public function lancamentosDiarios(User $user): array
    {
        $lancamentos = $this->repository->getAll($user);

        $lancamentos = $this->getAll($user);
        $lancamentosDiarios = [];
        $recebimento = 0;
        $pagamento = 0;
        $count = 0;
        
        foreach($lancamentos as $key => $item) {
            if ($key == 0) {
                $prevDate = date_format(date_create($item['created_at']), 'Y-m-d');
                $recebimento = $recebimento + $item['recebimento'];
                $pagamento = $pagamento + $item['pagamento'];
            }

            if ($key !== 0) {
                if ($prevDate == date_format(date_create($item['created_at']), 'Y-m-d')) {
                    $prevDate = date_format(date_create($item['created_at']), 'Y-m-d');
                    $recebimento = $recebimento + $item['recebimento'];
                    $pagamento = $pagamento + $item['pagamento'];

                    $lancamentosDiarios[$count] = [
                        'dataLancamento' => $prevDate,
                        'recebimentoTotal' => $recebimento,
                        'pagamentoTotal' => $pagamento,
                    ];
                } else {
                    $count = $count +1;
                    $prevDate = date_format(date_create($item['created_at']), 'Y-m-d');
                    $recebimento = $item['recebimento'];
                    $pagamento = $item['pagamento'];
                }
            }
        }

        return $lancamentosDiarios;
    }
}