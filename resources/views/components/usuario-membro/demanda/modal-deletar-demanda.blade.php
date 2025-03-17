<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/components_css/usuarioMembro/demanda/modal_deletar_demandas.css') }}">
    <title>Minhas Demandas</title>
</head>
<body>
    <!-- MODAL -->
    <div class="modal-out" id="clicar-fora-modal-{{$idDemanda}}" onclick="closeModalDeletar({{$idDemanda}})"></div>
    <div class="modal modal-small" id="caixa-modal-{{$idDemanda}}">
        <h3>Deseja mesmo excluir essa oferta?</h3>
        <p>"{{$demanda->titulo}}"</p>

        <div class="buttons-container">
            <form action="{{ route('demanda_delete_store', $idDemanda) }}" method="POST">
                @method('DELETE')
                @csrf
                <button class="button-b-primary" type="submit" id="botao-sim">Sim</button>
            </form>
            <a class="button-a-secondary" onclick="closeModalDeletar({{$idDemanda}})">Não</a>
        </div>
    </div>
    <!-- MODAL -->
</body>
</html>