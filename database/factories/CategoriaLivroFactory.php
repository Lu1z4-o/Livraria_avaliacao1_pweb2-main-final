<?php

namespace Database\Factories;

use App\Models\CategoriaLivro;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<CategoriaLivro>
 */
class CategoriaLivroFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {{
        $categoria=['Natalinos','Para ler na praia ','Favoritos da Angelim','Para toda a família ', 'Para dia chuvoso', 'Sem categoria'];

        }
        return [
            'categoria'=>fake()->unique()->randomElement($categoria),
        ];
    }
}
 


