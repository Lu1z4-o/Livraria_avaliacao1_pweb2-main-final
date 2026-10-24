<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Livraria;

class LivrariaSeeder extends Seeder
{
    public function run(): void
    {
        Livraria::factory()->count(5)->create();
    }
}
