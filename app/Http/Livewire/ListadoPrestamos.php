<?php

namespace App\Http\Livewire;

use App\Models\Prestamo;
use App\Traits\TablasWebTrait;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Database\Eloquent\Builder;

class ListadoPrestamos extends Component
{
    use WithPagination;
    use TablasWebTrait;

    public array $filtros = [
        "id" => ""
    ];
    
    public function render()
    {
        $prestamos = [];

        if (
            $this->filtros["id"] !== "" ||
            $this->buscador !== ""
        ) {
            $prestamos = Prestamo::with(['expediente']);

            if ($this->buscador !== "") {

                $valor = trim(strtolower($this->buscador));

                $prestamos->whereRaw("LOWER(nombre_solicitante) LIKE '" . $valor . "%'")
                    ->orWhereHas("expediente", function (Builder $query) use ($valor) {
                        $query->whereRaw("LOWER(numero) LIKE '" . $valor . "%'")
                            ->orWhereRaw("LOWER(nombre) LIKE '" . $valor . "%'");
                    });
            }

            if ($this->filtros["id"] !== '') {
                $prestamos->orderBy('id', $this->filtros["id"]);
            }

            $prestamos = $prestamos->paginate($this->cantRegistrosPorBusqueda);
        } else {
            $prestamos = Prestamo::with(['expediente'])->paginate($this->cantRegistrosPorBusqueda);
        }

        return view('livewire.listado-prestamos', [
            'prestamos' => $prestamos
        ]);
    }
}
