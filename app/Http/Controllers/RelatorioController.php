<?php

namespace App\Http\Controllers;

use App\Models\Livraria;
use App\Models\Avaliacao;
use App\Models\Hashtag;
use App\Models\Usuario;
use App\Models\Ebook;
use App\Charts\LivroCategoriaChart;
use App\Charts\HashtagsChart;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;


class RelatorioController extends Controller
{
    
    public function index(LivroCategoriaChart $chartCategorias, HashtagsChart $chartHashtags)
    {
        // Totais gerais para os cards informativos
        $totais = [
            'livros' => Livraria::count(),
            'ebooks' => Ebook::count(),
            'hashtags' => Hashtag::count(),
            'avaliacoes' => Avaliacao::count(),
            'usuarios' => Usuario::count(),
        ];

        // constrói os dois gráficos em formatos diferentes 
        $graficoCategorias = $chartCategorias->build();
        $graficoHashtags = $chartHashtags->build();

        return view('relatorios.index', compact('totais', 'graficoCategorias', 'graficoHashtags'));
    }


    public function exportarLivrosPdf()
    {
        $dados = Livraria::with(['categoriaLivro', 'hashtags', 'ebook'])->orderBy('nome')->get();

        $data = [
            'titulo' => 'Relatório do Acervo de Livros - Livraria Acácia',
            'date' => date('d/m/Y H:i'),
            'dataGeracao' => date('d/m/Y H:i'),
            'dados' => $dados,
            'livros' => $dados,
        ];

        $pdf = Pdf::loadView('relatorios.pdf_livros', $data);

        // navegador
        return $pdf->stream('relatorio_livros.pdf');
    }

   
    public function exportarAvaliacoesPdf()
    {
        $dados = Avaliacao::with('livro')->orderBy('id', 'desc')->get();

        $data = [
            'titulo' => 'Relatório de Avaliações e Resenhas - Livraria Acácia',
            'date' => date('d/m/Y H:i'),
            'dataGeracao' => date('d/m/Y H:i'),
            'dados' => $dados,
            'avaliacoes' => $dados,
        ];

        $pdf = Pdf::loadView('relatorios.pdf_avaliacoes', $data);

        // navegador
        return $pdf->stream('relatorio_avaliacoes.pdf');
    }

    
    public function chartCategorias(LivroCategoriaChart $chart)
    {
        return view('relatorios.chart_single', [
            'titulo' => 'Gráfico: Livros por Categoria Literária',
            'chart' => $chart->build()
        ]);
    }

    
    public function chartHashtags(HashtagsChart $chart)
    {
        return view('relatorios.chart_single', [
            'titulo' => 'Gráfico: Tropos Literários & Hashtags Mais Populares',
            'chart' => $chart->build()
        ]);
    }
}
