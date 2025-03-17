<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/usuarioProfessor/configuracao/configuracoes.css') }}">
    <link rel="stylesheet" href="{{ asset('css/menu_navegacao/menu.css') }}">
    <script src="{{ asset('js/menu/menu_navegacao.js') }}"></script>
    <title>Configurações</title>
</head>
<body> 
    @include('usuarioProfessor.menu')
    <main>
        <h2>Configurações</h2>
        <div class="buttons-container">
            <a class="button-a-primary" href="{{ route('ajuda_sistema_professor') }}">Ajuda do Sistema</a>
            {{-- <a class="button" href="{{ route('enviar_feedback_professor') }}">Enviar Feedback</a> --}}
            <a class="button-a-primary" href="{{ route('sobre_nos_professor') }}">Sobre nós</a>
        </div>
    </main>
</body>
</html>