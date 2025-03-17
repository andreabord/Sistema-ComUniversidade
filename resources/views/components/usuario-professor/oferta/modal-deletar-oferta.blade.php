<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/components_css/usuarioProfessor/oferta/modal_deletar_oferta.css') }}">
    <title>Minhas Demandas</title>
</head>
<body>
    <!-- MODAL -->
    <div class="modal-out" id="clicar-fora-modal-{{$idOferta}}" onclick="closeModalDeletar({{$idOferta}})"></div>
    <div class="modal modal-small" id="caixa-modal-{{$idOferta}}">
        <h3>Deseja mesmo excluir essa oferta?</h3>
        <p>"{{$oferta->titulo}}"</p>

        <div class="buttons-container">
            @if ($oferta->tipo === 'ACAO')
                <form action="{{ route('oferta_delete_store_acao', $idOferta) }}" method="POST">
            @elseif ($oferta->tipo === 'CONHECIMENTO')
                <form action="{{ route('oferta_delete_store_conhecimento', $idOferta) }}" method="POST">
            @endif
                @method('DELETE')
                @csrf
                <button class="button-b-primary" type="submit" id="botao-sim">Sim</button>
            </form>
            <a class="button-a-secondary" onclick="closeModalDeletar({{$idOferta}})">Não</a>
        </div>
    </div>
    <!-- MODAL -->
</body>
</html>