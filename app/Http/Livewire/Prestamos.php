<?php

namespace App\Http\Livewire;

use App\Models\Expediente;
use App\Models\Prestamo;
use Livewire\Component;
use Illuminate\Support\Facades\Validator;

class Prestamos extends Component
{
    public Expediente $expediente;
    public Prestamo $prestamo;
    public array $errores = [];

    protected $rules = [
        "prestamo.nombre_solicitante" => ["required"],
        "prestamo.solicitante_firma" => ["required"],
        "prestamo.fecha_prestamo" => ["required"],
    ];

    protected function getListeners()
    {
        return [
            'firmaSolicitante' => 'firmaSolicitante'
        ];
    }

    public function firmaSolicitante($firma)
    {
        $this->prestamo->solicitante_firma = $firma;
    }

    public function guardarPrestamo()
    {
        $this->errores = [];

        $validar_request = Validator::make($this->prestamo->toArray(), [
            "nombre_solicitante" => ["required", "string"],
            "solicitante_firma" => ["required", "string", "regex:/^data:image\/png;base64,/"],
            "fecha_prestamo" => ["required", "date_format:Y-m-d", "before_or_equal:". today()->format('Y-m-d')],
        ]);

        if ($validar_request->fails()) {   
            $this->errores = json_decode(json_encode($validar_request->errors()), true);
            $this->dispatchBrowserEvent('mensaje', [
                'icono' => 'error',
                'mensaje' => 'Tienes errores en el formulario'
            ]);
            return;
        }

        $this->prestamo = Prestamo::updateOrCreate(
            ['expediente_id' => $this->expediente->id],
            $validar_request->validated()
        );

        $this->dispatchBrowserEvent('mensaje', [
            'icono' => 'success',
            'mensaje' => 'Prestamo guardado exitosamente'
        ]);
    }

    public function eliminarPrestamo()
    {
        if(! $this->prestamo->id){
            $this->dispatchBrowserEvent('mensaje', [
                'icono' => 'error',
                'mensaje' => 'No hay prestamo para eliminar'
            ]);
            return;
        }
        
        $this->prestamo->delete();
        $this->prestamo = new Prestamo();
        $this->prestamo->fecha_prestamo = today()->format('Y-m-d');

        $this->dispatchBrowserEvent('mensaje', [
            'icono' => 'success',
            'mensaje' => 'Prestamo eliminado exitosamente'
        ]);
    }

    public function mount()
    {
        $this->prestamo = $this->expediente->prestamo ?? new Prestamo();

        if (! $this->prestamo->id) {
            $this->prestamo->fecha_prestamo = today()->format('Y-m-d');
        }
    }
    
    public function render()
    {
        return view('livewire.prestamos');
    }
}
