@extends('layout')

@section('titulo', 'Hashtags & Tropes dos Livros - Livraria Acácia')

@section('conteudo')

<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-1 small">
                <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-decoration-none text-muted">Início</a></li>
                <li class="breadcrumb-item active text-dark fw-semibold" aria-current="page">Hashtags (#)</li>
            </ol>
        </nav>
        <h2 class="brand-font mb-1 d-flex align-items-center gap-2">
            <i class="bi bi-hash text-danger"></i> Hashtags & Tropes dos Livros
        </h2>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('hashtag.create') }}" class="btn btn-primary d-inline-flex align-items-center gap-2 px-3 py-2 rounded-pill shadow-sm">
            <i class="bi bi-plus-circle"></i>
            <span>Nova Hashtag</span>
        </a>
    </div>
</div>

<div class="card card-custom mb-4">
    <div class="card-body p-3 p-md-4">
        <form action="{{ route('hashtag.search') }}" method="POST" class="row g-3 align-items-end">
            @csrf
            <div class="col-12 col-md-3">
                <label for="tipo" class="form-label small fw-bold text-muted">Buscar por</label>
                <select name="tipo" id="tipo" class="form-select rounded-3">
                    <option value="tag" {{ request('tipo') == 'tag' ? 'selected' : '' }}>Hashtag (#)</option>
                    <option value="livro" {{ request('tipo') == 'livro' ? 'selected' : '' }}>Livro Vinculado</option>
                    <option value="tipo" {{ request('tipo') == 'tipo' ? 'selected' : '' }}>Tipo / Classificação</option>
                    <option value="descricao" {{ request('tipo') == 'descricao' ? 'selected' : '' }}>Descrição</option>
                </select>
            </div>
            <div class="col-12 col-md-6">
                <label for="valor" class="form-label small fw-bold text-muted">Termo de Pesquisa</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0 rounded-start-3 text-muted">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" name="valor" id="valor" class="form-control border-start-0 rounded-end-3" 
                        placeholder="Ex: enemies to lovers, highschool, nome do livro..." value="{{ request('valor') }}">
                </div>
            </div>
            <div class="col-12 col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-primary flex-grow-1 rounded-3">
                    <i class="bi bi-filter me-1"></i> Filtrar
                </button>
                <a href="{{ route('hashtag.index') }}" class="btn btn-outline-secondary rounded-3" title="Limpar Filtros">
                    <i class="bi bi-arrow-counterclockwise"></i>
                </a>
            </div>
        </form>

        @if(isset($livros) && $livros->count() > 0)
            <div class="pt-3 mt-3 border-top d-flex align-items-center flex-wrap gap-2 small">
                <span class="text-muted fw-bold"><i class="bi bi-funnel me-1"></i>Filtrar por Livro:</span>
                <a href="{{ route('hashtag.index') }}" class="badge rounded-pill {{ empty($filtroLivroId) ? 'bg-dark text-white' : 'bg-light text-dark border' }} text-decoration-none px-3 py-2">
                    Todos ({{ $dados->count() }})
                </a>
                @foreach($livros->take(6) as $livro)
                    <a href="{{ route('hashtag.index', ['livro_id' => $livro->id]) }}" 
                       class="badge rounded-pill {{ (string)$filtroLivroId === (string)$livro->id ? 'bg-primary text-white' : 'bg-light text-dark border' }} text-decoration-none px-3 py-2">
                        {{ Str::limit($livro->nome, 20) }}
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</div>

<!-- tabelas de lista geral -->
<div class="card card-custom overflow-hidden">
    <div class="card-header-custom d-flex justify-content-between align-items-center">
        <span class="fw-bold text-dark">
            <i class="bi bi-table me-2 text-primary"></i>Listagem de Hashtags Cadastradas
        </span>
        <span class="badge bg-secondary-subtle text-secondary rounded-pill px-3 py-2">
            Total: {{ $dados->count() }} registro(s)
        </span>
    </div>

    @if($dados->count() > 0)
        <div class="table-responsive">
            <table class="table table-custom table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th style="width: 60px;"># ID</th>
                        <th>Hashtag</th>
                        <th style="min-width: 220px;">Livros Vinculados</th>
                        <th>Classificação</th>
                        <th>Descrição da trope</th>
                        <th class="text-end" style="width: 150px;">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dados as $item)
                        <tr>
                            <td class="fw-bold text-muted">#{{ $item->id }}</td>
                            <td>
                                <span class="tag-pill text-white shadow-sm" style="background-color: {{ $item->cor ?? '#8C5A3C' }};">
                                    <i class="bi bi-hash me-1"></i>{{ ltrim($item->tag, '#') }}
                                </span>
                            </td>
                            <td>
                                @if($item->livros && $item->livros->count() > 0)
                                    <div class="d-flex flex-wrap gap-1">
                                        @foreach($item->livros as $livro)
                                            <a href="{{ route('livraria.edit', $livro->id) }}" class="badge bg-light text-dark border text-decoration-none p-1 px-2 rounded-2" title="{{ $livro->autor }}">
                                                <i class="bi bi-book me-1 text-primary"></i>{{ Str::limit($livro->nome, 25) }}
                                            </a>
                                        @endforeach
                                    </div>
                                    <small class="text-muted d-block mt-1">Total: {{ $item->livros->count() }} livro(s)</small>
                                @else
                                    <span class="text-muted small fst-italic">Nenhum livro vinculado</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-light text-dark border px-2 py-1 rounded-pill">
                                    {{ $item->tipo }}
                                </span>
                            </td>
                            <td class="small text-secondary" style="max-width: 280px;">
                                {{ $item->descricao ?: '—' }}
                            </td>
                            <td class="text-end">
                                <div class="d-flex justify-content-end gap-1">
                                    <a href="{{ route('hashtag.edit', $item->id) }}" class="btn btn-sm btn-outline-warning rounded-2" title="Editar Hashtag">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('hashtag.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir esta hashtag permanentemente?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger rounded-2" title="Excluir Hashtag">
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
    @else
        <div class="p-5 text-center">
            <div class="mb-3">
                <i class="bi bi-hash text-muted" style="font-size: 3.5rem;"></i>
            </div>
            <h5 class="fw-bold text-dark">Nenhuma hashtag encontrada</h5>
            <p class="text-muted small mb-4">Cadastre novas hashtags aos livros da livraria ou ajuste seus filtros de busca.</p>
            <a href="{{ route('hashtag.create') }}" class="btn btn-primary rounded-pill px-4">
                <i class="bi bi-plus-circle me-1"></i> Adicionar Primeira Hashtag
            </a>
        </div>
    @endif
</div>

@endsection

