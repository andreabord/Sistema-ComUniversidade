<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> <!-- Força o HTTPS para o ngrok -->
    <link rel="stylesheet" href="{{ asset('css/usuarioEstudante/sair/sair_estudante.css') }}">
    <title>Sair</title>
</head>
<body>
    <div class="logout-container">
        <h2>Deseja mesmo Sair?</h2>

        <div class="logout-buttons">
            <a class="button-a-primary" href="{{ route('login_estudante_destroy') }}">Sim</a>
            <a class="button-a-secondary" href="{{ route('lista_todas_ofertas_estudante') }}">Não</a>
        </div>
    </div>
</body>
</html>