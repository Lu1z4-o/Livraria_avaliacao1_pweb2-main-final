<?php

namespace App\Charts;

use App\Models\Hashtag;
use ArielMejiaDev\LarapexCharts\LarapexChart;
class HashtagsChart
{
    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    {
        // Busca as 6 hashtags mais vinculadas aos livros através da tabela pivô livro_hashtag
        $hashtags = Hashtag::withCount('livros')
            ->orderByDesc('livros_count')
            ->take(6)
            ->get();

        $tags = [];
        $totais = [];

        foreach ($hashtags as $item) {
            $tags[] = $item->tag;
            $totais[] = $item->livros_count;
        }

        // Constrói e retorna a instância do gráfico de pizza configurado
        return (new LarapexChart)->pieChart()
            ->setTitle('Tropos Literários & Hashtags Mais Populares (#)')
            ->setSubtitle('Top 6 temas e ambientações mais frequentes no acervo')
            ->addData($totais)
            ->setLabels($tags)
            ->setColors(['#E76F51', '#2A9D8F', '#F4A261', '#264653', '#E9C46A', '#3A86FF']);
    }
}

