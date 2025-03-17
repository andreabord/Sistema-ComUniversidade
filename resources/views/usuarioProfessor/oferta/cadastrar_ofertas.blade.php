<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/menu_navegacao/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/usuarioProfessor/oferta/cadastrar_ofertas.css') }}">
    <script src="{{ asset('js/usuarioProfessor/oferta/modal_ajuda_tipo_oferta.js') }}"></script>
    <script src="{{ asset('js/menu/menu_navegacao.js') }}"></script>
    <title>Minhas Ofertas</title>
</head>
<body>
@include('usuarioProfessor.menu')
<main class="register-section" id="conteudo">
    <h1>Cadastrar Oferta</h1>

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

    <div class="input-container">
        <label for="opcao">Tipo de oferta</label>
        <div style="display:flex;flex-direction:row;">
            <select class="custom-select" id="opcao" name="opcao" autocomplete="off" onchange="mostrarFormulario()" required>
                <option value="">Escolha uma opção</option>
                <option value="acao" {{ old('opcao') == "acao" ? 'selected' : '' }}>Ação</option>
                <option value="conhecimento" {{ old('opcao') == "conhecimento" ? 'selected' : '' }}>Conhecimento</option>
            </select>
            <img src="{{asset('img/icones/info.svg')}}" alt="Mais informações" style="width:1.5rem;height:1.5rem;margin: auto 0 auto 1rem;cursor:pointer" onclick="openModalAjudaTipoOferta({{$usuarioProfessor}})">
            <x-usuario-professor.oferta.modal-ajuda-tipo-oferta :id-usuario="$usuarioProfessor"/>
        </div>
    </div>

    <form id="formularioAcao" action="{{ route('oferta_create_store_acao') }}" method="POST" style="display:none;">
        @csrf
        <input type="hidden" name="opcao" value="acao">

        <div class="input-container">
            <label for="titulo">
                <span>Título *</span>
            </label>
            <input class="input-text" type="text" name="titulo" autocomplete="off" required maxlength="80" value="{{ old('titulo') }}" title="{{ $errors->first('titulo') }}">
        </div>

        <div class="input-container">
            @php
                $listAreaConhecimento = $listAreaConhecimento->sortBy('nome');
            @endphp
            <label for="area_conhecimento">
                <span>Área Conhecimento *</span>
            </label>
            <select class="custom-select" data-live-search="true" name="area_conhecimento" required>
                <option value="" disabled selected>Escolha uma opção</option>
                @foreach ($listAreaConhecimento as $areaConhecimento)
                    <option value="{{ $areaConhecimento->nome }}" {{ old('area_conhecimento') == $areaConhecimento->nome ? 'selected' : '' }}>
                        {{ $areaConhecimento->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="input-container">
            @php
                $listPublicoAlvo = $listPublicoAlvo->sortBy('nome');
            @endphp
            <label for="publico_alvo">
                <span>Público Alvo *</span>
            </label>
            <select class="custom-select" data-live-search="true" name="publico_alvo" required>
                <option value="" disabled selected>Escolha uma opção</option>
                @foreach ($listPublicoAlvo as $publicoAlvo)
                    <option value="{{ $publicoAlvo->nome }}" {{ old('publico_alvo') == $publicoAlvo->nome ? 'selected' : '' }}>
                        {{ $publicoAlvo->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="input-container">
            <label for="tipo_acao">
                <span>Selecione a Modalidade da Oferta *</span>
            </label>
            <select class="custom-select" name="tipo_acao" required>
                <option value="" disabled selected>Escolha uma opção</option>
                <option value="Curso" {{ old('tipo_acao') == 'Curso' ? 'selected' : '' }}>Curso</option>
                <option value="Projeto" {{ old('tipo_acao') == 'Projeto' ? 'selected' : '' }}>Projeto</option>
                <option value="Programa" {{ old('tipo_acao') == 'Programa' ? 'selected' : '' }}>Programa</option>
                <option value="Evento" {{ old('tipo_acao') == 'Evento' ? 'selected' : '' }}>Evento</option>
            </select>
        </div>

        <div class="input-container">
            <label for="duracao">
                <span>Selecione a Duração da Oferta *</span>
            </label>
            <select class="custom-select" name="duracao" required>
                <option value="" disabled selected>Escolha uma opção</option>
                <option value="DIAS" {{ old('duracao') == 'DIAS' ? 'selected' : '' }}>Dias</option>
                <option value="SEMANAS" {{ old('duracao') == 'SEMANAS' ? 'selected' : '' }}>Semanas</option>
                <option value="MESES" {{ old('duracao') == 'MESES' ? 'selected' : '' }}>Meses</option>
                <option value="ANOS" {{ old('duracao') == 'ANOS' ? 'selected' : '' }}>Anos</option>
                <option value="INDEFINIDO" {{ old('duracao') == 'INDEFINIDO' ? 'selected' : '' }}>Indefinido</option>
            </select>
        </div>

        <div class="input-container">
            <label for="descricao">
                <span>Descrição *</span>
            </label>
            <textarea class="input-text" name="descricao" autocomplete="off" required maxlength="700">{{ old('descricao') }}</textarea>
        </div>

        <div class="input-container">
            <label for="data_limite">
                <span>Data de Expiração da Oferta</span>
            </label>
            <input class="input-text" type="date" name="data_limite" min="{{ date('Y-m-d') }}" value="{{ old('data_limite') }}">
        </div>

        <div class="input-container">
            <label for="status_registro">
                <span>Status de Registro *</span>
            </label>
            <select class="custom-select" name="status_registro" required>
                <option value="" disabled selected>Escolha uma opção</option>
                <option value="NAO_REGISTRADA" {{ old('status_registro') == 'NAO_REGISTRADA' ? 'selected' : '' }}>Não Registrada</option>
                <option value="REGISTRADA" {{ old('status_registro') == 'REGISTRADA' ? 'selected' : '' }}>Registrada</option>
            </select>
        </div>

        <div class="input-container">
            <label for="regime">
                <span>Regime de Aplicação *</span>
            </label>
            <select class="custom-select" name="regime" required>
                <option value="" disabled selected>Escolha uma opção</option>
                <option value="PRESENCIAL" {{ old('regime') == 'PRESENCIAL' ? 'selected' : '' }}>Presencial</option>
                <option value="ONLINE" {{ old('regime') == 'ONLINE' ? 'selected' : '' }}>Online</option>
            </select>
        </div>

        <div class="buttons-container">
            <button class="button-b-primary" type="submit">Cadastrar</button>
            <a class="button-a-secondary" title="Voltar" onclick="goBack()" href="{{ route('demanda_index') }}">Voltar</a>
        </div>
    </form>

    <form id="formularioConhecimento" action="{{ route('oferta_create_store_conhecimento') }}" method="POST" style="display:none;">
        @csrf
        <input type="hidden" id="opcaoSelecionadaConhecimento" name="opcao" value="conhecimento">

        <div class="input-container">
            <label for="titulo">
                <span>Título *</span>
            </label>
            <input class="input-text" type="text" name="titulo" autocomplete="off" required maxlength="80" value="{{ old('titulo') }}" title="{{ $errors->first('titulo') }}">
        </div>

        <div class="input-container">
            @php
                $listAreaConhecimento = $listAreaConhecimento->sortBy('nome');
            @endphp
            <label for="area_conhecimento">
                <span>Área Conhecimento *</span>
            </label>
            <select class="custom-select" data-live-search="true" name="area_conhecimento" required>
                <option value="" disabled selected>Escolha uma opção</option>
                @foreach ($listAreaConhecimento as $areaConhecimento)
                    <option value="{{ $areaConhecimento->nome }}" {{ old('area_conhecimento') == $areaConhecimento->nome ? 'selected' : '' }}>
                        {{ $areaConhecimento->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="input-container">
            <label for="descricao">
                <span>Descrição *</span>
            </label>
            <textarea class="input-text" name="descricao" autocomplete="off" required maxlength="700">{{ old('descricao') }}</textarea>
        </div>

        <div class="input-container">
            <label for="tempo_atuacao">Selecione o tempo de experiência *</label>
            <select class="custom-select" name="tempo_atuacao" autocomplete="off" required>
                <option disabled selected>Escolha uma opção</option>
                <option value="MENOS_1_ANO" {{ old('tempo_atuacao') == 'MENOS_1_ANO' ? 'selected' : '' }}>Menos de 1 ano</option>
                <option value="MAIS_1_ANO" {{ old('tempo_atuacao') == 'MAIS_1_ANO' ? 'selected' : '' }}>Mais de 1 ano</option>
                <option value="MAIS_3_ANOS" {{ old('tempo_atuacao') == 'MAIS_3_ANOS' ? 'selected' : '' }}>Mais de 3 anos</option>
                <option value="MAIS_5_ANOS" {{ old('tempo_atuacao') == 'MAIS_5_ANOS' ? 'selected' : '' }}>Mais de 5 anos</option>
            </select>
        </div>

        <div class="input-container">
            <label for="link_lattes">Link lattes</label>
            <input class="input-text" type="text" name="link_lattes" autocomplete="off" maxlength="255" value="{{old('link_lattes')}}" placeholder="Ex. https://lattes.com">
        </div>

        <div class="input-container">
            <label for="link_linkedin">Link linkedin</label>
            <input class="input-text" type="text" name="link_linkedin" autocomplete="off" maxlength="255" value="{{old('link_linkedin')}}" placeholder="Ex. https://linkedin.com">
        </div>

        <div class="buttons-container">
            <button class="button-b-primary" type="submit">Cadastrar</button>
            <a class="button-a-secondary" title="Voltar" onclick="goBack()" href="{{ route('demanda_index') }}">Voltar</a>
        </div>
    </form>
</main>
        <script src="{{ asset('js/errors/mensagem_erro.js') }}"></script>
        <script>

            $( function() {
                    $( "#data_limite" ).datepicker({
                    dateFormat: 'dd/mm/yy'
                });
            } );

            function goBack() {
                window.history.back();
            }

            // Variável PHP contendo os bairros
            const listAreaConhecimento = {!! json_encode($listAreaConhecimento) !!};
            
            // Variável PHP contendo os bairros
            const listPublicoAlvo = {!! json_encode($listPublicoAlvo) !!};

            // Variável PHP contendo os bairros
            const listTipoAcao = {!! json_encode($listTipoAcao) !!};

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
                    onSelection: onSelectionCallback,
                    resultsList: {
                        position: "afterend",
                        maxResults: 10,
                        noResults: true,
                        tabSelect: true
                    },
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

            function mostrarFormulario() {
                var opcaoSelecionada = document.getElementById("opcao").value;

                // Esconder todos os formulários
                document.getElementById("formularioAcao").style.display = "none";
                document.getElementById("formularioConhecimento").style.display = "none";

                // Exibir o formulário correspondente à opção selecionada
                if (opcaoSelecionada === "acao") {
                    document.getElementById("formularioAcao").style.display = "block";
                } else if (opcaoSelecionada === "conhecimento") {
                    document.getElementById("formularioConhecimento").style.display = "block";
                }
            }

        </script>
    </main>
</body>
</html>