<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="{{ asset('js/menu/menu_navegacao.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/menu_navegacao/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/usuarioMembro/demanda/editar_demandas.css') }}">
    <title>Editar Demanda</title>
</head>
<body>
    @include('usuarioMembro.menu')
    <main class="edit-section">
        <h1>Editar Necessidade</h1>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        @if ($error)
                            <p>{{ $error }}</p>
                        @endif
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('demanda_edit_store', $demanda->id_demanda) }}" method="POST">
            @csrf

            <div class="input-container">
                <label for="titulo">Título *</label>
                <input class="input-text" type="text" name="titulo" autocomplete="off" required maxlength="80" 
                    value="{{ $demanda->titulo ?? '' }}" title="{{ $errors->first('titulo') }}">
            </div>

            <div class="input-container">
                @php
                    $listPublicoAlvo = $listPublicoAlvo->sortBy('nome');
                @endphp
                <label for="publico_alvo">Público Alvo *</label>
                <select class="custom-select" data-live-search="true" name="publico_alvo" required>
                    <option value="" selected disabled>Selecione aqui</option>
                    @foreach ($listPublicoAlvo as $publicoAlvoElement)
                        <option value="{{ $publicoAlvoElement->nome }}" @selected(old('publico_alvo', $demanda->id_publico_alvo ?? '') == $publicoAlvoElement->id_publico_alvo)>{{ $publicoAlvoElement->nome }}</option>
                    @endforeach
                </select>
            </div>

            <div class="input-container">
                @php
                    $listAreaConhecimento = $listAreaConhecimento->sortBy('nome');
                @endphp
                <label for="area_conhecimento">Área de Conhecimento *</label>
                <select class="custom-select" data-live-search="true" name="area_conhecimento" required>
                    <option value="" selected disabled>Selecione aqui</option>
                    @foreach ($listAreaConhecimento as $areaConhecimentoElement)
                        <option value="{{ $areaConhecimentoElement->nome }}" @selected(old('area_conhecimento', $demanda->id_area_conhecimento ?? '') == $areaConhecimentoElement->id_area_conhecimento)>{{ $areaConhecimentoElement->nome }}</option>
                    @endforeach
                </select>
            </div>

            <div class="input-container">
                <label for="pessoas_afetadas">Pessoas Atingidas (apenas números) *</label>
                <input class="input-text" type="number" name="pessoas_afetadas" onkeypress="return event.charCode >= 48 && event.charCode <= 57" 
                    value="{{ $demanda->pessoas_afetadas ?? '' }}" required maxlength="10">
            </div>

            <div class="input-container">
                <label for="descricao">Descrição *</label>
                <textarea class="input-text" name="descricao" autocomplete="off" required maxlength="500">{{ $demanda->descricao ?? '' }}</textarea>
            </div>

            <div class="input-container">
                <label for="duracao">Selecione a Duração da Necessidade *</label>
                <select class="custom-select" name="duracao" required>
                    <option value="" disabled selected></option>
                    <option value="DIAS" @selected(old('duracao', $demanda->duracao) == 'DIAS')>Dias</option>
                    <option value="SEMANAS" @selected(old('duracao', $demanda->duracao) == 'SEMANAS')>Semanas</option>
                    <option value="MESES" @selected(old('duracao', $demanda->duracao) == 'MESES')>Meses</option>
                    <option value="ANOS" @selected(old('duracao', $demanda->duracao) == 'ANOS')>Anos</option>
                    <option value="INDEFINIDO" @selected(old('duracao', $demanda->duracao) == 'INDEFINIDO')>Indefinido</option>
                </select>
            </div>

            <div class="input-container">
                <label for="nivel_prioridade">Selecione o Nível de Prioridade *</label>
                <select class="custom-select" name="nivel_prioridade" required>
                    <option value="" disabled selected></option>
                    <option value="BAIXO" @selected(old('nivel_prioridade', $demanda->nivel_prioridade) == 'BAIXO')>Baixo</option>
                    <option value="MEDIO" @selected(old('nivel_prioridade', $demanda->nivel_prioridade) == 'MEDIO')>Médio</option>
                    <option value="ALTO" @selected(old('nivel_prioridade', $demanda->nivel_prioridade) == 'ALTO')>Alto</option>
                </select>
            </div>

            <div class="input-container">
                <label for="instituicao_setor">Instituição</label>
                <input class="input-text" type="text" name="instituicao_setor" value="{{ $demanda->instituicao_setor ?? '' }}" maxlength="70">
            </div>

            <div class="buttons-container">
                <button class="button-b-primary" type="submit">Salvar</button>
                <a class="button-a-secondary" title="Voltar" onclick="goBack()">Voltar</a>
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
    
            function inicializarAutoComplete(data, selector, onSelectionCallback) {

                const autoCompleteJS = new autoComplete({
                    data: {
                        src: data,
                        key: ["nome"],
                    },
                    name: "autoComplete",
                    selector: selector,
                    threshold: 0,
                    debounce: 300,
                    searchEngine: "strict",
                    highlight: true,
                    maxResults: 5,
                    onSelection: onSelectionCallback,
                });
    
                const autoCompleteInput = document.querySelector(selector);
                autoCompleteInput.addEventListener('focusout', function() {
                    const inputText = this.value;
    
                    const encontrado = data.find(item => item.nome === inputText);
    
                    if (!encontrado) {
                        this.value = '';
                    }
                });
            }
            // Inicializar o autocomplete para as áreas de conhecimento
            inicializarAutoComplete(listAreaConhecimento, "#autoCompleteAreaConhecimento", feedback => {
                const areaConhecimento = feedback.selection.value;
                const autoCompleteInput = document.getElementById('autoCompleteAreaConhecimento');
                autoCompleteInput.value = areaConhecimento.nome;
            });

            // Inicializar o autocomplete para os públicos-alvo
            inicializarAutoComplete(listPublicoAlvo, "#autoCompletePublicoAlvo", feedback => {
                const publicoAlvo = feedback.selection.value;
                const autoCompleteInput = document.getElementById('autoCompletePublicoAlvo');
                autoCompleteInput.value = publicoAlvo.nome;
            });
            
        </script>
    </main>
</body>
</html>