//ABRE E FECHA O MODAL
function openModalContatarOferta(id) {
    // Exibe o modal e a sobreposição
    document.getElementById(`modal-contatar-${id}`).style.visibility = 'visible';
    document.getElementById(`clicar-fora-modal-contatar-${id}`).style.visibility = 'visible';
}

function closeModalContatarOferta(id) {
    // Oculta o modal e a sobreposição
    document.getElementById(`modal-contatar-${id}`).style.visibility = 'hidden';
    document.getElementById(`clicar-fora-modal-contatar-${id}`).style.visibility = 'hidden';
}