<?php

namespace Database\Factories;

use App\Models\Livraria;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\CategoriaLivraria;
use App\Models\CategoriaLivro;

/**
 * @extends Factory<Livraria>
 */
class LivrariaFactory extends Factory
{
/**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        {
        $generos=['Terror','Aventura','Romance','Ação', 'Drama', 'Suspense'];
        $nomes=['Os tres porquinhos', 'Orgulho e Preconceito','Turma da Monica Jovem','A Morte no Nilo','Admirável Mundo Novo',
        'O Principe Cruel','Dom Casmurro','Noites Brancas','As Meninas','Romeu e Julieta','Torto Arado','Iracema','Cem anos de solidão',
         'A Paixão Segundo G.H.', 'Ensaio sobre a cegueira'];
        }
         return [
            'nome' => fake()->randomElement($nomes), 
            'valor' => fake()->randomFloat(2, 20, 100),
            'autor' => fake()->name(),
            'genero' => fake()->randomElement($generos),
            'categoria_id' => CategoriaLivro::inRandomOrder()->first()?->id ?? 1, //Alteração para evitar conflito de loops 
        ];
    }
}
