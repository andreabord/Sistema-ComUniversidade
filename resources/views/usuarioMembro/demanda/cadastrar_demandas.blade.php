<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="{{ asset('js/menu/menu_navegacao.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/menu_navegacao/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/usuarioMembro/demanda/cadastrar_demandas.css') }}">
    <title>Minhas Demandas</title>
</head>
<body>
    @include('usuarioMembro.menu')
    <main class="register-section">
        <h1>Cadastrar Necessidade</h1>

        <form action="{{ route('demanda_create_store') }}" method="POST">
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

            <div>
                @csrf
                <div class="input-container">
                    @if ($errors->has('titulo') || $errors->has('id_usuario'))
                        <label for="titulo">Titulo *</label>
                        <input class="input-text" title="{{ $errors->first('titulo') ?: $errors->first('id_usuario') }}" type="text" name="titulo" required maxlength="80" value="{{old('titulo')}}">
                    @else 
                        <label for="titulo">Titulo *</label>   
                        <input class="input-text" type="text" name="titulo" autocomplete="off" required maxlength="80" value="{{old('titulo')}}">
                    @endif
                </div>

                <div class="input-container">
                    @php
                        $listPublicoAlvo = $listPublicoAlvo->sortBy('nome');
                    @endphp
                    @error('publico_alvo')
                        <label for="publico_alvo">Publico alvo *</label>
                        <div>
                            <select class="custom-select" data-live-search="true" title="{{$message}}" name="publico_alvo" required maxlength="70">
                                <option value="" selected disabled>Escolha uma opção</option>
                                @foreach ($listPublicoAlvo as $publicoAlvo)
                                    <option value="{{$publicoAlvo->nome}}" {{ old('publico_alvo') == $publicoAlvo->nome ? 'selected' : '' }}>{{ $publicoAlvo->nome }}</option>
                                @endforeach
                            </select>
                        </div>
                    @else
                        <label for="publico_alvo">Publico alvo *</label>
                        <div>
                            <select class="custom-select" data-live-search="true" name="publico_alvo" required maxlength="70" value="{{old('publico_alvo')}}">
                                <option value="" selected disabled>Escolha uma opção</option>
                                @foreach ($listPublicoAlvo as $publicoAlvo)
                                    <option value="{{$publicoAlvo->nome}}" {{ old('publico_alvo') == $publicoAlvo->nome ? 'selected' : '' }}>{{ $publicoAlvo->nome }}</option>
                                @endforeach
                            </select>
                        </div>
                    @enderror
                </div>
                
                <div class="input-container">
                    @php
                        $listAreaConhecimento = $listAreaConhecimento->sortBy('nome');
                    @endphp
                    @error('area_conhecimento')
                        <label for="area_conhecimento">Área conhecimento *</label>
                        <div>
                            <select class="custom-select" data-live-search="true" title="{{$message}}" name="area_conhecimento" required maxlength="70">
                                <option value="" selected disabled>Escolha uma opção</option>
                                @foreach ($listAreaConhecimento as $areaConhecimento)
                                    <option value="{{$areaConhecimento->nome}}" {{ old('area_conhecimento') == $areaConhecimento->nome ? 'selected' : '' }}>{{ $areaConhecimento->nome }}</option>
                                @endforeach
                            </select>
                        </div>
                    @else
                        <label for="area_conhecimento">Área conhecimento *</label>
                        <div class="areaConhecimento">
                            <select class="custom-select" data-live-search="true" name="area_conhecimento" required maxlength="70" value="{{old('area_conhecimento')}}">
                                <option value="" selected disabled>Escolha uma opção</option>
                                @foreach ($listAreaConhecimento as $areaConhecimento)
                                    <option value="{{$areaConhecimento->nome}}" {{ old('area_conhecimento') == $areaConhecimento->nome ? 'selected' : '' }}>{{ $areaConhecimento->nome }}</option>
                                @endforeach
                            </select>
                        </div>
                    @enderror
                </div>

                
                <div class="input-container">
                    @error('pessoas_afetadas')
                        <label for="pessoas_afetadas">Pessoas atingidas (apenas números) *</label>
                        <input class="input-text" title="{{$message}}" type="number" name="pessoas_afetadas" min="0" autocomplete="off" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required maxlength="10" value="{{old('pessoas_afetadas')}}">
                    @else
                        <label for="pessoas_afetadas">Pessoas atingidas (apenas números) *</label>
                        <input class="input-text" type="number" name="pessoas_afetadas" min="0" autocomplete="off" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required maxlength="10" value="{{old('pessoas_afetadas')}}">
                    @enderror
                </div>

                <div class="input-container">
                    @error('descricao')
                        <label id="campo-label" for="descricao">>Descrição *</label>
                        <textarea class="input-text" title="{{$message}}" type="text" name="descricao" placeholder="Texto Livre" required maxlength="500">{{old('descricao')}}</textarea>
                    @else
                        <label id="campo-label" for="descricao">Descrição *</label>
                        <textarea class="input-text" type="text" name="descricao" autocomplete="off" required maxlength="500">{{old('descricao')}}</textarea>
                    @enderror
                </div>

                <div class="input-container">
                    @error('duracao')
                        <label for="duracao">Selecione a duração da necessidade *</label>
                        <select class="custom-select" title="{{$message}}" name="duracao" autocomplete="off" required value="{{old('duracao')}}">
                            <option value="" disabled selected>Escolha uma opção</option>
                            <option value="DIAS" {{ old('duracao') == 'DIAS' ? 'selected' : '' }}>Dias</option>
                            <option value="SEMANAS" {{ old('duracao') == 'SEMANAS' ? 'selected' : '' }}>Semanas</option>
                            <option value="MESES" {{ old('duracao') == 'MESES' ? 'selected' : '' }}>Meses</option>
                            <option value="ANOS" {{ old('duracao') == 'ANOS' ? 'selected' : '' }}>Anos</option>
                            <option value="INDEFINIDO" {{ old('duracao') == 'INDEFINIDO' ? 'selected' : '' }}>Indefinido</option>
                        </select>
                    @else
                        <label for="duracao">Selecione a duração da necessidade *</label>
                        <select class="custom-select" name="duracao" autocomplete="off" required value="{{old('duracao')}}">
                            <option value="" disabled selected>Escolha uma opção</option>
                            <option value="DIAS" {{ old('duracao') == 'DIAS' ? 'selected' : '' }}>Dias</option>
                            <option value="SEMANAS" {{ old('duracao') == 'SEMANAS' ? 'selected' : '' }}>Semanas</option>
                            <option value="MESES" {{ old('duracao') == 'MESES' ? 'selected' : '' }}>Meses</option>
                            <option value="ANOS" {{ old('duracao') == 'ANOS' ? 'selected' : '' }}>Anos</option>
                            <option value="INDEFINIDO" {{ old('duracao') == 'INDEFINIDO' ? 'selected' : '' }}>Indefinido</option>
                        </select>
                    @enderror
                </div>

                <div class="input-container">
                    @error('nivel_prioridade')
                        <label for="nivel_prioridade">Selecione o nível de prioridade da necessidade *</label>
                        <select class="custom-select" title="{{$message}}" name="nivel_prioridade" autocomplete="off" required value="{{old('nivel_prioridade')}}">
                            <option value="" disabled selected>Escolha uma opção</option>
                            <option value="BAIXO" {{ old('nivel_prioridade') == 'BAIXO' ? 'selected' : '' }}>Baixo</option>
                            <option value="MEDIO" {{ old('nivel_prioridade') == 'MEDIO' ? 'selected' : '' }}>Medio</option>
                            <option value="ALTO" {{ old('nivel_prioridade') == 'ALTO' ? 'selected' : '' }}>Alto</option>
                        </select>
                    @else
                        <label for="nivel_prioridade">Selecione o nível de prioridade da necessidade *</label>
                        <select class="custom-select" name="nivel_prioridade" autocomplete="off" required value="{{old('nivel_prioridade')}}">
                            <option value="" disabled selected>Escolha uma opção</option>
                            <option value="BAIXO" {{ old('nivel_prioridade') == 'BAIXO' ? 'selected' : '' }}>Baixo</option>
                            <option value="MEDIO" {{ old('nivel_prioridade') == 'MEDIO' ? 'selected' : '' }}>Medio</option>
                            <option value="ALTO" {{ old('nivel_prioridade') == 'ALTO' ? 'selected' : '' }}>Alto</option>
                        </select>
                    @enderror
                </div>

                <div class="input-container">
                    @error('instituicao_setor')
                        <label for="instituicao_setor">Instituição</label>
                        <input class="input-text" title="{{$message}}" type="text" name="instituicao_setor" autocomplete="off" maxlength="70" value="{{old('instituicao_setor')}}">
                    @else
                        <label for="instituicao_setor">Instituição</label>
                        <input class="input-text" type="text" name="instituicao_setor" autocomplete="off" maxlength="70" value="{{old('instituicao_setor')}}">

                    @enderror
                </div>

                <div class="buttons-container">
                    <button class="button-b-primary" type="submit">Cadastrar</button>
                    <a class="button-a-secondary" title="Voltar" onclick="goBack()" href="{{ route('demanda_index') }}">Voltar</a>
                </div>
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
        </script>
    </main>
</body>
</html>