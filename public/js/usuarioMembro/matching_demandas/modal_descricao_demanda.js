function openModalDescricao(id) {
    // Exibe o modal e a sobreposição
    document.getElementById(`caixa-modal-descricao-${id}`).style.visibility = 'visible';
    document.getElementById(`clicar-fora-modal-descricao-${id}`).style.visibility = 'visible';
}

function closeModalDescricao(id) {
    // Oculta o modal e a sobreposição
    document.getElementById(`caixa-modal-descricao-${id}`).style.visibility = 'hidden';
    document.getElementById(`clicar-fora-modal-descricao-${id}`).style.visibility = 'hidden';
}