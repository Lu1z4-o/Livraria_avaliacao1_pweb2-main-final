<?php

namespace App\Charts;

use App\Models\CategoriaLivro;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class LivroCategoriaChart
{
    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        // Busca todas as categorias calculando a quantidade de livros associados via Eloquent withCount
        $categorias = CategoriaLivro::withCount('livros')->get();

        $nomesCategorias = [];
        $qtdLivros = [];

        foreach ($categorias as $cat) {
            $nomesCategorias[] = $cat->categoria;
            $qtdLivros[] = $cat->livros_count;
        }

        // Constrói e retorna a instância do gráfico de barras configurado
        return (new LarapexChart)->barChart()
            ->setTitle('Livros por Categoria Literária')
            ->setSubtitle('Distribuição das obras do catálogo da Livraria')
            ->addData($qtdLivros, 'Total de Livros')
            ->setXAxis($nomesCategorias)
            ->setColors(['#B85D36', '#2A9D8F', '#E76F51', '#264653', '#F4A261', '#6A040F']);
    }
}
