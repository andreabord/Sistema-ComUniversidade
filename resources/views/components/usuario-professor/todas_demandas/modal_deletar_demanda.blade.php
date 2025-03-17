<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/components_css/usuarioProfessor/todas_demandas/modal_deletar_demanda.css') }}">
    <title>Todas as Ofertas</title>
</head>
<body>
    <!-- MODAL -->
    <div class="modal-out" id="clicar-fora-modal-{{$idDemanda}}" onclick="closeModalDeletar({{$idDemanda}})"></div>
    <div class="modal modal-small" id="caixa-modal-{{$idDemanda}}">
        <h3>Deseja mesmo remover esta necessidade da lista?</h3>
        <p>"{{$demanda->titulo}}"</p>

        <div class="buttons-container">
            <form action="{{ route('contato_direto_remover_professor', $idDemanda) }}" method="POST">
                @csrf
                <button class="button-b-primary" type="submit" id="botao-sim">Sim</button>
            </form>
            <a onclick="closeModalDeletar({{$idDemanda}})"><button class="button-b-secondary" id="botao-nao">Não</button></a>
        </div>
    </div>
    <!-- MODAL -->
</body>
</html>