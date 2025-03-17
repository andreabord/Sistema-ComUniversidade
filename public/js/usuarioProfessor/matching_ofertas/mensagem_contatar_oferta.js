var envioAutomaticoAgendado = false; // Variável para controlar o envio automático

function validarEnviarFormulario(id) {
    var mensagemContato = document.getElementById(`mensagem-contato-${id}`).value.trim();

    if (mensagemContato === '') {
        alert('Por favor, preencha a descrição da oferta antes de enviar.');
        return false; // Impede o envio do formulário
    }

    // Mostrar o modal de sucesso
    mostrarModalSucesso(id);

    // Agendar o envio real do formulário após um breve intervalo (para dar tempo ao usuário de ver o modal)
   /*  setTimeout(function() { */
        /* if (!envioAutomaticoAgendado) {
            document.getElementById(`form-contato-${id}`).submit();
        } */
    /* }, 10000); */ // Tempo em milissegundos (aqui definido como 10 segundos para ilustração)

    return false; // Impede o envio do formulário imediatamente
}

function mostrarModalSucesso(id) {
    // Mostra o modal de sucesso
    document.getElementById(`modal-sucesso-${id}`).style.visibility = 'visible';
    document.getElementById(`clicar-fora-modal-sucesso-${id}`).style.visibility = 'visible';
    document.getElementById(`modal-contatar-${id}`).style.visibility = 'hidden';
    document.getElementById(`clicar-fora-modal-contatar-${id}`).style.visibility = 'hidden';
    document.getElementById(`modal-visualizar-${id}`).style.visibility = 'hidden';
    document.getElementById(`clicar-fora-modal-visualizar-${id}`).style.visibility = 'hidden';
}

function fecharModalSucesso(id) {
    // Fecha o modal de sucesso
    document.getElementById(`modal-sucesso-${id}`).style.visibility = 'hidden';
    document.getElementById(`clicar-fora-modal-sucesso-${id}`).style.visibility = 'hidden';

    // Atualiza a variável para indicar que o envio automático foi cancelado
    envioAutomaticoAgendado = true;

    // Envia o formulário imediatamente
    document.getElementById(`form-contato-${id}`).submit();
}