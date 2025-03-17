<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/components_css/usuarioEstudante/contato_realizado/modal_visualizar_contato_realizado.css') }}">
    <script src="{{ asset('js/usuarioEstudante/contatos_realizados/modal_descricao_oferta.js') }}"></script>
    <title>Contatos Realizados</title>
</head>
<body>
    <div class="modal-out" id="clicar-fora-modal-visualizar-contato-realizado-{{$idContato}}" onclick="closeModalVisualizarContatoRealizado({{$idContato}})"></div>

    <div class="modal modal-large" id="modal-visualizar-contato-realizado-{{$idContato}}">
        <div class="title-date-offer" style="margin-bottom:1rem;">
            <h3 title="{{$oferta->titulo}}">{{$oferta->titulo}}</h3>
            <p>Data da oferta: {{ \Carbon\Carbon::parse($oferta->created_at)->format('d/m/Y') }}</p>
        </div>

        <p>{{$oferta->descricao}}</p>

        <hr class="division-hr">

        <p class="p-info" style="margin-bottom:1rem;">Dados do usuário contatado(a)</p>

        <div class="receiver-data">
            <p>Nome do contatado(a): {{$usuarioReceptor->nome}}</p>
            <p>Tipo de perfil:
                @if ($usuarioReceptor->tipo === 'PROFESSOR')
                    Servidor(a)
                @elseif ($usuarioReceptor->tipo === 'ALUNO')
                    Estudante
                @endif
            </p>
            <p>Instituição do contatado(a): {{$usuarioReceptor->instituicao ?? 'Não registrada'}}</p>
            <p>E-mail: {{$usuarioReceptor->email}}</p>
            <p>E-mail secundário: {{$usuarioReceptor->email_secundario ?? 'Não cadastrado'}}</p>
        </div>

        <hr class="division-hr">

        <div class="sender-message data-box">
            <p class="p-info" style="margin-bottom:1rem;">Sua mensagem</p>
            <p>{{$contatoMensagem->mensagem}}</p>
        </div>

        @if ($respostaMensagem != null)
            <div class="receiver-message data-box">
                <p class="p-info" style="margin:1rem 0;">Resposta de {{$usuarioReceptor->nome}}</p>
                <p>{{$respostaMensagem->mensagem}}</p>
                <hr class="division-hr">
                <p>Atenção: o sistema entende que o contato inicial já foi realizado entre as partes interessadas, portanto qualquer próxima forma de contato deve seguir por outro meio de comunicação (e-mail, telefone, etc.).</p>
            </div>
        @endif

        <div class="buttons-container">
            <button class="button-b-primary" onclick="closeModalVisualizarContatoRealizado({{$idContato}})">Fechar</button>
        </div>
    </div>
</body>
</html>