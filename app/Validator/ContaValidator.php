<?php

namespace App\Validator;

use App\Models\Conta;

class ContaValidator {
    public const PAGO = '1';

    public function isPago(Conta $conta): bool
    {
        return self::PAGO === $conta->status;
    }
}