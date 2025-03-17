<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/menu_navegacao/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/usuarioEstudante/perfil/perfil_edit_estudante.css') }}">
    <script src="{{ asset('js/perfil_imagem.js') }}"></script>
    <script src="{{ asset('js/menu/menu_navegacao.js') }}"></script>

    {{-- InputMask --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script>
    <title>Perfil</title>
</head>
<body> 
@include('usuarioEstudante.menu')
<main class="profile-edit" id="conteudo">
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    @if ($error)
                        <p>{{ $error }}</p>
                    @endif
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('perfil_edit_store_estudante', $usuario->id_usuario) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-container">
            <div class="avatar-container">
                <input type="hidden" name="foto_atual" value="{{ Auth::user()->foto ?? 'null' }}">

                @if($usuario->foto)
                    <div class="avatar-wrapper">
                        <img id="current-image" class="avatar-image" src="{{ asset('storage/' . Auth::user()->foto) }}" alt="Imagem de perfil do usuário">
                        <button type="button" class="edit-avatar-button">
                            <img src="{{ asset('img/icones/edit.svg') }}" alt="Editar">
                        </button>
                        <input type="file" id="image-input" name="foto" class="hidden-input" accept="image/*" onchange="previewImage(event)">
                    </div>
                    <button type="button" class="remove-avatar-button" onclick="removeImage()">Remover</button>
                @else
                    <div class="avatar-wrapper" onclick="openFileSelector()">
                        <img id="current-image" class="avatar-image" src="{{ asset('img/icones/user-image.svg') }}" alt="Imagem padrão">
                        <button type="button" class="edit-avatar-button">
                            <img src="{{ asset('img/icones/edit.svg') }}" alt="Editar">
                        </button>
                        <input type="file" id="image-input" name="foto" class="hidden-input" accept="image/*" onchange="previewImage(event)">
                    </div>
                @endif
            </div>

            <div class="input-group">
                <div class="input-container">
                    <label for="nome">Nome</label>
                    <input class="input-text" type="text" id="nome" name="nome" value="{{ $usuario->nome }}" required>
                </div>

                <div class="input-container">
                    <label for="sobrenome">Sobrenome</label>
                    <input class="input-text" type="text" id="sobrenome" name="sobrenome" value="{{ $usuario->sobrenome }}" required>
                </div>

                <div class="input-container">
                    <label for="nascimento">Data Nascimento</label>
                    <input class="input-text" type="text" id="nascimento" name="nascimento" value="{{ $nascimentoFormat }}" required>
                </div>

                <div class="input-container">
                    <label for="email">Email</label>
                    <input class="input-text" type="email" id="email" name="email" value="{{ $usuario->email }}" required>
                </div>

                <div class="input-container">
                    <label for="email_secundario">Email Secundário</label>
                    <input class="input-text" type="email" id="email_secundario" name="email_secundario" value="{{ $usuario->email_secundario }}">
                </div>

                <div class="input-container">
                    <label for="telefone">Telefone</label>
                    <input class="input-text" type="text" id="telefone" name="telefone" value="{{ $usuario->telefone }}" required>
                </div>

                <div class="input-container">
                    <label for="password">Alterar Senha</label>
                    <input class="input-text" type="password" id="password" name="password" placeholder="Digite uma nova senha">
                </div>

                <div class="input-container">
                    <label for="cep">CEP</label>
                    <input class="input-text" type="text" id="cep" name="cep" value="{{ $cepFormat }}" required>
                </div>

                <div class="input-container">
                    <label for="numero">Número</label>
                    <input class="input-text" type="number" id="numero" name="numero" value="{{ $usuario->numero }}" required>
                </div>

                <div class="input-container">
                    <label for="logradouro">Rua</label>
                    <input class="input-text" type="text" id="logradouro" name="logradouro" value="{{ $cep->logradouro }}" readonly>
                </div>

                <div class="input-container">
                    <label for="bairro">Bairro</label>
                    <input class="input-text" type="text" id="bairro" name="bairro" value="{{ $cep->bairro }}" readonly>
                </div>

                <div class="input-container">
                    <label for="cidade">Cidade</label>
                    <input class="input-text" type="text" id="cidade" name="cidade" value="{{ $cidade->nome }}" readonly>
                </div>

                <div class="input-container">
                    <label for="estado">Estado</label>
                    <input class="input-text" type="text" id="estado" name="estado" value="{{ $estado->nome }}" readonly>
                </div>

                <div class="input-container">
                    <label for="instituicao">Instituição</label>
                    <input class="input-text" type="text" id="instituicao" name="instituicao" value="{{ $usuario->instituicao }}">
                </div>

                <div class="input-container">
                    <label for="ra">Número de Matrícula</label>
                    <input class="input-text" type="number" id="ra" name="ra" value="{{ $usuarioEstudante->ra }}" required>
                </div>

                <div class="input-container">
                    <label for="curso">Curso</label>
                    <input class="input-text" type="text" id="curso" name="curso" value="{{ $usuarioEstudante->curso }}" required>
                </div>
            </div>
        </div>

        <div class="button-container">
            <button class="button-b-primary" type="submit">Salvar</button>
        </div>
    </form>
</main>

<script src="{{ asset('js/errors/mensagem_erro.js') }}"></script> 
<script src="{{ asset('js/usuarioEstudante/cadastro/cep.js') }}"></script>
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

    // Aplica a máscara de Cep usando o InputMask
    $('#cep').on('input', function() {
        if ($(this).val().trim().length > 0) {
            $(this).inputmask('99999-999'); 
        }
    });

        /* OLINHO DA SENHA */
        function togglePassword() {
        var passwordField = document.getElementById("password");
        var toggleButton = document.querySelector(".toggle-password");

        if (passwordField.type === "password") {
            passwordField.type = "text";
            toggleButton.innerHTML = '<img src="{{ asset('img/icones/show.svg')}}" alt="" style="width: 25px">';
        } else {
            passwordField.type = "password";
            toggleButton.innerHTML = '<img src="{{ asset('img/icones/hide.svg')}}" alt="" style="width: 25px">';
        }
    }

    // Verifica se há dados no campo de senha para exibir o ícone do olho
    function toggleEye() {
        var passwordField = document.getElementById("password");
        var toggleButton = document.querySelector(".toggle-password");

        if (passwordField.value !== "") {
            toggleButton.style.display = "inline-block";
        } else {
            toggleButton.style.display = "none";
        }
    }

    /* IMAGEM DE PERFIL */
    function previewImage(event) {
        const input = event.target;
        const currentImage = document.getElementById('current-image');
        const imagePlaceholder = document.getElementById('image-placeholder');
        const addImageText = document.getElementById('add-image-text');

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                currentImage.src = e.target.result;
                currentImage.style.display = 'inline-block';
                if (imagePlaceholder) {
                    imagePlaceholder.style.display = 'none'; // Oculta a mensagem "Adicionar uma imagem"
                }

                if (addImageText) {
                    addImageText.style.display = 'none';
                }
            };

            reader.readAsDataURL(input.files[0]);
        } else {
            // Se nenhum arquivo foi selecionado, redefina a imagem para a imagem padrão
            currentImage.src = "{{ asset('img/icones/perfil_claro.png') }}";
            currentImage.style.display = 'inline-block';
            if (imagePlaceholder) {
                imagePlaceholder.style.display = 'block'; // Mostra novamente a mensagem "Adicionar uma imagem"
            }
        }

        currentImage.style['object-fit'] = 'cover';
    }

    function openFileSelector() {
        document.getElementById('image-input').click();
    }

    function removeImage() {
        const currentImage = document.getElementById('current-image');
        const imagePlaceholder = document.getElementById('image-placeholder');
        const addImageText = document.getElementById('add-image-text');
        const imageInput = document.getElementById('image-input');

        currentImage.src = "{{ asset('img/icones/perfil_claro.png') }}";
        currentImage.style = 'object-fit: none; padding-bottom: 0px';

        if (imagePlaceholder) {
            imagePlaceholder.style.display = 'block'; // Mostra novamente a mensagem "Adicionar uma imagem"
        }

        if (addImageText) {
            addImageText.style.display = 'block'; // Mostra o texto "Adicionar imagem"
            addImageText.style = 'margin: 0; padding-bottom: 60px; color: #FFF'; 
        }

        // Remove o arquivo de imagem do campo de entrada de arquivo (input)
        imageInput.value = ''; // Limpa o input file

        const fotoAtualHiddenInput = document.querySelector('input[name="foto_atual"]');
        fotoAtualHiddenInput.value = 'null';
    }
</script>
</body>
</html>