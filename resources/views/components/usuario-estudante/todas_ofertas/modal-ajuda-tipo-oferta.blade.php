<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/menu_navegacao/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components_css/usuarioEstudante/todas_ofertas/modal_ajuda_tipo_oferta.css') }}">
    <script src="{{ asset('js/menu/menu_navegacao.js') }}"></script>
    <title>Minhas Demandas</title>
</head>
<body>
    <div class="modal-out" id="clicar-fora-modal-ajuda-{{$idUsuario}}" onclick="closeModalAjudaTipoOferta({{$idUsuario}})"></div>
    <div class="modal modal-large" id="caixa-modal-ajuda-{{$idUsuario}}">
        <div class="modal-header">
            <h3>Tipos de oferta</h3>

            <button class="close-button-modal" onclick="closeModalAjudaTipoOferta({{$idUsuario}})">&times;</button>
        </div>
        <strong>Ofertas Conhecimento</strong>
        <p>As Ofertas do Tipo Conhecimento são aquelas que envolvem a disponibilização do saber acumulado pelos servidores de uma instituição. Essas ofertas não estão necessariamente ligadas a uma ação específica ou prática, mas focam na disseminação do conhecimento teórico e prático que os profissionais podem compartilhar.</p>
        <br>
        <strong>Ofertas Ação</strong>
        <p>As Ofertas do Tipo Ação são iniciativas práticas voltadas para o desenvolvimento de atividades específicas que envolvem cursos, projetos, programas e eventos de extensão. Essas ações são direcionadas tanto para a comunidade interna de uma instituição quanto para o público externo, com o objetivo de promover a interação, a troca de conhecimentos e o engajamento social.</p>
        <br>
        <a href="{{route('ajuda_sistema_estudante')}}" style="color: #FFF">Saiba mais em Ajuda</a>
    </div>
</body>
</html>