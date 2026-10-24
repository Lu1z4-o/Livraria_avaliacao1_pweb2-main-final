<?php

namespace Database\Seeders;

use App\Models\Hashtag;
use App\Models\Livraria;
use Illuminate\Database\Seeder;

class HashtagSeeder extends Seeder
{
    public function run(): void
    {
        $livros = Livraria::all();

        if ($livros->isEmpty()) {
            return;
        }

        $exemploTags = [
            ['tag' => '#enemies-to-lovers', 'tipo' => 'Tropo Literário', 'descricao' => 'Inimigos que viram amantes com muita tensão e química.', 'cor' => '#d90429'],
            ['tag' => '#highschool', 'tipo' => 'Ambientação', 'descricao' => 'Dramas e romances no ensino médio.', 'cor' => '#3a86ff'],
            ['tag' => '#slow-burn', 'tipo' => 'Tropo Literário', 'descricao' => 'Romance com desenvolvimento lento e detalhado.', 'cor' => '#fb5607'],
            ['tag' => '#found-family', 'tipo' => 'Tropo Literário', 'descricao' => 'Amizades que se tornam uma família inseparável.', 'cor' => '#2a9d8f'],
            ['tag' => '#fake-dating', 'tipo' => 'Tropo Literário', 'descricao' => 'Namoro de mentira com sentimentos reais.', 'cor' => '#ff006e'],
            ['tag' => '#dark-academia', 'tipo' => 'Vibe / Estética', 'descricao' => 'Mistério, poesia e segredos universitários sombrios.', 'cor' => '#4a4e69'],
            ['tag' => '#grumpy-x-sunshine', 'tipo' => 'Dinâmica', 'descricao' => 'O rabugento e o raio de sol.', 'cor' => '#e76f51'],
            ['tag' => '#plot-twist', 'tipo' => 'Reviravolta', 'descricao' => 'Final chocante que ninguém esperava.', 'cor' => '#8338ec'],
            ['tag' => '#distopia', 'tipo' => 'Subgênero', 'descricao' => 'Regime totalitário e revolução.', 'cor' => '#264653'],
            ['tag' => '#confort-book', 'tipo' => 'Vibe / Clima', 'descricao' => 'Leitura acolhedora para relaxar.', 'cor' => '#8c5a3c'],
        ];

        //foreach adiciona as hashtags aos livros 
        foreach ($livros as $livro) {
            $tagsParaLivro = collect($exemploTags)->random(rand(1, 3));
            foreach ($tagsParaLivro as $tagData) {
                Hashtag::create([
                    'livro_id' => $livro->id,
                    'tag' => $tagData['tag'],
                    'tipo' => $tagData['tipo'],
                    'descricao' => $tagData['descricao'],
                    'cor' => $tagData['cor'],
                ]);
            }
        }
    }
}

