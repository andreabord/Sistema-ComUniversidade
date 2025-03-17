<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/components_css/usuarioProfessor/contato_realizado/modal_visualizar_contato_realizado.css') }}">
    <script src="{{ asset('js/usuarioProfessor/contatos_realizados/modal_descricao_oferta.js') }}"></script>
    <title>Contatos Realizados</title>
</head>
<body>
    <div class="modal-out" id="clicar-fora-modal-visualizar-contato-realizado-{{$idContato}}" onclick="closeModalVisualizarContatoRealizado({{$idContato}})"></div>
    <div class="modal modal-large" id="modal-visualizar-contato-realizado-{{$idContato}}">

            <!-- Cabeçalho do modal com título, data e descrição da necessidade -->
            <div id="title-date-offer">
                <h4 title="{{$demanda->titulo}}">{{$demanda->titulo}}</h4>
                <p>Data da necessidade: {{ \Carbon\Carbon::parse($demanda->created_at)->format('d/m/Y') }}</p>
            </div>
            <p>{{$demanda->descricao}}</p>

            <hr class="division-hr">

            <!-- Dados do usuário contatado -->
            <p class="p-info" style="margin-bottom:1rem;">Dados do usuário contatado(a)</p>

            <div class="receiver-data">
                <p>Nome do contatado(a): {{$usuarioReceptor->nome}}</p>
                <p>Tipo de perfil: 
                    @if ($usuarioReceptor->tipo === 'MEMBRO')
                        Membro Externo
                    @elseif ($usuarioReceptor->tipo === 'ALUNO')
                        Estudante
                    @endif
                </p>
                <p>Instituição do contatado(a): 
                    @if ($usuarioReceptor->instituicao != null)
                        {{$usuarioReceptor->instituicao}}
                    @else 
                        Não registrada
                    @endif
                </p>
                <p>E-mail: {{$usuarioReceptor->email}}</p>
                <p>E-mail secundário: 
                    @if ($usuarioReceptor->email_secundario != null)
                        {{$usuarioReceptor->email_secundario}}
                    @else    
                        Não cadastrado
                    @endif
                </p>
            </div>

            <!-- Mensagem do usuário contatante -->
            <hr class="division-hr">
            <div class="sender-message data-box">
                <p class="p-info" style="margin-bottom:1rem;">Sua mensagem</p>
                <p>{{$contatoMensagem->mensagem}}</p>
            </div>

            @if ($respostaMensagem != null)
                <div class="receiver-message data-box">
                    <p class="p-info" style="margin:1rem 0;">Resposta de {{$usuarioReceptor->nome}}</label>
                    <p>{{$respostaMensagem->mensagem}}</p>
                    <hr class="division-hr">
                    <p>Atenção: o sistema entende que o contato incial já foi realizado entre as partes interessadas, portanto qualquer próxima forma de contato deve seguir por outro meio de comunicação (email, telefone ....)</p>
                </div>
            @endif

            <!-- Botão de fechamento -->
            <div class="buttons-container">
                <button class="button-b-primary" onclick="closeModalVisualizarContatoRealizado({{$idContato}})">Fechar</button>
            </div>
        </div>    
        </div>
</body>
</html>