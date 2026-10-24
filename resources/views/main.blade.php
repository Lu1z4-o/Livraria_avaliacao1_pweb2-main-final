@extends('layout')

@section('titulo', 'Página Inicial - Livraria Acácia')

@section('conteudo')

<style>
    .hero-banner {
        background: linear-gradient(135deg, #22130B 0%, #3E2012 45%, #8C5A3C 100%);
        border-radius: 20px;
        box-shadow: 0 16px 36px rgba(34, 19, 11, 0.22);
        position: relative;
        overflow: hidden;
    }

    .hero-banner::after {
        content: '';
        position: absolute;
        top: -40%;
        right: -10%;
        width: 380px;
        height: 380px;
        background: radial-gradient(circle, rgba(221, 161, 94, 0.25) 0%, rgba(221, 161, 94, 0) 70%);
        border-radius: 50%;
        pointer-events: none;
    }

    .card-hover {
        transition: transform 0.25s cubic-bezier(0.165, 0.84, 0.44, 1), box-shadow 0.25s ease;
    }

    .card-hover:hover {
        transform: translateY(-5px);
        box-shadow: 0 14px 28px rgba(42, 24, 16, 0.09) !important;
    }

    .stat-card {
        border-radius: 16px;
        background: #FFFFFF;
        border: 1px solid #EADBCE;
    }
</style>


<div class="card border-0 text-white mb-5 hero-banner">
    <div class="card-body p-4 p-md-5 position-relative" style="z-index: 2;">
        <span class="badge bg-warning text-dark mb-3 px-3 py-2 rounded-pill fw-bold">
            <i class="bi bi-stars me-1"></i> Acervo Literário & Tropes
        </span>
        <h1 class="display-5 brand-font fw-bold mb-3 text-white">Explore Histórias e Conecte Tropes Literários</h1>
        <p class="col-lg-8 fs-5 text-light opacity-90 mb-4 fw-light">
            Descubra autores, gerencie o acervo da Livraria Acácia e explore os livros por suas <strong># hashtags e tropes</strong> característicos como <em>#enemies-to-lovers</em> e <em>#highschool</em>.
        </p>
        <div class="d-flex gap-3 flex-wrap">
            <a href="{{ route('livraria.index') }}" class="btn btn-light btn-lg text-dark fw-semibold px-4 rounded-pill shadow-sm">
                <i class="bi bi-journal-bookmark me-2 text-primary"></i>Ver Acervo Completo
            </a>
            <a href="{{ route('ebook.index') }}" class="btn btn-info btn-lg text-dark fw-bold px-4 rounded-pill shadow-sm">
                <i class="bi bi-tablet me-1"></i>E-books 
            </a>
            <a href="{{ route('hashtag.index') }}" class="btn btn-warning btn-lg text-dark fw-bold px-4 rounded-pill shadow-sm">
                <i class="bi bi-hash me-1"></i>Hashtags 
            </a>
            <a href="{{ route('relatorios.index') }}" class="btn btn-outline-light btn-lg px-4 rounded-pill">
                <i class="bi bi-pie-chart-fill me-2 text-warning"></i>Gráficos & PDFs
            </a>
        </div>
    </div>
</div>

<!-- numeros que estavam nos contadores -->
<div class="row g-3 mb-5">
    <div class="col-6 col-md-3">
        <div class="card text-center p-3 p-md-4 h-100 stat-card card-hover">
            <div class="d-inline-flex align-items-center justify-content-center mx-auto mb-2 rounded-circle bg-primary-subtle text-primary" style="width: 48px; height: 48px;">
                <i class="bi bi-book fs-4"></i>
            </div>
            <h3 class="fw-bold mb-0 text-dark">{{ $totalLivros ?? 0 }}</h3>
            <small class="text-muted fw-semibold">Livros no Acervo</small>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card text-center p-3 p-md-4 h-100 stat-card card-hover">
            <div class="d-inline-flex align-items-center justify-content-center mx-auto mb-2 rounded-circle bg-danger-subtle text-danger" style="width: 48px; height: 48px;">
                <i class="bi bi-hash fs-4"></i>
            </div>
            <h3 class="fw-bold mb-0 text-dark">{{ $totalHashtags ?? 0 }}</h3>
            <small class="text-muted fw-semibold">Hashtags & Tropes</small>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card text-center p-3 p-md-4 h-100 stat-card card-hover">
            <div class="d-inline-flex align-items-center justify-content-center mx-auto mb-2 rounded-circle bg-warning-subtle text-warning" style="width: 48px; height: 48px;">
                <i class="bi bi-star-fill fs-4"></i>
            </div>
            <h3 class="fw-bold mb-0 text-dark">{{ $totalAvaliacoes ?? 0 }}</h3>
            <small class="text-muted fw-semibold">Avaliações Feitas</small>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card text-center p-3 p-md-4 h-100 stat-card card-hover">
            <div class="d-inline-flex align-items-center justify-content-center mx-auto mb-2 rounded-circle bg-success-subtle text-success" style="width: 48px; height: 48px;">
                <i class="bi bi-people-fill fs-4"></i>
            </div>
            <h3 class="fw-bold mb-0 text-dark">{{ $totalUsuarios ?? 0 }}</h3>
            <small class="text-muted fw-semibold">Leitores Cadastrados</small>
        </div>
    </div>
</div>


<div class="card card-custom p-4 mb-5">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2 mb-3">
        <div>
            <span class="badge bg-danger-subtle text-danger rounded-pill px-3 py-1 fw-bold small">
                Tropes Literários &bull; 
            </span>
            <h3 class="brand-font m-0 mt-1 d-flex align-items-center gap-2 text-dark">
                <i class="bi bi-hash text-danger"></i> Tropes & Hashtags dos Livros
            </h3>
        </div>
        <a href="{{ route('hashtag.index') }}" class="btn btn-outline-danger btn-sm rounded-pill px-3">
            Ver todas as # Hashtags <i class="bi bi-arrow-right ms-1"></i>
        </a>
    </div>

    <div class="d-flex flex-wrap gap-2">
        @if(isset($hashtagsPopulares) && $hashtagsPopulares->count() > 0)
            @foreach($hashtagsPopulares as $tag)
                <a href="{{ route('hashtag.index') }}" 
                   class="tag-pill text-white shadow-sm"
                   style="background-color: {{ $tag->cor ?? '#8C5A3C' }}; font-size: 0.85rem;"
                   title="{{ $tag->tipo }}: {{ $tag->descricao }} (Presente em {{ $tag->livros_count ?? $tag->livros->count() }} livro(s))">
                    <i class="bi bi-hash me-1"></i>{{ ltrim($tag->tag, '#') }}
                    <span class="ms-1 opacity-75 small">({{ $tag->livros_count ?? $tag->livros->count() }} livros)</span>
                </a>
            @endforeach
        @else
            <span class="text-muted small">Nenhuma hashtag cadastrada ainda.</span>
        @endif
        <a href="{{ route('hashtag.create') }}" class="btn btn-sm btn-outline-secondary rounded-pill px-3 py-1 d-inline-flex align-items-center gap-1">
            <i class="bi bi-plus"></i> Adicionar Nova #
        </a>
    </div>
</div>

<!-- rota para ver os livros direto -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="brand-font m-0 text-dark">Últimos Livros Adicionados</h3>
        <small class="text-muted">Exemplares com suas respectivas categorias e hashtags vinculadas</small>
    </div>
    <a href="{{ route('livraria.index') }}" class="text-decoration-none fw-semibold" style="color: #8C5A3C;">
        Ver catálogo completo <i class="bi bi-arrow-right ms-1"></i>
    </a>
</div>

<div class="row row-cols-1 row-cols-md-3 g-4 mb-5">
    @forelse ($livrosDestaque ?? [] as $livro)
        <div class="col">
            <div class="card h-100 card-hover card-custom overflow-hidden">
                <!-- livrinhos -->
                <div style="position: relative; width: 100%; padding-top: 100%; background: #2B170C; overflow: hidden;">
                    <div style="position: absolute; top: 0; left: 0; bottom: 0; width: 8px; background: linear-gradient(to right, rgba(0,0,0,0.5), rgba(255,255,255,0.15) 60%, rgba(0,0,0,0.2)); z-index: 2;"></div>
                    <span style="position: absolute; top: 12px; right: 12px; z-index: 3;" class="badge bg-dark bg-opacity-75 text-white border border-light border-opacity-25 rounded-pill px-3 py-2 fw-bold">
                        R$ {{ number_format((float)$livro->valor, 2, ',', '.') }}
                    </span>

                    @if($livro->imagem && \Illuminate\Support\Facades\Storage::disk('public')->exists($livro->imagem))
                        <img src="{{ asset('storage/' . $livro->imagem) }}" alt="{{ $livro->nome }}" 
                             style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;">
                    @else
                        <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; display: flex; flex-direction: column; justify-content: space-between; padding: 1.25rem; color: #FAF4EB; background: linear-gradient(145deg, #26140B 0%, #452414 50%, #6E381C 100%); box-shadow: inset 6px 0 12px rgba(0,0,0,0.45);">
                            <div class="d-flex justify-content-between align-items-start">
                                <span class="badge bg-white bg-opacity-25 rounded-pill small" style="font-size: 0.65rem;">
                                    {{ $livro->categoriaLivro?->categoria ?? 'Acervo' }}
                                </span>
                                <i class="bi bi-book text-warning opacity-75 fs-5"></i>
                            </div>
                            <div class="my-auto py-2 text-center">
                                <h5 class="brand-font text-white mb-1" style="font-size: 1.1rem; line-height: 1.3;">
                                    {{ Str::limit($livro->nome, 35) }}
                                </h5>
                                <p class="small text-light opacity-75 mb-0" style="font-size: 0.8rem;">
                                    {{ $livro->autor ?: 'Autor Desconhecido' }}
                                </p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center small text-white-50 border-top border-light border-opacity-25 pt-2" style="font-size: 0.7rem;">
                                <span>{{ $livro->genero ?: 'Literatura' }}</span>
                                <i class="bi bi-bookmark-fill text-warning"></i>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="card-body d-flex flex-column p-4">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <span class="badge bg-secondary-subtle text-dark px-3 py-1 rounded-pill small">
                            {{ $livro->genero ?: 'Literatura' }}
                        </span>
                        <span class="badge bg-warning-subtle text-dark border border-warning-subtle px-2 py-1 small">
                            {{ $livro->categoriaLivro?->categoria ?? 'Sem Categoria' }}
                        </span>
                    </div>

                    <h5 class="card-title brand-font fs-5 text-dark mb-1 text-truncate" title="{{ $livro->nome }}">{{ $livro->nome }}</h5>
                    <p class="card-text text-muted small mb-3">
                        <i class="bi bi-pen me-1"></i>{{ $livro->autor ?: 'Autor Desconhecido' }}
                    </p>

                
                    <div class="mb-3">
                        <small class="text-muted fw-bold d-block mb-1" style="font-size: 0.72rem;">TROPES & HASHTAGS:</small>
                        <div class="d-flex flex-wrap gap-1">
                            @if($livro->hashtags && $livro->hashtags->count() > 0)
                                @foreach($livro->hashtags as $h)
                                    <span class="badge rounded-pill text-white" 
                                          style="background-color: {{ $h->cor ?? '#8C5A3C' }}; font-size: 0.7rem;"
                                          title="{{ $h->tipo }}: {{ $h->descricao }}">
                                        {{ $h->tag }}
                                    </span>
                                @endforeach
                            @else
                                <span class="text-muted small fst-italic" style="font-size: 0.75rem;">Nenhuma tag vinculada</span>
                            @endif
                        </div>
                    </div>

                    <div class="mt-auto pt-3 border-top d-flex gap-2">
                        <a href="{{ route('livraria.edit', $livro->id) }}" class="btn btn-outline-primary btn-sm flex-grow-1 rounded-pill">
                            <i class="bi bi-pencil me-1"></i> Detalhes & Capa
                        </a>
                        <a href="{{ route('hashtag.create', ['livro_id' => $livro->id]) }}" class="btn btn-sm btn-outline-danger rounded-pill px-3" title="Adicionar # hashtag">
                            <i class="bi bi-hash"></i> + #
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="p-4 text-center text-muted">
                Nenhum livro no catálogo ainda.
            </div>
        </div>
    @endforelse
</div>


<div class="card card-custom p-4 mb-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="brand-font m-0 text-dark">
                <i class="bi bi-chat-quote text-warning me-2"></i>O que os leitores estão dizendo
            </h4>
            <small class="text-muted">Opiniões sinceras da comunidade de leitores da livraria</small>
        </div>
        <a href="{{ route('avaliacao.index') }}" class="btn btn-outline-primary btn-sm rounded-pill px-3">
            Ver todas
        </a>
    </div>

    <div class="row g-3">
        @forelse ($ultimasAvaliacoes ?? [] as $avaliacao)
            <div class="col-md-6">
                <div class="p-3 border rounded-3 bg-light h-100">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <strong class="text-dark fs-6">{{ $avaliacao->livro->nome ?? 'Obra do Acervo' }}</strong>
                        <div class="text-warning small">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                        </div>
                    </div>
                    <p class="mb-2 small text-secondary fst-italic">
                        "{{ Str::limit($avaliacao->avaliacao, 140) }}"
                    </p>
                    <div class="d-flex justify-content-between align-items-center">
                        <small class="text-muted fw-semibold">Autor: <em>{{ $avaliacao->autor ?: '—' }}</em></small>
                        @if($avaliacao->data)
                            <small class="text-muted" style="font-size: 0.75rem;">{{ date('d/m/Y', strtotime($avaliacao->data)) }}</small>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center text-muted py-3">
                Nenhuma avaliação cadastrada ainda.
            </div>
        @endforelse
    </div>
</div>

@endsection