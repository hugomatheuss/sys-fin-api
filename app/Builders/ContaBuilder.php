<?php

namespace App\Builders;

class ContaBuilder {

    public function build(array $data): array
    {
        $data['valor'] = (string) $data['valor'];
        $data['dataVencimento'] = date("Y-m-d", strtotime($data['dataVencimento']));
        
        return $data;
    }
}