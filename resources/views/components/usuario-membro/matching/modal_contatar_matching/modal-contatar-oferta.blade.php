<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/components_css/usuarioMembro/matching/modal_contatar/modal_contatar_oferta.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components_css/usuarioMembro/matching/modal_contatar/modal_sucesso_oferta.css') }}">
    <script src="{{ asset('js/usuarioMembro/matching_demandas/mensagem_contatar_oferta.js') }}"></script>
    <title>Minhas Demandas</title>
</head>
<body>
    <!-- MODAL -->
    <div class="modal-out" id="clicar-fora-modal-contatar-{{$idMatching}}" onclick="closeModalContatarOferta({{$idMatching}})" style="display:none;"></div>

    <div class="modal modal-large" id="modal-contatar-{{$idMatching}}">
        <h2 style="margin-bottom: 1rem;">{{$oferta->titulo}}</h2>
        
        <div class="info-content">
            <div>
                <p id="data">Ofertado em: {{ \Carbon\Carbon::parse($oferta->created_at)->format('d/m/Y') }}</p>
                <p>Área de conhecimento: {{$oferta->areaConhecimento->nome}}</p>
                @if ($oferta->tipo == 'ACAO')
                    <p>Público alvo: {{$oferta->ofertaAcao->publicoAlvo->nome}}</p>

                    @if ($oferta->ofertaAcao->status_registro === 'REGISTRADA')
                        <p>Status da oferta: Registrada</p>
                    @elseif ($oferta->ofertaAcao->status_registro === 'NAO_REGISTRADA')
                        <p>Status da oferta: Não registrada</p>
                    @endif

                    <p>Duração: {{ucwords(strtolower($oferta->ofertaAcao->duracao))}}</p>

                    <p>Regime: {{ucwords(strtolower($oferta->ofertaAcao->regime))}}</p>

                    <p>Tipo ação: {{$oferta->ofertaAcao->tipoAcao->nome}}</p>

                    @if ($oferta->ofertaAcao->data_limite)
                        <p><strong>Data limite: {{ \Carbon\Carbon::parse($oferta->ofertaAcao->data_limite)->format('d/m/Y') }}</strong></p>
                    @else
                        <p><strong>Data limite: Indefinida</strong></p>
                    @endif
                @endif

                @if ($oferta->tipo == 'CONHECIMENTO')
                    @if ($oferta->ofertaConhecimento->link_lattes != null)
                        <p class="truncar-texto">Currículo lattes: <a href="{{$oferta->ofertaConhecimento->link_lattes}}">{{$oferta->ofertaConhecimento->link_lattes}}</a></p>
                    @else
                        <p class="truncar-texto">Currículo lattes: Link não adicionado</p>
                    @endif
                    @if ($oferta->ofertaConhecimento->link_linkedin != null)
                        <p class="truncar-texto">Currículo linkedin: <a href="{{$oferta->ofertaConhecimento->link_linkedin}}">{{$oferta->ofertaConhecimento->link_linkedin}}</a></p>
                    @else
                        <p class="truncar-texto">Currículo linkedin: Link não adicionado</p>
                    @endif

                    @if ($oferta->ofertaConhecimento->tempo_atuacao === 'MENOS_1_ANO')
                        <p>Tempo de experiência: Menos de 1 Ano</p>
                    @elseif ($oferta->ofertaConhecimento->tempo_atuacao === 'MAIS_1_ANO')
                        <p>Tempo de experiência: Mais de 1 Ano</p>
                    @elseif ($oferta->ofertaConhecimento->tempo_atuacao === 'MAIS_3_ANOS')
                        <p>Tempo de experiência: Mais de 3 Anos</p>
                    @elseif ($oferta->ofertaConhecimento->tempo_atuacao === 'MAIS_5_ANOS')
                        <p>Tempo de experiência: Mais de 5 Anos</p>
                    @endif
                @endif
            </div>

            <div>
                <h3>Descrição da oferta:</h3>
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
                @if ($professor->instituicao != null)
                    <p>Instituição: {{$professor->instituicao}}</p>
                @else
                    <p>Instituição: Não cadastrada</p>
                @endif
            </div>

            <div>
                <p class="p-info">E-mails para contato</p>
                <p>{{$professor->email}}</p>
                <p>{{$professor->email_secundario ?? '' }}</p>
            </div>
        </div>

        <hr class="division-hr">

        <form id="form-contato-{{$idMatching}}" action="{{ route('contato_realizado_store', [$idDemanda, $idMatching]) }}" method="POST" onsubmit="return validarEnviarFormulario({{$idMatching}})">
            @csrf
            <div class="contact-message">
                <p class="p-info" style="margin-bottom:1rem;">Escreva sua mensagem:</p>
                <textarea class="input-text" name="mensagem-contato" id="mensagem-contato-{{$idMatching}}" cols="122" rows="5" maxlength="900" placeholder="Contate o ofertante através dessa caixa de mensagem (*Obrigatório)"></textarea>
            </div>
            <div class="offer-buttons">
                <button type="submit" class="button-b-primary">Enviar</button>
                <button type="button" class="button-b-secondary" onclick="closeModalContatarOferta({{$idMatching}})" id="botao-fechar-modal-contatar">Voltar</button>
            </div>
        </form>
    </div>
    <!-- MODAL -->

    <!-- MODAL SUCESSO -->
    <div class="modal-out" id="clicar-fora-modal-sucesso-{{$idMatching}}" style="display:none;"></div>
    <div class="modal modal-small" id="modal-sucesso-{{$idMatching}}">
        <div class="modal-header">
            <h3 id="titulo-sucesso-{{$idMatching}}">Mensagem enviada com sucesso!</h3>
            <span class="close-icon" onclick="fecharModalSucesso({{$idMatching}})"><button class="button-b-primary">&times;</button></span>  
        </div>

        <p>Visualize esta mensagem através do menu, na seção <strong>"CONTATOS REALIZADOS"</strong>.</p>
    </div>
    <!-- MODAL SUCESSO -->
</body>
</html>