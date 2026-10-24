<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Relatório - Catálogo de Livros e E-books</title>
    <style>
        @page {
            margin: 28px 25px 35px 25px;
        }
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-size: 11px;
            color: #22130B;
            line-height: 1.4;
        }
        .header {
            border-bottom: 2px solid #B85D36;
            padding-bottom: 12px;
            margin-bottom: 15px;
        }
        .header-table {
            width: 100%;
            border-collapse: collapse;
        }
        .brand-title {
            font-size: 20px;
            font-weight: bold;
            color: #22130B;
            margin: 0;
        }
        .brand-subtitle {
            font-size: 11px;
            color: #6E5D53;
            margin-top: 3px;
        }
        .meta-info {
            text-align: right;
            font-size: 10px;
            color: #6E5D53;
        }
        .badge {
            display: inline-block;
            padding: 2px 6px;
            font-size: 9px;
            font-weight: bold;
            border-radius: 4px;
            background-color: #F4EBE1;
            color: #382014;
            border: 1px solid #EADBCE;
        }
        .badge-ebook {
            background-color: #E0F2FE;
            color: #0369A1;
            border: 1px solid #BAE6FD;
        }
        .badge-tag {
            background-color: #FEF3C7;
            color: #92400E;
            border: 1px solid #FDE68A;
            margin-right: 2px;
            margin-bottom: 2px;
        }
        table.data-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        table.data-table th {
            background-color: #382014;
            color: #FFFFFF;
            font-weight: bold;
            text-align: left;
            padding: 7px 6px;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        table.data-table td {
            padding: 6px 6px;
            border-bottom: 1px solid #EADBCE;
            vertical-align: top;
            font-size: 10px;
        }
        table.data-table tr:nth-child(even) td {
            background-color: #FAF7F2;
        }
        .price {
            font-weight: bold;
            color: #2A1810;
            white-space: nowrap;
        }
        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            height: 20px;
            border-top: 1px solid #EADBCE;
            font-size: 9px;
            color: #8C7B73;
            text-align: center;
            padding-top: 4px;
        }
        .summary-box {
            background-color: #FAF7F2;
            border: 1px solid #EADBCE;
            border-radius: 6px;
            padding: 8px 12px;
            margin-bottom: 12px;
            font-size: 10px;
        }
    </style>
</head>
<body>

    <div class="header">
        <table class="header-table">
            <tr>
                <td style="width: 65%;">
                    <h1 class="brand-title">Livraria Acácia</h1>
                    <div class="brand-subtitle">Relatório Oficial de Catálogo </div>
                </td>
                <td class="meta-info" style="width: 35%;">
                    <strong>Data de Emissão:</strong> {{ $dataGeracao }}<br>
                    <strong>Total no Catálogo:</strong> {{ $livros->count() }} livro(s)
                </td>
            </tr>
        </table>
    </div>

    <table class="data-table">
        <thead>
            <tr>
                <th style="width: 25px;">#</th>
                <th style="width: 170px;">Título da Obra</th>
                <th style="width: 110px;">Autor</th>
                <th style="width: 100px;">Categoria</th>
                <th style="width: 65px;">Preço Físico</th>
                <th style="width: 140px;">E-book Vinculado</th>
                <th>Hashtags (#)</th>
            </tr>
        </thead>
        <!--If que percorre cada livro e preenche as informações para colocar no pdf-->
        <tbody>
            @foreach($livros as $livro)
                <tr>
                    <td>{{ $livro->id }}</td>
                    <td>
                        <strong>{{ $livro->nome }}</strong>
                        @if($livro->genero)
                            <div style="font-size: 9px; color: #6E5D53;">Gênero: {{ $livro->genero }}</div>
                        @endif
                    </td>
                    <td>{{ $livro->autor }}</td>
                    <td>
                        <span class="badge">{{ $livro->categoriaLivro->categoria ?? 'Geral' }}</span>
                    </td>
                    <td class="price">
                        R$ {{ number_format($livro->valor, 2, ',', '.') }}
                    </td>
                    <td>
                        @if($livro->ebook)
                            <div class="badge-ebook badge">
                                {{ $livro->ebook->editora }}
                            </div>
                            <div style="font-size: 9px; color: #4B5563; margin-top: 2px;">
                                {{ $livro->ebook->numero_de_paginas }} págs. &bull; {{ $livro->ebook->tamanho_do_arquivo }}
                            </div>
                        @else
                            <span style="color: #9CA3AF; font-style: italic;">Sem e-book</span>
                        @endif
                    </td>
                    <td>
                        @forelse($livro->hashtags as $h)
                            <span class="badge-tag badge">{{ $h->tag }}</span>
                        @empty
                            <span style="color: #9CA3AF; font-size: 9px;">—</span>
                        @endforelse
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Livraria Acácia 
    </div>

</body>
</html>
