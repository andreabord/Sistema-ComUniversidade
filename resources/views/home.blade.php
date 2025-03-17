<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> Força o HTTPS para o ngrok -->
    <link rel="stylesheet" href="{{asset('css/home.css')}}">
    <title>ComUniversidade</title>
</head>
<body>
    <header role="banner">
        <div class="navbar">
            <div class="navbar-content">
                <div class="nav-left">
                    <img src="{{asset('img/home/logo-ufsc.png')}}">
                    <a class="nav-home-link" href="#">ComUniversidade</a>
                </div>
                <nav role="navagation" class="nav-right">
                    <a class="nav-links" href="#home">Home</a>
                    <a class="nav-links" href="#profiles">Perfis</a>
                    <a class="nav-links" href="#benefits">Benefícios</a>
                    <a class="button-a-primary" href="{{route('selecao_perfil')}}">Acessar</a></h4>
                </nav>
            </div>
        </div>
    </header>

    <main>
        <section id="home" class="home">
            <div class="home-left">
                <h2>Sistema ComUniversidade</h2>
                <span>
                    <p>Acreditando no poder transformador da extensão universitária para promover o desenvolvimento comunitário e enriquecer a educação superior. O sistema <strong>ComUniversidade</strong> foi desenvolvido com o intuito de conectar as comunidades locais com as universidades através de uma plataforma de ofertas e demandas, facilitando a colaboração e o intercâmbio de conhecimentos e recursos.</p>
                </span>
                <span>
                <p>
                    O sistema oferece uma interface amigável e intuitiva que permite tanto às comunidades quanto às universidades identificarem oportunidades de parceria de forma rápida e eficiente. Com o <strong>ComUniversidade</strong>, cada usuário pode criar um perfil personalizado que se adapta às suas necessidades e interesses específicos. O sistema pode ser usado por três tipos de perfil.
                </p>
            </span>
            </div>

            <div class="home-right">
                <img src="{{ asset('img/home/colorful-hands.jpg') }}" alt="Mãos coloridas unidas">
            </div>
        </section>



        <section id="profiles" class="profiles"> <!-- mudar as rotas dos botões -->
            <div>
                <h2>Tipos de Perfis</h2>
                <span>
                    <p>A segmentação de perfis permite uma experiência personalizada para cada tipo de usuário, facilitando a identificação e a conexão entre as partes interessadas. Seja você uma comunidade em busca de soluções práticas ou uma universidade em busca de oportunidades de engajamento social, o <strong>ComUniversidade</strong> oferece as ferramentas necessárias para transformar ideias em ações concretas e impactar positivamente o mundo ao seu redor.</p>
                </span>
                <div class="cards-profile-container">
                    <div class="card-profile">
                        <h4>Estudantes</h4>
                        <p>Estudantes universitários podem criar um perfil que enfatiza seus interesses acadêmicos facilitando sua participação em ações de extensão. </p>
                        <a id="nav-button" class="button-a-primary" href="{{ route('login_estudante_index') }}">Acessar como estudante</a></h4>
                    </div>
                    <div class="card-profile">
                        <h4>Servidores (Professores e TAES)</h4>
                        <p>Professores, pesquisadores universitários e técnicos podem criar um perfil que destaca suas competências, áreas de pesquisa e ações de extensão. </p>
                        <a id="nav-button" class="button-a-primary" href="{{ route('login_professor_index') }}">Acessar como servidor</a></h4>
                    </div>
                    <div class="card-profile">
                        <h4>Membros Externos</h4>
                        <p>As organizações, empresas e indivíduos da comunidade podem criar um perfil detalhado que descreve suas necessidades, objetivos e áreas de interesse.</p>
                        <a id="nav-button" class="button-a-primary" href="{{ route('login_membro_index') }}">Acessar como membro externo</a></h4>
                    </div>
                </div>
            </div>
        </section>


        
        <section id="benefits" class="benefits">
            <div class="benefits-content">
                <h2>Benefícios</h2>
                <p>
                    Alguns benefícios da utilização deste sistema.
                </p>
                <div class="benefits-lists-container">
                    <div class="benefits-list" id="benefits-university">
                        <h4>Benefícios para a Universidade</h4>
                        <ul>
                            <li>Aplicação prática do conhecimento</li>
                            <li>Pesquisa e inovação</li>
                            <li>Responsabilidade social</li>
                        </ul>
                    </div>
                    <div class="benefits-list" id="benefits-community">
                        <h4>Benefícios para a comunidade</h4>
                        <ul>
                            <li>Acesso ao conhecimento</li>
                            <li>Cooperação e solidariedade</li>
                            <li>Apoio em projetos sociais</li>
                        </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <footer>
            <div class="footer-content">
                <div class="dados-dev">
                    <h5>© 2024 UFSC, Araranguá</h5>
                    <h6>Tecnologia da Informação e Comunicação</h6>
                    <h6>Guilherme Oliveira de Sá Cabrera</h6>
                    <h6 class="name-designer">Design por <a href="https://www.linkedin.com/in/juliapereira-dev/">Julia Pereira</a></h6>
                </div>
            </div>
        </footer>
    </main>

    <script>
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();

                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
</body>
</html> 