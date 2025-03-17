<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/menu_navegacao/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/usuarioMembro/contatos_recebidos/todos_contatos_recebidos.css') }}">
    <script src="{{ asset('js/usuarioMembro/contatos_recebidos/modal_visualizar_contato_recebido.js') }}"></script>
    <script src="{{ asset('js/menu/menu_navegacao.js') }}"></script>
    <title>Contatos Recebidos</title>
</head>
<body> 
    @include('usuarioMembro.menu')
    <main class="all-contacts">
        <h1>Contatos Recebidos</h1>

        <div class="contacts-container">
            @if( session()->has('msg-contato-respondido'))
                <div class="alert alert-success">
                    <p>{{session('msg-contato-respondido')}}</p>
                </div>
            @endif

            @if (count($contatosRecebidos) < 1)
                <p class="no-data">Nenhum contato recebido até o momento!</p>
            @else
                @foreach ($contatosRecebidos as $contato)
                    <a onclick="openModalVisualizarContatoRecebido({{$contato['dados']->id_contato}})">
                        <div class="contact-card">
                            <div class="contact-info-title">
                                <span class="title-info">Oferta</span>
                                <p class="info" title="{{ $contato['demanda']->titulo }}">{{ $contato['demanda']->titulo }}</p>
                            </div>

                            <div class="contact-info-name hidden-768">
                                <span class="title-info">Nome do contato</span>
                                <p class="info" title="{{ $contato['usuarioEmissor']->nome }}">{{ $contato['usuarioEmissor']->nome }}</p>
                            </div>

                            <div class="contact-info hidden-1080">
                                <span class="title-info">Grupo</span>
                                @if ($contato['usuarioEmissor']->tipo === 'ALUNO') 
                                    <p class="info">Estudante</p>
                                @elseif ($contato['usuarioEmissor']->tipo === 'PROFESSOR')
                                    <p class="info">Servidor(a)</p>
                                @endif
                            </div>

                            <div class="contact-info hidden-460">
                                <span class="title-info">Data do contato</span>
                                <p class="info">{{ \Carbon\Carbon::parse($contato['dados']->created_at)->format('d/m/Y') }}</p>
                            </div>

                            <div class="contact-info-status">
                                @if ($contato['respostaEnviada'] != null)
                                    @if ($contato['respostaEnviada']->tipo_mensagem === 'INTERESSADO')
                                        <td><p class="status-interessado" title="Interessado(a)">Interessado(a)</p></td>
                                    @elseif ($contato['respostaEnviada']->tipo_mensagem === 'SEM_DISPONIBILIDADE')
                                        <td><p class="status-sem-disponibilidade" title="Sem disponibilidade">Sem disponibilidade</p></td>
                                    @elseif ($contato['respostaEnviada']->tipo_mensagem === 'RESPONDIDA')
                                        <td><p class="status-respondido" title="respondido">Respondido</p></td>
                                    @endif
                                @else
                                    <td><p class="status-realizado" title="Mensagem Recebida">Mensagem Recebida</p></td>
                                @endif                                
                            </div>
                        </div>
                    </a>
                    <x-usuario-membro.contatos-recebidos.modal-visualizar-contato-recebido :id-contato="$contato['dados']->id_contato"/>
                @endforeach
            @endif

            <div class="pagination-content ">
                {{ $paginate->links() }}
            </div>
        </div>

        <script src="{{ asset('js/errors/mensagem_erro.js') }}"></script>  
    </main>
</body>
</html>