@extends('layout')

@section('titulo', 'Gráficos & Relatórios em PDF - Livraria Acácia')

@section('conteudo')

<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-1 small">
                <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-decoration-none text-muted">Início</a></li>
                <li class="breadcrumb-item active text-dark fw-semibold" aria-current="page">Relatórios & Gráficos</li>
            </ol>
        </nav>
        <h2 class="brand-font mb-1 d-flex align-items-center gap-2">
            <i class="bi bi-pie-chart-fill text-warning"></i> Gráficos & Relatórios em PDF
        </h2>
    </div>
</div>

<!-- acessa de novo as outras tabelas -->
<div class="row g-3 mb-4">
    <div class="col-6 col-md-4 col-xl">
        <div class="card card-custom p-3 border-start border-4 border-primary">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted small fw-bold text-uppercase">Livros Físicos</span>
                    <h3 class="fw-bold mb-0 text-dark">{{ $totais['livros'] ?? 0 }}</h3>
                </div>
                <div class="bg-primary-subtle text-primary p-2 rounded-circle">
                    <i class="bi bi-book fs-4"></i>
                </div>
            </div>
            <a href="{{ route('livraria.index') }}" class="small text-decoration-none text-primary mt-2 d-inline-block">Ver catálogo &rarr;</a>
        </div>
    </div>

    <div class="col-6 col-md-4 col-xl">
        <div class="card card-custom p-3 border-start border-4 border-info">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted small fw-bold text-uppercase">E-books</span>
                    <h3 class="fw-bold mb-0 text-dark">{{ $totais['ebooks'] ?? 0 }}</h3>
                </div>
                <div class="bg-info-subtle text-info p-2 rounded-circle">
                    <i class="bi bi-tablet fs-4"></i>
                </div>
            </div>
            <a href="{{ route('ebook.index') }}" class="small text-decoration-none text-info mt-2 d-inline-block">Ver e-books &rarr;</a>
        </div>
    </div>

    <div class="col-6 col-md-4 col-xl">
        <div class="card card-custom p-3 border-start border-4 border-warning">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted small fw-bold text-uppercase">Hashtags</span>
                    <h3 class="fw-bold mb-0 text-dark">{{ $totais['hashtags'] ?? 0 }}</h3>
                </div>
                <div class="bg-warning-subtle text-warning p-2 rounded-circle">
                    <i class="bi bi-hash fs-4"></i>
                </div>
            </div>
            <a href="{{ route('hashtag.index') }}" class="small text-decoration-none text-warning mt-2 d-inline-block">Ver tags &rarr;</a>
        </div>
    </div>

    <div class="col-6 col-md-4 col-xl">
        <div class="card card-custom p-3 border-start border-4 border-danger">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted small fw-bold text-uppercase">Avaliações</span>
                    <h3 class="fw-bold mb-0 text-dark">{{ $totais['avaliacoes'] ?? 0 }}</h3>
                </div>
                <div class="bg-danger-subtle text-danger p-2 rounded-circle">
                    <i class="bi bi-star-fill fs-4"></i>
                </div>
            </div>
            <a href="{{ route('avaliacao.index') }}" class="small text-decoration-none text-danger mt-2 d-inline-block">Ver resenhas &rarr;</a>
        </div>
    </div>

    <div class="col-12 col-md-4 col-xl">
        <div class="card card-custom p-3 border-start border-4 border-success">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted small fw-bold text-uppercase">Usuários</span>
                    <h3 class="fw-bold mb-0 text-dark">{{ $totais['usuarios'] ?? 0 }}</h3>
                </div>
                <div class="bg-success-subtle text-success p-2 rounded-circle">
                    <i class="bi bi-people fs-4"></i>
                </div>
            </div>
            <a href="{{ route('usuario.index') }}" class="small text-decoration-none text-success mt-2 d-inline-block">Ver usuários &rarr;</a>
        </div>
    </div>
</div>

<!--emite relatorio -->
<div class="card card-custom p-4 mb-4 border-0 shadow-sm" style="background: linear-gradient(135deg, #FFFDFB 0%, #F5ECE3 100%);">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
        <div>
            <span class="badge bg-danger-subtle text-danger px-3 py-1 rounded-pill small fw-bold mb-2 d-inline-block">
                Relatórios Oficiais em PDF
            </span>
            <h4 class="brand-font mb-1 text-dark d-flex align-items-center gap-2">
                <i class="bi bi-file-earmark-pdf-fill text-danger"></i> Exportação de Relatórios com DomPDF
            </h4>
        </div>
        <div class="d-flex flex-wrap gap-2">
            <a href="{{ route('relatorios.livros.pdf') }}" target="_blank" class="btn btn-danger btn-sm px-3 py-2 rounded-pill shadow-sm d-flex align-items-center gap-2">
                <i class="bi bi-file-pdf"></i>
                <span>Relatório 1: Catálogo de Livros</span>
            </a>
            <a href="{{ route('relatorios.avaliacoes.pdf') }}" target="_blank" class="btn btn-outline-danger btn-sm px-3 py-2 rounded-pill shadow-sm d-flex align-items-center gap-2">
                <i class="bi bi-file-text"></i>
                <span>Relatório 2: Avaliações dos Leitores</span>
            </a>
        </div>
    </div>
</div>

<!-- graficos -->
<div class="row g-4 mb-4">
    <!-- grafico de barra -->
    <div class="col-lg-6">
        <div class="card card-custom h-100 shadow-sm">
            <div class="card-header bg-white border-bottom p-3 d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="fw-bold text-dark mb-0 d-flex align-items-center gap-2">
                        <i class="bi bi-bar-chart-fill text-primary"></i> 1. Livros por Categoria Literária
                    </h5>
                    <small class="text-muted">Formato: Barras verticais &bull;</small>
                </div>
            </div>
            <div class="card-body p-4 d-flex align-items-center justify-content-center">
                <div style="width: 100%;">
                    {!! $graficoCategorias->container() !!}
                </div>
            </div>
        </div>
    </div>

    <!-- grafico de pizza -->
    <div class="col-lg-6">
        <div class="card card-custom h-100 shadow-sm">
            <div class="card-header bg-white border-bottom p-3 d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="fw-bold text-dark mb-0 d-flex align-items-center gap-2">
                        <i class="bi bi-pie-chart-fill text-warning"></i> 2. Top Tropes Literários (#)
                    </h5>
                </div>
            </div>
            <div class="card-body p-4 d-flex align-items-center justify-content-center">
                <div style="width: 100%;">
                    {!! $graficoHashtags->container() !!}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
    <!-- script do grafico-->
    <script src="{{ $graficoCategorias->cdn() }}"></script>
    {{ $graficoCategorias->script() }}
    {{ $graficoHashtags->script() }}
@endpush
