<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/usuarioEstudante/contatos_realizados/todos_contatos_realizados.css') }}">
    <link rel="stylesheet" href="{{ asset('css/menu_navegacao/menu.css') }}">
    <script src="{{ asset('js/usuarioEstudante/contatos_realizados/modal_visualizar_contato_realizado.js') }}"></script>
    <script src="{{ asset('js/menu/menu_navegacao.js') }}"></script>
    <title>Contatos Realizados</title>
</head>
<body> 
    @include('usuarioEstudante.menu')
    <main class="all-contacts">
        <h1>Contatos Realizados</h1>

        <div class="contacts-container">
            @if( session()->has('msg-contato-respondido'))
                <div class="alert alert-success">
                    <p>{{session('msg-contato-respondido')}}</p>
                </div>
            @endif

            @if (count($contatosRealizados) < 1)
                <p class="no-data">Nenhum Contato Realizado</p></td>
            @else
                @foreach ($contatosRealizados as $contato) 
                    <a onclick="openModalVisualizarContatoRealizado({{$contato['dados']->id_contato}})">
                        <div class="contact-card">
                            <div class="contact-info-title">
                                <span class="title-info">Oferta</span>
                                <p class="info" title="{{ $contato['oferta']->titulo }}">{{ $contato['oferta']->titulo }}</p>
                            </div>

                            <div class="contact-info-name hidden-460">
                                <span class="title-info">Nome do contatado</span>
                                <p class="info" title="{{ $contato['usuarioReceptor']->nome }}">{{ $contato['usuarioReceptor']->nome }}</p>
                            </div>

                            <div class="contact-info hidden-768">
                                <span class="title-info">Grupo</span>
                                @if ($contato['usuarioReceptor']->tipo === 'PROFESSOR') 
                                    <p class="info">Servidor(a)</p>
                                @elseif ($contato['usuarioReceptor']->tipo === 'MEMBRO')
                                    <p class="info">Membro externo</p>
                                @endif
                            </div>

                            <div class="contact-info hidden-580">
                                <span class="title-info">Data</span>
                                <p class="info">{{ \Carbon\Carbon::parse($contato['dados']->created_at)->format('d/m/Y') }}</p>
                            </div>
                            
                            <div class="contact-info-status">
                                @if ($contato['respostaMensagem'] != null)
                                    @if ($contato['respostaMensagem']->tipo_mensagem === 'INTERESSADO')
                                        <p title="Interessado(a)" class="status-interessado">Interessado(a)</p>
                                    @elseif ($contato['respostaMensagem']->tipo_mensagem === 'SEM_DISPONIBILIDADE')
                                        <p title="Sem disponibilidade" class="status-sem-disponibilidade">Sem disponibilidade</p>
                                    @elseif ($contato['respostaMensagem']->tipo_mensagem === 'RESPONDIDA')
                                        <p title="respondido" class="status-respondido">Respondido</p>
                                    @endif
                                @else
                                    <p title="Mensagem Enviada" class="status-realizado">Mensagem Enviada</p>
                                @endif
                            </div>
                        </div>
                    </a>
                    <x-usuario-estudante.contatos-realizados.modal-visualizar-contato-realizado :id-contato="$contato['dados']->id_contato"/>
                @endforeach
            @endif
            
            <div class="pagination-content ">
                {{ $paginate->links() }}
            </div> 
        </div>
    </main>
</body>
</html>