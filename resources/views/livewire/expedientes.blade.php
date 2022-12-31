<div class="p-6">
    <div class="mb-3">
        <x-jet-label for="expediente" value="N° de Expediente" />
        <x-jet-input id="expediente" class="block mt-1 w-full" type="text" name="expediente" required wire:model.lazy="expediente.numero"/>
        @if(isset($errores['numero']))
        <div class="mt-3 ml-6 w-11/12">
            @foreach ($errores['numero'] as $error)
            <p class="w-full text-red-600 flex items-center">
                <span class="ml-2">{{ $error }}</span>
            </p>
            @endforeach
        </div>
        @endif
    </div>

    <div class="mb-3">
        <x-jet-label for="nombre" value="Nombre de Expediente" />
        <x-jet-input id="nombre" class="block mt-1 w-full" type="text" name="nombre" required wire:model.lazy="expediente.nombre"/>
        @if(isset($errores['nombre']))
        <div class="mt-3 ml-6 w-11/12">
            @foreach ($errores['nombre'] as $error)
            <p class="w-full text-red-600 flex items-center">
                <span class="ml-2">{{ $error }}</span>
            </p>
            @endforeach
        </div>
        @endif
    </div>

    <div>
        <x-jet-label for="folios" value="Folios" />
        <x-jet-input id="folios" class="block mt-1 w-full" type="text" name="folios" required wire:model.lazy="expediente.folios"/>
        @if(isset($errores['folios']))
        <div class="mt-3 ml-6 w-11/12">
            @foreach ($errores['folios'] as $error)
            <p class="w-full text-red-600 flex items-center">
                <span class="ml-2">{{ $error }}</span>
            </p>
            @endforeach
        </div>
        @endif
    </div>

    <div class="flex items-center justify-end mt-4">
        @if($expediente->id)
        <x-jet-button class="mr-4" onclick="window.location.href = '{{ URL::to('/') }}/expedientes/create';">
            Crear otro expediente
        </x-jet-button>
        <x-jet-button class="mr-4" onclick="window.location.href = '{{ URL::to('/') }}/expedientes/{{ $expediente->id }}';">
            Ver detalle
        </x-jet-button>
        @endif
        <x-jet-button wire:click="guardarExpediente">
            {{ $expediente->id ? 'Actualizar' : 'Crear' }}
        </x-jet-button>
    </div>
</div>