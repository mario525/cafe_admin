@php
        $pedido_detalles =  App\Models\PedidoDetalle::where('pedido_id', $item->id)->get();
@endphp
<div class="hidden sm:block">
    <div class="flex justify-between pb-3">
        <div class="w-1/3 pl-4 md:w-2/5">
            <span class=" text-sm uppercase  text-black font-bold">Nombre</span>
        </div>
        <div class="w-1/4 text-center xl:w-1/5">
            <span class="font-bold text-sm uppercase text-black">Cantidad</span>
        </div>
        <div class="mr-3 w-1/6 text-center md:w-1/5">
            <span class="font-bold text-sm uppercase text-black">Precio</span>
        </div>
        <div class="w-3/10 text-center md:w-1/5">
            <span class="font-bold pr-8 text-sm uppercase md:pr-16 xl:pr-8 text-black">Precio Total</span>
        </div>
    </div>
</div>
@foreach ($pedido_detalles as $pedido_detalle)
    <div
        class="mb-3 flex flex-col items-center justify-between rounded bg-white px-4 py-5 shadow sm:flex-row sm:py-4">
        <div
            class="flex w-full flex-col border-b border-grey-dark pb-4 text-center sm:w-1/3 sm:border-b-0 sm:pb-0 sm:text-left md:w-2/5 md:flex-row md:items-center">
            <span class="font-hkbold block pb-2 text-center text-sm uppercase text-secondary sm:hidden">Nombre
            </span>
            <div class="relative mx-auto w-20 sm:mx-0 sm:mr-3 sm:pr-0">
                <div class="aspect-w-1 aspect-h-1 w-full">
                    <img src="https://source.unsplash.com/1000x640/?oes-3" alt="product image"
                        class="object-cover" />
                </div>
            </div>
            <span class="mt-2 font-hk text-base text-secondary">{{$pedido_detalle->producto->nombre}}</span>
        </div>
        <div class="w-full border-b border-grey-dark pb-4 text-center sm:w-1/5 sm:border-b-0 sm:pb-0">
            <span
                class="font-hkbold block pt-3 pb-2 text-center text-sm uppercase text-secondary sm:hidden">Cantidad</span>
            <span class="font-hk text-secondary">{{$pedido_detalle->cantidad}}</span>
        </div>
        <div
            class="w-full border-b border-grey-dark pb-4 text-center sm:w-1/6 sm:border-b-0 sm:pr-6 sm:pb-0 sm:text-right xl:w-1/5 xl:pr-16">
            <span
                class="font-hkbold block pt-3 pb-2 text-center text-sm uppercase text-secondary sm:hidden">Subtotal</span>
            <span class="font-hk text-secondary">{{$pedido_detalle->subtotal}}</span>
        </div>
        <div class="w-full text-center sm:w-3/10 sm:text-right md:w-1/4 xl:w-1/5">
            <div class="pt-3 sm:pt-0">
                <p class="font-hkbold block pb-2 text-center text-sm uppercase text-secondary sm:hidden">
                    Total
                </p>
                    {{$pedido_detalle->total}}
            </div>
        </div>
    </div>
@endforeach
<div class="flex justify-end flex-wrap-reverse">
    <div class="w-1/2 md:w-1/4">

        <div class="px-3 flex">
            <div class="w-3/5 md:w-1/2">
                <span class="font-hk text-secondary">{{__("Total")}}: </span>
            </div>
            <div class="w-1/4">
                <span class="font-hk text-secondary">${{ $item->total }} </span>
            </div>
        </div>
    </div>



</div>

{{-- START buttons return, submit, edit --}}
<div class="flex flex-wrap mt-6">
    <div class="w-full md:w-1/2 px-4">
        {{-- START button return --}}
        <x-button-link title="{{ __('Regresar') }}" color="blue-500" id="button_return" name="button_return"
            href="/pedidos-detalles">
        </x-button-link>
        {{-- END button return --}}
    </div>

</div>
{{-- END buttons return, submit, edit --}}
