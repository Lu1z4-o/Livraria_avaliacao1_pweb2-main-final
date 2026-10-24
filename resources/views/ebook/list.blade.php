@extends('layout')

@section('titulo', 'E-books - Livraria Acácia')

@section('conteudo')

<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-1 small">
                <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-decoration-none text-muted">Início</a></li>
                <li class="breadcrumb-item active text-dark fw-semibold" aria-current="page">E-books</li>
            </ol>
        </nav>
        <h2 class="brand-font mb-1 d-flex align-items-center gap-2">
            <i class="bi bi-tablet text-info"></i> Catálogo de E-books Digitais
        </h2>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('ebook.create') }}" class="btn btn-primary d-inline-flex align-items-center gap-2 px-3 py-2 rounded-pill shadow-sm">
            <i class="bi bi-plus-circle"></i>
            <span>Novo E-book</span>
        </a>
    </div>
</div>

<!-- busca -->
<div class="card card-custom mb-4">
    <div class="card-body p-3 p-md-4">
        <form action="{{ route('ebook.search') }}" method="POST" class="row g-3 align-items-end">
            @csrf
            <div class="col-12 col-md-3">
                <label for="tipo" class="form-label small fw-bold text-muted">Buscar por</label>
                <select name="tipo" id="tipo" class="form-select rounded-3">
                    <option value="titulo" {{ request('tipo') == 'titulo' ? 'selected' : '' }}>Título do E-book</option>
                    <option value="livro" {{ request('tipo') == 'livro' ? 'selected' : '' }}>Livro Físico Vinculado</option>
                    <option value="autor" {{ request('tipo') == 'autor' ? 'selected' : '' }}>Autor</option>
                    <option value="editora" {{ request('tipo') == 'editora' ? 'selected' : '' }}>Editora Digital</option>
                    <option value="sinopse" {{ request('tipo') == 'sinopse' ? 'selected' : '' }}>Sinopse</option>
                    <option value="tamanho_do_arquivo" {{ request('tipo') == 'tamanho_do_arquivo' ? 'selected' : '' }}>Tamanho do Arquivo</option>
                </select>
            </div>
            <div class="col-12 col-md-6">
                <label for="valor" class="form-label small fw-bold text-muted">Termo de Pesquisa</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0 rounded-start-3 text-muted">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" name="valor" id="valor" class="form-control border-start-0 rounded-end-3" 
                        placeholder="Pesquisar por título, autor, editora ou formato..." value="{{ request('valor') }}">
                </div>
            </div>
            <div class="col-12 col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-primary flex-grow-1 rounded-3">
                    <i class="bi bi-search me-1"></i> Buscar
                </button>
                <a href="{{ route('ebook.index') }}" class="btn btn-outline-secondary rounded-3" title="Recarregar e-books">
                    <i class="bi bi-arrow-counterclockwise"></i>
                </a>
            </div>
        </form>
    </div>
</div>


<div class="card card-custom overflow-hidden">
    <div class="card-header-custom d-flex justify-content-between align-items-center">
        <span class="fw-bold text-dark">
            <i class="bi bi-tablet-landscape me-2 text-info"></i>E-books Cadastrados
        </span>
        <span class="badge bg-secondary-subtle text-secondary rounded-pill px-3 py-2">
            Total: {{ $dados->count() }} exemplar(es)
        </span>
    </div>

    @if($dados->count() > 0)
        <div class="table-responsive">
            <table class="table table-custom table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th style="width: 60px;"># ID</th>
                        <th style="min-width: 220px;">Livro Físico</th>
                        <th>Título & Autor</th>
                        <th>Editora Digital</th>
                        <th>Páginas</th>
                        <th>Tamanho</th>
                        <th>Sinopse</th>
                        <th class="text-end" style="width: 140px;">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dados as $item)
                        <tr>
                            <td class="fw-bold text-muted">#{{ $item->id }}</td>
                            <td>
                                @if($item->livro)
                                    <div>
                                        <a href="{{ route('livraria.edit', $item->livro->id) }}" class="fw-bold text-dark text-decoration-none hover-primary fs-6" title="Ver livro físico associado">
                                            <i class="bi bi-book-half me-1 text-primary"></i>{{ $item->livro->nome }}
                                        </a>
                                        <div class="small text-muted">
                                            R$ {{ number_format($item->livro->valor, 2, ',', '.') }} &bull; {{ $item->livro->autor }}
                                        </div>
                                    </div>
                                    <span class="badge bg-info-subtle text-info border border-info-subtle rounded-pill mt-1 small">
                                        <i class="bi bi-link-45deg me-1"></i>Vinculado
                                    </span>
                                @else
                                    <span class="text-danger small fst-italic">Sem vínculo físico</span>
                                @endif
                            </td>
                            <td>
                                <div class="fw-bold text-dark fs-6">{{ $item->titulo }}</div>
                                <div class="small text-muted"><i class="bi bi-pen me-1"></i>{{ $item->autor }}</div>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark border px-2 py-1">
                                    <i class="bi bi-building me-1 text-muted"></i>{{ $item->editora }}
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark border px-2 py-1">
                                    <i class="bi bi-file-earmark-text me-1 text-secondary"></i>{{ $item->numero_de_paginas }} págs.
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-secondary text-white px-2 py-1 font-monospace">
                                    <i class="bi bi-file-earmark-arrow-down me-1"></i>{{ $item->tamanho_do_arquivo }}
                                </span>
                            </td>
                            <td class="small text-secondary" style="max-width: 260px;">
                                {{ Str::limit($item->sinopse, 100) ?: '—' }}
                            </td>
                            <td class="text-end">
                                <div class="d-flex justify-content-end gap-1">
                                    <a href="{{ route('ebook.edit', $item->id) }}" class="btn btn-sm btn-outline-warning rounded-2" title="Editar E-book">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('ebook.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja remover este e-book?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger rounded-2" title="Excluir E-book">
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
                <i class="bi bi-tablet text-muted" style="font-size: 3.5rem;"></i>
            </div>
            <h5 class="fw-bold text-dark">Nenhum e-book cadastrado</h5>
            <p class="text-muted small mb-4">Adicione versões digitais do seu catálogo.</p>
            <a href="{{ route('ebook.create') }}" class="btn btn-primary rounded-pill px-4">
                <i class="bi bi-plus-circle me-1"></i> Cadastrar Primeiro E-book
            </a>
        </div>
    @endif
</div>

@endsection
