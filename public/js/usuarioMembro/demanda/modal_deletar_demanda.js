function openModalDeletar(id) {
    // Exibe o modal e a sobreposição
    document.getElementById(`clicar-fora-modal-${id}`).style.visibility = 'visible';
    document.getElementById(`caixa-modal-${id}`).style.visibility = 'visible';
}

function closeModalDeletar(id) {
    // Oculta o modal e a sobreposição
    document.getElementById(`clicar-fora-modal-${id}`).style.visibility = 'hidden';
    document.getElementById(`caixa-modal-${id}`).style.visibility = 'hidden';
}