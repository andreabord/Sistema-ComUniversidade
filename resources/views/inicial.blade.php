<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/inicial.css') }}">
    <title>ComUniversidade</title>
</head>

<body>
    <h2>Bem vindo(a) ao Sistema</h2>
    <div class="profile-selection-content">
        <h4>Selecione como deseja acessar</h4>
        <hr>
        <div class="profile-selection"> 
            <a href="{{ route('login_membro_index') }}" class="button-a-primary">Membro externo</a>
            <a href="{{ route('login_estudante_index') }}" class="button-a-primary">Estudante</a>
            <a href="{{ route('login_professor_index') }}" class="button-a-primary">Servidor</a>
        </div>
    </div>
</body>

</html>