@extends('layout')

@section('titulo', (!empty($data->id) ? 'Editar Hashtag' : 'Nova Hashtag') . ' - Livraria Acácia')

@section('conteudo')

<div class="row justify-content-center">
    <div class="col-lg-8 col-xl-7">
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb small">
                <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-decoration-none text-muted">Início</a></li>
                <li class="breadcrumb-item"><a href="{{ route('hashtag.index') }}" class="text-decoration-none text-muted">Hashtags (#)</a></li>
                <li class="breadcrumb-item active text-dark fw-semibold" aria-current="page">
                    {{ !empty($data->id) ? 'Editar' : 'Novo Cadastro' }}
                </li>
            </ol>
        </nav>

        <div class="card card-custom">
            <div class="card-header-custom d-flex align-items-center justify-content-between">
                <div>
                    <h4 class="brand-font mb-0 text-dark d-flex align-items-center gap-2">
                        <i class="bi bi-hash text-danger"></i>
                        {{ !empty($data->id) ? 'Editar Hashtag' : 'Cadastrar Nova Hashtag' }}
                    </h4>
                    <small class="text-muted">
                        Associe tropes e palavras-chave a múltiplos livros.
                    </small>
                </div>
    
            </div>

            <div class="card-body p-4 p-md-5">
                @php
                    $action = !empty($data->id) ? route('hashtag.update', $data->id) : route('hashtag.store');
                    $selectedLivros = old('livros', isset($data) ? $data->livros->pluck('id')->toArray() : (isset($selectedLivroId) ? [$selectedLivroId] : []));
                @endphp

                <form action="{{ $action }}" method="POST">
                    @csrf
                    @if (!empty($data->id))
                        @method('PUT')
                    @endif
                    <div class="mb-4">
                        <label for="tag" class="form-label fw-bold text-dark">
                            <i class="bi bi-tag me-1 text-danger"></i>Hashtag (#) <span class="text-danger">*</span>
                        </label>
                        <div class="input-group input-group-lg">
                            <span class="input-group-text bg-light text-muted fw-bold">#</span>
                            <input type="text" name="tag" id="tag" class="form-control rounded-end-3 @error('tag') is-invalid @enderror"
                                placeholder="ex: enemies-to-lovers, slow-burn, realismo..." 
                                value="{{ old('tag', isset($data->tag) ? ltrim($data->tag, '#') : '') }}" required>
                        </div>
                        <div class="form-text small">
                            Digite a hashtag ou trope literário (o símbolo '#' é adicionado automaticamente se não for digitado).
                        </div>
                        @error('tag')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-7">
                            <label for="tipo" class="form-label fw-bold text-dark">
                                <i class="bi bi-bookmark-star me-1 text-warning"></i>Classificação da trope <span class="text-danger">*</span>
                            </label>
                            @php
                                $tipoAtual = old('tipo', $data->tipo ?? 'Trope Literária');
                                $tiposOpcoes = [
                                    'Trope Literário' => 'Trope Literário (ex: Enemies to Lovers, Slow Burn)',
                                    'Escola Literária' => 'Escola Literária (ex: Realismo, Romantismo, Naturalismo)',
                                    'Ambientação' => 'Ambientação (ex: Rio Antigo, Salões Aristocráticos)',
                                    'Vibe / Estética' => 'Vibe / Estética (ex: Dark Academia, Melancolia)',
                                    'Dinâmica' => 'Dinâmica (ex: Vingança, Casamento de Conveniência)',
                                    'Técnica Narrativa' => 'Técnica Narrativa (ex: Narrador Não Confiável, Defunto Autor)',
                                    'Gênero Clássico' => 'Gênero Clássico (ex: Tragédia, Epopeia, Sátira)'
                                ];
                            @endphp
                            <select name="tipo" id="tipo" class="form-select rounded-3 @error('tipo') is-invalid @enderror" required>
                                @foreach($tiposOpcoes as $chave => $rotulo)
                                    <option value="{{ $chave }}" {{ $tipoAtual === $chave ? 'selected' : '' }}>{{ $rotulo }}</option>
                                @endforeach
                            </select>
                            @error('tipo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-5">
                            <label for="cor" class="form-label fw-bold text-dark">
                                <i class="bi bi-palette me-1 text-info"></i>Cor da Badge
                            </label>
                            <div class="d-flex align-items-center gap-2">
                                <input type="color" name="cor" id="cor" class="form-control form-control-color rounded-3 p-1"
                                    value="{{ old('cor', $data->cor ?? '#8C5A3C') }}" title="Escolha a cor da etiqueta">
                                <span class="badge rounded-pill text-white px-3 py-2 fw-semibold" id="previewBadge" style="background-color: {{ old('cor', $data->cor ?? '#8C5A3C') }};">
                                    {{ old('tag', $data->tag ?? '#preview') }}
                                </span>
                            </div>
                            <div class="form-text small">Personalize a cor da etiqueta na vitrine.</div>
                        </div>
                    </div>

                    <!-- descreve a hashtag -->
                    <div class="mb-4">
                        <label for="descricao" class="form-label fw-bold text-dark">
                            <i class="bi bi-card-text me-1 text-secondary"></i>Descrição da trope
                        </label>
                        <textarea name="descricao" id="descricao" rows="2" class="form-control rounded-3 @error('descricao') is-invalid @enderror">{{ old('descricao', $data->descricao ?? '') }}</textarea>
                        @error('descricao')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="mb-4 p-3 bg-light rounded-3 border">
                        <label class="form-label fw-bold text-dark d-flex justify-content-between align-items-center mb-1">
                            <span><i class="bi bi-book me-1 text-primary"></i>Livros Associados</span>
                        </label>
                        <small class="text-muted d-block mb-3">
                            Uma hashtag pode estar presente em vários livros do acervo. Marque os livros que possuem este tropo:
                        </small>

                        <div class="row g-2" style="max-height: 220px; overflow-y: auto;">
                            @foreach ($livros as $livro)
                                <div class="col-md-6">
                                    <div class="form-check p-2 bg-white rounded-3 border h-100 d-flex align-items-center gap-2">
                                        <input class="form-check-input ms-1" type="checkbox" name="livros[]" value="{{ $livro->id }}" id="livro_{{ $livro->id }}"
                                            {{ in_array($livro->id, $selectedLivros) ? 'checked' : '' }}>
                                        <label class="form-check-label w-100 cursor-pointer pe-2" for="livro_{{ $livro->id }}">
                                            <div class="fw-semibold text-dark small text-truncate">{{ $livro->nome }}</div>
                                            <div class="text-muted" style="font-size: 0.72rem;">{{ $livro->autor }}</div>
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                        <a href="{{ route('hashtag.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                            <i class="bi bi-arrow-left me-1"></i> Voltar
                        </a>
                        <button type="submit" class="btn btn-primary rounded-pill px-5 shadow-sm">
                            <i class="bi bi-check2-circle me-1"></i> {{ !empty($data->id) ? 'Atualizar Hashtag' : 'Salvar Hashtag' }}
                        </button>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>

@push('scripts')
<script>
    const corInput = document.getElementById('cor');
    const tagInput = document.getElementById('tag');
    const previewBadge = document.getElementById('previewBadge');

    if (corInput && previewBadge) {
        corInput.addEventListener('input', function() {
            previewBadge.style.backgroundColor = this.value;
        });
    }

    if (tagInput && previewBadge) {
        tagInput.addEventListener('input', function() {
            const val = this.value.trim();
            previewBadge.textContent = val ? '#' + val.replace(/^#+/, '') : '#preview';
        });
    }
</script>
@endpush

@endsection
