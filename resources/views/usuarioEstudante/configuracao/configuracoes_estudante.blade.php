<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/menu_navegacao/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/usuarioEstudante/configuracao/configuracoes.css') }}">
    <script src="{{ asset('js/menu/menu_navegacao.js') }}"></script>
    <title>Configurações</title>
</head>
<body> 
    @include('usuarioEstudante.menu')
    <main>
        <h2>Configurações</h2>
        <div class="buttons-container">
            <a class="button-a-primary" href="{{ route('ajuda_sistema_estudante') }}">Ajuda do Sistema</a>
            {{-- <a class="button-a-primary" href="{{ route('enviar_feedback_estudante') }}">Enviar Feedback</a> --}}
            <a class="button-a-primary" href="{{ route('sobre_nos_estudante') }}">Sobre nós</a>
        </div>
    </main>
</body>
</html>