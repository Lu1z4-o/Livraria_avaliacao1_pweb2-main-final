@extends('layout')

@section('titulo', $titulo . ' - Livraria Acácia')

@section('conteudo')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="brand-font text-dark m-0">{{ $titulo }}</h4>
            <a href="{{ route('relatorios.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
                &larr; Voltar para Painel
            </a>
        </div>
        <div class="card card-custom p-4 shadow-sm bg-white">
            {!! $chart->container() !!}
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="{{ $chart->cdn() }}"></script>
    {{ $chart->script() }}
@endpush

