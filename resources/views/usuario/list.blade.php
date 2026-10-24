@extends('layout')

@section('titulo', 'Usuários - Livraria Acácia')

@section('conteudo')

<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-1 small">
                <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-decoration-none text-muted">Início</a></li>
                <li class="breadcrumb-item active text-dark fw-semibold" aria-current="page">Usuários</li>
            </ol>
        </nav>
        <h2 class="brand-font mb-1 d-flex align-items-center gap-2">
            <i class="bi bi-people text-success"></i> Gestão de Usuários
        </h2>
        <p class="text-muted mb-0 small">
            Consulte e gerencie o cadastro de leitores e usuários da Livraria Acácia.
        </p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('usuario.create') }}" class="btn btn-primary d-inline-flex align-items-center gap-2 px-3 py-2 rounded-pill shadow-sm">
            <i class="bi bi-person-plus"></i>
            <span>Novo Usuário</span>
        </a>
    </div>
</div>


<div class="card card-custom mb-4">
    <div class="card-body p-3 p-md-4">
        <form action="{{ route('usuario.search') }}" method="POST" class="row g-3 align-items-end">
            @csrf
            <div class="col-12 col-md-3">
                <label for="tipo" class="form-label small fw-bold text-muted">Buscar por</label>
                <select name="tipo" id="tipo" class="form-select rounded-3">
                    <option value="nome" {{ request('tipo') == 'nome' ? 'selected' : '' }}>Nome Completo</option>
                    <option value="cpf" {{ request('tipo') == 'cpf' ? 'selected' : '' }}>CPF</option>
                    <option value="email" {{ request('tipo') == 'email' ? 'selected' : '' }}>E-mail</option>
                    <option value="telefone" {{ request('tipo') == 'telefone' ? 'selected' : '' }}>Telefone</option>
                    <option value="endereco" {{ request('tipo') == 'endereco' ? 'selected' : '' }}>Endereço</option>
                </select>
            </div>
            <div class="col-12 col-md-6">
                <label for="valor" class="form-label small fw-bold text-muted">Termo de Pesquisa</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0 rounded-start-3 text-muted">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" name="valor" id="valor" class="form-control border-start-0 rounded-end-3" 
                        placeholder="Digite o nome, e-mail ou documento..." value="{{ request('valor') }}">
                </div>
            </div>
            <div class="col-12 col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-primary flex-grow-1 rounded-3">
                    <i class="bi bi-search me-1"></i> Buscar
                </button>
                <a href="{{ route('usuario.index') }}" class="btn btn-outline-secondary rounded-3" title="Recarregar lista">
                    <i class="bi bi-arrow-counterclockwise"></i>
                </a>
            </div>
        </form>
    </div>
</div>

<!-- tabela -->
<div class="card card-custom overflow-hidden">
    <div class="card-header-custom d-flex justify-content-between align-items-center">
        <span class="fw-bold text-dark">
            <i class="bi bi-person-lines-fill me-2 text-success"></i>Usuários Cadastrados
        </span>
        <span class="badge bg-secondary-subtle text-secondary rounded-pill px-3 py-2">
            Total: {{ $dados->count() }} usuário(s)
        </span>
    </div>

    @if($dados->count() > 0)
        <div class="table-responsive">
            <table class="table table-custom table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th style="width: 60px;"># ID</th>
                        <th style="width: 70px;">Foto</th>
                        <th>Nome Completo</th>
                        <th>CPF</th>
                        <th>Contato</th>
                        <th>Endereço</th>
                        <th class="text-end" style="width: 140px;">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dados as $item)
                        <tr>
                            <td class="fw-bold text-muted">#{{ $item->id }}</td>
                            <td>
                                @if(!empty($item->foto))
                                    <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->nome }}" class="rounded-circle border shadow-sm object-fit-cover" style="width: 44px; height: 44px;">
                                @else
                                    <div class="rounded-circle bg-light border d-flex align-items-center justify-content-center text-muted fw-bold" style="width: 44px; height: 44px; font-size: 0.85rem;" title="Sem foto de perfil">
                                        {{ strtoupper(mb_substr($item->nome, 0, 2)) }}
                                    </div>
                                @endif
                            </td>
                            <td>
                                <div class="fw-bold text-dark fs-6">{{ $item->nome }}</div>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark border px-2 py-1 font-monospace">
                                    {{ $item->cpf }}
                                </span>
                            </td>
                            <td>
                                <div class="small text-dark"><i class="bi bi-envelope me-1 text-muted"></i>{{ $item->email }}</div>
                                <div class="small text-muted"><i class="bi bi-telephone me-1 text-muted"></i>{{ $item->telefone }}</div>
                            </td>
                            <td class="small text-secondary" style="max-width: 250px;">
                                {{ $item->endereco }}
                            </td>
                            <td class="text-end">
                                <div class="d-flex justify-content-end gap-1">
                                    <a href="{{ route('usuario.edit', $item->id) }}" class="btn btn-sm btn-outline-warning rounded-2" title="Editar Usuário">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('usuario.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja remover este usuário?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger rounded-2" title="Excluir Usuário">
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
                <i class="bi bi-person-x text-muted" style="font-size: 3.5rem;"></i>
            </div>
            <h5 class="fw-bold text-dark">Nenhum usuário encontrado</h5>
            <p class="text-muted small mb-4">Cadastre novos leitores no sistema ou realize uma nova pesquisa.</p>
            <a href="{{ route('usuario.create') }}" class="btn btn-primary rounded-pill px-4">
                <i class="bi bi-person-plus me-1"></i> Cadastrar Usuário
            </a>
        </div>
    @endif
</div>

@endsection
