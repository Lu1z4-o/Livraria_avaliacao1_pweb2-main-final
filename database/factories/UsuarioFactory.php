<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class UsuarioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome' => fake()->name(),
            'cpf' => fake()->numerify('###########'),
            'endereco' => fake()->address(), 
            'email' => fake()->unique()->safeEmail(),
            'telefone' => fake()->numerify('(##) 9####-####'),
        ];
    }
}