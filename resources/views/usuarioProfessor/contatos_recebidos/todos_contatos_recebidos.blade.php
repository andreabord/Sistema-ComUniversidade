<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/menu_navegacao/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/usuarioProfessor/contatos_recebidos/todos_contatos_recebidos.css') }}">
    <script src="{{ asset('js/usuarioProfessor/contatos_recebidos/modal_visualizar_contato_recebido.js') }}"></script>
    <script src="{{ asset('js/menu/menu_navegacao.js') }}"></script>
    <title>Contatos Recebidos</title>
</head>
<body>
<body> 
    @include('usuarioProfessor.menu')
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
                                <span class="title-info">Título da oferta</span>
                                <p class="info" title="{{ $contato['oferta']->titulo }}">{{ $contato['oferta']->titulo }}</p>
                            </div>

                            <div class="contact-info hidden-580">
                                <span class="title-info">Tipo de oferta</span>
                                @if ($contato['oferta']->tipo === 'ACAO')
                                    <p class="info">Ação</p>
                                @elseif ($contato['oferta']->tipo === 'CONHECIMENTO')
                                    <p class="info">Conhecimento</p>
                                @endif
                            </div>

                            <div class="contact-info-name hidden-768">
                                <span class="title-info">Nome do contato</span>
                                <p class="info" title="{{$contato['usuarioEmissor']->nome}}">{{ $contato['usuarioEmissor']->nome }}</p>
                            </div>

                            <div class="contact-info hidden-1080">
                                <span class="title-info">Grupo</span>
                                @if ($contato['usuarioEmissor']->tipo === 'ALUNO') 
                                    <p class="info">Estudante</p>
                                @elseif ($contato['usuarioEmissor']->tipo === 'MEMBRO')
                                    <p class="info">Membro externo</p>
                                @endif
                            </div>

                            <div class="contact-info hidden-460">
                                <span class="title-info">Data do contato</span>
                                <p class="info">{{ \Carbon\Carbon::parse($contato['dados']->created_at)->format('d/m/Y') }}</p>
                            </div>

                            <div class="contact-info-status">
                                @if ($contato['respostaEnviada'] != null)
                                    @if ($contato['respostaEnviada']->tipo_mensagem === 'INTERESSADO')
                                        <p class="status-interessado" title="Interessado(a)">Interessado(a)</p>
                                    @elseif ($contato['respostaEnviada']->tipo_mensagem === 'SEM_DISPONIBILIDADE')
                                        <p class="status-sem-disponibilidade" title="Sem disponibilidade">Sem disponibilidade</p>
                                    @elseif ($contato['respostaEnviada']->tipo_mensagem === 'RESPONDIDA')
                                        <p class="status-respondido" title="Respondido">Respondido</p>
                                    @endif
                                @else
                                    <p class="status-realizado" title="Mensagem Recebida">Mensagem Recebida</p>
                                @endif                                
                            </div>
                        </div>
                    </a>
                    <x-usuario-professor.contatos-recebidos.modal-visualizar-contato-recebido :id-contato="$contato['dados']->id_contato"/>
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