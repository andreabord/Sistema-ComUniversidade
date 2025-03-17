<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/components_css/usuarioProfessor/todas_demandas/modal_contatar_demanda.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components_css/usuarioProfessor/todas_demandas/modal_sucesso_demanda.css') }}">
    <script src="{{ asset('js/usuarioProfessor/todas_demandas/mensagem_contatar_demanda.js') }}"></script>
    <title>Minhas Demandas</title>
</head>
<body>
    <!-- MODAL -->
    <div class="modal-out" id="clicar-fora-modal-contatar-{{$idDemanda}}" onclick="closeModalContatarOferta({{$idDemanda}})"></div>

    <div class="modal modal-large" id="modal-contatar-{{$idDemanda}}">
        <h2>{{$demanda->titulo}}</h2>
        
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
                <h6>Descrição da necessidade:</h6>
                <p>{{$demanda->descricao}}</p>
            </div>
        </div>

        <hr class="division-hr">

        <p class="p-info" style="margin-bottom:1rem;">Dados de contato</p>
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

        <hr class="division-hr">

        <form id="form-contato-{{$idDemanda}}" action="{{ route('contato_direto_store_professor', $idDemanda) }}" method="POST" onsubmit="return validarEnviarFormulario({{$idDemanda}})">
            @csrf
            <div class="contact-message">
                <p class="p-info" style="margin-bottom:1rem;">Escreva sua mensagem:</p>
                <textarea class="input-text" name="mensagem-contato" id="mensagem-contato-{{$idDemanda}}" cols="122" rows="5" maxlength="900" placeholder="Contate o ofertante através dessa caixa de mensagem (*Obrigatório)"></textarea>
            </div>
            <div class="demand-buttons">
                <button type="submit" class="button-b-primary">Enviar</button>
                <button type="button" class="button-b-secondary" onclick="closeModalContatarOferta({{$idDemanda}})" id="botao-fechar-modal-contatar">Voltar</button>
            </div>
        </form>
    </div>
    <!-- MODAL -->

    <!-- MODAL SUCESSO -->
    <div class="modal-out" id="clicar-fora-modal-sucesso-{{$idDemanda}}" style="display:none;"></div>
    <div class="modal modal-small" id="modal-sucesso-{{$idDemanda}}">
        <div class="modal-header">
            <h3 id="titulo-sucesso-{{$idDemanda}}">Mensagem enviada com sucesso!</h3>
            <span class="close-icon" onclick="fecharModalSucesso({{$idDemanda}})"><button class="button-b-primary">&times;</button></span>
        </div>

        <p>Visualize esta mensagem através do menu, na seção <strong>"CONTATOS REALIZADOS"</strong>.</p>
    </div>
    <!-- MODAL SUCESSO -->
</body>
</html>