function openModalAjudaTipoOferta(id) {
    // Exibe o modal e a sobreposição
    document.getElementById(`caixa-modal-ajuda-${id}`).style.visibility = 'visible';
    document.getElementById(`clicar-fora-modal-ajuda-${id}`).style.visibility = 'visible';
}

function closeModalAjudaTipoOferta(id) {
    // Oculta o modal e a sobreposição
    document.getElementById(`caixa-modal-ajuda-${id}`).style.visibility = 'hidden';
    document.getElementById(`clicar-fora-modal-ajuda-${id}`).style.visibility = 'hidden';
}