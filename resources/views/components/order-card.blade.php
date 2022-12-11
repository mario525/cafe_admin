@php
    $user_name = App\Models\User::where('id', $value->user_id)->first();
    $pedido_detalle = App\Models\PedidoDetalle::where('pedido_id', $value->id)->get();
@endphp

<div class="flex flex-wrap pb-2 px-2">
    <div class="w-full">
        <div class="flex flex-wrap">
            {{-- CARTA - PRODUCTO --}}
            <div class="w-full lg:w-1/2 lg:flex ">
                <div
                    class="h-2 lg:h-auto lg:w-5 flex-none bg-{{ $color }}-500 rounded-t lg:rounded-t-none lg:rounded-l text-center overflow-hidden">
                </div>
                <div
                    class=" w-full  xl:border-b border-r xl:border-r-0 border-l border-gray-400 lg:border-l-0 lg:border-t lg:border-gray-400 bg-white rounded-b lg:rounded-b-none lg:rounded-r-none p-4 flex flex-col justify-between leading-normal xl:h-full">
                    <div class="mb-8">
                        <div class="text-gray-900 font-bold text-xl mb-2">Orden #{{ $value->id }}</div>


                        <div class="flex  flex-wrap">
                            <div class="w-full">
                                <div class="px-3 flex">

                                    <div class="w-4/6 ">
                                        <span class="font-hk text-secondary font-bold">
                                            Producto
                                        </span>
                                    </div>
                                    <div class="w-1/6">
                                        <span class="font-hk text-secondary font-bold">Cantidad</span>
                                    </div>
                                    <div class="w-1/6">
                                        <span class="font-hk text-secondary font-bold">Total</span>
                                    </div>
                                </div>
                                @foreach ($pedido_detalle as $pedido)
                                    <div class="px-3 flex">

                                        <div class="w-4/6 ">
                                            <span class="font-hk text-secondary">
                                                {{ $pedido->producto->nombre }}
                                            </span>
                                        </div>
                                        <div class="w-1/6">
                                            <span class="font-hk text-secondary">{{ $pedido->cantidad }}</span>
                                        </div>
                                        <div class="w-1/6">
                                            <span class="font-hk text-secondary">${{ $pedido->total }}</span>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="w-full text-end mt-2">
                                    <span class=" font-hk text-secondary ">Precio Final: ${{ $value->total }}</span>
                                </div>
                            </div>




                        </div>


                    </div>
                    <div class="flex items-center">
                        <div class="text-sm">
                            <p class="text-gray-900 leading-none">{{ $user_name->name }}</p>
                            <p class="text-gray-600">{{ $value->created_at }}</p>
                        </div>
                    </div>
                </div>
            </div>
            {{-- CARTA COMENTARIO --}}
            <div class="w-full lg:w-1/3 ">
                <div
                    class=" w-full  xl:border-b border-r xl:border-r-0 border-l  border-gray-400 lg:border-l-0 lg:border-t lg:border-gray-400 bg-white rounded-b lg:rounded-b-none lg:rounded-r-none p-4 flex flex-col justify-between leading-normal md:h-full">
                    <div class="mb-8">


                        <p class="text-gray-700 text-base">Comentario: </p>

                        <p>
                            {{ $value->detalle_comentario }}
                        </p>






                    </div>

                </div>
            </div>
            {{-- CARTA ACCEPTAR --}}
            <div class="w-full lg:w-1/6 ">
                <div
                    class=" w-full  border-b border-r border-l border-gray-400 lg:border-l-0 lg:border-t lg:border-gray-400 bg-white rounded-b lg:rounded-b-none lg:rounded-r p-4 flex flex-col justify-between leading-normal md:h-full">
                    <div class="xl:py-8 flex flex-wrap justify-between">
                        @if ($value->estado_pedido_id == 1)
                            <div class="xl:w-full xl:pb-2 w-2/5">
                                <form class="w-full" method="POST" action="{{ route('buttonsel', ['id' => $value->id]) }}">
                                    @csrf
                                    @method('post')
                                    <button id="red" name="action" href="red" value="acceptar"
                                        class="w-full block bg-blue-500 text-white active:bg-green-200 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150 text-center"
                                        type="submit">
                                        Acceptar
                                </button>
                                </form>

                            </div>

                            <div class="xl:w-full xl:pb-2 w-2/5">
                                <form class="w-full" method="POST" action="{{ route('buttonsel', ['id' => $value->id]) }}">
                                    @csrf
                                <button id="red" name="action" href="red" value="rechazar"
                                    class="w-full block bg-red-500 text-white active:bg-green-200 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150 text-center"
                                    type="submit">
                                    Rechazar
                            </button>
                        </form>
                            </div>
                        @elseif ($value->estado_pedido_id == 2)
                        <div class="xl:w-full xl:pb-2 w-2/5">
                            <form class="w-full" method="POST" action="{{ route('buttonsel', ['id' => $value->id]) }}">
                                @csrf
                            <button id="red" name="action" href="red" value="preparando"
                                class="w-full block bg-blue-500 text-white active:bg-green-200 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150 text-center"
                                type="submit">
                                Comenzar Preparacion
                        </button>
                    </form>
                        </div>
                        @elseif ($value->estado_pedido_id == 3)
                        <div class="xl:w-full xl:pb-2 w-2/5">
                            <form class="w-full" method="POST" action="{{ route('buttonsel', ['id' => $value->id]) }}">
                                @csrf
                            <button id="red" name="action" href="red" value="listo_para_entregar"
                                class="w-full block bg-blue-500 text-white active:bg-green-200 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150 text-center"
                                type="submit">
                                Pedido Terminado
                        </button>
                    </form>
                        </div>
                        @elseif ($value->estado_pedido_id == 4)
                        <div class="xl:w-full xl:pb-2 w-2/5">
                            <form class="w-full" method="POST" action="{{ route('buttonsel', ['id' => $value->id]) }}">
                                @csrf
                            <button id="red" name="action" href="red" value="entregado"
                                class="w-full block bg-blue-500 text-white active:bg-green-200 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150 text-center"
                                type="submit">
                                Pedido Entregado
                        </button>
                    </form>
                        </div>
                        @endif



                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
