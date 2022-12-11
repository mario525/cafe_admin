<!DOCTYPE html>
<html data-theme="cupcake" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="author" content="UNEDL">
    <meta name="description" content="UNEDL">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @php
        $setting = App\Models\config::first();
        $active_count = App\Models\Pedido::where('estado_pedido_id', '1')
         ->orwhere('estado_pedido_id', '2')
         ->orwhere('estado_pedido_id', '3')
         ->orwhere('estado_pedido_id', '4')
         ->count();
    @endphp

    <title>{{ $setting->name ?? '' }} Admin - @yield('title')</title>

    @if (isset($setting->icon))
        <link rel="icon" href="{{ asset('upload/site_setting/' . $setting->icon) }}">
    @else
        <link rel="icon" href="{{ asset('favicon.ico') }}">
    @endif

    @include('layouts.styles')
</head>

<body class="text-slate-700 antialiased">
    <div id="root">
        {{-- START sidebar --}}
        @include('layouts.sidebar', $setting)
        {{-- END sidebar --}}
        <div class="relative md:ml-64   bg-slate-50">
            {{-- START header --}}
            @include('layouts.header')


            <div id="banner_color" class=" bg-{{ $setting->color }}-{{ $setting->shade }} md:pt-32 pb-32  pt-12">

                <div class="px-4 md:px-10 mx-auto w-full ">
                </div>
            </div>
            {{-- END header --}}
            <div class="px-4 md:px-10  mx-auto w-full -m-20 absolute">
                {{-- START main --}}
                <div class="mb-28   ">
                    @yield('content')
                </div>
                    </div>
                    {{-- END main --}}
                {{-- START footer --}}
            @include('layouts.footer')
            {{-- END footer --}}
        </div>
    </div>
    {{-- START scripts --}}
    @include('layouts.scripts')
    @stack('js')
    {{-- END scripts --}}
</body>

</html>
