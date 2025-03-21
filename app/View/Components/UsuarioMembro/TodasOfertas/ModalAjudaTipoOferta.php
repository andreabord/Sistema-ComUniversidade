<?php

namespace App\View\Components\UsuarioMembro\TodasOfertas;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ModalAjudaTipoOferta extends Component
{

    /**
     * Create a new component instance.
     */
    public function __construct(
        public int $idUsuario
    )
    {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.usuario-membro.todas_ofertas.modal-ajuda-tipo-oferta', [
        ]);
    }
}
