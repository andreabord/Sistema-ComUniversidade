<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/menu_navegacao/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/usuarioMembro/matching_demandas/visualizar_matching_demandas.css') }}">
    <script src="{{ asset('js/menu/menu_navegacao.js') }}"></script>
    <script src="{{ asset('js/usuarioMembro/matching_demandas/modal_deletar_oferta.js') }}"></script>
    <script src="{{ asset('js/usuarioMembro/matching_demandas/modal_visualizar_oferta.js') }}"></script>
    <script src="{{ asset('js/usuarioMembro/matching_demandas/modal_descricao_demanda.js') }}"></script>
    <script src="{{ asset('js/usuarioMembro/matching_demandas/modal_ajuda_tipo_oferta.js') }}"></script>
    <title>Matching Demanda</title>
</head>
<body>
    @include('usuarioMembro.menu')
    <main class="matchings" id="conteudo">
        <div class="demand-header">
            <div>
                <div style="display:flex;flex-direction:row;justify-content:start;">
                    <h2>Ofertas encontradas para {{ $demanda->titulo }}</h2>
                </div>
                <p>Criada em: {{ \Carbon\Carbon::parse($demanda->created_at)->format('d/m/Y') }}</p>
            </div>

            <div class="demand-details-description">
                <div class="actions">
                    <button id="button-toggle" class="button-b-primary" onclick="toggleDadosDetalhados()">Ver Mais</button>
                    <a class="button-a-secondary icon-button" onclick="openModalDescricao({{ $demanda->id_demanda }})">
                        <img class="icon" src="{{ asset('img/icones/description.svg') }}" alt="Ver descrição">
                    </a>
                    <x-usuario-membro.matching.modal-descricao-demanda :id-demanda="$demanda->id_demanda"/>
                </div>
            </div>
        </div>

        <div class="demand-detailed-data" id="dados-detalhados-demanda" style="display: none;"> 
            <div class="dados">
                <hr class="division-hr">
                <h4>Dados da necessidade</h4>
                <p>Tipo: Necessidade</p>
                <p>Pessoas atingidas: aprox. {{ $demanda->pessoas_afetadas }}</p>
                <p>Duração: {{ ucwords(strtolower($demanda->duracao)) }}</p>
                <p>Instituição: {{ $demanda->instituicao_setor ?? 'Não cadastrada' }}</p>
                <p>Área de conhecimento: {{ $demanda->areaConhecimento->nome }}</p>
                <p>Público alvo: {{ $demanda->publicoAlvo->nome }}</p>
                <p>Nível de prioridade: {{ ucwords(strtolower($demanda->nivel_prioridade)) }}</p>
            </div>
        </div>
        

        <hr class="division-hr">

        @if (session()->has('msg-matching'))
            <div class="alert alert-success">
                <p>{{ session('msg-matching') }}</p>
            </div>
        @endif

        <div class="cards-container">
            @forelse ($ofertasEncontradas as $matching)
                <div class="offer-card">
                    <div class="status-tag">
                        @if ($matching['status'] == 'nao_visualizado')
                            <span class="status-nao-visualizado">Não visualizado</span>
                        @elseif ($matching['status'] == 'visualizado')
                            <span class="status-visualizado">Visualizado</span>
                        @endif
                    </div>

                    <h4>{{$matching['oferta']->titulo}}</h4>
                    <p class="date">{{ \Carbon\Carbon::parse($matching['oferta']->created_at)->format('d/m/Y') }}</p>

                    <hr class="division-hr">

                    <div class="offer-info">
                        <p>{{$matching['oferta']->areaConhecimento->nome}}</p>
                        @if ($matching['oferta']->tipo === 'ACAO')
                            <p>Ação</p>
                        @elseif ($matching['oferta']->tipo === 'CONHECIMENTO')
                            <p>Conhecimento</p>
                        @endif
                    </div>

                    <hr class="division-hr">
                    
                    <div class="action-buttons">
                        <a class="action-button" onclick="openModalVisualizarOferta({{$matching['oferta']->id_oferta}})" >Visualizar</a>
                        <x-usuario-membro.matching.modal-visualizar-oferta :id-matching="$matching['oferta']->id_oferta" :id-demanda="$demanda->id_demanda"/>
                        <a class="action-button" onclick="openModalDeletar({{$matching['oferta']->id_oferta}})">Deletar</a>
                        <x-usuario-membro.matching.modal-deletar-matching :id-matching="$matching['oferta']->id_oferta" :id-demanda="$demanda->id_demanda"/>
                    </div>
                </div>
            @empty
                <p class="no-data">Nenhuma oferta encontrada para esta necessidade</p>
            @endforelse
        </div>

        <script>
            function toggleDadosDetalhados() {
                const detalhes = document.getElementById('dados-detalhados-demanda');
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
