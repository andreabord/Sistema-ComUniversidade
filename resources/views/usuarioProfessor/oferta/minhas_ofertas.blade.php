<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/menu_navegacao/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/usuarioProfessor/oferta/minhas_ofertas.css') }}">
    <script src="{{ asset('js/menu/menu_navegacao.js') }}"></script>
    <script src="{{ asset('js/usuarioProfessor/oferta/modal_deletar_oferta.js') }}"></script>
    <script src="{{ asset('js/usuarioProfessor/oferta/modal_ajuda_tipo_oferta.js') }}"></script>
    <title>Minhas Ofertas</title>
</head>
<body> 

@include('usuarioProfessor.menu')
<main class="offers offers-section">
    <h1>Minhas Ofertas</h1>

    @if( session()->has('msg-oferta'))
        <div class="alert alert-success">
            <p>{{session('msg-oferta')}}</p>
        </div>
    @endif

    <div class="pagination-button">
        <a class="button-a-primary" href="{{ route('oferta_create_index') }}">Cadastre uma nova Oferta</a>
    </div>

    

    <div class="cards-container">
        @if (count($ofertas) < 1)
            <p class="no-data">Nenhuma oferta cadastrada</p>
        @else
            @foreach ($ofertas as $oferta)
                <div class="offer-card">
                    <h4>{{ $oferta->titulo }}</h4>
                    <p class="date">{{ \Carbon\Carbon::parse($oferta->created_at)->format('d/m/Y') }}</p>

                    <hr class="division-hr">

                    <div class="offer-info">
                        <p>Area do conhecimento: {{ $oferta->areaConhecimento->nome }}</p>
                        @if ($oferta->tipo === 'ACAO')
                            <p>Tipo de oferta: Ação</p>
                        @elseif ($oferta->tipo === 'CONHECIMENTO')
                            <p>Tipo de oferta: Conhecimento</p>
                        @endif
                    </div>

                    <hr class="division-hr">

                    <div class="action-buttons">
                        <a href="{{ route('oferta_matching_index', $oferta->id_oferta) }}">Visualizar</a>
                        @if ($oferta->tipo === 'ACAO')
                            <a href="{{ route('oferta_edit_index_acao', $oferta->id_oferta) }}">Editar</a>
                        @elseif ($oferta->tipo === 'CONHECIMENTO')
                            <a href="{{ route('oferta_edit_index_conhecimento', $oferta->id_oferta) }}">Editar</a>
                        @endif
                        <a onclick="openModalDeletar({{$oferta->id_oferta}})">Deletar</a>
                        <x-usuario-professor.oferta.modal-deletar-oferta :id-oferta="$oferta->id_oferta" />
                    </div>
                </div>
            @endforeach
        @endif
    </div>

    <div class="pagination-content">
        {{ $ofertas->links() }}
    </div>


    <script src="{{ asset('js/errors/mensagem_erro.js') }}"></script> 
</main>
</body>
</html>