<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/usuarioProfessor/contatos_realizados/todos_contatos_realizados.css') }}">
    <link rel="stylesheet" href="{{ asset('css/menu_navegacao/menu.css') }}">
    <script src="{{ asset('js/usuarioProfessor/contatos_realizados/modal_visualizar_contato_realizado.js') }}"></script>
    <script src="{{ asset('js/menu/menu_navegacao.js') }}"></script>
    <title>Contatos Realizados</title>
</head>
<body> 

@include('usuarioProfessor.menu')
    <main class="all-contacts">
        <h1>Contatos Realizados</h1>

        <div class="contacts-container">
            @if( session()->has('msg-contato-respondido'))
                <div class="alert alert-success" style="text-align: center">
                    <p>{{session('msg-contato-respondido')}}</p>
                </div>
            @endif

            @if (count($contatosRealizados) < 1)
                <p class="no-data">Nenhum contato realizado até o momento!</p>
            @else
                @foreach ($contatosRealizados as $contato)    
                    <a onclick="openModalVisualizarContatoRealizado({{$contato['dados']->id_contato}})">
                        <div class="contact-card">
                            <div class="contact-info-title">
                                <span class="title-info">Necessidade</span>
                                <p class="info" title="{{ $contato['demanda']->titulo }}">{{ $contato['demanda']->titulo }}</p>
                            </div>

                            <div class="contact-info-name hidden-580">
                                <span class="title-info">Nome do contato</span>
                                <p class="info" title="{{ $contato['usuarioReceptor']->nome }}">{{ $contato['usuarioReceptor']->nome }}</p>
                            </div>

                            <div class="contact-info hidden-768">
                                <span class="title-info">Tipo</span>
                                @if ($contato['usuarioReceptor']->tipo === 'ALUNO') 
                                    <p class="info">Estudante</p>
                                @elseif ($contato['usuarioReceptor']->tipo === 'MEMBRO')
                                    <p class="info">Membro Externo</p>
                                @endif
                            </div>

                            <div class="contact-info hidden-460">
                                <span class="title-info">Data</span>
                                <p class="info">{{ \Carbon\Carbon::parse($contato['dados']->created_at)->format('d/m/Y') }}</p>
                            </div>

                            <div class="contact-info-status">
                                @if ($contato['respostaMensagem'] != null)
                                    @if ($contato['respostaMensagem']->tipo_mensagem === 'INTERESSADO')
                                        <p class="status-interessado" title="Interessado(a)">Interessado(a)</p></td>
                                    @elseif ($contato['respostaMensagem']->tipo_mensagem === 'SEM_DISPONIBILIDADE')
                                        <p class="status-sem-disponibilidade" title="Sem disponibilidade">Sem disponibilidade</p></td>
                                    @elseif ($contato['respostaMensagem']->tipo_mensagem === 'RESPONDIDA')
                                        <p class="status-respondido" title="Respondido">Respondido</p></td>
                                    @endif
                                @else
                                    <p class="status-realizado" title="Mensagem Enviada">Mensagem Enviada</p></td>
                                @endif                                
                            </div>
                        </div>
                    </a>
                    <x-usuario-professor.contatos-realizados.modal-visualizar-contato-realizado :id-contato="$contato['dados']->id_contato"/>
                @endforeach
            @endif
            
            <div class="pagination-content ">
                {{ $paginate->links() }}
            </div>
        </div>
    </main>
</body>
</html>