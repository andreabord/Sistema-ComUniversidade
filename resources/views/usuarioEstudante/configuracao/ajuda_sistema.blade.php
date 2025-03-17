<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/menu_navegacao/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/usuarioEstudante/configuracao/ajuda_sistema.css') }}">
    <script src="{{ asset('js/menu/menu_navegacao.js') }}"></script>
    <title>Configurações</title>
</head>
<body> 
    @include('usuarioEstudante.menu')
    <main id="help">
        <h1>Ajuda do Sistema</h1>
        <section>
            <h4>Como o Sistema está estruturado?</h4>
            <p>
                Este sistema foi desenvolvido para conectar os usuários de maneira eficaz e precisa, promovendo uma rede de colaboração eficiente, onde os usuários podem resolver problemas e oferecer suporte reciprocamente. A estrutura do sistema é dividida em várias seções, conforme descrito a seguir:
                Ao entrar no sistema, a primeira seção visível será "Todas as Ofertas Disponíveis", onde você pode visualizar todas as ofertas cadastradas por outros usuários e fazer contatos com os mesmos de acordo com seus interesses e objetivos. Além disso, também existe uma seção de contatos, destinada à troca de mensagens, onde você usuário pode ver todos os seus contatos realizados e as respectivas respostas recebidas para cada contato. 
            </p>
        </section>
        <hr class="division-hr">
        <section>
            <h4>Como posso realizar um contato?</h4>
            <p>
                Os contatos do sistema sempre estão relacionados a uma oferta. Portanto, para que você, usuário, consiga fazer um contato, basta você acessar a seção de "Todas as Ofertas", onde estão listadas as ofertas cadastradas pelos servidores das universidades. Ao acessar essa seção, você poderá selecionar a oferta que melhor atende aos seus interesses, escrever sua mensagem e depois enviar. Após isso, seus contatos estarão disponíveis na seção de "Contatos Realizados". Lá, você verá o status do seu contato, que inicialmente será "Contato Enviado", e assim que for respondido, será atualizado. 
                Uma explicação mais detalhada de cada status referente a um contato está disponível no card abaixo.
            </p>
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
                    <span class="status-respondido">Contato Respondido</span> (Cor Azul), indica que o contato foi respondido por um servidor(a) de uma determinada universidade.<br>
                </p>
            </div>
        </section>
        <hr class="division-hr">
        <section>
            <h4>Posso trocar mensagens de maneira ilimitadas sobre uma mesma oferta ?</h4>
            <p>
                Não, o intuito do sistema é conectar usuários que possuem necessidade e ofertas condizentes, para que problemas possam ser resolvidos de maneira rápida e eficiente. Dito isso, nosso objetivo é apenas gerar um primeiro contato entre as partes de modo que elas consigam se interconectar e, posteriormente, por meio de outras formas de contato, elas desenvolvam propriamente suas soluções. Por isso, nós permitimos que os usuários façam apenas uma troca de mensagens para cada contato criado. Ou seja, cada vez que alguns dos usuários iniciam o contato, o outro que recebe tem o direito de resposta, e então o contato é finalizado, não havendo possibilidade de uma terceira mensagem. Apesar disso, é possível fazer quantos contatos quiser, desde que seja sobre ofertas diferentes.
            </p>
        </section>
        <hr class="division-hr">
        <section>
            <h4>Caso eu exclua uma oferta da lista de Ofertas, é possível recuperar?</h4>
            <p>
                Não, o sistema não possui uma seção destinada à listagem das ofertas excluídas, portanto, caso uma oferta seja excluída, ela não poderá ser recuperada. Mas para evitar exclusões acidentais, o sistema foi estruturado com avisos de confirmação para todas as ações de excluir, desse modo, caso você clique sem querer no botão de excluir, será necessário realizar a confirmação de SIM ou NÃO antes que a ação seja executada. Evitando, problemas de exclusão.
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