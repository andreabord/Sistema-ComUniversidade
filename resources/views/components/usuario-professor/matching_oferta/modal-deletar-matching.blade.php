<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/menu_navegacao/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components_css/usuarioProfessor/matching_ofertas/modal_deletar_matchings.css') }}">
    <script src="{{ asset('js/menu/menu_navegacao.js') }}"></script>
    <title>Minhas Demandas</title>
</head>
<body>
<div class="modal-out" id="clicar-fora-modal-deletar-{{$idMatching}}" onclick="closeModalDeletar({{$idMatching}})"></div>
    <div class="modal modal-small" id="caixa-modal-deletar-{{$idMatching}}">
        <h3>Deseja mesmo remover esta oferta da lista?</h3>
        <p>Após removida, ela não será mostrada novamente.</p>

        <div class="buttons-container">
            <form action="{{ route('matching_remover_demanda', [$idMatching, $idOferta]) }}" method="POST">
                @csrf
                <button class="button-b-primary" type="submit" id="botao-sim">Sim</button>
            </form>
            <a class="button-b-secondary" onclick="closeModalDeletar({{$idMatching}})">Não</a>
        </div>
    </div>
</body>
</html>