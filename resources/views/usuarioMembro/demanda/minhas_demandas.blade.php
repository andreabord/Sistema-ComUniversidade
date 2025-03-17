<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/menu_navegacao/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/usuarioMembro/demanda/minhas_demandas.css') }}">
    <script src="{{ asset('js/menu/menu_navegacao.js') }}"></script>
    <script src="{{ asset('js/usuarioMembro/demanda/modal_deletar_demanda.js') }}"></script>
    <title>Minhas Demandas</title>
</head>
<body> 
    @include('usuarioMembro.menu')
    <main class="demands demands-section">
        <h1>Minhas Necessidades</h1>
            
        @if( session()->has('msg-demanda'))
            <div class="alert alert-success">
                <p>{{session('msg-demanda')}}</p>
            </div>
        @endif

        <div class="pagination-button">
            <a class="button-a-primary" href="{{ route('demanda_create_index') }}">Cadastrar novas necessidades</button></a>
        </div>

        <div class="cards-container">
            @if (count($demandas) < 1)
                <p class="no-data">Cadastre uma necessidade!</p>
            @else
                @foreach ($demandas as $demanda) 
                    <div class="demand-card">
                        <h4>{{ $demanda->titulo }}</h4>
                        <p class="date">{{ \Carbon\Carbon::parse($demanda->created_at)->format('d/m/Y') }}</p>

                        <hr class="division-hr">

                        <div class="demand-info">
                            <p>{{ $demanda->areaConhecimento->nome }}</p>
                        </div>

                        <hr class="division-hr">

                        <div class="action-buttons">
                            <a href="{{ route('demanda_matching_index', $demanda->id_demanda) }}">Visualizar</a>
                            <a href="{{ route('demanda_edit_index', $demanda->id_demanda) }}">Editar</a>
                            <a onclick="openModalDeletar({{$demanda->id_demanda}})">Deletar</a>
                            <x-usuario-membro.demanda.modal-deletar-demanda :id-demanda="$demanda->id_demanda" />
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

        <div class="pagination-content">
            {{ $demandas->links() }}
        </div>
        <script src="{{ asset('js/errors/mensagem_erro.js') }}"></script>   
    </main>
</body>
</html>