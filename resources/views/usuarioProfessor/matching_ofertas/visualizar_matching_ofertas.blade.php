<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/menu_navegacao/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/usuarioProfessor/matching_ofertas/visualizar_matching_oferta.css') }}">
    <script src="{{ asset('js/menu/menu_navegacao.js') }}"></script>
    <script src="{{ asset('js/usuarioProfessor/matching_ofertas/modal_deletar_oferta.js') }}"></script>
    <script src="{{ asset('js/usuarioProfessor/matching_ofertas/modal_visualizar_oferta.js') }}"></script>
    <script src="{{ asset('js/usuarioProfessor/matching_ofertas/modal_descricao_demanda.js') }}"></script>
    <script src="{{ asset('js/usuarioProfessor/matching_ofertas/modal_interessados_oferta.js') }}"></script>
    <title>Matching Ofertas</title>
</head>
<body>  
<body> 
    @include('usuarioProfessor.menu')
    <main class="matchings">
        <div class="offer-header">
            <div>
                <h2>Necessidades encontradas para {{$oferta->titulo}}</h2>
                <p class="date">{{ \Carbon\Carbon::parse($oferta->created_at)->format('d/m/Y') }}</p>
            </div>

            <div class="offer-details-description">
                <div class="actions">
                    <button id ="button-toggle" class="button-b-primary" onclick="toggleDadosDetalhados()">Ver Mais</button>
                    <a class="button-a-secondary icon-button" onclick="openModalDescricao({{$oferta->id_oferta}})">
                        <img class="icon" src="{{ asset('img/icones/description.svg') }}" alt="Ver Descrição">
                    </a>
                    <x-usuario-professor.matching-acao.modal-descricao-oferta :id-oferta="$oferta->id_oferta"/>
                    @if ($oferta->tipo === 'ACAO')
                        <a class="button-a-secondary icon-button" onclick="openModalUsuariosInteressados({{$oferta->id_oferta}})">
                            <img class="icon" src="{{ asset('img/icones/user-interested.svg') }}" alt="Ver Interessados">
                        </a>
                        <x-usuario-professor.matching-acao.modal-interessados-oferta :id-oferta="$oferta->id_oferta"/>
                    @endif
                </div>
            </div>
        </div>

        <div id="dados-detalhados-oferta" class="offer-detailed-data" style="display: none;">
            <div class="dados">
                <hr class="division-hr">
                <h4>Dados da Oferta {{ strtolower($oferta->tipo) === 'acao' ? 'Ação' : 'Conhecimento' }}:</h4>
                @if ($oferta->tipo === 'ACAO')
                    <p>Regime: {{ ucwords(strtolower($ofertaAcao->regime)) }}</p>
                    <p>Duração: {{ ucwords(strtolower($ofertaAcao->duracao)) }}</p>
                    <p>Status registro: {{ $ofertaAcao->status_registro === 'REGISTRADA' ? 'Registrada' : 'Não Registrada' }}</p>
                    <p>Data limite: {{ $ofertaAcao->data_limite ? \Carbon\Carbon::parse($ofertaAcao->data_limite)->format('d/m/Y') : 'Indefinida' }}</p>
                    <p>Área conhecimento: {{$oferta->areaConhecimento->nome}}</p>
                    <p>Público alvo: {{$ofertaAcao->publicoAlvo->nome}}</p>
                    <p>Tipo da ação: {{ ucwords(strtolower($ofertaAcao->tipoAcao->nome)) }}</p>
                @elseif ($oferta->tipo === 'CONHECIMENTO')
                    <p>Área conhecimento: {{$oferta->areaConhecimento->nome}}</p>
                    <p>Tempo de experiência: {{
                        $ofertaConhecimento->tempo_atuacao === 'MENOS_1_ANO' ? 'Menos de 1 Ano' :
                        ($ofertaConhecimento->tempo_atuacao === 'MAIS_1_ANO' ? 'Mais de 1 Ano' :
                        ($ofertaConhecimento->tempo_atuacao === 'MAIS_3_ANOS' ? 'Mais de 3 Anos' : 'Mais de 5 Anos'))}}</p>
                    <p>Link lattes: <a href="{{$ofertaConhecimento->link_lattes}}">{{$ofertaConhecimento->link_lattes}}</a></p>
                    <p>Link linkedin: <a href="{{$ofertaConhecimento->link_linkedin}}">{{$ofertaConhecimento->link_linkedin}}</a></p>
                @endif
            </div>
        </div>
        

        <hr class="division-hr">

        @if( session()->has('msg-matching'))
            <div class="alert alert-success">
                <p>{{ session('msg-matching') }}</p>
            </div>
        @endif

        <div class="cards-container">
            @forelse ($demandasEncontradas as $key => $matching)
                <div class="demand-card">
                    <div class="status-tag">
                        @if ($matching['status'] == 'nao_visualizado')
                            <span class="status-nao-visualizado">Não visualizado</span>
                        @elseif ($matching['status'] == 'visualizado')
                            <span class="status-visualizado">Visualizado</span>
                        @endif
                    </div>

                    <h4>{{$matching['demanda']->titulo}}</h4>
                    <p class="date">{{ \Carbon\Carbon::parse($matching['demanda']->created_at)->format('d/m/Y') }}</p>

                    <hr class="division-hr">

                    <div class="demand-info">
                        <p><strong>Área de Conhecimento:</strong> {{$matching['demanda']->areaConhecimento->nome}}</p>
                        <p><strong>Nº de Pessoas Impactadas:</strong> {{$matching['demanda']->pessoas_afetadas}}</p>
                        <p><strong>Status:</strong> {{ $matching['status'] === 'nao_visualizado' ? 'Não Visualizado' : 'Visualizado' }}</p>
                    </div>

                    <hr class="division-hr">

                    <div class="action-buttons">
                        <a class="action-button" onclick="openModalVisualizarOferta({{$matching['demanda']->id_demanda}})">Ver</a>
                        <x-usuario-professor.matching-acao.modal-visualizar-demanda :id-matching="$matching['demanda']->id_demanda" :id-oferta="$oferta->id_oferta"/>
                        <a class="action-button" onclick="openModalDeletar({{$matching['demanda']->id_demanda}})">Deletar</a>
                        <x-usuario-professor.matching-acao.modal-deletar-matching :id-matching="$matching['demanda']->id_demanda" :id-oferta="$oferta->id_oferta"/>
                    </div>
                </div>
            @empty
                <p class="no-data">Nenhum matching encontrado para esta oferta</p>
            @endforelse
        </div>

        <script>
            function toggleDadosDetalhados() {
                const detalhes = document.getElementById('dados-detalhados-oferta');
                const botao = document.getElementById('button-toggle');

                if (detalhes.style.display === 'none') {
                    detalhes.style.display = 'flex';
                    botao.textContent = 'Ver Menos';
                } else {
                    detalhes.style.display = 'none';
                    botao.textContent = 'Ver Mais';
                }
            }
        </script>
    </main>
</body>
</html>