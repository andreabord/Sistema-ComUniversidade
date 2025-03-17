<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/components_css/usuarioProfessor/matching_ofertas/modal_contatar_oferta.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components_css/usuarioProfessor/matching_ofertas/modal_sucesso_oferta.css') }}">
    <script src="{{ asset('js/usuarioProfessor/matching_ofertas/mensagem_contatar_oferta.js') }}"></script>
    <title>Minhas Demandas</title>
</head>
<body>
    <!-- MODAL -->
    <div class="modal-out" id="clicar-fora-modal-contatar-{{$idMatching}}" onclick="closeModalVisualizarOferta({{$idMatching}})" style="display:none;"></div>
    
    <div class="modal modal-large" id="modal-contatar-{{$idMatching}}">
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
                <p class="p-info">Contatos Email</p>
                <p>{{$usuarioMembro->email}}</p>
                <p>{{$usuarioMembro->email_secundario ?? '' }}</p>                
            </div>
        </div>

        <hr class="division-hr">

        <form id="form-contato-{{$idMatching}}" action="{{ route('contato_realizado_store_professor', [$idMatching, $idOferta]) }}" method="POST" onsubmit="return validarEnviarFormulario({{$idMatching}})">
            @csrf
            <div class="contact-massage">
                <p class="p-info" style="margin-bottom:1rem;">Escreva sua mensagem:</p>
                <textarea class="input-text" name="mensagem-contato" id="mensagem-contato-{{$idMatching}}" cols="119" rows="5" maxlength="900" placeholder="Contate o ofertante através dessa caixa de mensagem (*Obrigatório)"></textarea>
            </div>
            <div class="demand-buttons">
                <button class="button-b-primary" type="submit">Enviar</button>
                <button class="button-b-secondary" type="button" onclick="closeModalContatarOferta({{$idMatching}})" id="botao-fechar-modal-contatar">Voltar</button>
            </div>
        </form>
    </div>
    <!-- MODAL -->

    <!-- MODAL SUCESSO -->
    <div class="modal-out" id="modal-sucesso-{{$idMatching}}" style="display:none;"></div>
    <div class="modal modal-small" id="modal-sucesso-{{$idMatching}}">
        <div class="modal-header">
            <h3 id="titulo-sucesso-{{$idMatching}}">Mensagem enviada com sucesso!</h3>

            <span class="fechar-modal-sucesso-contatar" onclick="fecharModalSucesso({{$idMatching}})"><button class="button-b-primary">&times;</button></span>
        </div>

        <p>Visualize esta mensagem através do menu, na seção <strong>"CONTATOS REALIZADOS"</strong>.</p>
    </div>
    <!-- MODAL SUCESSO -->
</body>
</html>