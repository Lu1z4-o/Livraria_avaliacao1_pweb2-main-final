@extends('layout')

@section('titulo', (!empty($data->id) ? 'Editar Usuário' : 'Novo Usuário') . ' - Livraria Acácia')

@section('conteudo')

<div class="row justify-content-center">
    <div class="col-lg-8 col-xl-7">

        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb small">
                <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-decoration-none text-muted">Início</a></li>
                <li class="breadcrumb-item"><a href="{{ route('usuario.index') }}" class="text-decoration-none text-muted">Usuários</a></li>
                <li class="breadcrumb-item active text-dark fw-semibold" aria-current="page">
                    {{ !empty($data->id) ? 'Editar Usuário' : 'Novo Cadastro' }}
                </li>
            </ol>
        </nav>

        <div class="card card-custom">
            <div class="card-header-custom d-flex align-items-center justify-content-between">
                <div>
                    <h4 class="brand-font mb-0 text-dark d-flex align-items-center gap-2">
                        <i class="bi bi-person-badge text-success"></i>
                        {{ !empty($data->id) ? 'Editar Cadastro de Usuário' : 'Cadastrar Novo Usuário' }}
                    </h4>
                    <small class="text-muted">Informe os dados pessoais e de contato do leitor.</small>
                </div>
                <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3 py-2 small">
                    Usuário
                </span>
            </div>

            <!-- verifica se o usuário já foi preenchido pelo id  -->
            <div class="card-body p-4 p-md-5">
                @php
                    $action = !empty($data->id) ? route('usuario.update', $data->id) : route('usuario.store');
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
                            <i class="bi bi-person me-1 text-primary"></i>Nome Completo <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="nome" id="nome" class="form-control form-control-lg rounded-3 @error('nome') is-invalid @enderror"
                            placeholder="Ex: Luiza Vitória, Carlos Eduardo..." 
                            value="{{ old('nome', $data->nome ?? '') }}" required>
                        @error('nome')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label for="cpf" class="form-label fw-bold text-dark">
                                <i class="bi bi-card-heading me-1 text-secondary"></i>CPF <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="cpf" id="cpf" class="form-control rounded-3 @error('cpf') is-invalid @enderror"
                                placeholder="000.000.000-00" 
                                value="{{ old('cpf', $data->cpf ?? '') }}" required>
                            @error('cpf')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                       
                        <div class="col-md-6">
                            <label for="telefone" class="form-label fw-bold text-dark">
                                <i class="bi bi-telephone me-1 text-info"></i>Telefone <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="telefone" id="telefone" class="form-control rounded-3 @error('telefone') is-invalid @enderror"
                                placeholder="(00) 00000-0000" 
                                value="{{ old('telefone', $data->telefone ?? '') }}" required>
                            @error('telefone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                 
                    <div class="mb-4">
                        <label for="email" class="form-label fw-bold text-dark">
                            <i class="bi bi-envelope me-1 text-warning"></i>E-mail <span class="text-danger">*</span>
                        </label>
                        <input type="email" name="email" id="email" class="form-control rounded-3 @error('email') is-invalid @enderror"
                            placeholder="exemplo@email.com" 
                            value="{{ old('email', $data->email ?? '') }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                  
                    <div class="mb-4">
                        <label for="endereco" class="form-label fw-bold text-dark">
                            <i class="bi bi-geo-alt me-1 text-danger"></i>Endereço Completo <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="endereco" id="endereco" class="form-control rounded-3 @error('endereco') is-invalid @enderror"
                            placeholder="Rua, número, bairro, cidade - UF" 
                            value="{{ old('endereco', $data->endereco ?? '') }}" required>
                        @error('endereco')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4 p-3 bg-light rounded-3 border">
                        <label for="foto" class="form-label fw-bold text-dark d-flex justify-content-between align-items-center mb-1">
                            <span><i class="bi bi-camera me-1 text-primary"></i>Foto de Perfil (Upload de Imagem)</span>
                            <span class="badge bg-secondary-subtle text-secondary small">JPEG, PNG, WEBP (Máx: 2MB)</span>
                        </label>
                        <small class="text-muted d-block mb-3">Selecione uma imagem.</small>

                        <div class="row align-items-center g-3">
                            <div class="col-auto">
                                <div class="position-relative">
                                    @if(!empty($data->foto))
                                        <img src="{{ asset('storage/' . $data->foto) }}" alt="Foto do Usuário" id="previewImg" class="rounded-circle border shadow-sm object-fit-cover" style="width: 80px; height: 80px;">
                                    @else
                                        <div id="previewPlaceholder" class="rounded-circle bg-white border d-flex align-items-center justify-content-center text-muted shadow-sm" style="width: 80px; height: 80px;">
                                            <i class="bi bi-person fs-1 text-secondary"></i>
                                        </div>
                                        <img src="" alt="Nova Foto" id="previewImg" class="rounded-circle border shadow-sm object-fit-cover d-none" style="width: 80px; height: 80px;">
                                    @endif
                                </div>
                            </div>
                            <div class="col">
                                <input type="file" name="foto" id="foto" class="form-control rounded-3 @error('foto') is-invalid @enderror" accept="image/*">
                                @error('foto')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror

                                @if(!empty($data->foto))
                                    <div class="form-check mt-2">
                                        <input class="form-check-input" type="checkbox" name="remover_foto" id="remover_foto" value="1">
                                        <label class="form-check-label text-danger small" for="remover_foto">
                                            <i class="bi bi-trash me-1"></i>Remover foto de perfil atual
                                        </label>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                        <a href="{{ route('usuario.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                            <i class="bi bi-arrow-left me-1"></i> Voltar
                        </a>
                        <button type="submit" class="btn btn-primary rounded-pill px-5 shadow-sm">
                            <i class="bi bi-check2-circle me-1"></i> {{ !empty($data->id) ? 'Atualizar Usuário' : 'Salvar Usuário' }}
                        </button>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>
<!-- pré visualização da imagem -->
@push('scripts')
<script>
    const fotoInput = document.getElementById('foto');
    const previewImg = document.getElementById('previewImg');
    const previewPlaceholder = document.getElementById('previewPlaceholder');

    if (fotoInput && previewImg) {
        fotoInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(evt) {
                    previewImg.src = evt.target.result;
                    previewImg.classList.remove('d-none');
                    if (previewPlaceholder) {
                        previewPlaceholder.classList.add('d-none');
                    }
                };
                reader.readAsDataURL(file);
            }
        });
    }
</script>
@endpush

@endsection
