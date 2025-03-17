<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/components_css/usuarioEstudante/todas_ofertas/modal_visualizar_oferta.css') }}">
    <script src="{{ asset('js/usuarioEstudante/todas_ofertas/modal_contatar_oferta.js') }}"></script>
    <title>Todas ofertas</title>
</head>
<body>
    <!-- MODAL -->
    <div class="modal-out" id="clicar-fora-modal-visualizar-{{$idOferta}}" onclick="closeModalVisualizarOferta({{$idOferta}})"></div>

    <div class="modal modal-large" id="modal-visualizar-{{$idOferta}}">
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

            <div>
                <p class="p-info">Descrição da Oferta:</p>
                <p>{{$oferta->descricao}}</p>
            </div>
        </div>

        <hr class="division-hr">

        <p class="p-info" style="margin-bottom: 1rem;">Dados de contato</p>
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

        <div class="offer-buttons">
            <a class="button-a-primary" onclick="openModalContatarOferta({{$idOferta}})">Contatar</a>
            <form action="{{ route('contato_direto_visualizar_estudante', [$idOferta]) }}" method="POST">
                @csrf
                <span onclick="closeModalVisualizarOferta({{$idOferta}})" id="botao-fechar-modal">
                    <button class="button-b-secondary">Fechar</button>
                </span>
            </form>
            <x-usuario-estudante.todas-ofertas.modal-contatar-oferta :id-oferta="$oferta->id_oferta" />
        </div>
    </div>
    <!-- MODAL -->
</body>
</html>