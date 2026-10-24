@extends('layout')

@section('titulo', (!empty($data->id) ? 'Editar Livro' : 'Novo Livro') . ' - Livraria Acácia')

@section('conteudo')

<div class="row justify-content-center">
    <div class="col-lg-9 col-xl-8">
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb small">
                <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-decoration-none text-muted">Início</a></li>
                <li class="breadcrumb-item"><a href="{{ route('livraria.index') }}" class="text-decoration-none text-muted">Livros</a></li>
                <li class="breadcrumb-item active text-dark fw-semibold" aria-current="page">
                    {{ !empty($data->id) ? 'Editar Livro' : 'Novo Cadastro' }}
                </li>
            </ol>
        </nav>

        <div class="card card-custom">
            <div class="card-header-custom d-flex align-items-center justify-content-between">
                <div>
                    <h4 class="brand-font mb-0 text-dark d-flex align-items-center gap-2">
                        <i class="bi bi-journal-bookmark text-primary"></i>
                        {{ !empty($data->id) ? 'Editar Livro' : 'Cadastrar Novo Livro' }}
                    </h4>
                    <small class="text-muted">Preencha as informações do exemplar para o acervo (Obras em Domínio Público).</small>
                </div>
                <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3 py-2 small">
                    <i class="bi bi-shield-check me-1"></i> Domínio Público
                </span>
            </div>
             <!-- verifica se o usuário já foi preenchido pelo id  -->
            <div class="card-body p-4 p-md-5">
                @php
                    $action = !empty($data->id) ? route('livraria.update', $data->id) : route('livraria.store');
                @endphp

                   <!-- se já houver id, há um post com método put  -->
                <form action="{{ $action }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if (!empty($data->id))
                        @method('PUT')
                    @endif

                    <input type="hidden" name="id" value="{{ old('id', $data->id ?? '') }}">

                    
                    <div class="mb-4">
                        <label for="nome" class="form-label fw-bold text-dark">
                            <i class="bi bi-book me-1 text-primary"></i>Título da Obra <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="nome" id="nome" class="form-control form-control-lg rounded-3 @error('nome') is-invalid @enderror"
                            placeholder="Ex: Dom Casmurro, Memórias Póstumas de Brás Cubas..." 
                            value="{{ old('nome', $data->nome ?? '') }}" required>
                        <div class="form-text small text-muted">O título deve ser único no catálogo para evitar duplicações na listagem.</div>
                        @error('nome')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row g-3 mb-4">
                        <!-- Autor -->
                        <div class="col-md-7">
                            <label for="autor" class="form-label fw-bold text-dark">
                                <i class="bi bi-pen me-1 text-secondary"></i>Autor(a) da Obra
                            </label>
                            <input type="text" name="autor" id="autor" class="form-control rounded-3 @error('autor') is-invalid @enderror"
                                placeholder="Ex: Machado de Assis, Aluísio Azevedo..." 
                                value="{{ old('autor', $data->autor ?? '') }}">
                            @error('autor')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Valor / Preço -->
                        <div class="col-md-5">
                            <label for="valor" class="form-label fw-bold text-dark">
                                <i class="bi bi-currency-dollar me-1 text-success"></i>Valor (R$) <span class="text-danger">*</span>
                            </label>
                            <input type="number" step="0.01" min="0" name="valor" id="valor" class="form-control rounded-3 @error('valor') is-invalid @enderror"
                                placeholder="0,00" 
                                value="{{ old('valor', $data->valor ?? '') }}" required>
                            @error('valor')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <!-- Gênero -->
                        <div class="col-md-6">
                            <label for="genero" class="form-label fw-bold text-dark">
                                <i class="bi bi-tag me-1 text-info"></i>Gênero Literário
                            </label>
                            <input type="text" name="genero" id="genero" class="form-control rounded-3 @error('genero') is-invalid @enderror"
                                placeholder="Ex: Realismo, Romance Psicológico..." 
                                value="{{ old('genero', $data->genero ?? '') }}">
                            @error('genero')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Categoria Especial -->
                        <div class="col-md-6">
                            <label for="categoria_id" class="form-label fw-bold text-dark">
                                <i class="bi bi-folder2 me-1 text-warning"></i>Categoria Especial <span class="text-danger">*</span>
                            </label>
                            <select name="categoria_id" id="categoria_id" class="form-select rounded-3 @error('categoria_id') is-invalid @enderror" required>
                                <option value="" disabled {{ empty($data->categoria_id) ? 'selected' : '' }}>Selecione uma categoria...</option>
                                @foreach($categorias as $cat)
                                    <option value="{{ $cat->id }}" {{ (string)old('categoria_id', $data->categoria_id ?? '') === (string)$cat->id ? 'selected' : '' }}>
                                        {{ $cat->categoria }}
                                    </option>
                                @endforeach
                            </select>
                            @error('categoria_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Sinopse da Obra (Solicitado no Trabalho) -->
                    <div class="mb-4">
                        <label for="sinopse" class="form-label fw-bold text-dark">
                            <i class="bi bi-card-text me-1 text-primary"></i>Sinopse da Obra
                        </label>
                        <textarea name="sinopse" id="sinopse" rows="4" class="form-control rounded-3 @error('sinopse') is-invalid @enderror"
                            placeholder="Resumo do enredo, contexto histórico, personagens centrais e relevância da obra...">{{ old('sinopse', $data->sinopse ?? '') }}</textarea>
                        @error('sinopse')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Upload de Imagem da Capa (Formato Retrato) -->
                    <div class="mb-4 p-3 bg-light rounded-3 border">
                        <label for="imagem" class="form-label fw-bold text-dark d-flex align-items-center justify-content-between">
                            <span><i class="bi bi-image me-1 text-primary"></i>Capa do Livro (Retrato)</span>
                            <span class="badge bg-light text-muted border small">Opcional &bull; JPG, PNG, WEBP (Máx: 2MB)</span>
                        </label>

                        @if(!empty($data->imagem))
                            <div class="d-flex align-items-center gap-3 mb-3 p-2 bg-white rounded-3 border">
                                <div style="width: 75px; height: 110px; flex-shrink: 0;" class="rounded shadow-sm overflow-hidden border">
                                    <img src="{{ asset('storage/' . $data->imagem) }}" alt="Capa atual" class="w-100 h-100 object-fit-cover">
                                </div>
                                <div class="flex-grow-1">
                                    <span class="badge bg-success-subtle text-success border border-success-subtle mb-1">Capa Atual Cadastrada</span>
                                    <p class="small text-muted mb-2">Selecione uma nova imagem abaixo.</p>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remover_imagem" id="remover_imagem" value="1">
                                        <label class="form-check-label small text-danger fw-semibold" for="remover_imagem">
                                            <i class="bi bi-trash3 me-1"></i>Remover capa atual deste livro
                                        </label>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <input type="file" name="imagem" id="imagem" class="form-control rounded-3 @error('imagem') is-invalid @enderror" 
                               accept="image/png, image/jpeg, image/jpg, image/webp, image/gif" onchange="previewNovaCapa(event)">
                        <div class="form-text small">
                            A imagem é salva no servidor e excluída automaticamente caso o livro seja deletado ou a imagem substituída.
                        </div>
                        @error('imagem')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <!-- prévia da imagem -->
                        <div id="novaCapaPreviewContainer" class="mt-3 d-none align-items-center gap-3 p-2 bg-white rounded-3 border">
                            <div style="width: 75px; height: 110px; flex-shrink: 0;" class="rounded shadow-sm overflow-hidden border">
                                <img id="novaCapaPreview" src="#" alt="Prévia" class="w-100 h-100 object-fit-cover">
                            </div>
                            <div>
                                <span class="badge bg-primary-subtle text-primary border border-primary-subtle mb-1">Nova Imagem Selecionada</span>
                                <p class="small text-muted mb-0">Esta será a nova capa salva ao enviar o formulário.</p>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4 p-3 rounded-3 bg-light border">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <label class="form-label fw-bold text-dark mb-0">
                                <i class="bi bi-hash text-danger me-1"></i>Hashtags & Tropes Literárias
                            </label>
                            <a href="{{ route('hashtag.create') }}" target="_blank" class="btn btn-sm btn-outline-danger rounded-pill px-3 py-1">
                                <i class="bi bi-plus-circle me-1"></i>Nova #
                            </a>
                        </div>
                        @php
                            $selectedHashtags = old('hashtags', isset($data) ? $data->hashtags->pluck('id')->toArray() : []);
                        @endphp
                    <!--seleciona automaticamente as hashtags do array das selecionadas -->
                        <div class="row g-2" style="max-height: 220px; overflow-y: auto;">
                            @foreach($hashtags as $tag)
                                <div class="col-sm-6 col-md-4">
                                    <div class="form-check p-2 bg-white rounded-3 border h-100 d-flex align-items-center gap-2">
                                        <input class="form-check-input ms-1" type="checkbox" name="hashtags[]" value="{{ $tag->id }}" id="tag_{{ $tag->id }}"
                                            {{ in_array($tag->id, $selectedHashtags) ? 'checked' : '' }}>
                                        <label class="form-check-label w-100 cursor-pointer d-flex align-items-center justify-content-between pe-1" for="tag_{{ $tag->id }}">
                                            <span class="badge rounded-pill text-white" style="background-color: {{ $tag->cor ?? '#8C5A3C' }}; font-size: 0.75rem;">
                                                {{ $tag->tag }}
                                            </span>
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Botões de Ação -->
                    <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                        <a href="{{ route('livraria.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                            <i class="bi bi-arrow-left me-1"></i> Voltar
                        </a>
                        <button type="submit" class="btn btn-primary rounded-pill px-5 shadow-sm">
                            <i class="bi bi-check2-circle me-1"></i> {{ !empty($data->id) ? 'Atualizar Livro' : 'Salvar Livro' }}
                        </button>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>

@push('scripts')
<script>
    function previewNovaCapa(event) {
        const file = event.target.files[0];
        const container = document.getElementById('novaCapaPreviewContainer');
        const img = document.getElementById('novaCapaPreview');
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                img.src = e.target.result;
                container.classList.remove('d-none');
                container.classList.add('d-flex');
            }
            reader.readAsDataURL(file);
        } else {
            container.classList.add('d-none');
            container.classList.remove('d-flex');
        }
    }
</script>
@endpush

@endsection