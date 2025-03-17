<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- JS -->
    <script src="{{ asset('js/menu/menu_navegacao.js') }}"></script>
    <script src="{{ asset('js/usuarioEstudante/todas_ofertas/modal_visualizar_oferta.js') }}"></script>
    <script src="{{ asset('js/usuarioEstudante/todas_ofertas/modal_deletar_oferta.js') }}"></script>
    <script src="{{ asset('js/usuarioEstudante/todas_ofertas/filtros_ofertas.js') }}"></script>
    <script src="{{ asset('js/usuarioEstudante/todas_ofertas/modal_ajuda_tipo_oferta.js') }}"></script>
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/menu_navegacao/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/usuarioEstudante/todas_ofertas/todas_ofertas_estudante.css') }}">
    <title>Todas as Ofertas</title>
</head>
<body> 
    @include('usuarioEstudante.menu')
    <main class="all-offers">
        <div class="title-search">
            <h1>Todas as Ofertas Disponíveis</h1>

            <hr class="division-hr">

            <div class="filters-search">
                <div class="text-search-container">
                    <form action="{{ route('lista_todas_ofertas_estudante') }}" method="GET">
                        @csrf
                        <div class="input-box">
                            <input class="input-text" type="text" name="pesquisa_titulo" class="form-control" placeholder="Pesquisar título..." value="{{ $pesquisaTitulo ? $pesquisaTitulo: '' }}"">
                            <button class="button-b-primary" type="submit" id="pesquisaTitulo">
                                <i class="bi bi-search"><img src="{{asset('img/usuarioMembro/todas_ofertas/lupa_pesquisa.png')}}" alt=""></i> <!-- Ícone de busca (exemplo: usando Bootstrap Icons) -->
                            </button>
                            <a class="button-a-secondary button-a-icon" id="btn-filters"><img src="{{ asset('img/icones/filter.svg') }}" alt="ícone de filtros"></a>
                        </div>
                    </form>
                </div>

                <div class="filters" id="filters">
                    <form action="{{ route('lista_todas_ofertas_estudante') }}" method="GET">
                        @csrf
                        <select class="custom-select" data-live-search="true" name="area_conhecimento">
                            <option value="" selected disabled>Selecione a área conhecimento</option>
                            @foreach ($listAreaConhecimento as $areaConhecimento)
                                <option value="{{ $areaConhecimento->id_area_conhecimento }}" {{ $areaConhecimentoSelecionada == $areaConhecimento->id_area_conhecimento ? 'selected' : '' }}>{{ $areaConhecimento->nome }}</option>
                            @endforeach
                        </select>

                        <select class="custom-select" data-live-search="true" name="publico_alvo">
                            <option value="" selected disabled>Selecione o público alvo</option>
                            @foreach ($listPublicoAlvo as $publicoAlvo)
                                <option value="{{ $publicoAlvo->id_publico_alvo }}" {{ $publicoAlvoSelecionado == $publicoAlvo->id_publico_alvo ? 'selected' : '' }}>{{ $publicoAlvo->nome }}</option>
                            @endforeach
                        </select>

                        <select class="custom-select" name="status_registro">
                            <option selected disabled>Selecione o status registro</option>
                            <option value="NAO_REGISTRADA" {{ $statusRegistroSelecionado == 'NAO_REGISTRADA' ? 'selected' : '' }}>Não Registrada</option>
                            <option value="REGISTRADA" {{ $statusRegistroSelecionado == 'REGISTRADA' ? 'selected' : '' }}>Registrada</option>
                        </select>

                        <select class="custom-select" name="regime">
                            <option selected disabled>Selecione a modalidade</option>
                            <option value="PRESENCIAL" {{ $regimeSelecionado == 'PRESENCIAL' ? 'selected' : '' }}>Presencial</option>
                            <option value="ONLINE" {{ $regimeSelecionado == 'ONLINE' ? 'selected' : '' }}>Online</option>
                        </select>

                        <div class="buttons-filter">
                            <button class="button-b-primary" type="submit">Buscar</button>
                            <a href="{{route('lista_todas_ofertas_estudante')}}"><button class="button-b-secondary" id="limparFiltro">Limpar Filtros</button></a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        @if( session()->has('msg-deletar'))
            <div class="alert alert-success" style="text-align: center">
                <p>{{session('msg-deletar')}}</p>
            </div>
        @endif

        <div class="cards-container">
            @if (count($ofertas) < 1)
                <p class="no-data">Nenhuma oferta disponível</p></td>
            @else
                @foreach ($ofertas as $key => $oferta)
                    <div class="offer-card">
                        <div class="status-tag">
                            @if ($oferta['status'] == 'nao_visualizado')
                                <span class="status-nao-visualizado" title="Não Visualizado">Não Visualizado</span>
                            @elseif ($oferta['status'] == 'visualizado')
                                <span class="status-visualizado" title="Visualizado">Visualizado</span>
                            @endif
                        </div>

                        <h4>{{$oferta['oferta']->titulo}}</h4>
                        <p class="date">{{ \Carbon\Carbon::parse($oferta['oferta']->created_at)->format('d/m/Y') }}</p>

                        <hr class="division-hr">

                        <div class="offer-info">
                            <p>Área do conhecimento: {{$oferta['oferta']->areaConhecimento->nome}}</p>
                            @if ($oferta['oferta']->tipo === 'ACAO')
                                <p>Tipo de oferta: Ação</p>
                            @elseif ($oferta['oferta']->tipo === 'CONHECIMENTO')
                                <p> tipo de oferta: Conhecimento</p>
                            @endif
                        </div>

                        <hr class="division-hr">

                        <div class="action-buttons">
                            <a class="action-button" onclick="openModalVisualizarOferta({{$oferta['oferta']->id_oferta}})" >Visualizar</a>
                            <x-usuario-estudante.todas-ofertas.modal-visualizar-oferta :id-oferta="$oferta['oferta']->id_oferta" />
                            <a class="action-button" onclick="openModalDeletar({{$oferta['oferta']->id_oferta}})">Deletar</a>
                            <x-usuario-estudante.todas-ofertas.modal-deletar-oferta :id-oferta="$oferta['oferta']->id_oferta" />
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

        <div class="pagination-content ">
            {{ $paginate->links() }}
        </div>
    </main>
    <script src="{{ asset('js/errors/mensagem_erro.js') }}"></script>
    
    <script>
        // Obtém o modal e o botão
        var filters_container = document.getElementById("filters");
        var btn_filters = document.getElementById("btn-filters");

        // Quando o usuário clicar no link, abre o modal
        btn_filters.onclick = function(event) {
            event.preventDefault(); // Impede a ação padrão do link
            if (filters_container.style.display == "flex") {
                filters_container.style.display = "none"; 
            }
            else {
                filters_container.style.display = "flex"; 
            }
        }
    </script>
</body>
</html>