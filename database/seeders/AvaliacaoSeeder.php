<?php

namespace Database\Seeders;

use App\Models\Avaliacao;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AvaliacaoSeeder extends Seeder
{
    public function run(): void
    {
        Avaliacao::factory()->count(5)->create();
    }
}
    

