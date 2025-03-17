document.addEventListener('DOMContentLoaded', function() {
    adicionarOuvintesDeEventos();
});

function adicionarOuvintesDeEventos() {
    var botoesInteressado = document.querySelectorAll('[id^="botao-interessado-"]');
    var botoesSemDisponibilidade = document.querySelectorAll('[id^="botao-sem-disponibilidade-"]');
    var botoesContatoRespondido = document.querySelectorAll('[id^="botao-contato-respondido-"]');
    
    botoesInteressado.forEach(function(botao) {
        botao.addEventListener('click', function() {
            var id = botao.id.split('-').pop(); // Extrai o ID do botão
            openModalConfirmaInteresse(id);
        });
    });
    
    botoesSemDisponibilidade.forEach(function(botao) {
        botao.addEventListener('click', function() {
            var id = botao.id.split('-').pop(); // Extrai o ID do botão
            openModalConfirmaSemDisponibilidade(id);
        });
    });

    botoesContatoRespondido.forEach(function(botao) {
        botao.addEventListener('click', function() {
            var id = botao.id.split('-').pop(); // Extrai o ID do botão
            openModalConfirmaContatoRespondido(id);
        });
    });
}


function validarEnviarFormulario(id) {
    var mensagemContato = document.getElementById(`mensagem-contato-${id}`).value.trim();

    if (mensagemContato === '') {
        alert('Por favor, preencha a descrição da oferta antes de enviar.');
        return false;
    }

    /* var botaoInteressado = document.getElementById(`botao-interessado-${id}`);
    var botaoSemDisponibilidade = document.getElementById(`botao-sem-disponibilidade-${id}`);

    botaoInteressado.addEventListener('click', function() {
        openModalConfirmaInteresse(id);
    });
    
    botaoSemDisponibilidade.addEventListener('click', function() {
        openModalConfirmaSemDisponibilidade(id);
    }); */

    return false; // Impede o envio do formulário imediatamente
}

function habilitarBotoes(id) {
    var mensagemContato = document.getElementById(`mensagem-contato-${id}`).value.trim();
    var botaoInteressado = document.getElementById(`botao-interessado-${id}`);
    var botaoNaoInteressado = document.getElementById(`botao-sem-disponibilidade-${id}`);

    if (mensagemContato !== '') {
        botaoInteressado.removeAttribute('disabled');
        botaoNaoInteressado.removeAttribute('disabled');
    } else {
        botaoInteressado.setAttribute('disabled', 'true');
        botaoNaoInteressado.setAttribute('disabled', 'true');
    }
}

/* ___________________________________________________________________________________________________________ */
/* MODAL INTERESSE */
function openModalConfirmaInteresse(id) {

    document.getElementById(`modal-confirmar-interesse-${id}`).style.visibility = 'visible';
    document.getElementById(`clicar-fora-modal-confirmar-interesse-${id}`).style.visibility = 'visible';
    document.getElementById(`modal-visualizar-${id}`).style.visibility = 'hidden';
    document.getElementById(`clicar-fora-modal-visualizar-recebido-${id}`).style.visibility = 'hidden';

    var botaoConfirmaEnvioInteresse = document.getElementById(`botao-confirma-envio-interesse-${id}`);

    botaoConfirmaEnvioInteresse.addEventListener('click', function() {
        form = document.getElementById(`form-contato-${id}`);
        const inputHidden = document.createElement('input');
        inputHidden.type = 'hidden';
        inputHidden.name = 'tipo_mensagem';
        inputHidden.value = 'INTERESSADO';
        form.appendChild(inputHidden);
        form.submit();
    });

}

function closeModalConfirmaInteresse(id) {
    // Oculta o modal e a sobreposição

    document.getElementById(`modal-confirmar-interesse-${id}`).style.visibility = 'hidden';
    document.getElementById(`clicar-fora-modal-confirmar-interesse-${id}`).style.visibility = 'hidden';
    document.getElementById(`modal-visualizar-${id}`).style.visibility = 'visible';
    document.getElementById(`clicar-fora-modal-visualizar-recebido-${id}`).style.visibility = 'visible';
}

/* ___________________________________________________________________________________________________________ */
/* MODAL SEM DISPONIBILIDADE */
function openModalConfirmaSemDisponibilidade(id) {

    document.getElementById(`modal-confirmar-sem-disponibilidade-${id}`).style.visibility = 'visible';
    document.getElementById(`clicar-fora-modal-confirmar-sem-disponibilidade-${id}`).style.visibility = 'visible';
    document.getElementById(`modal-visualizar-${id}`).style.visibility = 'hidden';
    document.getElementById(`clicar-fora-modal-visualizar-recebido-${id}`).style.visibility = 'hidden';

    var botaoConfirmaEnvioSemDisponibilidade = document.getElementById(`botao-confirma-envio-sem-disponibilidade-${id}`);

    botaoConfirmaEnvioSemDisponibilidade.addEventListener('click', function() {
        form = document.getElementById(`form-contato-${id}`);
        const inputHidden = document.createElement('input');
        inputHidden.type = 'hidden';
        inputHidden.name = 'tipo_mensagem';
        inputHidden.value = 'SEM_DISPONIBILIDADE';
        form.appendChild(inputHidden);
        form.submit();
    });
}

function closeModalConfirmaSemDisponibilidade(id) {
    // Oculta o modal e a sobreposição

    document.getElementById(`modal-confirmar-sem-disponibilidade-${id}`).style.visibility = 'hidden';
    document.getElementById(`clicar-fora-modal-confirmar-sem-disponibilidade-${id}`).style.visibility = 'hidden';
    document.getElementById(`modal-visualizar-${id}`).style.visibility = 'visible';
    document.getElementById(`clicar-fora-modal-visualizar-recebido-${id}`).style.visibility = 'visible';
}

/* ___________________________________________________________________________________________________________ */
