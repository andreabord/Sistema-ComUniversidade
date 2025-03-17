<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        h1 {
            margin-bottom: 1rem;
            width: 100%;
            text-align: center;
        }

        p {
            margin-bottom: 0.75rem;
        }

        .button-a-primary {
            color: #ffffff !important;
            background-color: #3e6ff4;
            border-radius: 0.5rem;
            text-decoration: none;
            margin: 1rem 0;
            padding: 0.75rem 1.125rem;
            max-width: fit-content;
            max-height: fit-content;
        }

        .button-a-primary:hover {
            background-color: #255cf5;
            text-decoration: none;
        }

        .forget-full {
            margin: 0;
            padding: 3rem;
            height: fit-content;
            background-color: #f8fafb;
            font-family: 'Google Sans', system-ui;
            font-optical-sizing: auto;
            font-weight: 400;
            font-style: normal;
            font-size: 16px;
            color: black;
        }

        .forget-container {
            background-color: #ffffff;
            border-radius: 0.75rem;
            border: 1px solid #f1f2f3;
            width: 100%;
            padding: 2rem;
        }

        .buttons-container {
            padding: 1.5rem 0;
        }

        @media (max-width: 768px) {
            .forget-full {
                font-size: 14px;
                padding: 1rem 0;
            }

            .button-a-primary, .button-a-secondary {
                padding: 1rem 1.5rem;;
            }
        }

        @media (min-width: 1400px) {
            .forget-full {
                font-size: 18px;
            }
        }
    </style>
    <title>Document</title>
</head>
<body>
    <div class="forget-full">
        <div class="forget-container">
            <h1>Redefinição de Senha</h1>
            <p>Olá,</p>
            <p>Você está recebendo este e-mail porque uma solicitação de redefinição de senha foi recebida para sua conta. Se você não solicitou isso, ignore este e-mail.</p>
            <p>Para redefinir sua senha, clique no botão abaixo:</p>
            <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
                <tr>
                    <td align="center" class="buttons-container">
                        <a class="button-a-primary" href="{{ route('reset_password', $token) }}">Redefinir Senha</a>
                    </td>
                </tr>
            </table>
            <p>Se você não solicitou uma redefinição de senha, nenhuma ação adicional é necessária.</p>
            <p>Obrigado,<br/>Equipe de Suporte</p>
        </div>
    </div>
</body>
</html>