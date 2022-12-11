@extends('layouts.app')
{{-- Nombre en el title --}}
@section('title')
    {{ __('Pedidos Activos') }}
@endsection
{{-- Nombre en el header --}}
@section('header')
    {{ __('Pedidos Activos') }}
@endsection
{{-- Contenido --}}
@section('content')
    <div class="w-full px-4">
        <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-slate-100 border-0">
            <div class="rounded-t bg-white mb-0 px-6 py-6">
                <div class="text-center flex justify-between">

                    <ul class="nav nav-tabs flex flex-col md:flex-row flex-wrap list-none border-b-0 pl-0 w-full"
                        id="tabs-tabFill" role="tablist">
                        <li class="nav-item flex-auto text-center" role="presentation">
                            <a href="#tabs-homeFill"
                                class="
      nav-link
      w-full
      block
      font-medium
      text-xs
      leading-tight
      uppercase
      border-x-0 border-t-0 border-b-2 border-transparent
      px-6
      py-3
      my-2
      hover:border-transparent hover:bg-gray-100
      focus:border-transparent
      active
    "
                                id="tabs-home-tabFill" data-bs-toggle="pill" data-bs-target="#tabs-homeFill" role="tab"
                                aria-controls="tabs-homeFill" aria-selected="true">Pendientes @if ($pending_count)
                                    ({{ $pending_count }})
                                @endif
                            </a>
                        </li>
                        <li class="nav-item flex-auto text-center" role="presentation">
                            <a href="#tabs-profileFill"
                                class="
      nav-link
      w-full
      block
      font-medium
      text-xs
      leading-tight
      uppercase
      border-x-0 border-t-0 border-b-2 border-transparent
      px-6
      py-3
      my-2
      hover:border-transparent hover:bg-gray-100
      focus:border-transparent
    "
                                id="tabs-profile-tabFill" data-bs-toggle="pill" data-bs-target="#tabs-profileFill"
                                role="tab" aria-controls="tabs-profileFill" aria-selected="false">Acceptados
                                @if ($acceptado_count)
                                    ({{ $acceptado_count }})
                                @endif
                            </a>
                        </li>
                        <li class="nav-item flex-auto text-center" role="presentation">
                            <a href="#tabs-messagesFill"
                                class="
      nav-link
      w-full
      block
      font-medium
      text-xs
      leading-tight
      uppercase
      border-x-0 border-t-0 border-b-2 border-transparent
      px-6
      py-3
      my-2
      hover:border-transparent hover:bg-gray-100
      focus:border-transparent
    "
                                id="tabs-messages-tabFill" data-bs-toggle="pill" data-bs-target="#tabs-messagesFill"
                                role="tab" aria-controls="tabs-messagesFill" aria-selected="false">En preparacion
                                @if ($preparando_count)
                                    ({{ $preparando_count }})
                                @endif
                            </a>
                        </li>
                        <li class="nav-item flex-auto text-center" role="presentation">
                            <a href="#tabs-finish"
                                class="
      nav-link
      w-full
      block
      font-medium
      text-xs
      leading-tight
      uppercase
      border-x-0 border-t-0 border-b-2 border-transparent
      px-6
      py-3
      my-2
      hover:border-transparent hover:bg-gray-100
      focus:border-transparent
    "
                                id="tabs-finish-tabFill" data-bs-toggle="pill" data-bs-target="#tabs-finish" role="tab"
                                aria-controls="tabs-finish" aria-selected="false">Listo para entregar @if ($listo_count)
                                    ({{ $listo_count }})
                                @endif
                            </a>
                        </li>
                    </ul>

                    {{-- START button add item --}}

                    {{-- END button add item --}}

                </div>
            </div>



            <div class="tab-content" id="tabs-tabContentFill">
                <div class="tab-pane fade show active" id="tabs-homeFill" role="tabpanel"
                    aria-labelledby="tabs-home-tabFill">
                    @if (count($pending_order) == 0)
                        <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md"
                            role="alert">
                            <div class="flex">
                                <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path
                                            d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z" />
                                    </svg></div>
                                <div>
                                    <p class="font-bold">No tienes ningun pedido en estatus pendiente!</p>
                                </div>
                            </div>
                        </div>
                    @else
                        <!-- [PRODUCTO] -->
                        @foreach ($pending_order as $item)
                            <x-order-card :value='$item'></x-order-card>
                        @endforeach
                        <div class="mx-2 mb-2">
                            {{ $pending_order->links() }}
                        </div>

                        <!-- [PRODUCTO] -->
                    @endif
                </div>
                <div class="tab-pane fade" id="tabs-profileFill" role="tabpanel" aria-labelledby="tabs-profile-tabFill">

                    @if (count($accepted_order) == 0)
                        <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md"
                            role="alert">
                            <div class="flex">
                                <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path
                                            d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z" />
                                    </svg></div>
                                <div>
                                    <p class="font-bold">No tienes ningun pedido en estatus acceptado!</p>
                                </div>
                            </div>
                        </div>
                    @else
                        <!-- [PRODUCTO] -->
                        @foreach ($accepted_order as $item)
                            <x-order-card :value='$item' color='yellow'></x-order-card>
                        @endforeach
                        <div class="mx-2 mb-2">
                            {{ $accepted_order->links() }}
                        </div>
                        <!-- [PRODUCTO] -->
                    @endif
                </div>
                <div class="tab-pane fade" id="tabs-messagesFill" role="tabpanel" aria-labelledby="tabs-profile-tabFill">
                    @if (count($preparing_order) == 0)
                        <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md"
                            role="alert">
                            <div class="flex">
                                <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path
                                            d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z" />
                                    </svg></div>
                                <div>
                                    <p class="font-bold">No tienes ningun pedido en estatus Preparando!</p>
                                </div>
                            </div>
                        </div>
                    @else
                        <!-- [PRODUCTO] -->
                        @foreach ($preparing_order as $item)
                            <x-order-card :value='$item' color='orange'></x-order-card>
                        @endforeach
                        <div class="mx-2 mb-2">
                            {{ $preparing_order->links() }}
                        </div>
                        <!-- [PRODUCTO] -->
                    @endif
                </div>
                <div class="tab-pane fade" id="tabs-finish" role="tabpanel" aria-labelledby="tabs-profile-tabFill">
                    @if (count($done_order) == 0)
                        <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md"
                            role="alert">
                            <div class="flex">
                                <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path
                                            d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z" />
                                    </svg></div>
                                <div>
                                    <p class="font-bold">No tienes ningun pedido en estatus Listo para entregar!</p>
                                </div>
                            </div>
                        </div>
                    @else
                        <!-- [PRODUCTO] -->
                        @foreach ($done_order as $item)
                            <x-order-card :value='$item' color='green'></x-order-card>
                        @endforeach
                        <div class="mx-2 mb-2">
                            {{ $done_order->links() }}
                        </div>
                        <!-- [PRODUCTO] -->
                    @endif

                </div>
            </div>

        </div>
    </div>
    {{-- END GridJs --}}
@endsection
