<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LivrariaController;
use App\Http\Controllers\UsuarioController; 
use App\Http\Controllers\AvaliacaoController;
use App\Http\Controllers\HashtagController;
use App\Http\Controllers\EbookController;
use App\Http\Controllers\RelatorioController;

/**
 * 
 * contador de todos os dados inseridos, fica na página inicial
 */
Route::get('/', function () {
    $totalLivros = \App\Models\Livraria::count();
    $totalEbooks = \App\Models\Ebook::count();
    $totalHashtags = \App\Models\Hashtag::count();
    $totalAvaliacoes = \App\Models\Avaliacao::count();
    $totalUsuarios = \App\Models\Usuario::count();

    $livrosDestaque = \App\Models\Livraria::with(['categoriaLivro', 'hashtags', 'ebook'])->latest()->take(3)->get();
    $ultimasAvaliacoes = \App\Models\Avaliacao::with('livro')->latest()->take(3)->get();
    $hashtagsPopulares = \App\Models\Hashtag::with('livros')->withCount('livros')->orderByDesc('livros_count')->take(8)->get();

    return view('main', compact(
        'totalLivros',
        'totalEbooks',
        'totalHashtags',
        'totalAvaliacoes',
        'totalUsuarios',
        'livrosDestaque',
        'ultimasAvaliacoes',
        'hashtagsPopulares'
    ));
});


// livros
Route::get('/livraria', [LivrariaController::class, 'index'])->name('livraria.index');
Route::get('/livraria/create', [LivrariaController::class, 'create'])->name('livraria.create');
Route::post('/livraria/store', [LivrariaController::class, 'store'])->name('livraria.store');
Route::get('/livraria/edit/{id}', [LivrariaController::class, 'edit'])->name('livraria.edit');
Route::put('/livraria/update/{id}', [LivrariaController::class, 'update'])->name('livraria.update');
Route::delete('/livraria/{id}', [LivrariaController::class, 'destroy'])->name('livraria.destroy');
Route::post('/livraria/search', [LivrariaController::class, 'search'])->name('livraria.search');


// ebooks
Route::get('/ebook', [EbookController::class, 'index'])->name('ebook.index');
Route::get('/ebook/create', [EbookController::class, 'create'])->name('ebook.create');
Route::post('/ebook/store', [EbookController::class, 'store'])->name('ebook.store');
Route::get('/ebook/edit/{id}', [EbookController::class, 'edit'])->name('ebook.edit');
Route::put('/ebook/update/{id}', [EbookController::class, 'update'])->name('ebook.update');
Route::delete('/ebook/{id}', [EbookController::class, 'destroy'])->name('ebook.destroy');
Route::post('/ebook/search', [EbookController::class, 'search'])->name('ebook.search');


// hashtags 
Route::get('/hashtag', [HashtagController::class, 'index'])->name('hashtag.index');
Route::get('/hashtag/create', [HashtagController::class, 'create'])->name('hashtag.create');
Route::post('/hashtag/store', [HashtagController::class, 'store'])->name('hashtag.store');
Route::get('/hashtag/edit/{id}', [HashtagController::class, 'edit'])->name('hashtag.edit');
Route::put('/hashtag/update/{id}', [HashtagController::class, 'update'])->name('hashtag.update');
Route::delete('/hashtag/{id}', [HashtagController::class, 'destroy'])->name('hashtag.destroy');
Route::post('/hashtag/search', [HashtagController::class, 'search'])->name('hashtag.search');


// usuário
Route::get('/usuario', [UsuarioController::class, 'index'])->name('usuario.index');
Route::get('/usuario/create', [UsuarioController::class, 'create'])->name('usuario.create');
Route::post('/usuario/store', [UsuarioController::class, 'store'])->name('usuario.store');
Route::get('/usuario/edit/{id}', [UsuarioController::class, 'edit'])->name('usuario.edit');
Route::put('/usuario/update/{id}', [UsuarioController::class, 'update'])->name('usuario.update');
Route::delete('/usuario/{id}', [UsuarioController::class, 'destroy'])->name('usuario.destroy');
Route::post('/usuario/search', [UsuarioController::class, 'search'])->name('usuario.search');


// avaliação
Route::get('/avaliacao', [AvaliacaoController::class, 'index'])->name('avaliacao.index');
Route::get('/avaliacao/create', [AvaliacaoController::class, 'create'])->name('avaliacao.create'); 
Route::post('/avaliacao/store', [AvaliacaoController::class, 'store'])->name('avaliacao.store');
Route::get('/avaliacao/edit/{id}', [AvaliacaoController::class, 'edit'])->name('avaliacao.edit');
Route::put('/avaliacao/update/{id}', [AvaliacaoController::class, 'update'])->name('avaliacao.update');
Route::delete('/avaliacao/{id}', [AvaliacaoController::class, 'destroy'])->name('avaliacao.destroy');
Route::post('/avaliacao/search', [AvaliacaoController::class, 'search'])->name('avaliacao.search');


// pdf e gráfico 
Route::get('/relatorios', [RelatorioController::class, 'index'])->name('relatorios.index');
Route::get('/relatorios/livros-pdf', [RelatorioController::class, 'exportarLivrosPdf'])->name('relatorios.livros.pdf');
Route::get('/relatorios/avaliacoes-pdf', [RelatorioController::class, 'exportarAvaliacoesPdf'])->name('relatorios.avaliacoes.pdf');
Route::get('/relatorios/chart-categorias', [RelatorioController::class, 'chartCategorias'])->name('relatorios.chart.categorias');
Route::get('/relatorios/chart-hashtags', [RelatorioController::class, 'chartHashtags'])->name('relatorios.chart.hashtags');
