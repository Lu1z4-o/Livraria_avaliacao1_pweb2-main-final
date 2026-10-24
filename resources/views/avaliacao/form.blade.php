@extends('layout')

@section('titulo', (!empty($data->id) ? 'Editar resenha' : 'Nova resenha') . ' - Livraria Acácia')

@section('conteudo')

<div class="row justify-content-center">
    <div class="col-lg-8 col-xl-7">

        <!-- Breadcrumbs -->
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb small">
                <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-decoration-none text-muted">Início</a></li>
                <li class="breadcrumb-item"><a href="{{ route('avaliacao.index') }}" class="text-decoration-none text-muted">Avaliações</a></li>
                <li class="breadcrumb-item active text-dark fw-semibold" aria-current="page">
                    {{ !empty($data->id) ? 'Editar resenha' : 'Nova resenha' }}
                </li>
            </ol>
        </nav>

        <div class="card card-custom">
            <div class="card-header-custom d-flex align-items-center justify-content-between">
                <div>
                    <h4 class="brand-font mb-0 text-dark d-flex align-items-center gap-2">
                        <i class="bi bi-star-fill text-warning"></i>
                        {{ !empty($data->id) ? 'Editar resenha' : 'Registrar Nova resenha' }}
                    </h4>
                    <small class="text-muted">Compartilhe suas reflexões e nota sobre uma obra que você leu.</small>
                </div>
                <span class="badge bg-warning-subtle text-dark border border-warning-subtle rounded-pill px-3 py-2 small">
                    Resenha
                </span>
            </div>

            <div class="card-body p-4 p-md-5">
                @php
                    $action = !empty($data->id) ? route('avaliacao.update', $data->id) : route('avaliacao.store');
                @endphp

                <form action="{{ $action }}" method="POST">
                    @csrf
                    @if (!empty($data->id))
                        @method('PUT')
                    @endif

                    <input type="hidden" name="id" value="{{ old('id', $data->id ?? '') }}">

                    <!-- livro da avaliação -->
                    <div class="mb-4">
                        <label for="livro_id" class="form-label fw-bold text-dark d-flex justify-content-between align-items-center">
                            <span><i class="bi bi-book me-1 text-primary"></i>Livro resenhado  <span class="text-danger">*</span></span>
                            <span class="badge bg-secondary-subtle text-secondary small">1 Livro </span>
                        </label>
                        @php
                            $livroSelecionado = old('livro_id', $data->livro_id ?? ($selectedLivroId ?? ''));
                        @endphp
                        <select name="livro_id" id="livro_id" class="form-select form-select-lg rounded-3 @error('livro_id') is-invalid @enderror" required>
                            <option value="">-- Selecione o livro a ser resenhado --</option>
                            @foreach ($livros as $livro)
                                <option value="{{ $livro->id }}" 
                                    data-autor="{{ $livro->autor }}"
                                    {{ (string)$livroSelecionado === (string)$livro->id ? 'selected' : '' }}>
                                    {{ $livro->nome }} ({{ $livro->autor }})
                                </option>
                            @endforeach
                        </select>
                        <div class="form-text small">Selecione uma obra do catálogo da Livraria para vincular esta resenha.</div>
                        @error('livro_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row g-3 mb-4">
                        
                        <div class="col-md-6">
                            <label for="autor" class="form-label fw-bold text-dark">
                                <i class="bi bi-person me-1 text-secondary"></i>Autor(a) da Resenha / Crítico
                            </label>
                            <input type="text" name="autor" id="autor" class="form-control rounded-3 @error('autor') is-invalid @enderror"
                                placeholder="Seu nome ou apelido de leitor..." 
                                value="{{ old('autor', $data->autor ?? '') }}">
                            @error('autor')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        
                        <div class="col-md-6">
                            <label for="data" class="form-label fw-bold text-dark">
                                <i class="bi bi-calendar-check me-1 text-info"></i>Data de Conclusão da Leitura
                            </label>
                            <input type="date" name="data" id="data" class="form-control rounded-3 @error('data') is-invalid @enderror"
                                value="{{ old('data', isset($data->data) ? date('Y-m-d', strtotime($data->data)) : '') }}">
                            @error('data')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                  
                    <div class="mb-4">
                        <label for="avaliacao" class="form-label fw-bold text-dark">
                            <i class="bi bi-chat-quote me-1 text-warning"></i>O que achei do livro<span class="text-danger">*</span>
                        </label>
                        <textarea name="avaliacao" id="avaliacao" rows="4" class="form-control rounded-3 @error('avaliacao') is-invalid @enderror"
                            placeholder="Escreva sua opinião sincera sobre a leitura, personagens, reviravoltas e o desfecho..." required>{{ old('avaliacao', $data->avaliacao ?? '') }}</textarea>
                        @error('avaliacao')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    
                    <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                        <a href="{{ route('avaliacao.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                            <i class="bi bi-arrow-left me-1"></i> Voltar
                        </a>
                        <button type="submit" class="btn btn-primary rounded-pill px-5 shadow-sm">
                            <i class="bi bi-check2-circle me-1"></i> {{ !empty($data->id) ? 'Atualizar Resenha' : 'Publicar Resenha' }}
                        </button>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>

@endsection
