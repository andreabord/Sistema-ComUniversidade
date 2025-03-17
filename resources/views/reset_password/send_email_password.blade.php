<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/reset_password/send_email_password.css')}}">
    <title>Redefinir Senha</title>
</head>
<body>
    <div class="login-container">
        <h1>Redefinir Senha</h1>
        <p>Enviaremos um link para seu e-mail, use o link para redefinir a senha</p>

        <form method="POST" action="{{ route('send_email_password') }}">
            @csrf
            
            @if (session()->has('success'))
                <p class="alert alert-success">{{ session('success')}}</p>
            @elseif (session()->has('error'))
                <p class="alert alert-danger">{{ session('error') }}</p>
            @endif

            @if (session()->has('token'))
                <p class="alert alert-warning">{{ session('token') }}</p>
            @endif

            <label for="email">E-mail</label>
            
            @error('email')
                <input title="{{$message}}" type="email" id="email" name="email" placeholder="E-mail" required>
                <div class="alert alert-danger">
                    <p>{{ $message }}</p>
                </div>
            @else
                <input class="input-text" type="email" id="email" name="email" placeholder="E-mail" required>
            @enderror

            <div class="buttons-container">
                <button class="button-b-primary" type="submit">Enviar</button>
            </div>
        </form>
    </div>
    <script src="{{ asset('js/errors/mensagem_erro.js') }}"></script>
    <script src="{{ asset('js/reset_password/send_email_password.js') }}"></script>
</body>
</html>
