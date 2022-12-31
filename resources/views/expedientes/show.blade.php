<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ 'Detalle del Expediente ' . $expediente->numero }}
        </h2>
    </x-slot>

    <div class="pt-12 pb-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="mb-3">
                    <x-jet-label for="nombre" value="Nombre de Expediente" />
                    <x-jet-input id="nombre" class="block mt-1 w-full" type="text" name="nombre" disabled value="{{ $expediente->nombre }}"/>
                </div>
            
                <div class="mb-3">
                    <x-jet-label for="folios" value="Folios" />
                    <x-jet-input id="folios" class="block mt-1 w-full" type="text" name="folios" disabled value="{{ $expediente->folios }}"/>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-jet-button onclick="window.location.href = '{{ URL::to('/') }}/expedientes/{{ $expediente->id }}/edit';">
                        Actualizar
                    </x-jet-button>
                </div>
            </div>
        </div>
    </div>
    <div class="pb-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @livewire('prestamos', ['expediente' => $expediente])
            </div>
        </div>
    </div>

    <x-slot name="scripts">
        <script src="{{ asset('js/signature_pad.min.js') }}"></script>
        <script src="{{ asset('js/trim_canvas.js') }}"></script>
        <script>
            // Variables para realizar la firma
            content_signature_width = 0;
            content_signature_height = 0;
            signature_canvas = null;
            signature_pad = null;
        
            function htmlSignature(){
                return `
                    <div id="content_signature" style="background: rgba(37, 37, 37, .8); position: fixed; top: 150%; left: 0; width: 100%; height: 100%; z-index: 1050 !important;">
                        <div style="width: 97%; height: 96%; margin: auto auto;">
                            <div id="content_signature_canvas" style="background: white; width: 98% !important; height: 88% !important; margin: 1em auto;">
                                <canvas id="signature_canva" width="50" height="50"></canvas>
                            </div>
                            <div class="flex items-center justify-end mt-4">
                                <x-jet-button class="mr-4" onclick="clearSignatureCanvas()">
                                    Limpiar
                                </x-jet-button>

                                <x-jet-button class="mr-4" id="btnSaveSignature">
                                    Guardar
                                </x-jet-button>

                                <x-jet-button class="mr-4" onclick="hiddenSignatureCanvas()">
                                    Cancelar
                                </x-jet-button>
                            </div>
                        </div>
                    </div>
                `;
            };
        
            function showSignatureCanvas(){
        
                $("body").append(htmlSignature());
        
                content_signature_width = $("#content_signature_canvas").width();
                content_signature_height = $("#content_signature_canvas").height();
                signature_canvas = document.getElementById('signature_canva');

                $('#btnSaveSignature').on('click', sendSignature)

                signature_canvas.width = content_signature_width - 2;
                signature_canvas.height = content_signature_height - 2;
        
                signature_pad = new SignaturePad(signature_canvas, {
                    minWidth: 2,
                    maxWidth: 4,
                });
        
                $("#content_signature").css({"top": "0"});
            };
        
            function clearSignatureCanvas(){
                signature_pad.clear();
            };
        
            function hiddenSignatureCanvas(){
                $("#content_signature").remove();
                content_signature_width = 0;
                content_signature_height = 0;
                signature_canvas = null;
                signature_pad = null;
            };
        
            function sendSignature(){
                if(signature_pad.isEmpty()){
                    messageFlash.fire({
                        icon: 'error',
                        title: 'No ha firmado',
                    });
                    return;
                }
        
                const base64 = trimCanvas(signature_canvas).toDataURL();
        
                $(`#prev_img_solicitante_firma`).attr('src', base64);
                Livewire.emit('firmaSolicitante', base64);

                hiddenSignatureCanvas();
            };

            $("#signature").on('click', showSignatureCanvas)
        </script>
    </x-slot>
</x-app-layout>