<?php

namespace Database\Seeders;

use App\Models\Conta;
use Exception;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        try {
            Conta::factory()
                ->count(50)
                ->create();
        } catch(Exception $e) {
            dd($e);
        }
    }
}
