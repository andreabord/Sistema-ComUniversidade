<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="{{ asset('js/menu/menu_navegacao.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/menu_navegacao/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/usuarioProfessor/oferta/editar_ofertas_conhecimento.css') }}">
    <title>Editar Oferta Conhecimento</title>
</head>
<body>
    @include('usuarioProfessor.menu')
    <main class="edit-section" id="conteudo">
    <h1>Editar Oferta Conhecimento</h1>

    @if($errors->any())
        <div class="error-container">
            <ul>
                @foreach ($errors->all() as $error)
                    @if ($error)
                        <p class="alert alert-danger">{{ $error }}</p>
                    @endif
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('oferta_edit_store_conhecimento', $oferta->id_oferta) }}" method="POST">
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
            <label for="descricao">Descrição *</label>
            <textarea class="input-text" name="descricao" autocomplete="off" required maxlength="700">{{ old('descricao', $oferta->descricao) }}</textarea>
        </div>

        <div class="input-container">
            <label for="tempo_atuacao">Tempo de Experiência *</label>
            <select class="custom-select" name="tempo_atuacao" required>
                <option value="" disabled selected>Escolha uma opção</option>
                <option value="MENOS_1_ANO" @selected(old('tempo_atuacao', $oferta->ofertaConhecimento->tempo_atuacao) == 'MENOS_1_ANO')>Menos de 1 Ano</option>
                <option value="MAIS_1_ANO" @selected(old('tempo_atuacao', $oferta->ofertaConhecimento->tempo_atuacao) == 'MAIS_1_ANO')>Mais de 1 Ano</option>
                <option value="MAIS_3_ANOS" @selected(old('tempo_atuacao', $oferta->ofertaConhecimento->tempo_atuacao) == 'MAIS_3_ANOS')>Mais de 3 Anos</option>
                <option value="MAIS_5_ANOS" @selected(old('tempo_atuacao', $oferta->ofertaConhecimento->tempo_atuacao) == 'MAIS_5_ANOS')>Mais de 5 Anos</option>
            </select>
        </div>

        <div class="input-container">
            <label for="link_lattes">Link Lattes</label>
            <input class="input-text" type="text" name="link_lattes" autocomplete="off" maxlength="255" 
                value="{{ $oferta->ofertaConhecimento->link_lattes }}" title="{{ $errors->first('link_lattes') }}">
        </div>

        <div class="input-container">
            <label for="link_linkedin">Link LinkedIn</label>
            <input class="input-text" type="text" name="link_linkedin" autocomplete="off" maxlength="255" 
                value="{{ $oferta->ofertaConhecimento->link_linkedin }}" title="{{ $errors->first('link_linkedin') }}">
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
            const listAreaConhecimento = {!! json_encode($listAreaConhecimento) !!};
        </script>
    </main>
</body>
</html>