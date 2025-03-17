<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/reset_password/new_password.css')}}">
    <title>Recuperacao Senha</title>
</head>
<body>
<div class="password-container">
    @if (session()->has('error'))
         <div class="alert alert-danger">
            <p>{{session('error')}}</p>
        </div>
    @endif

    <h1>Redefinição de senha</h1>
    
    <form action="{{ route('new_password') }}" method="POST">
        @csrf
        <input type="hidden" name="token" value="{{$token}}">
        
        <div class="input-password" style="position: relative;">
            <label for="new_password">Nova Senha</label>
            <div style="position: relative;">
                <input class="input-text" title="Nova senha" type="password" id="new_password" name="password" placeholder="Senha Nova" required autocomplete="new-password">
                <span id="toggle_new_password" onclick="toggleNewPassword('new_password', 'toggle_new_password')" style="position: absolute; top: 20%; right: 43px; cursor: pointer;"><img class="icons" src="{{ asset('img/icones/show.svg')}}" alt=""></span>
                <span class="info-icon" onclick="showPasswordRules()" style="position: absolute; top: 20%; right: 15px; cursor: pointer;">
                    <img class="icons" src="{{ asset('img/icones/info.svg') }}" alt="Ícone informativo">
                </span>
            </div>

            @error('password')
                <div class="alert alert-danger">
                    <p>{{$message}}</p>
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

        <div div class="input-password" style="position: relative;">
            <label for="confirma">Confirmar Senha</label>
            <div style="position: relative;">
                <input class="input-text" title="Confirmar Senha" type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirmar Senha" required autocomplete="new-password">
                <span id="toggle_password_confirmation" onclick="toggleConfirmPassword()" style="position: absolute; top: 20%; right: 43px; cursor: pointer;"><img class="icons" src="{{ asset('img/icones/show.svg')}}" alt=""></span>
                <span onclick="showPasswordRules2()" style="position: absolute; top: 20%; right: 15px; cursor: pointer;">
                    <img class="icons" src="{{ asset('img/icones/info.svg') }}" alt="Ícone informativo">
                </span>
            </div>

            @error('password')
                <div class="alert alert-danger">
                    <p>{{$message}}</p>
                </div>
            @enderror

            <div id="password-rules2" style="display: none; position: absolute; right: 7.5px; bottom: 80%; padding: 1rem; background-color: white; border: 1px solid var(--color-medium-grey); border-radius: 12px; list-style: inside;">
                <p>Regras de criação de senha:</p>
                <ul>
                    <li>Deve conter pelo menos 8 caracteres</li>
                    <li>Deve conter pelo menos uma letra maiúscula</li>
                    <li>Deve conter pelo menos uma letra minúscula</li>
                    <li>Deve conter pelo menos um número</li>
                </ul>
            </div>
        </div>

        <div class="buttons-container">
            <button class="button-b-primary" type="submit">Login</button> 
        </div>
    </form>
</div>

    <script>
        function toggleNewPassword() {
            var newPasswordField = document.getElementById('new_password');
            var toggleButton = document.getElementById('toggle_new_password');

            if (newPasswordField.type === "password") {
                newPasswordField.type = "text";
                toggleButton.innerHTML = '<img src="{{ asset('img/icones/hide.svg')}}" alt="" style="width: 1.5rem">';
            } else {
                newPasswordField.type = "password";
                toggleButton.innerHTML = '<img src="{{ asset('img/icones/show.svg')}}" alt="" style="width: 1.5rem">';
            }
        }

        function toggleConfirmPassword() {
            var confirmPasswordField = document.getElementById('password_confirmation');
            var toggleButton = document.getElementById('toggle_password_confirmation');

            if (confirmPasswordField.type === "password") {
                confirmPasswordField.type = "text";
                toggleButton.innerHTML = '<img src="{{ asset('img/icones/hide.svg')}}" alt="" style="width: 1.5rem">';
            } else {
                confirmPasswordField.type = "password";
                toggleButton.innerHTML = '<img src="{{ asset('img/icones/show.svg')}}" alt="" style="width: 1.5rem">';
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

        function showPasswordRules2() {
            document.getElementById('password-rules2').style.display = 'block';

            // Remove a caixa de diálogo após 5 segundos
            setTimeout(function() {
                document.getElementById('password-rules2').style.display = 'none';;
            }, 5000);
        }
    </script>
</body>
</html>
