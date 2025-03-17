<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/menu_navegacao/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/usuarioMembro/configuracao/ajuda_sistema.css') }}">
    <script src="{{ asset('js/menu/menu_navegacao.js') }}"></script>
    <title>Configurações</title>
</head>
<body> 
    @include('usuarioMembro.menu')
    <main id="help">
        <h1>Ajuda do Sistema</h1>
        <section>
            <h4>Como o Sistema está estruturado?</h4>
            <p>Este sistema foi desenvolvido com o intuito de conectar os usuários de forma eficaz e precisa. Isso é possível graças a um sistema de matching que relaciona ofertas e necessidades, promovendo uma rede de colaboração eficiente entre os usuários, ajudando-os a solucionar problemas e oferecer suporte mútuo. A partir disso, o sistema foi estruturado e dividido em algumas seções, como explicado abaixo:<br>
            Ao entrar no nosso sistema, a primeira seção que você, usuário, verá será a tela de "Minhas Necessidades". Nela, você pode acessar as necessidades já cadastradas por você e também cadastrar novas necessidades. Em seguida, através do menu, você pode acessar a seção de "Todas as Ofertas", que permite uma exploração mais ampla das opções disponíveis, oferecendo mais flexibilidade na busca por soluções, de maneira independente ao sistema de matching. Por fim, existe a seção de Contatos, que também pode ser acessada no menu e está dividida em "Contatos Realizados" e "Contatos Recebidos", facilitando a organização e a troca de mensagens.
            </p>
        </section>
        <hr class="division-hr">
        <section>
            <h4>Quero cadastrar uma necessidade como faço?</h4>
            <p>Para cadastrar uma necessidade é bem fácil, acesse primeiramente o menu localizado no canto superior esquerdo da tela, em seguida encontre a sessão de "Minhas Necessidades", clique nela, e você será redirecionado para uma a tela de minhas necessidades, busque por um botão chamado de "Cadastrar Novas Necessidades", agora basta você clicar nele, preencher os dados solicitados e pronto. Você terá criado sua primeira necessidade.
            </p>
        </section>
        <hr class="division-hr">
        <section>
            <h4>Como posso acessar as ofertas encontradas pelo matching para minha necessidade?</h4>
            <p>Para acessar todas as ofertas encontradas para uma determinada necessidade cadastrada por você, basta acessar a seção de "Minhas Necessidades" através do menu. Lá, você verá todas as suas necessidades listadas. Ao encontrar a necessidade desejada na lista, clique em VISUALIZAR para saber detalhes dessa necessidade. Pronto, todas as ofertas encontradas através do matching para aquela necessidade específica serão exibidas.</p>
        </section>
        <hr class="division-hr">
        <section>
            <h4>Como posso realizar um contato?</h4>
            <p>Os contatos do sistema sempre estão relacionados a uma necessidade e uma oferta. Portanto, para que você, usuário, consiga fazer um contato, existem duas opções: ou através da seção de "Minhas Necessidades", onde é possível acessar as ofertas encontradas para uma necessidade, ou através da seção "Todas as Ofertas", que contém todas as ofertas cadastradas pelos servidores das universidades. Ao acessar uma dessas seções, você poderá selecionar a oferta que melhor atende às suas necessidades, escrever sua mensagem e depois enviar. Após isso, seus contatos estarão disponíveis na seção de "Contatos Realizados". Lá, você verá o status do seu contato, que inicialmente será "Contato Enviado", e assim que for respondido, será atualizado. 
            Uma explicação mais detalhada de cada status referente a um contato está disponível no texto abaixo.</p>
        </section>
        <hr class="division-hr">
        <section>
            <h4>Como funciona os status dos contatos?</h4>
            <p>Os status presentes para os contatos, sejam eles Recebidos ou Realizados, funcionam da mesma forma e servem para facilitar a visualização de você usuário. Os status apresentados pelo sistema são:<br></p>
            <div>
                <p style="line-height:1.75;">
                    <br>
                    <span class="status-realizado">Contato Enviado</span> (Cor Amarela), indica que o contato foi enviado e que aguarda resposta da pessoa que foi contatada.<br>
                    <br>
                    <span class="status-respondido">Contato Respondido</span> (Cor Azul), indica que o contato foi respondido pelo servidor(a) e que o contato está relacionado a uma Oferta do tipo Ação.<br>
                    <br>
                    <span class="status-sem-disponibilidade">Sem Disponibilidade</span> (Cor Vermelho), indica que o contato foi respondido demonstrando que no momento não está disponível para ajudar com a necessidade ou não está interessado na oferta.<br>
                    <br>
                    <span class="status-interessado">Interesse</span> (Cor Verde), indica que o contato foi respondido demostrando interesse em ajudar com a necessidade. 
                </p>
            </div>
        </section>
        <hr class="division-hr">
        <section>
            <h4>Como posso responder um contato?</h4>
            <p>Os contatos do sistema sempre estão relacionados a uma necessidade e uma oferta. Portanto, para que você, usuário, consiga responder um contato, basta ir através do menu até a seção de "Contatos Recebidos" onde estarão listados todos os contatos realizados por outros usuários com destino para você. A partir daí, você poderá responder com sua mensagem e enviar selecionando o status, podendo ser INTERESSE (positivo) ou SEM DISPONIBILIDADE (negativo).</p>
        </section>
        <hr class="division-hr">
        <section>
            <h4>Posso trocar mensagens de maneira ilimitadas sobre uma mesma necessidade/oferta ?</h4>
            <p>Não, o intuito do sistema é conectar usuários que possuem necessidade e ofertas condizentes, para que problemas possam ser resolvidos de maneira rápida e eficiente. Dito isso, nosso objetivo é apenas gerar um primeiro contato entre as partes de modo que elas consigam se interconectar e, posteriormente, por outras formas de contato, elas desenvolvam propriamente suas soluções. Por isso, nós permitimos que os usuários façam uma troca de mensagens para cada contato criado. Ou seja, cada vez que alguns dos usuários iniciam o contato, o outro que recebe tem o direito de resposta, e então o contato é finalizado, não havendo possibilidade de uma terceira mensagem. Apesar disso, é possível fazer quantos contatos quiser, desde que seja sobre ofertas/necessidades diferentes.
            </p>
        </section>
        <hr class="division-hr">
        <section>
            <h4>Qual a diferença de uma oferta do tipo Ação e do tipo Conhecimento?</h4>
            <p>A principal diferença está relacionada ao tipo de proposta que essas ofertas irão oferecer. Por exemplo, quando um servidor(a) decide criar uma oferta do tipo ação, isso quer dizer que ele tem algum projeto, programa, curso... que deseja oferecer e que possa solucionar algumas necessidades. Já quando um servidor(a) decide criar uma oferta do tipo conhecimento, o objetivo é oferecer o conhecimento em si, e não um curso específico. Portanto, essa diferença acaba afetando bastante nos status de resposta para os contatos. Já que para as ofertas do tipo conhecimento os servidores(as) podem demonstrar o status sendo de (Interesse/Sem disponibilidade), enquanto nas ofertas do tipo Ação os mesmos só podem responder o contato (Contato Respondido), já que esse segundo tipo de oferta não está ligado ao conhecimento pessoal dele(a).</p>
        </section>
        <hr class="division-hr">
        <section>
            <h4>Caso eu exclua uma necessidade ou oferta da lista de matchings, é possível recuperar?</h4>
            <p>Não, o sistema não possui uma seção destinada à listagem das ofertas e necessidades excluídas, portanto, caso uma necessidade ou oferta seja excluída, ela não poderá ser recuperada. Mas para evitar exclusões acidentais, o sistema foi estruturado com avisos de confirmação para todas as ações de excluir. Desse modo, caso você clique sem querer no botão de excluir, será necessário realizar a confirmação de SIM ou NÃO antes que a ação seja executada.
            </p>
        </section>
        <hr class="division-hr">
        <section>
            <h4>Precisa de suporte ou gostaria de fazer sugestões?</h4>
            <p>
                Se você encontrar algum problema ou tiver dúvidas sobre o uso do nosso sistema, estamos aqui para ajudar! Por favor, entre em contato com a nossa equipe de suporte.
                <br><br>    
                Envie um e-mail para: sistemacomuniversidade@gmail.com
            </p>
        </section>
    </main>
</body>
</html>