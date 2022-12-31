<?php

namespace App\Traits;

trait TablasWebTrait {

    public $buscador = "";
    public $cantRegistrosPorBusqueda = 10;

    public function CambiarFiltro($parametro)
    {
        switch ($this->filtros[$parametro]) {
            case "":
                $this->filtros[$parametro] = "asc";
                break;
            case "asc":
                $this->filtros[$parametro] = "desc";
                break;
            case "desc":
                $this->filtros[$parametro] = "";
                break;
        }
        $this->resetPage();
    }

    public function updatingBuscador()
    {
        $this->resetPage();
    }

    public function updatingCantRegistrosPorBusqueda()
    {
        $this->resetPage();
    }
}
