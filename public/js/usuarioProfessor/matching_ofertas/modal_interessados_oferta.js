function openModalUsuariosInteressados(id) {
    // Exibe o modal e a sobreposição
    document.getElementById(`caixa-modal-interessados-${id}`).style.visibility = 'visible';
    document.getElementById(`clicar-fora-modal-interessados-${id}`).style.visibility = 'visible';
}

function closeModalUsuariosInteressados(id) {
    // Oculta o modal e a sobreposição
    document.getElementById(`caixa-modal-interessados-${id}`).style.visibility = 'hidden';
    document.getElementById(`clicar-fora-modal-interessados-${id}`).style.visibility = 'hidden';
}