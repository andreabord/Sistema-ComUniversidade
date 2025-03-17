<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/autenticacao_usuario/login_professor.css')}}">
    <title>Login - servidor</title>
</head>

<body>
    <div class="login-container">
        <form method="POST" action="{{ route('login_professor_store') }}">
            @csrf
            @if (session()->has('success'))
                <div class="alert alert-success">
                    <p>{{session('success')}}</p>
                </div>
            @endif

            <h2>Login como servidor</h2>
            <hr class="division-hr">

            <div class="inputs">
                <div class="input-email">
                    <!-- campo email-->
                    <label for="email">E-mail</label>
                    <input class="input-text" type="text" id="email" name="email" placeholder="Digite seu e-mail" value={{ old('email')}}>
                    @error('email')
                        <div class="alert alert-danger">
                            <p>{{ $message }}</p>
                        </div>
                    @enderror
                    @error('message')
                        <div class="alert alert-danger">
                            <p>{{ $message }}</p>
                        </div>
                    @enderror
                </div>

                <div class="input-password" style="position: relative;">
                    <!-- campo senha -->
                    <label for="password">Senha</label>
                    <div style="position: relative;">
                        <input class="input-text" type="password" id="password" name="password" placeholder="Digite seu senha" required oninput="toggleEye()">
                        <span class="toggle-password" onclick="togglePassword()" style="position: absolute; top: 20%; right: 43px; cursor: pointer; display: none"><img class="icons" src="{{ asset('img/icones/show.svg')}}" alt="Ícone com olho aberto"></span>
                        <span id="info-show" onclick="showPasswordRules()" style="position: absolute; top: 20%; right: 15px; cursor: pointer;">
                            <img class="icons" src="{{ asset('img/icones/info.svg') }}" alt="Ícone informativo">
                        </span>
                    </div>
                    @error('password')
                        <div class="alert alert-danger">
                            <p>{{ $message }}</p>
                        </div>
                    @enderror
                    @error('message')
                    <div class="alert alert-danger">
                        <p>{{ $message }}</p>
                    </div>
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
            </div>

            <!-- infos finais -->
            <div class="final-actions">
                <a href="{{ route('reset_index') }}">Esqueci minha senha</a>
                <button class="button-b-primary" type="submit">Entrar</button>
            </div>
        </form>

        <script src="{{ asset('js/errors/mensagem_erro.js') }}"></script>
    </div>

    <div class="log-up-content">
        <p>Ainda não possui conta?</p>
        <a class ="button-a-secondary" href="{{ route('cadastro_professor_index') }}">Cadastre-se</a>
    </div>

    <script>
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