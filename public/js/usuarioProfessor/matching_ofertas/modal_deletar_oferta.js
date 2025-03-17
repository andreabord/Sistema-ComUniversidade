function openModalDeletar(id) {
    // Exibe o modal e a sobreposição
    document.getElementById(`caixa-modal-deletar-${id}`).style.visibility = 'visible';
    document.getElementById(`clicar-fora-modal-deletar-${id}`).style.visibility = 'visible';
}

function closeModalDeletar(id) {
    // Oculta o modal e a sobreposição
    document.getElementById(`caixa-modal-deletar-${id}`).style.visibility = 'hidden';
    document.getElementById(`clicar-fora-modal-deletar-${id}`).style.visibility = 'hidden';
}