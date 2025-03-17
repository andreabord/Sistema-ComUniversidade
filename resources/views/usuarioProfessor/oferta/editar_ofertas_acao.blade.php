<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="{{ asset('js/menu/menu_navegacao.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/menu_navegacao/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/usuarioProfessor/oferta/editar_ofertas_acao.css') }}">
    <title>Editar Demanda</title>
</head>
<body>
    @include('usuarioProfessor.menu')
    <main class="edit-section" id="conteudo">
    <h1>Editar Oferta Ação</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    @if ($error)
                        <p class="alert alert-danger">{{ $error }}</p>
                    @endif
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('oferta_edit_store_acao', $oferta->id_oferta) }}" method="POST">
        @csrf

        <div class="input-container">
            <label for="titulo">Título *</label>
            <input class="input-text" type="text" name="titulo" autocomplete="off" required maxlength="80" 
                value="{{ $oferta->titulo }}" title="{{ $errors->first('titulo') }}">
        </div>

        <div class="input-container">
            @php
                $listAreaConhecimento = $listAreaConhecimento->sortBy('nome');
            @endphp
            <label for="area_conhecimento">Área Conhecimento *</label>
            <select class="custom-select" data-live-search="true" name="area_conhecimento" required>
                <option value="" disabled selected>Escolha uma opção</option>
                @foreach ($listAreaConhecimento as $areaConhecimentoElement)
                    <option value="{{ $areaConhecimentoElement->nome }}" @selected(old('area_conhecimento', $oferta->id_area_conhecimento ?? '') == $areaConhecimentoElement->id_area_conhecimento)>
                        {{ $areaConhecimentoElement->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="input-container">
            @php
                $listPublicoAlvo = $listPublicoAlvo->sortBy('nome');
            @endphp
            <label for="publico_alvo">Público Alvo *</label>
            <p>{{ $oferta->id_publico_alvo }}</p>
            <select class="custom-select" data-live-search="true" name="publico_alvo" required>
                <option value="" disabled selected>Escolha uma opção</option>
                @foreach ($listPublicoAlvo as $publicoAlvoElement)
                    <option value="{{ $publicoAlvoElement->nome }}" @selected(old('publico_alvo', $oferta->ofertaAcao->id_publico_alvo ?? '') == $publicoAlvoElement->id_publico_alvo)>
                        {{ $publicoAlvoElement->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="input-container">
            <label for="tipo_acao">Modalidade da Oferta *</label>
            <select class="custom-select" name="tipo_acao" required>
                <option value="" disabled selected>Escolha uma opção</option>
                <option value="Curso" @selected(old('tipo_acao', $oferta->ofertaAcao->tipoAcao->nome) == 'Curso')>Curso</option>
                <option value="Projeto" @selected(old('tipo_acao', $oferta->ofertaAcao->tipoAcao->nome) == 'Projeto')>Projeto</option>
                <option value="Programa" @selected(old('tipo_acao', $oferta->ofertaAcao->tipoAcao->nome) == 'Programa')>Programa</option>
                <option value="Evento" @selected(old('tipo_acao', $oferta->ofertaAcao->tipoAcao->nome) == 'Evento')>Evento</option>
            </select>
        </div>

        <div class="input-container">
            <label for="duracao">Duração da Oferta *</label>
            <select class="custom-select" name="duracao" required>
                <option value="" disabled selected>Escolha uma opção</option>
                <option value="DIAS" @selected(old('duracao', $oferta->ofertaAcao->duracao) == 'DIAS')>Dias</option>
                <option value="SEMANAS" @selected(old('duracao', $oferta->ofertaAcao->duracao) == 'SEMANAS')>Semanas</option>
                <option value="MESES" @selected(old('duracao', $oferta->ofertaAcao->duracao) == 'MESES')>Meses</option>
                <option value="ANOS" @selected(old('duracao', $oferta->ofertaAcao->duracao) == 'ANOS')>Anos</option>
                <option value="INDEFINIDO" @selected(old('duracao', $oferta->ofertaAcao->duracao) == 'INDEFINIDO')>Indefinido</option>
            </select>
        </div>

        <div class="input-container">
            <label for="descricao">Descrição *</label>
            <textarea class="input-text" name="descricao" autocomplete="off" required maxlength="700">{{ old('descricao', $oferta->descricao) }}</textarea>
        </div>

        <div class="input-container">
            <label for="data_limite">Data de Expiração</label>
            <input class="input-text" type="date" name="data_limite" min="{{ date('Y-m-d') }}" value="{{ old('data_limite', $oferta->ofertaAcao->data_limite) }}">
        </div>

        <div class="input-container">
            <label for="status_registro">Status de Registro *</label>
            <select class="custom-select" name="status_registro" required>
                <option value="" disabled selected>Escolha uma opção</option>
                <option value="NAO_REGISTRADA" @selected(old('status_registro', $oferta->ofertaAcao->status_registro) == 'NAO_REGISTRADA')>Não Registrada</option>
                <option value="REGISTRADA" @selected(old('status_registro', $oferta->ofertaAcao->status_registro) == 'REGISTRADA')>Registrada</option>
            </select>
        </div>

        <div class="input-container">
            <label for="regime">Regime de Aplicação *</label>
            <select class="custom-select" name="regime" required>
                <option value="" disabled selected>Escolha uma opção</option>
                <option value="PRESENCIAL" @selected(old('regime', $oferta->ofertaAcao->regime) == 'PRESENCIAL')>Presencial</option>
                <option value="ONLINE" @selected(old('regime', $oferta->ofertaAcao->regime) == 'ONLINE')>Online</option>
            </select>
        </div>

        <div class="buttons-container">
            <button class="button-b-primary" type="submit">Salvar</button>
            <a class="button-a-secondary" title="Voltar" onclick="goBack()" href="{{ route('demanda_index') }}">Voltar</a>
        </div>
    </form>

    <script src="{{ asset('js/errors/mensagem_erro.js') }}"></script>
    <script>
        function goBack() {
            window.history.back();
        }
        // Variável PHP contendo os bairros
        const listPublicoAlvo = {!! json_encode($listPublicoAlvo) !!};

        // Variável PHP contendo os bairros
        const listAreaConhecimento = {!! json_encode($listAreaConhecimento) !!};

        // Variável PHP contendo os bairros
        const listTipoAcao = {!! json_encode($listTipoAcao) !!};
    </script>
    </main>
</body>
</html>