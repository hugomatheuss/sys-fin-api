<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContaRequest;
use App\Http\Resources\ContaResource;
use App\Services\ContaService;
use Exception;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;

class ContaController extends Controller
{
    public function __construct(
        protected ContaService $contaService,
        protected User $user
    )
    {
        $this->contaService = $contaService;
        $this->user = auth()->user();
        $this->middleware('auth:api');
    }

    public function index()
    {
        try {
            $contas = $this->contaService->getAll($this->user);

            if (is_null($contas)) {
                throw new Exception("Você não possui contas cadastradas.");
            }

            return ContaResource::collection($contas);
        } catch (Exception $e) {
            //TO DO
        }
    }

    public function store(ContaRequest $request)
    {
        try {
            $data = $this->contaService->create($request->validated(), $this->user);
            return new ContaResource($data);
        } catch (Exception $e) {
            //TO DO
        }
    }

    public function show($id)
    {
        try {
            $conta = $this->contaService->getOne($id, $this->user);

            if (is_null($conta)) {
                throw new Exception("Esta conta não existe.");
            }

            return new ContaResource($conta);
        } catch (Exception $e) {
            //TO DO
        }
    }

    public function buscar(Request $request)
    {
        try {
            $contas = $this->contaService->search($request->all(), $this->user);

            if (is_null($contas)) {
                throw new Exception(("A busca não retornou contas."));
            }

            return new ContaResource($contas);
        } catch (Exception $e) {
            //TO DO
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $isUpdated = $this->contaService->update($request->all(), $id, $this->user);

            if(!$isUpdated) {
                throw new Exception("Houve um erro.");
            }
            $contaUpdated = $this->contaService->getOne($id, $this->user);

            return response()->json([
                'updated' => true,
                'conta' => $contaUpdated
            ]);
        } catch (Exception $e) {
            //TO DO
        }
    }

    public function pagar($id)
    {
        try {
            $this->contaService->pagarConta($id, $this->user);
            $contaPaga = $this->contaService->getOne($id, $this->user);
            
            return response()->json([
                'pago' => true,
                'conta' => $contaPaga
            ]);
        } catch (Exception $e) {
            throw $e->getMessage();
        }
    }

    public function destroy($id)
    {
        try {
            $isDeleted = $this->contaService->delete($id, $this->user);

            if (!$isDeleted) {
                throw new Exception("Houve um erro.");
            }

            return response()->json([
                "Deleted", 204
            ]);
        } catch (Exception $e) {
            //TO DO
        }
    }
}
