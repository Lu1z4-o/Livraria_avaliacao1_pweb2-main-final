@extends('layout')

@section('titulo', 'Resenhas Literárias - Livraria Acácia')

@section('conteudo')

<!-- Cabeçalho -->
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-1 small">
                <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-decoration-none text-muted">Início</a></li>
                <li class="breadcrumb-item active text-dark fw-semibold" aria-current="page">Avaliações</li>
            </ol>
        </nav>
        <h2 class="brand-font mb-1 d-flex align-items-center gap-2">
            <i class="bi bi-star-fill text-warning"></i> Resenhas dos Leitores
        </h2>
        <p class="text-muted mb-0 small">
            Opiniões e impressões deixadas pela nossa comunidade de leitura.
        </p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('avaliacao.create') }}" class="btn btn-primary d-inline-flex align-items-center gap-2 px-3 py-2 rounded-pill shadow-sm">
            <i class="bi bi-plus-circle"></i>
            <span>Nova Resenha</span>
        </a>
    </div>
</div>


<div class="card card-custom mb-4">
    <div class="card-body p-3 p-md-4">
        <form action="{{ route('avaliacao.search') }}" method="POST" class="row g-3 align-items-end">
            @csrf
            <div class="col-12 col-md-3">
                <label for="tipo" class="form-label small fw-bold text-muted">Buscar por</label>
                <select name="tipo" id="tipo" class="form-select rounded-3">
                    <option value="livro" {{ request('tipo') == 'livro' ? 'selected' : '' }}>Título do Livro</option>
                    <option value="autor" {{ request('tipo') == 'autor' ? 'selected' : '' }}>Autor da Resenha</option>
                    <option value="avaliacao" {{ request('tipo') == 'avaliacao' ? 'selected' : '' }}>Conteúdo da Resenha</option>
                    <option value="data" {{ request('tipo') == 'data' ? 'selected' : '' }}>Data da Leitura</option>
                </select>
            </div>
            <div class="col-12 col-md-6">
                <label for="valor" class="form-label small fw-bold text-muted">Termo de Pesquisa</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0 rounded-start-3 text-muted">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" name="valor" id="valor" class="form-control border-start-0 rounded-end-3" 
                        placeholder="Pesquisar por livro, autor ou resenha..." value="{{ request('valor') }}">
                </div>
            </div>
            <div class="col-12 col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-primary flex-grow-1 rounded-3">
                    <i class="bi bi-search me-1"></i> Buscar
                </button>
                <a href="{{ route('avaliacao.index') }}" class="btn btn-outline-secondary rounded-3" title="Recarregar avaliações">
                    <i class="bi bi-arrow-counterclockwise"></i>
                </a>
            </div>
        </form>
    </div>
</div>

<!-- Tabela de Avaliações -->
<div class="card card-custom overflow-hidden">
    <div class="card-header-custom d-flex justify-content-between align-items-center">
        <span class="fw-bold text-dark">
            <i class="bi bi-chat-heart me-2 text-warning"></i>Lista de Avaliações
        </span>
        <span class="badge bg-secondary-subtle text-secondary rounded-pill px-3 py-2">
            Total: {{ $dados->count() }} resenha(s)
        </span>
    </div>

    @if($dados->count() > 0)
        <div class="table-responsive">
            <table class="table table-custom table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th style="width: 60px;"># ID</th>
                        <th>Livro & Autor</th>
                        <th>Data de Conclusão</th>
                        <th>Resenha</th>
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
                                        <a href="{{ route('livraria.edit', $item->livro->id) }}" class="fw-bold text-dark text-decoration-none hover-primary fs-6" title="Ver livro no catálogo">
                                            <i class="bi bi-book me-1 text-primary"></i>{{ $item->livro->nome }}
                                        </a>
                                        <div class="small text-muted"><i class="bi bi-pen me-1"></i>Autor da Resenha: {{ $item->livro->autor }}</div>
                                    </div>
                                @else
                                    <span class="text-danger small fst-italic">Livro não vinculado</span>
                                @endif
                                @if($item->autor)
                                    <div class="small text-secondary mt-1"><i class="bi bi-person me-1"></i>Crítico/Leitor: <strong>{{ $item->autor }}</strong></div>
                                @endif
                            </td>
                            <td>
                                @if($item->data)
                                    <span class="badge bg-light text-dark border px-2 py-1">
                                        <i class="bi bi-calendar3 me-1 text-muted"></i>{{ date('d/m/Y', strtotime($item->data)) }}
                                    </span>
                                @else
                                    <span class="text-muted small">—</span>
                                @endif
                            </td>
                            <td style="max-width: 320px;">
                                <div class="d-flex align-items-center gap-1 text-warning mb-1 small">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-half"></i>
                                </div>
                                <p class="mb-0 small text-secondary fst-italic">
                                    "{{ Str::limit($item->avaliacao, 120) }}"
                                </p>
                            </td>
                            <td class="text-end">
                                <div class="d-flex justify-content-end gap-1">
                                    <a href="{{ route('avaliacao.edit', $item->id) }}" class="btn btn-sm btn-outline-warning rounded-2" title="Editar Avaliação">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('avaliacao.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja remover esta avaliação?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger rounded-2" title="Excluir Avaliação">
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
                <i class="bi bi-chat-square-dots text-muted" style="font-size: 3.5rem;"></i>
            </div>
            <h5 class="fw-bold text-dark">Nenhuma resenha encontrada</h5>
            <p class="text-muted small mb-4">Compartilhe o que você achou de uma leitura cadastrando a primeira resenha.</p>
            <a href="{{ route('avaliacao.create') }}" class="btn btn-primary rounded-pill px-4">
                <i class="bi bi-plus-circle me-1"></i> Escrever Avaliação
            </a>
        </div>
    @endif
</div>

@endsection
