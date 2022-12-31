<div class="container mx-auto px-6">
    <div class="flex flex-col">
        <div class="w-full my-2 flex flex-col gap-y-2 sm:flex-row sm:justify-between">
            <div class="w-full sm:w-64 flex justify-center items-center bg-white rounded-xl border-2 border-gray-300 overflow-hidden">
                <input class="pl-4 rounded-md focus:outline-none flex-grow p-2" placeholder="Buscar" wire:model="buscador">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 my-auto m-2" style="color: gray" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
            <div class="w-full sm:w-24">
                <select wire:model="cantRegistrosPorBusqueda" class="w-full h-full text-black placeholder-gray-600 px-4 py-2.5 text-base transition duration-500 ease-in-out transform rounded-xl border-2 border-gray-300 bg-white focus:outline-none">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </div>
        </div>
        <div class="-my-2 py-2 overflow-x-auto">
            <div class="align-middle inline-block min-w-full overflow-hidden sm:rounded-lg border-2 border-gray-300">
                <table class="min-w-full">
                    <thead>
                        <tr>
                            <th class="p-3 border-b border-gray-200 bg-gray-50 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                <div wire:click="CambiarFiltro('id')" class="w-full h-full flex items-center cursor-pointer">
                                    <span class="mr-2">ID</span>
                                    @switch($filtros["id"])
                                    @case("")
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
                                    </svg>
                                    @break
                                    @case("asc")
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12" />
                                    </svg>
                                    @break
                                    @case("desc")
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 13l-5 5m0 0l-5-5m5 5V6" />
                                    </svg>
                                    @break
                                    @endswitch
                                </div>
                            </th>
                            <th class="p-3 border-b border-gray-200 bg-gray-50 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                <span>NUMERO DE EXPEDIENTE</span>
                            </th>
                            <th class="p-3 border-b border-gray-200 bg-gray-50 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                <span>SOLICITANTE</span>
                            </th>
                            <th class="p-3 border-b border-gray-200 bg-gray-50 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                <span>FECHA</span>
                            </th>
                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                ACCIONES
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @if(count($prestamos) > 0)
                        @foreach ($prestamos as $prestamo)
                        <tr>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-center">
                                <div class="text-sm leading-5 text-gray-900">{{ $prestamo->id }}</div>
                            </td>

                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-center">
                                <div class="text-sm leading-5 text-gray-900">{{ $prestamo->expediente->numero }}</div>
                            </td>

                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-center">
                                <div class="text-sm leading-5 text-gray-900">{{ $prestamo->nombre_solicitante }}</div>
                            </td>

                            <td class="px-3 py-4 whitespace-no-wrap border-b border-gray-200 text-center">
                                <div class="text-sm leading-5 text-gray-900">{{ $prestamo->fecha_prestamo }}</div>
                            </td>

                            <td class="py-4 whitespace-no-wrap border-b border-gray-200 leading-5 text-gray-500">
                                <div class="flex item-center justify-center">
                                    <div class="mr-2 transform hover:text-indigo-600 hover:scale-110">
                                        <a href="{{ URL::to('/') }}/expedientes/{{ $prestamo->expediente->id }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td class="py-4 whitespace-no-wrap border-b text-center border-gray-200 leading-5 text-gray-500" colspan="9">
                                {{ __('No hay registros') }}
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        <div class="px-5 py-4 bg-white sm:rounded-lg {{ count($prestamos) > 0 && $prestamos->lastPage() > 1 ? 'my-8 border-2 border-gray-300' : '' }}">
            {{ $prestamos->links() }}
        </div>
    </div>
</div>
