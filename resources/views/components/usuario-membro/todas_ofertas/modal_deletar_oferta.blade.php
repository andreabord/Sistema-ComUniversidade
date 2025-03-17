<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/components_css/usuarioMembro/todas_ofertas/modal_deletar_oferta.css') }}">
    <title>Todas as Ofertas</title>
</head>
<body>
    <div class="modal-out" id="clicar-fora-modal-{{$idOferta}}" onclick="closeModalDeletar({{$idOferta}})"></div>
    <div class="modal modal-small" id="caixa-modal-{{$idOferta}}">
        <h3>Deseja mesmo remover esta oferta da lista?</h3>
        <p>Após removida, ela não será mostrada novamente.</p>

        <div class="buttons-container">
            <form action="{{ route('contato_direto_remover', $idOferta) }}" method="POST">
                @csrf
                <button class="button-b-primary" type="submit" id="botao-sim">Sim</button>
            </form>
            <button class="button-b-secondary" id="botao-nao" onclick="closeModalDeletar({{$idOferta}})">Não</button>
        </div>
    </div>
</body>
</html>