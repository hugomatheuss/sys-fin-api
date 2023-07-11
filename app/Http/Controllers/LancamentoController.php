<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\LancamentoResource;
use App\Models\User;
use App\Services\LancamentoService;
use Exception;
use Illuminate\Http\Request;

class LancamentoController extends Controller
{
    public function __construct
    (
        protected LancamentoService $lancamentoService,
        protected User $user
    )
    {
        $this->lancamentoService = $lancamentoService;
        $this->user = auth()->user();
        $this->middleware('auth:api');
    }

    public function index()
    {
        try {
            $lançamentos = $this->lancamentoService->getAll($this->user);

            if (is_null($lançamentos)) {
                throw new Exception("Você não possui lançamentos cadastradas.");
            }

            return LancamentoResource::collection($lançamentos);
        } catch (Exception $e) {
            //TO DO
        }
    }

    public function store(Request $request)
    {
        try {
            $data = $this->lancamentoService->create($request->all(), $this->user);
            return new LancamentoResource($data);
        } catch (Exception $e) {
            //TO DO
        }
    }

    public function diarios()
    {
        try {
            $lancamentosDiarios = $this->lancamentoService->lancamentosDiarios($this->user);
            return $lancamentosDiarios;
        } catch (Exception $e) {
            //TO DO
        }
    }
}