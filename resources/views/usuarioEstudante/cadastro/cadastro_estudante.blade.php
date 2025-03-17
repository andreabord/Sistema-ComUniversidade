<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/usuarioEstudante/cadastro/cadastro_estudante.css') }}">

    {{-- InputMask --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script>
    <title>Cadastro de estudantes</title>
</head>
<body>
    <div class="register-container">
        <h1>Cadastro estudante</h1>
        <h5>Seja bem-vindo(a)!</h5>

        <hr class="division-hr">

        <form method="POST" action="{{ route('cadastro_create_estudante') }}" enctype="multipart/form-data">
            @csrf
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

            <div class="input-image">
                <div class="img-foto-perfil">
                    <img id="current-image" style="display: none;">
                    <img id="image-placeholder" src="{{asset('img/icones/user-image.svg')}}" alt="">
                </div>
                <div class="button-container">
                    <button class="button-b-primary" type="button" id="add-image" onclick="openFileSelector()">Adicionar imagem</button>
                    <button class="button-b-secondary" type="button" id="remove-image" onclick="removeImage()" style="display: none;">Remover imagem</button>
                </div>
                <input type="file" id="image-input" name="foto" style="display: none;" accept="image/*" onchange="previewImage(event)" maxlength="255">
            </div>
            
            <div class="inputs-content">
                {{-- NOME --}}
                <div class="input-container">
                    @error('nome')
                        <label for="nome">Nome *</label>
                        <input class="alert-danger" type="text" id="nome" name="nome" autocomplete="off" value="{{old('nome')}}" maxlength="60" required title="{{ $message }}">
                    @else
                        <label for="nome">Nome *</label>
                        <input class="input-text" type="text" id="nome" name="nome" autocomplete="off" value="{{old('nome')}}" maxlength="60" required>
                    @enderror
                </div>

                {{-- SOBRENOME --}}
                <div class="input-container">
                    @error('sobrenome')
                        <label for="sobrenome">Sobrenome *</label>
                        <input class="alert-danger" type="text" id="sobrenome" name="sobrenome" autocomplete="off" value="{{old('sobrenome')}}" maxlength="100" required title="{{ $message }}">
                    @else
                        <label for="sobrenome">Sobrenome *</label>
                        <input class="input-text" type="text" id="sobrenome" name="sobrenome" autocomplete="off" value="{{old('sobrenome')}}" maxlength="100" required>
                    @enderror
                </div>

                {{-- NASCIMENTO --}}
                <div class="input-container">
                    @error('nascimento')
                        <label for="nascimento">Data Nascimento *</label>
                        <input class="alert-danger" type="text" id="nascimento" name="nascimento" autocomplete="off" value="{{old('nascimento')}}" required title="{{ $message }}">
                    @else
                        <label for="nascimento">Data Nascimento *</label>
                        <input class="input-text" type="text" id="nascimento" name="nascimento" autocomplete="off" value="{{old('nascimento')}}" required>
                    @enderror
                </div>

                {{-- EMAIL --}}
                <div class="input-container">
                    @error('email')
                        <label for="email">Email *</label>
                        <input class="alert-danger" type="email" id="email" name="email" autocomplete="off" value="{{old('email')}}" maxlength="255" required title="{{ $message }}">
                    @else
                        <label for="email">Email *</label>
                        <input class="input-text" type="email" id="email" name="email" autocomplete="off" value="{{old('email')}}" maxlength="255" required>
                    @enderror
                </div>

                {{-- EMAIL_SECUNDARIO --}}
                <div class="input-container">
                    @error('email_secundario')
                        <label for="email_secundario">Email Secundário</label>
                        <input class="alert-danger" type="email" id="email_secundario" name="email_secundario" autocomplete="off" value="{{old('email_secundario')}}" title="{{ $message }}">
                    @else
                        <label for="email_secundario">Email Secundário</label>
                        <input class="input-text" type="email" id="email_secundario" name="email_secundario" autocomplete="off" value="{{old('email_secundario')}}">
                    @enderror
                </div>

                {{-- TELEFONE --}}
                <div class="input-container">
                    @error('telefone')
                        <label for="telefone">Telefone *</label>
                        <input class="alert-danger" type="text" id="telefone" name="telefone" autocomplete="off" value="{{old('telefone')}}" required title="{{ $message }}">
                    @else
                        <label for="telefone">Telefone *</label>
                        <input class="input-text" type="text" id="telefone" name="telefone" autocomplete="off" value="{{old('telefone')}}" required>
                    @enderror
                </div>

                {{-- PASSWORD --}}
                <div class="input-container" style="position: relative;">
                    @error('password')
                        <label for="password">Senha *</label>
                        <input class="alert-danger" type="password" id="password" name="password" autocomplete="off" required maxlength="100" title="{{ $message }}" oninput="toggleEye()">
                        <span class="info-icon" onclick="showPasswordRules()" style="position: absolute; right: 7.5px; bottom: 5px;">
                            <img src="{{ asset('img/icones/info.svg') }}" alt="Ícone informativo" style="width: 1.5rem;">
                        </span>
                        <span class="toggle-password" onclick="togglePassword()" style="display: none; position: absolute; right: 35px; bottom: 5px;">
                            <img src="{{ asset('img/icones/show.svg') }}" alt="" style="width: 1.5rem;">
                        </span>
                    @else
                        <label for="password">Senha *</label>
                        <input class="input-text" type="password" id="password" name="password" autocomplete="off" required maxlength="100" oninput="toggleEye()">
                        <span class="info-icon" onclick="showPasswordRules()" style="position: absolute; right: 7.5px; bottom: 5px;">
                            <img src="{{ asset('img/icones/info.svg') }}" alt="Ícone informativo" style="width: 1.5rem;">
                        </span>
                        <span class="toggle-password" onclick="togglePassword()" style="display: none; position: absolute; right: 35px; bottom: 5px;">
                            <img src="{{ asset('img/icones/show.svg') }}" alt="" style="width: 1.5rem;">
                        </span>
                    @enderror
                    <div id="password-rules" style="display: none; position: absolute; right: 7.5px; bottom: 80%; padding: 1rem; background-color: white; border: 1px solid var(--color-medium-grey); border-radius: 12px; list-style: inside;">
                        <p>Regras de criação de senha:</p>
                        <ul>
                            <li>Deve conter pelo menos 8 caracteres</li>
                            <li>Deve conter pelo menos uma letra maiúscula</li>
                            <li>Deve conter pelo menos uma letra minúscula</li>
                            <li>Deve conter pelo menos um número</li>
                        </ul>
                    </div>
                </div>

                {{-- CEP --}}
                <div class="input-container">
                    @error('cep')
                        <label for="cep">CEP *</label>
                        <input title="{{ $message }}" class="alert-danger input-text" id="cep" autocomplete="off" type="text" name="cep" value="{{old('cep')}}" required>
                    @else
                        <label for="cep">CEP *</label>
                        <input type="text" name="cep" id="cep" class="input-text" autocomplete="off" value="{{old('cep')}}" required>
                    @enderror
                </div>

                {{-- RUA --}}
                <div class="input-container readonly">
                    @error('logradouro')
                        <label for="logradouro">Rua</label>
                        <input title="{{ $message }}" class="alert-danger input-text" autocomplete="off" type="text" id="logradouro" name="logradouro" value="{{old('logradouro')}}" required readonly>
                    @else
                        <label for="logradouro">Rua</label>
                        <input type="text" id="logradouro" name="logradouro" class="input-text" autocomplete="off" value="{{old('logradouro')}}" required readonly>
                    @enderror
                </div>

                {{-- NUMERO --}}
                <div class="input-container">
                    @error('numero')
                        <label for="numero">Número *</label>
                        <input title="{{ $message }}" class="alert-danger input-text" autocomplete="off" type="number" id="numero" name="numero" value="{{old('numero')}}" required maxlength="20">
                    @else
                        <label for="numero">Número *</label>
                        <input type="number" id="numero" name="numero" class="input-text" autocomplete="off" value="{{old('numero')}}" required maxlength="20">
                    @enderror
                </div>

                {{-- COMPLEMENTO --}}
                <div class="input-container">
                    @error('complemento')
                        <label for="complemento">Complemento</label>
                        <input title="{{ $message }}" class="alert-danger input-text" autocomplete="off" type="text" id="complemento" name="complemento" value="{{old('complemento')}}" maxlength="255">
                    @else
                        <label for="complemento">Complemento</label>
                        <input type="text" id="complemento" name="complemento" class="input-text" autocomplete="off" value="{{old('complemento')}}" maxlength="255">
                    @enderror
                </div>

                {{-- ESTADO --}}
                <div class="input-container readonly">
                    @error('estado')
                        <label for="estado">Estado</label>
                        <input title="{{ $message }}" type="text" id="estado" class="estado alert-danger input-text" autocomplete="off" name="estado" value="{{old('estado')}}" required readonly>
                    @else
                        <label for="estado">Estado</label>
                        <input class="estado input-text" type="text" id="estado" name="estado" autocomplete="off" value="{{old('estado')}}" readonly required>
                    @enderror
                </div>

                {{-- BAIRRO --}}
                <div class="input-container readonly">
                    @error('bairro')
                        <label for="bairro">Bairro</label>
                        <input title="{{ $message }}" type="text" id="bairro" class="bairro alert-danger input-text" autocomplete="off" name="bairro" value="{{old('bairro')}}" required readonly>
                    @else
                        <label for="bairro">Bairro</label>
                        <input type="text" id="bairro" class="bairro input-text" name="bairro" autocomplete="off" value="{{old('bairro')}}" readonly required>
                    @enderror
                </div>

                {{-- CIDADE --}}
                <div class="input-container readonly">
                    @error('cidade')
                        <label for="cidade">Cidade</label>
                        <input title="{{ $message }}" type="text" id="cidade" class="cidade alert-danger input-text" autocomplete="off" name="cidade" value="{{old('cidade')}}" required readonly>
                    @else
                        <label for="cidade">Cidade</label>
                        <input type="text" id="cidade" class="cidade input-text" name="cidade" autocomplete="off" value="{{old('cidade')}}" required readonly>
                    @enderror
                </div>

                {{-- INSTITUICAO --}}
                <div class="input-container">
                    @error('instituicao')
                        <label for="instituicao">Instituição</label>
                        <input title="{{ $message }}" class="alert-danger input-text" autocomplete="off" type="text" id="instituicao" name="instituicao" value="{{old('instituicao')}}" maxlength="100">
                    @else
                        <label for="instituicao">Instituição</label>
                        <input type="text" id="instituicao" name="instituicao" class="input-text" autocomplete="off" value="{{old('instituicao')}}" maxlength="100">
                    @enderror
                </div>

                {{-- CURSO --}}
                <div class="input-container">
                    @error('curso')
                        <label for="curso">Curso *</label>
                        <input title="{{ $message }}" class="alert-danger input-text" autocomplete="off" type="text" id="curso" name="curso" value="{{old('curso')}}" required maxlength="255">
                    @else
                        <label for="curso">Curso *</label>
                        <input type="text" id="curso" name="curso" class="input-text" autocomplete="off" value="{{old('curso')}}" required maxlength="255">
                    @enderror
                </div>

                {{-- RA --}}
                <div class="input-container">
                    @error('ra')
                        <label for="ra">Número de matrícula *</label>
                        <input title="{{ $message }}" class="alert-danger input-text" autocomplete="off" type="text" id="ra" name="ra" value="{{ old('ra') }}" required maxlength="20">
                    @else
                        <label for="ra">Número de matrícula *</label>
                        <input type="text" id="ra" name="ra" class="input-text" autocomplete="off" value="{{ old('ra') }}" required maxlength="20">
                    @enderror
                </div>
            </div>

            <div class="button-container">
                <button class="button-b-primary" style="margin-top: 1rem;" type="submit">Cadastrar</button>
                <p>* Campos Obrigatórios</p>
            </div>
        </form>
    </div>

    <div class="login-content">
        <p>Já possui cadastro? Faça log in</p>
        <a href="{{ route('login_estudante_index') }}" class="button-a-secondary">Entre</a>
    </div>

    <script src="{{ asset('js/usuarioMembro/login_membro/mensagem_erro.js') }}"></script>
    <script src="{{ asset('js/usuarioEstudante/cadastro/cep.js') }}"></script>
    <script>
        // Aplica a máscara de telefone usando Inputmask
        $('#telefone').on('input', function() {
            if ($(this).val().trim().length > 0) {
                $(this).inputmask('(99) 99999-9999');
            }
        });
    
        // Aplica a máscara de data usando Inputmask
        $('#nascimento').on('input', function() {
            if ($(this).val().trim().length > 0) {
                $(this).inputmask('99/99/9999');
            }
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
                toggleButton.innerHTML = '<img src="{{ asset('img/icones/hide.svg')}}" alt="" style="width: 1.5rem">';
            } else {
                passwordField.type = "password";
                toggleButton.innerHTML = '<img src="{{ asset('img/icones/show.svg')}}" alt="" style="width: 1.5rem">';
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
            const removeButton = document.getElementById('remove-image');
            const addButton = document.getElementById('add-image');

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    currentImage.src = e.target.result;
                    currentImage.style.display = 'inline-block';
                    imagePlaceholder.style.display = 'none'; // Oculta a mensagem "Adicionar uma imagem"
                    removeButton.style.display = 'block'; // Mostra o botão de remoção
                    addButton.style.display = 'none'; // Oculta o botão de adicionar
                };

                reader.readAsDataURL(input.files[0]);
            } else {
                // Se nenhum arquivo foi selecionado, redefine para a imagem padrão
                resetImage();
            }
        }

        function openFileSelector() {
            document.getElementById('image-input').click();
        }

        function removeImage() {
            resetImage();
        }

        function resetImage() {
            const currentImage = document.getElementById('current-image');
            const imagePlaceholder = document.getElementById('image-placeholder');
            const removeButton = document.getElementById('remove-image');
            const addButton = document.getElementById('add-image');
            const imageInput = document.getElementById('image-input');

            currentImage.style.display = 'none';
            currentImage.src = '';
            imagePlaceholder.style.display = 'block'; // Mostra novamente a mensagem "Adicionar uma imagem"
            removeButton.style.display = 'none'; // Oculta o botão de remoção
            addButton.style.display = 'block'; // Mostra o botão de adicionar
            imageInput.value = ''; // Limpa o valor do input de arquivo
        }

        /* permitir somente numeros */
        document.getElementById('numero').addEventListener('input', function(event) {
            this.value = this.value.replace(/[^\d]/g, '');
        });

        /* INFORMATIVO SENHA */
        function showPasswordRules() {
            document.getElementById('password-rules').style.display = 'block';

            // Remove a caixa de diálogo após 5 segundos
            setTimeout(function() {
                document.getElementById('password-rules').style.display = 'none';;
            }, 5000);
        }
    </script>
</body>
</html>