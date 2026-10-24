<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Relatório - Avaliações & Críticas Literárias</title>
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
            background-color: #FEF3C7;
            color: #92400E;
            border: 1px solid #FDE68A;
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
            padding: 8px 6px;
            border-bottom: 1px solid #EADBCE;
            vertical-align: top;
            font-size: 10px;
        }
        table.data-table tr:nth-child(even) td {
            background-color: #FAF7F2;
        }
        .review-text {
            color: #374151;
            font-style: italic;
            font-size: 9.5px;
            line-height: 1.35;
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
    </style>
</head>
<body>
    <div class="header">
        <table class="header-table">
            <tr>
                <td style="width: 65%;">
                    <h1 class="brand-title">Livraria Acácia</h1>
                    <div class="brand-subtitle">Relatório Geral de Avaliações e Críticas Literárias</div>
                </td>
                <td class="meta-info" style="width: 35%;">
                    <strong>Data de Emissão:</strong> {{ $dataGeracao }}<br>
                    <strong>Total de Avaliações:</strong> {{ $avaliacoes->count() }} resenha(s)
                </td>
            </tr>
        </table>
    </div>

    <!-- tabela -->
    <table class="data-table">
        <thead>
            <tr>
                <th style="width: 25px;">#</th>
                <th style="width: 170px;">Livro vinculado</th>
                <th style="width: 120px;">Crítico / Leitor</th>
                <th style="width: 75px;">Data</th>
                <th>Resenha / Crítica</th>
            </tr>
        </thead>
        <!--If que percorre as avaliações-->
        <tbody>
            @foreach($avaliacoes as $av)
                <tr>
                    <td>{{ $av->id }}</td>
                    <td>
                        <strong>{{ $av->livro->nome ?? 'Livro não identificado' }}</strong>
                        @if(isset($av->livro) && $av->livro->autor)
                            <div style="font-size: 9px; color: #6E5D53;">Autor: {{ $av->livro->autor }}</div>
                        @endif
                    </td>
                    <td>
                        <strong>{{ $av->autor ?: 'Leitor Anônimo' }}</strong>
                    </td>
                    <td>
                        @if($av->data)
                            {{ date('d/m/Y', strtotime($av->data)) }}
                        @else
                            <span style="color: #9CA3AF;">—</span>
                        @endif
                    </td>
                    <td class="review-text">
                        "{{ $av->avaliacao }}"
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Livraria Acácia &bull;  Relatório de Avaliações
    </div>

</body>
</html>
