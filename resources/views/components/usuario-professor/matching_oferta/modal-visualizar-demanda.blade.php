<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/components_css/usuarioProfessor/matching_ofertas/modal_visualizar_oferta.css') }}">
    <script src="{{ asset('js/usuarioProfessor/matching_ofertas/modal_contatar_oferta.js') }}"></script>
    <title>Minhas Demandas</title>
</head>
<body>
    <!-- MODAL -->
    <div class="modal-out" id="clicar-fora-modal-visualizar-{{$idMatching}}" onclick="closeModalVisualizarOferta({{$idMatching}})"></div>
    
    <div class="modal modal-large" id="modal-visualizar-{{$idMatching}}">
        <h2 style="margin-bottom:1rem;">{{$demanda->titulo}}</h2>

        <div class="info-content">
            <div>
                <p id="data">Criada em: {{ \Carbon\Carbon::parse($demanda->created_at)->format('d/m/Y') }}</p>
                <p>Área conhecimento: {{$demanda->areaConhecimento->nome}}</p>
                <p>Público alvo: {{$demanda->publicoAlvo->nome}}</p>
                <p>Duração: {{ucwords(strtolower($demanda->duracao))}}</p>
                <p>Tipo: Necessidade</p>
                <p>Pessoas atingidas: aprox. {{$demanda->pessoas_afetadas}}</p>
                <p>Nivel prioridade: {{ucwords(strtolower($demanda->nivel_prioridade))}}</p>
                <p>Instituição: {{$demanda->instituicao_setor ?? 'Não cadastrada' }}</p>

            </div>

            <div class="demand-description">
                <h3>Descrição da necessidade:</h3>
                <p>{{$demanda->descricao}}</p>
            </div>
        </div>

        <hr class="division-hr">

        <p class="p-info" style="margin-bottom: 1rem;">Dados de contato</p>
        <h3>{{$usuarioMembro->nome}}</h3>

        <div class="info-contente">
            @if ($usuarioMembro->tipo === 'MEMBRO')
                <p>Tipo de usuário: Membro externo</p>
            @elseif ($usuarioMembro->tipo === 'ALUNO')
                <p>Tipo de usuário: Estudante</p>
            @endif
            <p>Instituição: {{$usuarioMembro->instituicao ?? 'Não cadastrada'}}</p>
            <p class="p-info">Contatos Email</p>
            <p>{{$usuarioMembro->email}}</p>
            <p>{{$usuarioMembro->email_secundario ?? '' }}</p>
        </div>

        <div class="demand-buttons">
            <a class="button-a-primary" onclick="openModalContatarOferta({{$idMatching}})">Contatar</a>
            <form action="{{ route('matching_visualizar_demanda', [$idMatching, $idOferta]) }}" method="GET">
                @csrf
                <span onclick="closeModalVisualizarOferta({{$idMatching}})" id="botao-fechar-modal"><button class="button-b-secondary">Fechar</button></span>
            </form>
            <x-usuario-professor.matching-acao.modal-contatar-demanda :id-matching="$idMatching" :id-oferta="$id_oferta"/>
        </div>
    </div>
</body>
</html>