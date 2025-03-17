<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/usuarioMembro/sair/sair_membro.css') }}">
    <title>Sair</title>
</head>
<body>
    <div class="logout-container">
        <h2>Deseja mesmo Sair?</h2>

        <div class="logout-buttons">
            <a class="button-a-primary" href="{{ route('login_membro_destroy') }}">Sim</a>
            <a class="button-a-secondary" href="{{ route('demanda_index') }}">Não</a>
        </div>
    </div>
</body>
</html>