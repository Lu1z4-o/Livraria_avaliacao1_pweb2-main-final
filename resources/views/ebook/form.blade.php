@extends('layout')

@section('titulo', (!empty($data->id) ? 'Editar E-book' : 'Novo E-book Digital') . ' - Livraria Acácia')

@section('conteudo')

<div class="row justify-content-center">
    <div class="col-lg-8 col-xl-7">

        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb small">
                <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-decoration-none text-muted">Início</a></li>
                <li class="breadcrumb-item"><a href="{{ route('ebook.index') }}" class="text-decoration-none text-muted">E-books (1:1)</a></li>
                <li class="breadcrumb-item active text-dark fw-semibold" aria-current="page">
                    {{ !empty($data->id) ? 'Editar E-book' : 'Novo Cadastro Digital' }}
                </li>
            </ol>
        </nav>

        <div class="card card-custom">
            <div class="card-header-custom d-flex align-items-center justify-content-between">
                <div>
                    <h4 class="brand-font mb-0 text-dark d-flex align-items-center gap-2">
                        <i class="bi bi-tablet text-info"></i>
                        {{ !empty($data->id) ? 'Editar E-book Digital' : 'Cadastrar Novo E-book' }}
                    </h4>
                </div>
            </div>

            <div class="card-body p-4 p-md-5">
                @php
                    $action = !empty($data->id) ? route('ebook.update', $data->id) : route('ebook.store');
                    $livroSelecionadoId = old('livro_id', $data->livro_id ?? '');
                @endphp

                <form action="{{ $action }}" method="POST">
                    @csrf
                    @if (!empty($data->id))
                        @method('PUT')
                    @endif

                    <input type="hidden" name="id" value="{{ old('id', $data->id ?? '') }}">

                    <!-- vincular -->
                    <div class="mb-4">
                        <label for="livro_id" class="form-label fw-bold text-dark d-flex justify-content-between align-items-center">
                            <span><i class="bi bi-book-half me-1 text-primary"></i>Livro físico associado <span class="text-danger">*</span></span>
                        </label>
                        <select name="livro_id" id="livro_id" class="form-select form-select-lg rounded-3 @error('livro_id') is-invalid @enderror" required>
                            <option value="">-- Selecione a obra física vinculada --</option>
                            @foreach ($livros as $livro)
                                <option value="{{ $livro->id }}" 
                                    data-titulo="{{ $livro->nome }}"
                                    data-autor="{{ $livro->autor }}"
                                    data-sinopse="{{ $livro->sinopse }}"
                                    {{ (string)$livroSelecionadoId === (string)$livro->id ? 'selected' : '' }}>
                                    {{ $livro->nome }} ({{ $livro->autor }})
                                </option>
                            @endforeach
                        </select>
                        @error('livro_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- início das informações do e-book -->
                    <div class="mb-4">
                        <label for="titulo" class="form-label fw-bold text-dark">
                            <i class="bi bi-card-heading me-1 text-info"></i>Título do E-book <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="titulo" id="titulo" class="form-control form-control-lg rounded-3 @error('titulo') is-invalid @enderror" 
                            value="{{ old('titulo', $data->titulo ?? '') }}" required>
                        @error('titulo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row g-3 mb-4">
                        
                        <div class="col-md-6">
                            <label for="autor" class="form-label fw-bold text-dark">
                                <i class="bi bi-pen me-1 text-secondary"></i>Autor(a) <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="autor" id="autor" class="form-control rounded-3 @error('autor') is-invalid @enderror"
                                placeholder="Ex: Machado de Assis" 
                                value="{{ old('autor', $data->autor ?? '') }}" required>
                            @error('autor')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="editora" class="form-label fw-bold text-dark">
                                <i class="bi bi-building me-1 text-secondary"></i>Editora Digital / Publicação <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="editora" id="editora" class="form-control rounded-3 @error('editora') is-invalid @enderror"
                                placeholder="Ex: Domínio Público / Garnier" 
                                value="{{ old('editora', $data->editora ?? '') }}" required>
                            @error('editora')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label for="numero_de_paginas" class="form-label fw-bold text-dark">
                                <i class="bi bi-file-earmark-text me-1 text-secondary"></i>Número de Páginas <span class="text-danger">*</span>
                            </label>
                            <input type="number" name="numero_de_paginas" id="numero_de_paginas" min="1" class="form-control rounded-3 @error('numero_de_paginas') is-invalid @enderror"
                                placeholder="Ex: 256" 
                                value="{{ old('numero_de_paginas', $data->numero_de_paginas ?? '') }}" required>
                            @error('numero_de_paginas')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                            
                        <div class="col-md-6">
                            <label for="tamanho_do_arquivo" class="form-label fw-bold text-dark">
                                <i class="bi bi-file-earmark-arrow-down me-1 text-secondary"></i>Tamanho do Arquivo <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="tamanho_do_arquivo" id="tamanho_do_arquivo" class="form-control rounded-3 @error('tamanho_do_arquivo') is-invalid @enderror"
                                placeholder="Ex: 2.1 MB, 850 KB, 4.5 MB" 
                                value="{{ old('tamanho_do_arquivo', $data->tamanho_do_arquivo ?? '') }}" required>
                            @error('tamanho_do_arquivo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="sinopse" class="form-label fw-bold text-dark">
                            <i class="bi bi-card-text me-1 text-secondary"></i>Sinopse <span class="text-danger">*</span>
                        </label>
                        <textarea name="sinopse" id="sinopse" rows="4" class="form-control rounded-3 @error('sinopse') is-invalid @enderror" 
                        required>{{ old('sinopse', $data->sinopse ?? '') }}</textarea>
                        @error('sinopse')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                        <a href="{{ route('ebook.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                            <i class="bi bi-arrow-left me-1"></i> Voltar
                        </a>
                        <button type="submit" class="btn btn-primary rounded-pill px-5 shadow-sm">
                            <i class="bi bi-check2-circle me-1"></i> {{ !empty($data->id) ? 'Atualizar E-book' : 'Salvar E-book' }}
                        </button>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>

@push('scripts')
<script>
    // Preenchimento automático inteligente ao escolher o livro físico associado
    const selectLivro = document.getElementById('livro_id');
    const inputTitulo = document.getElementById('titulo');
    const inputAutor = document.getElementById('autor');
    const textareaSinopse = document.getElementById('sinopse');

    if (selectLivro) {
        selectLivro.addEventListener('change', function() {
            const opt = this.options[this.selectedIndex];
            if (opt && opt.value) {
                const titulo = opt.getAttribute('data-titulo');
                const autor = opt.getAttribute('data-autor');
                const sinopse = opt.getAttribute('data-sinopse');

                if (inputTitulo && (!inputTitulo.value || inputTitulo.value.trim() === '')) {
                    inputTitulo.value = titulo || '';
                }
                if (inputAutor && (!inputAutor.value || inputAutor.value.trim() === '')) {
                    inputAutor.value = autor || '';
                }
                if (textareaSinopse && (!textareaSinopse.value || textareaSinopse.value.trim() === '')) {
                    textareaSinopse.value = sinopse || '';
                }
            }
        });
    }
</script>
@endpush

@endsection
