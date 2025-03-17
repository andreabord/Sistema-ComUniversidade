<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/menu_navegacao/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/usuarioEstudante/perfil/perfil_estudante.css') }}">
    <script src="{{ asset('js/perfil_imagem.js') }}"></script>
    <script src="{{ asset('js/menu/menu_navegacao.js') }}"></script>

    {{-- InputMask --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script>

    <title>Perfil</title>
</head>
<body> 
@include('usuarioEstudante.menu')
<main class="profile" id="conteudo">
    @if(session()->has('perfil-update'))
        <div class="alert alert-success">
            <p>{{ session('perfil-update') }}</p>
        </div>
    @endif

    <div class="cadastro-container">
        <div class="profile-picture-full">
            @if($usuario->foto)
                <div class="profile-picture-container">
                    <img class="profile-picture" src="{{ asset('storage/' . Auth::user()->foto) }}" alt="imagem de perfil do usuario">
                </div>
            @else
                <div class="profile-picture-container">
                    <img class="profile-picture" src="{{ asset('img/icones/user-image.svg') }}" alt="Foto de Perfil">
                </div>
            @endif
        </div>

        <div class="dados-usuario">
            <h1>Seus dados</h1>
            <hr class="division-hr">
            <p><strong>Nome:</strong> {{ $usuario->nome }}</p>
            <p><strong>Sobrenome:</strong> {{ $usuario->sobrenome }}</p>
            <p><strong>Data de Nascimento:</strong> {{ $nascimentoFormat }}</p>
            <p><strong>Email:</strong> {{ $usuario->email }}</p>
            <p><strong>Email Secundário:</strong> {{ $usuario->email_secundario }}</p>
            <p><strong>Telefone:</strong> {{ $usuario->telefone }}</p>
            <p><strong>Tipo Pessoa:</strong> {{ ucwords(strtolower($usuario->tipo_pessoa)) }}</p>
            <hr class="division-hr">
            <p><strong>CEP:</strong> {{ $cepFormat }}</p>
            <p><strong>Número:</strong> {{ $usuario->numero }}</p>
            <p><strong>Rua:</strong> {{ $cep->logradouro }}</p>
            <p><strong>Cidade:</strong> {{ $cidade->nome }}</p>
            <p><strong>Estado:</strong> {{ $estado->nome }}</p>
            <p><strong>Bairro:</strong> {{ $cep->bairro }}</p>
            <p><strong>Complemento:</strong> {{ $usuario->complemento }}</p>
            <hr class="division-hr">
            <p><strong>Instituição:</strong> {{ $usuario->instituicao ?? 'Não cadastrada' }}</p>
            <p><strong>Número de Matrícula:</strong> {{ $usuarioEstudante->ra }}</p>
            <p><strong>Curso:</strong> {{ $usuarioEstudante->curso }}</p>
        </div>
    </div>

    <div class="button-container">
        <a href="{{ route('perfil_edit_index_estudante', $usuario->id_usuario) }}">
            <button class="button-b-primary" type="submit">Editar</button>
        </a>
    </div>
</main>

<script src="{{ asset('js/errors/mensagem_erro.js') }}"></script>   
<script>

    function goBack() {
        window.history.back();
    }                                           
    // Aplica a máscara de telefone usando Inputmask
    $(document).ready(function(){
        $('#telefone').inputmask('(99) 99999-9999');
    });

    // Aplica a máscara de data usando Inputmask
    $(document).ready(function(){
        $('#nascimento').inputmask('99/99/9999');
    });
</script>
</body>
</html>