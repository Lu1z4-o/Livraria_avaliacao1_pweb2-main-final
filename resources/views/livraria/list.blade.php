@extends('layout')

@section('titulo', 'Catálogo de Livros - Livraria Acácia')

@push('styles')
<style>
    /* estilo do retrato  */
    .book-portrait-card {
        border-radius: 16px;
        background: #FFFFFF;
        border: 1px solid var(--border-soft, #EADBCE);
        overflow: hidden;
        transition: transform 0.25s ease, box-shadow 0.25s ease;
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .book-portrait-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 16px 32px rgba(42, 24, 16, 0.12) !important;
    }

    .book-cover-wrapper {
        position: relative;
        width: 100%;
        padding-top: 135%; /* Proporção Retrato (3:4) */
        background: #2B170C;
        overflow: hidden;
    }

    .book-cover-img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.35s ease;
    }

    .book-portrait-card:hover .book-cover-img {
        transform: scale(1.04);
    }

    /*  sem foto */
    .book-cover-placeholder {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        padding: 1.25rem;
        color: #FAF4EB;
        background: linear-gradient(145deg, #26140B 0%, #452414 50%, #6E381C 100%);
        box-shadow: inset 6px 0 12px rgba(0, 0, 0, 0.45);
    }

    .book-spine-effect {
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        width: 9px;
        background: linear-gradient(to right, rgba(0, 0, 0, 0.5), rgba(255, 255, 255, 0.15) 60%, rgba(0, 0, 0, 0.2));
        z-index: 3;
    }

    .book-price-badge {
        position: absolute;
        top: 12px;
        right: 12px;
        z-index: 4;
        background: rgba(34, 19, 11, 0.85);
        backdrop-filter: blur(4px);
        color: #FDFBF7;
        font-weight: 700;
        font-size: 0.82rem;
        padding: 0.35rem 0.75rem;
        border-radius: 50rem;
        border: 1px solid rgba(255, 255, 255, 0.15);
    }
</style>
@endpush

@section('conteudo')

<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-1 small">
                <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-decoration-none text-muted">Início</a></li>
                <li class="breadcrumb-item active text-dark fw-semibold" aria-current="page">Livros</li>
            </ol>
        </nav>
        <h2 class="brand-font mb-1 d-flex align-items-center gap-2">
            <i class="bi bi-journal-bookmark text-primary"></i> Acervo de Livros
        </h2>
    </div>
    <div class="d-flex align-items-center gap-2 flex-wrap">
        <div class="btn-group shadow-sm" role="group" aria-label="Alternar Visualização">
            <button type="button" class="btn btn-outline-secondary btn-sm active" id="btnModoRetrato" onclick="alternarModo('retrato')" title="Modo Retrato / Capas">
                <i class="bi bi-grid-fill me-1"></i> Retrato
            </button>
            <button type="button" class="btn btn-outline-secondary btn-sm" id="btnModoTabela" onclick="alternarModo('tabela')" title="Modo Tabela">
                <i class="bi bi-table me-1"></i> Tabela
            </button>
        </div>
        <a href="{{ route('livraria.create') }}" class="btn btn-primary d-inline-flex align-items-center gap-2 px-3 py-2 rounded-pill shadow-sm">
            <i class="bi bi-plus-circle"></i>
            <span>Novo Livro</span>
        </a>
    </div>
</div>

<!-- aviso de domínio público -->
<div class="alert alert-light border border-success-subtle rounded-3 d-flex align-items-center justify-content-between py-2 px-3 mb-4">
    <div class="d-flex align-items-center gap-2 small">
        <i class="bi bi-shield-check text-success fs-5"></i>
        <span><strong>Acervo 100% em Domínio Público:</strong> Isenção de obrigatoriedade do registro comercial de venda para livros digitais.</span>
    </div>
    <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill">Domínio Público</span>
</div>


<div class="card card-custom mb-4">
    <div class="card-body p-3 p-md-4">
        <form action="{{ route('livraria.search') }}" method="POST" class="row g-3 align-items-end">
            @csrf
            <div class="col-12 col-md-3">
                <label for="tipo" class="form-label small fw-bold text-muted">Campo de Busca</label>
                <select name="tipo" id="tipo" class="form-select rounded-3">
                    <option value="nome" {{ request('tipo') == 'nome' ? 'selected' : '' }}>Título da Obra</option>
                    <option value="autor" {{ request('tipo') == 'autor' ? 'selected' : '' }}>Autor(a)</option>
                    <option value="genero" {{ request('tipo') == 'genero' ? 'selected' : '' }}>Gênero</option>
                    <option value="sinopse" {{ request('tipo') == 'sinopse' ? 'selected' : '' }}>Sinopse</option>
                    <option value="categoria" {{ request('tipo') == 'categoria' ? 'selected' : '' }}>Categoria Especial</option>
                    <option value="hashtag" {{ request('tipo') == 'hashtag' ? 'selected' : '' }}>Hashtag / Tropo</option>
                </select>
            </div>
            <div class="col-12 col-md-6">
                <label for="valor" class="form-label small fw-bold text-muted">Pesquisar por</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0 rounded-start-3 text-muted">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" name="valor" id="valor" class="form-control border-start-0 rounded-end-3" 
                        placeholder="Digite o título, autor, hashtag, sinopse..." value="{{ request('valor') }}">
                </div>
            </div>
            <div class="col-12 col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-primary flex-grow-1 rounded-3">
                    <i class="bi bi-search me-1"></i> Buscar
                </button>
                <a href="{{ route('livraria.index') }}" class="btn btn-outline-secondary rounded-3" title="Recarregar catálogo">
                    <i class="bi bi-arrow-counterclockwise"></i>
                </a>
            </div>
        </form>
    </div>
</div>

@if($dados->count() > 0)

    
    <div id="visaoRetrato">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <span class="fw-bold text-dark small text-uppercase">
                <i class="bi bi-images me-1 text-primary"></i>Galeria em Formato Retrato ({{ $dados->count() }} obras únicas)
            </span>
            <small class="text-muted">Capas em formato retrato com upload e exclusão física de arquivo.</small>
        </div>

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 mb-5">
            @foreach ($dados as $item)
                <div class="col">
                    <div class="book-portrait-card">
                        
                       
                        <div class="book-cover-wrapper">
                            <div class="book-spine-effect"></div>
                            <span class="book-price-badge">
                                R$ {{ number_format((float)$item->valor, 2, ',', '.') }}
                            </span>

                            @if($item->imagem && \Illuminate\Support\Facades\Storage::disk('public')->exists($item->imagem))
                                <img src="{{ asset('storage/' . $item->imagem) }}" alt="{{ $item->nome }}" class="book-cover-img">
                            @else
                                
                                <div class="book-cover-placeholder">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <span class="badge bg-white bg-opacity-25 rounded-pill small" style="font-size: 0.65rem;">
                                            {{ $item->categoriaLivro?->categoria ?? 'Acervo' }}
                                        </span>
                                        <i class="bi bi-book text-warning opacity-75 fs-5"></i>
                                    </div>
                                    <div class="my-auto py-2 text-center">
                                        <h5 class="brand-font text-white mb-1" style="font-size: 1.05rem; line-height: 1.3;">
                                            {{ Str::limit($item->nome, 45) }}
                                        </h5>
                                        <p class="small text-light opacity-75 mb-0" style="font-size: 0.8rem;">
                                            {{ $item->autor ?: 'Autor Desconhecido' }}
                                        </p>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center small text-white-50 border-top border-light border-opacity-25 pt-2" style="font-size: 0.7rem;">
                                        <span>{{ $item->genero ?: 'Literatura' }}</span>
                                        <span class="badge bg-warning text-dark" style="font-size: 0.6rem;">Domínio Público</span>
                                    </div>
                                </div>
                            @endif
                        </div>

                        
                        <div class="p-3 d-flex flex-column flex-grow-1">
                            <h5 class="brand-font fs-6 text-dark mb-1 text-truncate" title="{{ $item->nome }}">
                                {{ $item->nome }}
                            </h5>
                            <p class="small text-muted mb-2 text-truncate">
                                <i class="bi bi-pen me-1"></i>{{ $item->autor ?: 'Não informado' }}
                            </p>

                            <div class="d-flex align-items-center gap-1 mb-2">
                                <span class="badge bg-light text-dark border small" style="font-size: 0.7rem;">
                                    {{ $item->genero ?: 'Geral' }}
                                </span>
                                <span class="badge bg-warning-subtle text-dark border border-warning-subtle small" style="font-size: 0.7rem;">
                                    {{ $item->categoriaLivro?->categoria ?? 'Sem Categoria' }}
                                </span>
                            </div>

                           
                            @if(!empty($item->sinopse))
                                <p class="small text-muted mb-2" style="font-size: 0.78rem; line-height: 1.35; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;" title="{{ $item->sinopse }}">
                                    {{ $item->sinopse }}
                                </p>
                            @endif

                            <!-- ebook -->
                            <div class="mb-2">
                                @if($item->ebook)
                                    <a href="{{ route('ebook.edit', $item->ebook->id) }}" class="badge bg-info-subtle text-dark border border-info-subtle text-decoration-none small d-inline-flex align-items-center gap-1" >
                                        <i class="bi bi-tablet-fill text-primary"></i> E-book: {{ $item->ebook->tamanho_do_arquivo }} 
                                    </a>
                                @else
                                    <a href="{{ route('ebook.create') }}" class="badge bg-light text-muted border text-decoration-none small" title="Cadastrar E-book para este livro">
                                        <i class="bi bi-plus-circle me-1"></i>Vincular E-book
                                    </a>
                                @endif

                                @if($item->avaliacoes && $item->avaliacoes->count() > 0)
                                    <a href="{{ route('avaliacao.index') }}" class="badge bg-warning-subtle text-dark border border-warning-subtle text-decoration-none small ms-1" title="Ver avaliações">
                                        <i class="bi bi-star-fill text-warning"></i> {{ $item->avaliacoes->count() }} resenhas
                                    </a>
                                @endif
                            </div>

                            
                            <div class="mb-3 flex-grow-1">
                                <div class="d-flex flex-wrap align-items-center gap-1">
                                    @if($item->hashtags && $item->hashtags->count() > 0)
                                        @foreach($item->hashtags->take(3) as $tag)
                                            <a href="{{ route('hashtag.index', ['livro_id' => $item->id]) }}" 
                                               class="tag-pill text-white shadow-sm"
                                               style="background-color: {{ $tag->cor ?? '#8C5A3C' }}; font-size: 0.68rem; padding: 0.2rem 0.5rem;"
                                               title="{{ $tag->tipo }}: {{ $tag->descricao }}">
                                                {{ $tag->tag }}
                                            </a>
                                        @endforeach
                                        @if($item->hashtags->count() > 3)
                                            <span class="badge bg-light text-muted border" style="font-size: 0.65rem;">+{{ $item->hashtags->count() - 3 }}</span>
                                        @endif
                                    @else
                                        <span class="text-muted small fst-italic" style="font-size: 0.72rem;">Sem hashtags</span>
                                    @endif
                                </div>
                            </div>

                            
                            <div class="pt-2 border-top d-flex gap-2">
                                <a href="{{ route('livraria.edit', $item->id) }}" class="btn btn-sm btn-outline-primary flex-grow-1 rounded-pill">
                                    <i class="bi bi-pencil-square me-1"></i> Editar
                                </a>
                                <a href="{{ route('avaliacao.create', ['livro_id' => $item->id]) }}" class="btn btn-sm btn-outline-warning rounded-circle d-inline-flex align-items-center justify-content-center"
                                   style="width: 31px; height: 31px;" title="Adicionar Avaliação">
                                    <i class="bi bi-star"></i>
                                </a>
                                <form action="{{ route('livraria.destroy', $item->id) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('Tem certeza que deseja excluir este livro? A imagem da capa, e-book e hashtags vinculadas também serão removidas.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger rounded-circle d-inline-flex align-items-center justify-content-center" 
                                            style="width: 31px; height: 31px;" title="Excluir livro">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Formato de tabela -->
    <div id="visaoTabela" class="d-none">
        <div class="card card-custom overflow-hidden mb-5">
            <div class="card-header-custom d-flex justify-content-between align-items-center">
                <span class="fw-bold text-dark">
                    <i class="bi bi-table me-2 text-primary"></i>Listagem Tabular com Miniatura Retrato
                </span>
                <span class="badge bg-secondary-subtle text-secondary rounded-pill px-3 py-2">
                    Total: {{ $dados->count() }} livro(s)
                </span>
            </div>

            <div class="table-responsive">
                <table class="table table-custom table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th style="width: 60px;"># ID</th>
                            <th style="width: 80px;">Capa</th>
                            <th>Título & Autor</th>
                            <th>Preço</th>
                            <th>Gênero & Categoria</th>
                            <th>E-book</th>
                            <th>Hashtags (#)</th>
                            <th class="text-end" style="width: 140px;">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dados as $item)
                            <tr>
                                <td class="fw-bold text-muted">#{{ $item->id }}</td>
                                <td>
                                    <div style="width: 48px; height: 68px; flex-shrink: 0;" class="rounded shadow-sm overflow-hidden border bg-dark">
                                        @if($item->imagem && \Illuminate\Support\Facades\Storage::disk('public')->exists($item->imagem))
                                            <img src="{{ asset('storage/' . $item->imagem) }}" alt="{{ $item->nome }}" class="w-100 h-100 object-fit-cover">
                                        @else
                                            <div class="w-100 h-100 d-flex align-items-center justify-content-center text-warning" style="background: linear-gradient(135deg, #2D1A10, #5C321E);">
                                                <i class="bi bi-book" style="font-size: 1.1rem;"></i>
                                            </div>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <div class="fw-bold text-dark fs-6">{{ $item->nome }}</div>
                                    <div class="small text-muted"><i class="bi bi-pen me-1"></i>{{ $item->autor }}</div>
                                    @if(!empty($item->sinopse))
                                        <div class="small text-muted mt-1" style="font-size: 0.74rem;">{{ Str::limit($item->sinopse, 70) }}</div>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1 fs-6">
                                        R$ {{ number_format((float)$item->valor, 2, ',', '.') }}
                                    </span>
                                </td>
                                <td>
                                    <div><span class="badge bg-light text-dark border px-2 py-1">{{ $item->genero }}</span></div>
                                    <div class="mt-1"><span class="badge bg-warning-subtle text-dark border border-warning-subtle px-2 py-1">{{ $item->categoriaLivro?->categoria ?? 'Sem Categoria' }}</span></div>
                                </td>
                                <td>
                                    @if($item->ebook)
                                        <span class="badge bg-info-subtle text-dark border border-info-subtle">
                                            <i class="bi bi-tablet me-1"></i>{{ $item->ebook->tamanho_do_arquivo }}
                                        </span>
                                    @else
                                        <span class="badge bg-light text-muted border">Não vinculado</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex flex-wrap align-items-center gap-1">
                                        @if($item->hashtags && $item->hashtags->count() > 0)
                                            @foreach($item->hashtags as $tag)
                                                <a href="{{ route('hashtag.index', ['livro_id' => $item->id]) }}" 
                                                   class="tag-pill text-white shadow-sm"
                                                   style="background-color: {{ $tag->cor ?? '#8C5A3C' }}; font-size: 0.72rem; padding: 0.2rem 0.55rem;"
                                                   title="{{ $tag->tipo }}: {{ $tag->descricao }}">
                                                    {{ $tag->tag }}
                                                </a>
                                            @endforeach
                                        @else
                                            <span class="text-muted small fst-italic">Sem tags</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="text-end">
                                    <div class="d-flex justify-content-end gap-1">
                                        <a href="{{ route('livraria.edit', $item->id) }}" class="btn btn-sm btn-outline-warning rounded-2" title="Editar Livro">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form action="{{ route('livraria.destroy', $item->id) }}" method="POST" 
                                              onsubmit="return confirm('Tem certeza que deseja excluir este livro? A imagem da capa, e-book e hashtags vinculadas também serão removidas.')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger rounded-2" title="Excluir Livro">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@else
    <div class="card card-custom p-5 text-center">
        <div class="mb-3">
            <i class="bi bi-journal-x text-muted" style="font-size: 3.5rem;"></i>
        </div>
        <h5 class="fw-bold text-dark">Nenhum livro encontrado</h5>
        <p class="text-muted small mb-4">Tente outra busca ou cadastre um novo exemplar com capa na livraria.</p>
        <a href="{{ route('livraria.create') }}" class="btn btn-primary rounded-pill px-4 mx-auto">
            <i class="bi bi-plus-circle me-1"></i> Cadastrar Livro
        </a>
    </div>
@endif

@endsection

@push('scripts')
<script>
    function alternarModo(modo) {
        const visaoRetrato = document.getElementById('visaoRetrato');
        const visaoTabela = document.getElementById('visaoTabela');
        const btnRetrato = document.getElementById('btnModoRetrato');
        const btnTabela = document.getElementById('btnModoTabela');

        if (!visaoRetrato || !visaoTabela) return;

        if (modo === 'tabela') {
            visaoRetrato.classList.add('d-none');
            visaoTabela.classList.remove('d-none');
            btnTabela.classList.add('active');
            btnRetrato.classList.remove('active');
            localStorage.setItem('livraria_view_mode', 'tabela');
        } else {
            visaoTabela.classList.add('d-none');
            visaoRetrato.classList.remove('d-none');
            btnRetrato.classList.add('active');
            btnTabela.classList.remove('active');
            localStorage.setItem('livraria_view_mode', 'retrato');
        }
    }

    // Lembra a preferência do usuário salva no navegador
    document.addEventListener('DOMContentLoaded', function() {
        const modoSalvo = localStorage.getItem('livraria_view_mode');
        if (modoSalvo === 'tabela') {
            alternarModo('tabela');
        }
    });
</script>
@endpush
