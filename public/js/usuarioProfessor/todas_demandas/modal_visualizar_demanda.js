function openModalVisualizarOferta(id) {
    // Exibe o modal e a sobreposição
    document.getElementById(`modal-visualizar-${id}`).style.visibility = 'visible';
    document.getElementById(`clicar-fora-modal-visualizar-${id}`).style.visibility = 'visible';
}

function closeModalVisualizarOferta(id) {
    // Oculta o modal e a sobreposição
    document.getElementById(`modal-visualizar-${id}`).style.visibility = 'hidden';
    document.getElementById(`clicar-fora-modal-visualizar-${id}`).style.visibility = 'hidden';
}