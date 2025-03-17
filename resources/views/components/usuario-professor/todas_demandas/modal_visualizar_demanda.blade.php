<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/components_css/usuarioProfessor/todas_demandas/modal_visualizar_demanda.css') }}">
    <script src="{{ asset('js/usuarioProfessor/todas_demandas/modal_contatar_demanda.js') }}"></script>
    <title>Todas ofertas</title>
</head>
<body>
    <!-- MODAL -->
    <div class="modal-out" id="clicar-fora-modal-visualizar-{{$idDemanda}}" onclick="closeModalVisualizarOferta({{$idDemanda}})"></div>

    <div class="modal modal-large" id="modal-visualizar-{{$idDemanda}}">
        <h2 style="margin-bottom: 1rem;">{{$demanda->titulo}}</h2>
        
        <div class="info-content">
            <div>
                <p id="data">Criada em: {{ \Carbon\Carbon::parse($demanda->created_at)->format('d/m/Y') }}</p>
                <p>Área de conhecimento: {{$demanda->areaConhecimento->nome}}</p>
                <p>Público alvo: {{$demanda->publicoAlvo->nome}}</p>
                <p>Duração: {{ucwords(strtolower($demanda->duracao))}}</p>
                <p>Prioridade: {{ucwords(strtolower($demanda->nivel_prioridade))}}</p>
                <p>Instituição: {{$demanda->instituicao_setor ?? 'Não cadastrada'}}</p>
            </div>

            <div>
                <p class="p-info">Descrição da necessidade:</p>
                <p>{{$demanda->descricao}}</p>
            </div>
        </div>

        <hr class="division-hr">

        <p class="p-info" style="margin-bottom: 1rem;">Dados de contato</p>
        <h3>{{$usuarioMembro->nome}}</h3>

        <div class="info-content">
            <div>
                @if ($usuarioMembro->tipo === 'MEMBRO')
                    <p>Tipo de usuário: Membro externo</p>
                @elseif ($usuarioMembro->tipo === 'ALUNO')
                    <p>Tipo de usuário: Estudante</p>
                @endif
                <p>Instituição: {{$usuarioMembro->instituicao ?? 'Não cadastrada'}}</p>
            </div>

            <div>
                <p class="p-info">E-mails para contato</p>
                <p>{{$usuarioMembro->email}}</p>
                <p>{{$usuarioMembro->email_secundario ?? '' }}</p>
            </div>
        </div>

        <div class="demand-buttons">
            <a class="button-a-primary" onclick="openModalContatarOferta({{$idDemanda}})">Contatar</a>
            <form action="{{ route('contato_direto_visualizar_professor', [$idDemanda]) }}" method="POST">
                @csrf
                <span onclick="closeModalVisualizarOferta({{$idDemanda}})" id="botao-fechar-modal"><button class="button-b-secondary">Fechar</button></span>
            </form>
            <x-usuario-professor.todas-demandas.modal-contatar-demanda :id-demanda="$demanda->id_demanda" />
        </div>
    </div>
</body>
</html>