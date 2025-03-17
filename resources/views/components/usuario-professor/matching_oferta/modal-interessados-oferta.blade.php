<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/components_css/usuarioProfessor/matching_ofertas/modal_interessados_oferta.css') }}">
    <title>Usuários Interessados</title>
</head>
<body>
<div class="modal-out" id="clicar-fora-modal-interessados-{{$idOferta}}" onclick="closeModalUsuariosInteressados({{$idOferta}})"></div>
<div class="modal modal-large" id="caixa-modal-interessados-{{$idOferta}}">
    <div class="modal-header">
        <h3>Usuários Interessados</h3>
        <button onclick="closeModalUsuariosInteressados({{$idOferta}})" class="button-b-primary">&times;</button>
    </div>

    <hr class="division-hr">

    <div>
        @if (count($usuarios) < 1)
            <p class="no-data">Nenhum usuário interessado(a) na sua oferta</p>
        @else
            <div class="cards-list">
                @foreach ($usuarios as $index => $usuario)
                    <div class="card-user">
                        <h5>Usuário {{ $index + 1 }}</h5>
                        <p>Email: <span title="{{ $usuario->email }}">{{ $usuario->email }}</span></p>
                        <p>Tipo: 
                            @if ($usuario->tipo === 'MEMBRO')
                                Membro Externo
                            @elseif ($usuario->tipo === 'ALUNO')
                                Estudante
                            @endif
                        </p>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
</body>
</html>