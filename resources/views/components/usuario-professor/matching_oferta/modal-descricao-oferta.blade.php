<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/components_css/usuarioProfessor/matching_ofertas/modal_descricao_demanda.css') }}">
    <title>Descrição Oferta</title>
</head>
<body>
    <div class="modal-out" id="clicar-fora-modal-descricao-{{$idOferta}}" onclick="closeModalDescricao({{$idOferta}})"></div>
    <div class="modal modal-small" id="caixa-modal-descricao-{{$idOferta}}">
        <div class="modal-header">
            <h3>Descrição da Oferta</h3>
            <span onclick="closeModalDescricao({{$idOferta}})" id="botao_fechar_modal"><button class="button-b-primary">&times;</button></span>
        </div>
        <p>{{$oferta->descricao}}</p>
    </div>
</body>
</html>