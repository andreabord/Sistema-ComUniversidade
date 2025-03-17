function openModalVisualizarContatoRealizado(id) {
    // Exibe o modal e a sobreposição
    document.getElementById(`modal-visualizar-contato-realizado-${id}`).style.visibility = 'visible';
    document.getElementById(`clicar-fora-modal-visualizar-contato-realizado-${id}`).style.visibility = 'visible';
}

function closeModalVisualizarContatoRealizado(id) {
    // Oculta o modal e a sobreposição
    document.getElementById(`modal-visualizar-contato-realizado-${id}`).style.visibility = 'hidden';
    document.getElementById(`clicar-fora-modal-visualizar-contato-realizado-${id}`).style.visibility = 'hidden';
}


