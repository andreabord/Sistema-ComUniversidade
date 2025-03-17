<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/components_css/usuarioMembro/contato_recebido/modal_visualizar_contato_recebido.css') }}">
    <link rel="stylesheet" href="{{ asset('css/usuarioMembro/contatos_recebidos/modal_interessado_contato_recebido.css') }}">
    <link rel="stylesheet" href="{{ asset('css/usuarioMembro/contatos_recebidos/modal_nao_interessado_contato_recebido.css') }}">
    <script src="{{ asset('js/usuarioMembro/contatos_recebidos/validacao_mensagem_resposta.js') }}"></script>
    <script src="{{ asset('js/usuarioMembro/contatos_recebidos/modal_descricao_demanda.js') }}"></script>
    <title>Contatos Recebidos</title>
</head>

<body>
    <div class="modal-out" id="clicar-fora-modal-visualizar-recebido-{{$idContato}}" onclick="closeModalVisualizarContatoRecebido({{$idContato}})"></div>
    <div class="modal modal-large" id="modal-visualizar-{{$idContato}}">
        <div id="title-date-offer" style="margin-bottom:1rem;">
            <h4 title="{{$demanda->titulo}}">{{$demanda->titulo}}</h4>
            <p>Data necessidade: {{ \Carbon\Carbon::parse($demanda->created_at)->format('d/m/Y') }}</p>
        </div>
        <div>
            {{$demanda->descricao}}
        </div>

        <hr class="division-hr">

        <p class="p-info" style="margin-bottom:1rem;">Dados do usuário contatante</p>

        <div class="sender-data">
            <p>Nome do contatante: {{$usuarioEmissor->nome}}</p>
            <p>Tipo de perfil: 
                @if ($usuarioEmissor->tipo === 'MEMBRO')
                    Membro Externo
                @elseif ($usuarioEmissor->tipo === 'ALUNO')
                    Estudante
                @endif
            </p>
            <p>Instituição do contatante: 
                @if ($usuarioEmissor->instituicao != null)
                    {{$usuarioEmissor->instituicao}}
                @else 
                    Não registrada
                @endif
            </p>
            <p>E-mail: {{$usuarioEmissor->email}}</p>
            <p>E-mail secundário: 
                @if ($usuarioEmissor->email_secundario != null)
                    {{$usuarioEmissor->email_secundario}}
                @else    
                    Não cadastrado
                @endif
            </p>
        </div>

        <!-- Mensagem do contato -->
        <hr class="division-hr">

        <div class="sender-message">
            <p class="p-info" style="margin-bottom:1rem;">Mensagem de {{$usuarioEmissor->nome}}</p>
            <p>{{$contatoMensagem->mensagem}}</p>
        </div>

        <hr class="division-hr">

        @if ($respostaMensagem != null)
            <!-- Resposta já enviada -->
            <div class="receiver-message">
                <p class="p-info" style="margin-bottom:1rem;">Sua resposta</p>
                <p>{{$respostaMensagem->mensagem}}</p>
                <hr class="division-hr">
                <p>Atenção: o sistema entende que o contato inicial já foi realizado entre as partes interessadas, portanto qualquer próxima forma de contato deve seguir por outro meio de comunicação (email, telefone, etc.).</p>
            </div>
            <div class="buttons-container">
                <button class="button-b-primary" onclick="closeModalVisualizarContatoRecebido({{$idContato}})">Fechar</button>
            </div>

        @else
            <form id="form-contato-{{$idContato}}" action="{{ route('contato_recebido_store', [$idContato]) }}" method="POST" onsubmit="return validarEnviarFormulario({{$idContato}})">
                @csrf
                <div class="receiver-message">
                    <p class="p-info" style="margin-bottom:1rem;">Escreva a sua resposta</p>
                    <textarea class="input-text" name="resposta-contato" id="mensagem-contato-{{$idContato}}"  placeholder="Existe alguém interessado em sua necessidade, responda aqui (*Obrigatório)" oninput="habilitarBotoes({{$idContato}})"></textarea>
                </div>

                <div class="buttons-container">
                    <button class="button-b-primary" id="botao-interessado-{{$idContato}}" name="tipo_mensagem" type="submit" disabled>Tenho interesse</button>
                    <button class="button-b-primary" id="botao-sem-disponibilidade-{{$idContato}}" name="tipo_mensagem" type="submit" disabled>Sem disponibilidade</button>
                    <button type="button" class="button-b-secondary" onclick="closeModalVisualizarContatoRecebido({{$idContato}})">Fechar</button>
                </div>
            </form>
        @endif
    </div>

    <!-- Modais de confirmação -->
    <div class="modal-out" id="clicar-fora-modal-confirmar-interesse-{{$idContato}}" onclick="closeModalConfirmaInteresse({{$idContato}})"></div>
    <div class="modal modal-small" id="modal-confirmar-interesse-{{$idContato}}">
        <p>Você está prestes a enviar a mensagem com a informação demonstrando <span class="status-interessado">Interesse</span> no contato. Confirma o envio da mensagem?</p>
        <div class="buttons-container-confirmation">
            <button class="button-b-primary" id="botao-confirma-envio-interesse-{{$idContato}}">Confirmar</button>
            <button class="button-b-secondary" onclick="closeModalConfirmaInteresse({{$idContato}})">Cancelar</button>
        </div>
    </div>

    <div class="modal-out" id="clicar-fora-modal-confirmar-sem-disponibilidade-{{$idContato}}" onclick="closeModalConfirmaSemDisponibilidade({{$idContato}})"></div>
    <div class="modal modal-small" id="modal-confirmar-sem-disponibilidade-{{$idContato}}">
        <p>Você está prestes a enviar a mensagem com a informação demonstrando <span class="status-sem-disponibilidade">Sem disponibilidade</span> no contato. Confirma o envio da mensagem?</p>
        <div class="buttons-container-confirmation">
            <button class="button-b-primary" id="botao-confirma-envio-sem-disponibilidade-{{$idContato}}">Confirmar</button>
            <button class="button-b-secondary" onclick="closeModalConfirmaSemDisponibilidade({{$idContato}})">Cancelar</button>
        </div>
    </div>
</body>
</html>