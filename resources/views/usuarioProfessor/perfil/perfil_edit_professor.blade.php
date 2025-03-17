<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/menu_navegacao/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/usuarioProfessor/perfil/perfil_edit_professor.css') }}">
    <script src="{{ asset('js/perfil_imagem.js') }}"></script>
    <script src="{{ asset('js/menu/menu_navegacao.js') }}"></script>

    {{-- InputMask --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script>
    <title>Perfil</title>
</head>
<body> 
@include('usuarioProfessor.menu')
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

    <form action="{{ route('perfil_edit_store_professor', $usuario->id_usuario) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="cadastro-container">
            <div class="section-form">
                <div class="avatar-container">
                    <input type="hidden" name="foto_atual" value="{{ Auth::user()->foto ?? 'null' }}">
                    @if($usuario->foto)
                        <div class="avatar-wrapper">
                            <img id="current-image" onclick="openFileSelector()" class="avatar-image" src="{{ asset('storage/' . Auth::user()->foto) }}" alt="Imagem de perfil do usuário">
                            <button type="button" class="edit-avatar-button">
                                <img src="{{ asset('img/icones/edit.svg') }}" alt="Editar">
                            </button>
                            <input type="file" id="image-input" name="foto" class="hidden-input" accept="image/*" onchange="previewImage(event)">
                        </div>
                        <button type="button" class="remove-avatar-button" onclick="removeImage()">Remover</button>
                    @else
                        <div class="avatar-wrapper" onclick="openFileSelector()">
                            <img id="current-image" class="avatar-image" src="{{ asset('img/icones/user-image.svg') }}" alt="Imagem padrão">
                            <button type="button" class="edit-avatar-button" onclick="openFileSelector()">
                                <img src="{{ asset('img/icones/edit.svg') }}" alt="Editar">
                            </button>
                            <input type="file" id="image-input" name="foto" class="hidden-input" accept="image/*" onchange="previewImage(event)">
                        </div>
                    @endif
                </div>

                <div class="input-container">
                    <label for="nome">Nome</label>
                    <input class="input-text" type="text" id="nome" name="nome" autocomplete="off" value="{{ $usuario->nome }}" required>
                </div>

                <div class="input-container">
                    <label for="sobrenome">Sobrenome</label>
                    <input class="input-text" type="text" id="sobrenome" name="sobrenome" value="{{ $usuario->sobrenome }}" autocomplete="off" required>
                </div>

                <div class="input-container">
                    <label for="nascimento">Data Nascimento</label>
                    <input class="input-text" type="text" id="nascimento" name="nascimento" value="{{ $nascimentoFormat }}" autocomplete="off" required>
                </div>

                <div class="input-container">
                    <label for="email">Email</label>
                    <input class="input-text" type="email" id="email" name="email" autocomplete="off" value="{{ $usuario->email }}" required>
                </div>

                <div class="input-container">
                    <label for="email_secundario">Email Secundário</label>
                    <input class="input-text" type="email" id="email_secundario" name="email_secundario" value="{{ $usuario->email_secundario }}" autocomplete="off">
                </div>

                <div class="input-container">
                    <label for="telefone">Telefone</label>
                    <input class="input-text" type="text" id="telefone" name="telefone" autocomplete="off" value="{{ $usuario->telefone }}" required>
                </div>

                <div class="input-container">
                    <label for="password">Alterar Senha</label>
                    <input class="input-text" type="password" id="password" name="password" autocomplete="off">
                </div>

                <div class="input-container">
                    <label for="cep">CEP</label>
                    <input class="input-text" type="text" id="cep" name="cep" autocomplete="off" value="{{ $cepFormat }}" required>
                </div>

                <div class="input-container">
                    <label for="numero">Número</label>
                    <input class="input-text" type="number" id="numero" name="numero" value="{{ $usuario->numero }}" autocomplete="off" required>
                </div>

                <div class="input-container">
                    <label for="logradouro">Rua</label>
                    <input class="input-text" type="text" id="logradouro" name="logradouro" autocomplete="off" value="{{ $cep->logradouro }}" readonly>
                </div>

                <div class="input-container">
                    <label for="complemento">Complemento</label>
                    <input class="input-text" type="text" id="complemento" name="complemento" value="{{ $usuario->complemento }}" autocomplete="off">
                </div>

                <div class="input-container">
                    <label for="bairro">Bairro</label>
                    <input class="input-text" type="text" id="bairro" name="bairro" autocomplete="off" value="{{ $cep->bairro }}" readonly>
                </div>

                <div class="input-container">
                    <label for="cidade">Cidade</label>
                    <input class="input-text" type="text" id="cidade" name="cidade" autocomplete="off" value="{{ $cidade->nome }}" readonly>
                </div>

                <div class="input-container">
                    <label for="estado">Estado</label>
                    <input class="input-text" type="text" id="estado" name="estado" autocomplete="off" value="{{ $estado->nome }}" readonly>
                </div>

                <div class="input-container">
                    <label for="instituicao">Instituição</label>
                    <input class="input-text" type="text" id="instituicao" name="instituicao" autocomplete="off" value="{{ $usuario->instituicao }}">
                </div>

                <div class="input-container">
                    <label for="numero_registro">Número do Registro</label>
                    <input class="input-text" type="number" id="numero_registro" name="numero_registro" autocomplete="off" value="{{ $usuarioProfessor->numero_registro }}" required maxlength="20">
                </div>

                <div class="input-container">
                    <label for="link_curriculo">Link do Currículo</label>
                    <input class="input-text" type="text" id="link_curriculo" name="link_curriculo" autocomplete="off" value="{{ $usuarioProfessor->link_curriculo }}">
                </div>
            </div>
        </div>
        
        <div class="button-container">
            <button class="button-b-primary" type="submit">Salvar</button>
        </div>
    </form>
</main>
    <script src="{{ asset('js/errors/mensagem_erro.js') }}"></script> 
    <script src="{{ asset('js/usuarioProfessor/cadastro/cep.js') }}"></script>

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

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    currentImage.src = e.target.result;
                    currentImage.style.display = 'inline-block';
                };

                reader.readAsDataURL(input.files[0]);
            } else {
                currentImage.src = "{{ asset('img/icones/user-image.svg') }}";
                currentImage.style.display = 'inline-block';
            }
        }

        function openFileSelector() {
            document.getElementById('image-input').click();
        }

        function removeImage() {
            const currentImage = document.getElementById('current-image');
            const imageInput = document.getElementById('image-input');

            currentImage.src = "{{ asset('img/icones/user-image.svg') }}";
            imageInput.value = '';

            const fotoAtualHiddenInput = document.querySelector('input[name="foto_atual"]');
            fotoAtualHiddenInput.value = 'null';
        }
    </script>
</body>
</html>