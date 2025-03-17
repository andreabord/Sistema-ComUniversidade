<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/usuarioProfessor/sair/sair_professor.css') }}">
    <title>Sair</title>
</head>
<body>
    <div class="logout-container">
        <h1>Deseja mesmo Sair?</h1>

        <div class="logout-buttons">
            <a class="button-a-primary" href="{{ route('login_professor_destroy') }}">Sim</a>
            <a class="button-a-secondary" href="{{ route('oferta_index') }}">Não</a>
        </div>
    </div>
</body>
</html>