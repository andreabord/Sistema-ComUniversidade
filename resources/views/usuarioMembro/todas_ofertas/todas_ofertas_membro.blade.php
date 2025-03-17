<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- JS -->
    <script src="{{ asset('js/menu/menu_navegacao.js') }}"></script>
    <script src="{{ asset('js/usuarioMembro/todas_ofertas/modal_visualizar_oferta.js') }}"></script>
    <script src="{{ asset('js/usuarioMembro/todas_ofertas/modal_deletar_oferta.js') }}"></script>
    <script src="{{ asset('js/usuarioMembro/todas_ofertas/filtros_ofertas.js') }}"></script>
    <script src="{{ asset('js/usuarioMembro/todas_ofertas/modal_ajuda_tipo_oferta.js') }}"></script>
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/menu_navegacao/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/usuarioMembro/todas_ofertas/todas_ofertas_membro.css') }}">
    <title>Todas as Ofertas</title>
</head>

<body> 
    @include('usuarioMembro.menu')
    <main class="all-offers">
        <div style="display:flex;flex-direction:row;justify-content:start;">
            <h1>Todas as Ofertas Disponíveis</h1>
            <img src="{{asset('img/icones/info.svg')}}" alt="Mais informações" style="width:1.5rem;height:1.5rem;margin: auto 0 auto 1rem;cursor:pointer" onclick="openModalAjudaTipoOferta({{$usuarioMembro}})">
            <x-usuario-membro.todas-ofertas.modal-ajuda-tipo-oferta :id-usuario="$usuarioMembro"/>
        </div>
        
        <hr class="division-hr">

        <div class="filters-search">
            <div class="text-search-container">
                <form action="{{ route('list_todas_ofertas') }}" method="GET">
                    @csrf
                    <div class="input-box">
                        <input class="input-text" type="text" name="pesquisa_titulo" class="form-control" placeholder="Pesquisar título..." value="{{ $pesquisaTitulo ? $pesquisaTitulo: '' }}">
                        <button class="button-b-primary button-b-icon" type="submit" id="pesquisaTitulo">
                            <i class="bi bi-search"><img src="{{asset('img/usuarioMembro/todas_ofertas/lupa_pesquisa.png')}}" alt=""></i> <!-- Ícone de busca (exemplo: usando Bootstrap Icons) -->
                        </button>
                        <a class="button-a-secondary button-a-icon" id="btn-filters"><img src="{{asset('img/icones/filter.svg')}}" alt="ícone de filtros"></a>
                    </div>
                </form>
            </div>


            <div class="filters" id="filters">
                <form action="{{ route('list_todas_ofertas') }}" method="GET">
                    @csrf
                    <select class="custom-select" id="opcao" autocomplete="off" onchange="mostrarFormulario()" name="tipo_oferta">
                        <option value="" selected disabled>Selecione o tipo de oferta</option>
                        <option value="ACAO" {{ $tipoOfertaSelecionada == 'ACAO' ? 'selected' : '' }}>Ação</option>
                        <option value="CONHECIMENTO" {{ $tipoOfertaSelecionada == 'CONHECIMENTO' ? 'selected' : '' }}>Conhecimento</option>
                    </select>

                    <!-- formulário de ação -> aparece se o usuário escolhe ação -->
                    <div class="filter-type" id="formularioFiltroAcao" style="display: none;">
                        <select class="custom-select" data-live-search="true" name="area_conhecimento_acao">
                            <option value="" selected disabled>Selecione a área de conhecimento</option>
                            @foreach ($listAreaConhecimento as $areaConhecimento)
                                <option value="{{ $areaConhecimento->id_area_conhecimento }}" {{ $areaConhecimentoSelecionadaAcao == $areaConhecimento->id_area_conhecimento ? 'selected' : '' }}>{{ $areaConhecimento->nome }}</option>
                            @endforeach
                        </select>

                        <select class="custom-select" data-live-search="true" name="publico_alvo">
                            <option value="" selected disabled>Selecione o público alvo</option>
                            @foreach ($listPublicoAlvo as $publicoAlvo)
                                <option value="{{ $publicoAlvo->id_publico_alvo }}" {{ $publicoAlvoSelecionado == $publicoAlvo->id_publico_alvo ? 'selected' : '' }}>{{ $publicoAlvo->nome }}</option>
                            @endforeach
                        </select>

                        <select class="custom-select" name="status_registro">
                            <option selected disabled>Selecione o status de registro</option>
                            <option value="NAO_REGISTRADA" {{ $statusRegistroSelecionado == 'NAO_REGISTRADA' ? 'selected' : '' }}>Não Registrada</option>
                            <option value="REGISTRADA" {{ $statusRegistroSelecionado == 'REGISTRADA' ? 'selected' : '' }}>Registrada</option>
                        </select>

                        <select class="custom-select" name="regime">
                            <option selected disabled>Selecione a modalidade</option>
                            <option value="PRESENCIAL" {{ $regimeSelecionado == 'PRESENCIAL' ? 'selected' : '' }}>Presencial</option>
                            <option value="ONLINE" {{ $regimeSelecionado == 'ONLINE' ? 'selected' : '' }}>Online</option>
                        </select>
                    </div>


                    <!-- formulário de conhecimento -> aparece se o usuário escolhe conhecimento -->
                    <div class="filter-type" id="formularioFiltroConhecimento" style="display: none;">
                        <select class="custom-select"data-live-search="true" name="area_conhecimento_conhecimento">
                            <option value="" selected>Selecione a área de conhecimento</option>
                            @foreach ($listAreaConhecimento as $areaConhecimento)
                                <option value="{{ $areaConhecimento->id_area_conhecimento }}" {{ $areaConhecimentoSelecionadaConhecimento == $areaConhecimento->id_area_conhecimento ? 'selected' : '' }}>{{ $areaConhecimento->nome }}</option>
                            @endforeach
                        </select>

                        <select class="custom-select" name="tempo_atuacao">
                            <option selected disabled>Selecione o tempo experiência</option>
                            <option value="MENOS_1_ANO" {{ $tempoAtuacaoSelecionado == 'MENOS_1_ANO' ? 'selected' : '' }}>Menos de 1 Ano</option>
                            <option value="MAIS_1_ANO" {{ $tempoAtuacaoSelecionado == 'MAIS_1_ANO' ? 'selected' : '' }}>Mais de 1 Ano</option>
                            <option value="MAIS_3_ANOS" {{ $tempoAtuacaoSelecionado == 'MAIS_3_ANOS' ? 'selected' : '' }}>Mais de 3 Anos</option>
                            <option value="MAIS_5_ANOS" {{ $tempoAtuacaoSelecionado == 'MAIS_5_ANOS' ? 'selected' : '' }}>Mais de 5 Anos</option>
                        </select>
                    </div>

                    <div class="buttons-filter">
                        <button class="button-b-primary" type="submit">Buscar</button>
                        <a href="{{route('list_todas_ofertas')}}"><button class="button-b-secondary" id="limparFiltro">Limpar Filtros</button></a>
                    </div>
                </form>
            </div>
        </div>

        @if( session()->has('msg-deletar'))
            <div class="alert alert-success">
                <p>{{session('msg-deletar')}}</p>
            </div>
        @endif

        <div class="cards-container">
            @if (count($ofertas) < 1)
                <p class="no-data">Nenhuma oferta disponível</p>
            @else
                @foreach ($ofertas as $key => $oferta)
                    <div class="offer-card">
                        <div class="status-tag">
                            @if ($oferta['status'] == 'nao_visualizado')
                                <span class="status-nao-visualizado">Não visualizado</span>
                            @elseif ($oferta['status'] == 'visualizado')
                                <span class="status-visualizado">Visualizado</span>
                            @endif
                        </div>

                        <h4>{{$oferta['oferta']->titulo}}</h4>
                        <p class="date">{{ \Carbon\Carbon::parse($oferta['oferta']->created_at)->format('d/m/Y') }}</p>

                        <hr class="division-hr">

                        <div class="offer-info">
                            <p>{{$oferta['oferta']->areaConhecimento->nome}}</p>
                            @if ($oferta['oferta']->tipo === 'ACAO')
                                <p>Ação</p>
                            @elseif ($oferta['oferta']->tipo === 'CONHECIMENTO')
                                <p>Conhecimento</p>
                            @endif
                        </div>

                        <hr class="division-hr">

                        <div class="action-buttons">
                            <a class="action-button" onclick="openModalVisualizarOferta({{$oferta['oferta']->id_oferta}})" >Visualizar</a>
                            <x-usuario-membro.todas-ofertas.modal-visualizar-oferta :id-oferta="$oferta['oferta']->id_oferta" />
                            <a class="action-button" onclick="openModalDeletar({{$oferta['oferta']->id_oferta}})">Deletar</a>
                            <x-usuario-membro.todas-ofertas.modal-deletar-oferta :id-oferta="$oferta['oferta']->id_oferta" />
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

        <div class="pagination-content ">
            {{ $paginate->links() }}
        </div>

        <script>
            /* opcao SELECT */
            function mostrarFormulario() {
                var opcao = document.getElementById("opcao").value;

                // Esconde todos os formulários
                document.getElementById("formularioFiltroAcao").style.display = "none";
                document.getElementById("formularioFiltroConhecimento").style.display = "none";

                // Mostra o formulário correspondente à opção selecionada
                if (opcao === "ACAO") {
                    document.getElementById("formularioFiltroAcao").style.display = "flex";
                    document.getElementById("formularioFiltroConhecimento").style.display = "none";
                } else if (opcao === "CONHECIMENTO") {
                    document.getElementById("formularioFiltroConhecimento").style.display = "flex";
                    document.getElementById("formularioFiltroAcao").style.display = "none";
                }
            }

            document.addEventListener("DOMContentLoaded", function() {
                // Verifica o tipo de oferta selecionado
                var tipoSelecionado = document.getElementById("opcao").value;

                // Exibe o formulário correspondente
                if (tipoSelecionado === "ACAO") {
                    document.getElementById("formularioFiltroAcao").style.display = "flex";
                } else if (tipoSelecionado === "CONHECIMENTO") {
                    document.getElementById("formularioFiltroConhecimento").style.display = "flex";
                }
            });

            // Chamando a função ao carregar a página
            document.addEventListener("DOMContentLoaded", function() {
                mostrarFormulario();
            });

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
    </main>
    <script src="{{ asset('js/errors/mensagem_erro.js') }}"></script>  
</body>
</html>