<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/components_css/usuarioEstudante/todas_ofertas/modal_contatar_oferta.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components_css/usuarioEstudante/todas_ofertas/modal_sucesso_oferta.css') }}">
    <script src="{{ asset('js/usuarioEstudante/todas_ofertas/mensagem_contatar_oferta.js') }}"></script>
    <title>Minhas Demandas</title>
</head>
<body>
    <!-- MODAL -->
    <div class="modal-out" id="clicar-fora-modal-contatar-{{$idOferta}}" onclick="closeModalContatarOferta({{$idOferta}})" style="display:none;"></div>

    <div class="modal modal-large" id="modal-contatar-{{$idOferta}}">
        <h2 style="margin-bottom: 1rem;">{{$oferta->titulo}}</h2>

        <div class="info-content">
            <div>
                <p id="data">Ofertado em: {{ \Carbon\Carbon::parse($oferta->created_at)->format('d/m/Y') }}</p>
                <p>Área de conhecimento: {{$oferta->areaConhecimento->nome}}</p>
                @if ($oferta->tipo == 'ACAO')
                    <p>Público Alvo: {{$oferta->ofertaAcao->publicoAlvo->nome}}</p>
                    <p>Status da Oferta: {{ $oferta->ofertaAcao->status_registro === 'REGISTRADA' ? 'Registrada' : 'Não Registrada' }}</p>
                    <p>Duração: {{ ucwords(strtolower($oferta->ofertaAcao->duracao)) }}</p>
                    <p>Regime: {{ ucwords(strtolower($oferta->ofertaAcao->regime)) }}</p>
                    <p>Tipo Ação: {{$oferta->ofertaAcao->tipoAcao->nome}}</p>
                    <p><strong>Data Limite: {{ $oferta->ofertaAcao->data_limite ? \Carbon\Carbon::parse($oferta->ofertaAcao->data_limite)->format('d/m/Y') : 'Indefinida' }}</strong></p>
                @endif
            </div>
        </div>

        <hr class="division-hr">

        <p class="p-info" style="margin-bottom:1rem;">Dados de contato</p>
        <h3>{{$professor->nome}}</h3>

        <div class="info-content">
            <div>
                @if ($professor->tipo === 'PROFESSOR')
                    <p>Tipo de usuário: Servidor(a)</p>
                @endif
                <p>Instituição: {{$professor->instituicao ?? 'Não cadastrada'}}</p>
            </div>

            <div>
                <p class="p-info">E-mails para contato</p>
                <p>{{$professor->email}}</p>
                <p>{{$professor->email_secundario ?? ''}}</p>
            </div>
        </div>

        <hr class="division-hr">

        <form id="form-contato-{{$idOferta}}" action="{{ route('contato_direto_store_estudante', $idOferta) }}" method="POST" onsubmit="return validarEnviarFormulario({{$idOferta}})">
            @csrf
            <div class="contact-message">
                <p class="p-info" style="margin-bottom:1rem;">Escreva sua mensagem:</p>
                <textarea class="input-text" name="mensagem-contato" id="mensagem-contato-{{$idOferta}}" cols="122" rows="5" maxlength="900" placeholder="Contate o ofertante através dessa caixa de mensagem (*Obrigatório)"></textarea>
            </div>
            <div class="offer-buttons">
                <button type="submit" class="button-b-primary">Enviar</button>
                <button type="button" class="button-b-secondary" onclick="closeModalContatarOferta({{$idOferta}})">Voltar</button>
            </div>
        </form>
    </div>

    <!-- MODAL SUCESSO -->
    <div class="modal-out" id="clicar-fora-modal-sucesso-{{$idOferta}}" style="display:none;"></div>
    <div class="modal modal-small" id="modal-sucesso-{{$idOferta}}">
        <div class="modal-header">
            <h3 id="titulo-sucesso-{{$idOferta}}">Mensagem enviada com sucesso!</h3>
            <span class="close-icon" onclick="fecharModalSucesso({{$idOferta}})"><button class="button-b-primary">&times;</button></span>
        </div>
        <p>Visualize esta mensagem através do menu, na seção <strong>"CONTATOS REALIZADOS"</strong>.</p>
    </div>
    <!-- MODAL SUCESSO -->
</body>
</html>