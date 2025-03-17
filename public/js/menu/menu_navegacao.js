function abrirMenu() {
    event.preventDefault(); // Impede o comportamento padrão do link
    document.getElementById('menu_navegacao').style.display = 'flex';

    document.getElementById('menu-button').setAttribute('onclick', 'fecharMenu()');
}

function fecharMenu() {
    event.preventDefault(); // Impede o comportamento padrão do link
    document.getElementById('menu_navegacao').style.display = 'none';

    document.getElementById('menu-button').setAttribute('onclick', 'abrirMenu()');
}