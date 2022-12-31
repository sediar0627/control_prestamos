<?php

namespace App\Http\Livewire;

use App\Models\Expediente;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Expedientes extends Component
{
    public Expediente $expediente;
    public array $errores = [];

    protected $rules = [
        "expediente.numero" => ["required"],
        "expediente.nombre" => ["required"],
        "expediente.folios" => ["required"],
    ];

    public function guardarExpediente()
    {
        $this->errores = [];

        $validar_request = Validator::make($this->expediente->toArray(), [
            "numero" => [
                "required", 
                "string",
                ($this->expediente->id ? Rule::unique('expedientes', 'numero')->ignore($this->expediente->id) : "unique:expedientes,numero") 
            ],
            "nombre" => ["required", "string"],
            "folios" => ["required", "string"],
        ]);

        if ($validar_request->fails()) {   
            $this->errores = json_decode(json_encode($validar_request->errors()), true);
            $this->dispatchBrowserEvent('mensaje', [
                'icono' => 'error',
                'mensaje' => 'Tienes errores en el formulario'
            ]);
            return;
        }

        if($this->expediente->id) {
            // El expediente ya existe
            $this->expediente->save();

            $this->dispatchBrowserEvent('mensaje', [
                'icono' => 'success',
                'mensaje' => 'Expediente actualizado exitosamente'
            ]);
            
            return;
        }

        Expediente::create($validar_request->validated());

        $this->dispatchBrowserEvent('mensaje', [
            'icono' => 'success',
            'mensaje' => 'Expediente creado exitosamente'
        ]);

        $this->expediente = new Expediente();
    }

    public function render()
    {
        return view('livewire.expedientes');
    }
}
