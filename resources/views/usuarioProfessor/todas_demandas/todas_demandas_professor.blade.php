<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- JS -->
    <script src="{{ asset('js/menu/menu_navegacao.js') }}"></script>
    <script src="{{ asset('js/usuarioProfessor/todas_demandas/modal_visualizar_demanda.js') }}"></script>
    <script src="{{ asset('js/usuarioProfessor/todas_demandas/modal_deletar_demanda.js') }}"></script>
    <script src="{{ asset('js/usuarioProfessor/todas_demandas/filtros_demandas.js') }}"></script>
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/menu_navegacao/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/usuarioProfessor/todas_demandas/todas_demandas_professor.css') }}">
    <title>Todas as Ofertas</title>
</head>
<body> 
    @include('usuarioProfessor.menu')
    <main class="all-demands">
        <h1>Todas as Necessidades Disponíveis</h1>

        <hr class="division-hr">

        <div class="filters-search">
            <div class="text-search-container">
                <form action="{{ route('lista_todas_demandas') }}" method="GET">
                    @csrf
                    <div class="input-box">
                        <input class="input-text" type="text" name="pesquisa_titulo" placeholder="Pesquisar título..." value="{{ $pesquisaTitulo ? $pesquisaTitulo : '' }}">
                        <button class="button-b-primary button-b-icon" type="submit" id="pesquisaTitulo">
                            <img src="{{ asset('img/usuarioMembro/todas_ofertas/lupa_pesquisa.png') }}" alt="Buscar">
                        </button>
                        <a class="button-a-secondary button-a-icon" id="btn-filters"><img src="{{ asset('img/icones/filter.svg') }}" alt="Ícone de filtros"></a>
                    </div>
                </form>
            </div>

            <div class="filters" id="filters">
                <form action="{{ route('lista_todas_demandas') }}" method="GET">
                    @csrf
                    <select class="custom-select" name="area_conhecimento">
                        <option value="" selected disabled>Área de Conhecimento</option>
                        @foreach ($listAreaConhecimento as $areaConhecimento)
                            <option value="{{ $areaConhecimento->id_area_conhecimento }}" {{ $areaConhecimentoSelecionada == $areaConhecimento->id_area_conhecimento ? 'selected' : '' }}>{{ $areaConhecimento->nome }}</option>
                        @endforeach
                    </select>

                    <select class="custom-select" name="publico_alvo">
                        <option value="" selected disabled>Público Alvo</option>
                        @foreach ($listPublicoAlvo as $publicoAlvo)
                            <option value="{{ $publicoAlvo->id_publico_alvo }}" {{ $publicoAlvoSelecionado == $publicoAlvo->id_publico_alvo ? 'selected' : '' }}>{{ $publicoAlvo->nome }}</option>
                        @endforeach
                    </select>

                    <select class="custom-select" name="duracao">
                        <option value="" selected disabled>Duração</option>
                        <option value="DIAS" {{ $duracaoSelecionada == 'DIAS' ? 'selected' : '' }}>Dias</option>
                        <option value="SEMANAS" {{ $duracaoSelecionada == 'SEMANAS' ? 'selected' : '' }}>Semanas</option>
                        <option value="MESES" {{ $duracaoSelecionada == 'MESES' ? 'selected' : '' }}>Meses</option>
                        <option value="ANOS" {{ $duracaoSelecionada == 'ANOS' ? 'selected' : '' }}>Anos</option>
                        <option value="INDEFINIDO" {{ $duracaoSelecionada == 'INDEFINIDO' ? 'selected' : '' }}>Indefinido</option>
                    </select>

                    <select class="custom-select" name="prioridade">
                        <option value="" selected disabled>Prioridade</option>
                        <option value="BAIXO" {{ $prioridadeSelecionada == 'BAIXO' ? 'selected' : '' }}>Baixo</option>
                        <option value="MEDIO" {{ $prioridadeSelecionada == 'MEDIO' ? 'selected' : '' }}>Médio</option>
                        <option value="ALTO" {{ $prioridadeSelecionada == 'ALTO' ? 'selected' : '' }}>Alto</option>
                    </select>

                    <div class="buttons-filter">
                        <button class="button-b-primary" type="submit">Buscar</button>
                        <a href="{{ route('lista_todas_demandas') }}" class="button-a-secondary">Limpar Filtros</a>
                    </div>
                </form>
            </div>
        </div>

        @if(session()->has('msg-deletar'))
            <div class="alert alert-success">
                <p>{{ session('msg-deletar') }}</p>
            </div>
        @endif

        <div class="cards-container">
            @if (count($demandas) < 1)
                <p class="no-data">Nenhuma necessidade disponível no momento.</p>
            @else
                @foreach ($demandas as $demanda)
                    <div class="demand-card">
                        <div class="status-tag">
                            @if ($demanda['status'] == 'nao_visualizado')
                                <span class="status-nao-visualizado">Não visualizado</span>
                            @else
                                <span class="status-visualizado">Visualizado</span>
                            @endif
                        </div>

                        <h4>{{ $demanda['demanda']->titulo }}</h4>
                        <p class="date">{{ \Carbon\Carbon::parse($demanda['demanda']->created_at)->format('d/m/Y') }}</p>

                        <hr class="division-hr">

                        <div class="demand-info">
                            <p>{{ $demanda['demanda']->areaConhecimento->nome }}</p>
                        </div>

                        <hr class="division-hr">

                        <div class="action-buttons">
                            <a class="action-button" onclick="openModalVisualizarOferta({{ $demanda['demanda']->id_demanda }})">Visualizar</a>
                            <x-usuario-professor.todas-demandas.modal-visualizar-demanda :id-demanda="$demanda['demanda']->id_demanda" />
                            <a class="action-button" onclick="openModalDeletar({{ $demanda['demanda']->id_demanda }})">Deletar</a>
                            <x-usuario-professor.todas-demandas.modal-deletar-demanda :id-demanda="$demanda['demanda']->id_demanda" />
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