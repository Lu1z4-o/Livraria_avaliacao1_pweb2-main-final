<?php

namespace Database\Factories;

use App\Models\Hashtag;
use App\Models\Livraria;
use Illuminate\Database\Eloquent\Factories\Factory;

class HashtagFactory extends Factory
{
    protected $model = Hashtag::class;

    public function definition(): array
    {
        $tagsPopulares = [
            [
                'tag' => '#enemies-to-lovers',
                'tipo' => 'Tropo Literário',
                'descricao' => 'Inimigos jurados que ao longo da trama se apaixonam intensamente.',
                'cor' => '#d90429',
            ],
            [
                'tag' => '#highschool',
                'tipo' => 'Ambientação',
                'descricao' => 'Trama centrada no ambiente escolar, dramas juvenis e primeiras descobertas.',
                'cor' => '#3a86ff',
            ],
            [
                'tag' => '#slow-burn',
                'tipo' => 'Tropo Literário',
                'descricao' => 'Desenvolvimento romântico lento e gradual, com muita tensão e química.',
                'cor' => '#fb5607',
            ],
            [
                'tag' => '#found-family',
                'tipo' => 'Tropo Literário',
                'descricao' => 'Grupo de personagens que constroem laços profundos como uma verdadeira família.',
                'cor' => '#2a9d8f',
            ],
            [
                'tag' => '#fake-dating',
                'tipo' => 'Tropo Literário',
                'descricao' => 'Namoro de mentira que acaba se transformando em sentimentos reais.',
                'cor' => '#ff006e',
            ],
            [
                'tag' => '#dark-academia',
                'tipo' => 'Vibe / Estética',
                'descricao' => 'Clima misterioso em bibliotecas góticas, investigações e amor pelo saber.',
                'cor' => '#4a4e69',
            ],
            [
                'tag' => '#grumpy-x-sunshine',
                'tipo' => 'Dinâmica de Personagens',
                'descricao' => 'O contraste perfeito entre um protagonista fechado/carrancudo e outro solar e alegre.',
                'cor' => '#e76f51',
            ],
            [
                'tag' => '#plot-twist',
                'tipo' => 'Reviravolta',
                'descricao' => 'Reviravolta surpreendente que redefine todo o rumo da história.',
                'cor' => '#8338ec',
            ],
            [
                'tag' => '#distopia',
                'tipo' => 'Subgênero',
                'descricao' => 'Sociedade futurista opressiva com luta pela liberdade e sobrevivência.',
                'cor' => '#264653',
            ],
            [
                'tag' => '#confort-book',
                'tipo' => 'Vibe / Clima',
                'descricao' => 'Livro aconchegante, ideal para aquecer o coração e ler com um bom café.',
                'cor' => '#8c5a3c',
            ],
        ];

        $escolhida = fake()->randomElement($tagsPopulares);

        return [
            'livro_id' => Livraria::inRandomOrder()->first()?->id ?? Livraria::factory(),
            'tag' => $escolhida['tag'],
            'tipo' => $escolhida['tipo'],
            'descricao' => $escolhida['descricao'],
            'cor' => $escolhida['cor'],
        ];
    }
}

