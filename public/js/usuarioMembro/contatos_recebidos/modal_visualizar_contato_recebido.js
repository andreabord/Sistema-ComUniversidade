function openModalVisualizarContatoRecebido(id) {
    // Exibe o modal e a sobreposição
    document.getElementById(`modal-visualizar-${id}`).style.visibility = 'visible';
    document.getElementById(`clicar-fora-modal-visualizar-recebido-${id}`).style.visibility = 'visible';
}

function closeModalVisualizarContatoRecebido(id) {
    // Oculta o modal e a sobreposição
    document.getElementById(`modal-visualizar-${id}`).style.visibility = 'hidden';
    document.getElementById(`clicar-fora-modal-visualizar-recebido-${id}`).style.visibility = 'hidden';
}