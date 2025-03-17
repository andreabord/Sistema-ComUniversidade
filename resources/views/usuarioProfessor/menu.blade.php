<!-- Menu do Sistema -->
<header>
    <div class="nav-bar">
        <a href="#" id="menu-button" onclick="abrirMenu()">&#9776;</a>
        <h5>Sistema ComUniversidade</h5>
        @if(Auth::user()->foto)
            <a title="Perfil" href="{{ route('perfil_index_professor') }}"><img class="photo-icon" id="img-personalizada" src="{{ asset('storage/' . Auth::user()->foto) }}" alt="imagem de perfil do usuario"></a>
        @else
            <a title="Perfil" href="{{ route('perfil_index_professor') }}"><img src="{{ asset('img/icones/user.svg') }}" alt="imagem de perfil do usuario"></a>
        @endif
    </div>
    
    <nav class="nav-menu" id="menu_navegacao">
        <a href="{{ route('oferta_index') }}"><i><img src="{{ asset('img/icones/offers.svg') }}" id="icones-menu" alt="icone de demanda"></i>Minhas Ofertas</a>
        <a href="{{ route('lista_todas_demandas') }}"><i><img src="{{ asset('img/icones/necessity.svg') }}" id="icones-menu" alt="icone de oferta/demanda"></i>Todas as Necessidades</a>
        <a href="{{ route('lista_contatos_realizados_professor') }}"><i><img src="{{ asset('img/icones/contacts-made.svg') }}" id="icones-menu" alt="icone de contato"></i>Contatos Realizados</a>
        <a href="{{ route('lista_contatos_recebidos_professor') }}"><i><img src="{{ asset('img/icones/contacts-received.svg') }}" id="icones-menu" alt="icone de contato"></i>Contatos Recebidos</a>
        <hr>
        <a href="{{ route('configuracoes_professor') }}"><i><img src="{{ asset('img/icones/config.svg') }}" id="icones-menu" alt="icone de contato"></i>Configurações</a>
        <a href="{{ route('logout_professor_index') }}"><i><img src="{{ asset('img/icones/logout.svg') }}" id="icones-menu" alt="icone de contato"></i>Sair</a>
    </nav>
</header>