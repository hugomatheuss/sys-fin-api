<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Conta>
 */
class ContaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'fornecedor' => fake()->name(),
            'valor' => fake()->randomFloat(2),
            'descricao' => fake()->sentence(5),
            'status' => fake()->numberBetween(1, 2),
            'tipo' => fake()->numberBetween(1, 2),
            'numeroDocumento' => fake()->randomNumber(7, true),
            'dataPagamento' => fake()->date(),
            'dataVencimento' => fake()->date(),
            'user_id' => fake()->numberBetween(1, 2),
        ];
    }
}
