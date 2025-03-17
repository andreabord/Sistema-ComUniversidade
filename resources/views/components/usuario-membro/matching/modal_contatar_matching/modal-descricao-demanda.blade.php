<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/components_css/usuarioMembro/matching/modal_contatar/modal_descricao_demanda.css') }}">
    <title>Document</title>
</head>
<body>
    <div class="modal-out" id="clicar-fora-modal-descricao-{{$idDemanda}}" onclick="closeModalDescricao({{$idDemanda}})"></div>
    <div class="modal modal-small" id="caixa-modal-descricao-{{$idDemanda}}">
        <div class="modal-header">
            <h3>Descrição da Necessidade</h3>
            <span onclick="closeModalDescricao({{$idDemanda}})" id="botao_fechar_modal"><button class="button-b-primary">&times;</button></span>
        </div>
        <p>{{$demanda->descricao}}</p>
    </div>
</body>
</html>