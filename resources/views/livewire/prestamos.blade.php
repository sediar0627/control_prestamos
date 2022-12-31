<div class="p-6">
    <div class="mb-3">
        <x-jet-label for="nombre_solicitante" value="Nombre del Solicitante" />
        <x-jet-input id="nombre_solicitante" class="block mt-1 w-full" type="text" name="nombre_solicitante" required wire:model.lazy="prestamo.nombre_solicitante"/>
        @if(isset($errores['nombre_solicitante']))
        <div class="mt-3 ml-6 w-11/12">
            @foreach ($errores['nombre_solicitante'] as $error)
            <p class="w-full text-red-600 flex items-center">
                <span class="ml-2">{{ $error }}</span>
            </p>
            @endforeach
        </div>
        @endif
    </div>

    <div class="mb-3">
        <x-jet-label for="fecha_prestamo" value="Fecha del Prestamo" />
        <x-jet-input id="fecha_prestamo" class="block mt-1 w-full" type="date" name="fecha_prestamo" required wire:model.lazy="prestamo.fecha_prestamo"/>
        @if(isset($errores['fecha_prestamo']))
        <div class="mt-3 ml-6 w-11/12">
            @foreach ($errores['fecha_prestamo'] as $error)
            <p class="w-full text-red-600 flex items-center">
                <span class="ml-2">{{ $error }}</span>
            </p>
            @endforeach
        </div>
        @endif
    </div>

    <div class="mb-3">
        <x-jet-label value="Firma del Solicitante" />
        @if(isset($errores['solicitante_firma']))
        <div class="mt-3 ml-6 w-11/12">
            @foreach ($errores['solicitante_firma'] as $error)
            <p class="w-full text-red-600 flex items-center">
                <span class="ml-2">{{ $error }}</span>
            </p>
            @endforeach
        </div>
        @endif
        <div class="flex items-center justify-center">
            <img src="{{ $prestamo->solicitante_firma }}" id="prev_img_solicitante_firma" style="max-width: 300px; max-height: 150px;" />
        </div>
    </div>
    
    <div class="flex items-center justify-end mt-4">
        <x-jet-button class="mr-4" id="signature">
            Firmar
        </x-jet-button>
        @if($expediente->prestamo)            
        <x-jet-button class="mr-4" wire:click="eliminarPrestamo">
            Eliminar Prestamo
        </x-jet-button>
        @endif
        <x-jet-button wire:click="guardarPrestamo">
            Guardar Prestamo
        </x-jet-button>
    </div>

</div>
