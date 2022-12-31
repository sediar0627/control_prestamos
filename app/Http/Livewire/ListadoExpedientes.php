<?php

namespace App\Http\Livewire;

use App\Models\Expediente;
use App\Traits\TablasWebTrait;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Database\Eloquent\Builder;

class ListadoExpedientes extends Component
{
    use WithPagination;
    use TablasWebTrait;

    public array $filtros = [
        "id" => ""
    ];

    public function render()
    {
        $expedientes = [];

        if (
            $this->filtros["id"] !== "" ||
            $this->buscador !== ""
        ) {
            $expedientes = Expediente::with(['prestamo']);

            if ($this->buscador !== "") {

                $valor = trim(strtolower($this->buscador));

                $expedientes->whereRaw("LOWER(numero) LIKE '" . $valor . "%'")
                    ->orWhereRaw("LOWER(nombre) LIKE '" . $valor . "%'")
                    ->orWhereHas("prestamo", function (Builder $query) use ($valor) {
                        $query->whereRaw("LOWER(nombre_solicitante) LIKE '" . $valor . "%'");
                    });
            }

            if ($this->filtros["id"] !== '') {
                $expedientes->orderBy('id', $this->filtros["id"]);
            }

            $expedientes = $expedientes->paginate($this->cantRegistrosPorBusqueda);
        } else {
            $expedientes = Expediente::with(['prestamo'])->paginate($this->cantRegistrosPorBusqueda);
        }

        return view('livewire.listado-expedientes', [
            'expedientes' => $expedientes
        ]);
    }
}
