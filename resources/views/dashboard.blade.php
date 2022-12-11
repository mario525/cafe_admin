@extends('layouts.app')
{{-- Nombre en el title --}}
@section('title')
    {{ __('Dashboard') }}
@endsection
{{-- Nombre en el header --}}
@section('header')
    {{ __('Dashboard') }}
@endsection
{{-- Contenido --}}
@section('content')
    {{-- START mensaje --}}
    <div class="flex flex-wrap">
        <div class="w-full px-4">
            <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                <h5 class="text-slate-100 uppercase font-bold text-xs">
                    {{ __('Recent Violations') }}
                </h5>
            </div>
        </div>
    </div>
    {{-- END mensaje --}}
    {{-- START contador Infracciones --}}
    <div class="flex flex-wrap mt-4">
        <div class="w-full lg:w-1/4 xl:w-1/4  px-4">
            <div class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg">
                <div class="flex-auto p-4">
                    <div class="flex flex-wrap">
                        <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                            <h5 class="text-slate-400 uppercase font-bold text-xs">
                                {{ __('Daily Sales') }}
                            </h5>
                            <span class="counter"  id="infra">0</span>
                        </div>
                        <div
                            class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-red-500">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- END contador Infracciones --}}
        {{-- START contador Ordenes de Visita --}}
        <div class="w-full lg:w-1/4 xl:w-1/4  px-4">
            <div class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg">
                <div class="flex-auto p-4">
                    <div class="flex flex-wrap">
                        <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                            <h5 class="text-slate-400 uppercase font-bold text-xs">
                                {{ __('Weekly Sales') }}
                            </h5>
                            <span class="counter" id="orden" >0</span>
                        </div>
                        <div
                            class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-orange-500">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- END contador Ordenes de Visita --}}
        {{-- START contador Citatorio --}}
        <div class="w-full lg:w-1/4 xl:w-1/4  px-4">
            <div class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg">
                <div class="flex-auto p-4">
                    <div class="flex flex-wrap">
                        <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                            <h5 class="text-slate-400 uppercase font-bold text-xs">
                                {{ __('Montly Sales') }}
                            </h5>
                            <span class="counter"  id='cita' >0</span>
                        </div>
                        <div
                            class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-purple-500">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- END contador Citatorio --}}
        {{-- START contador Apercibimientos--}}
        <div class="w-full lg:w-1/4 xl:w-1/4  px-4">
            <div class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg">
                <div class="flex-auto p-4">
                    <div class="flex flex-wrap">
                        <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                            <h5 class="text-slate-400 uppercase font-bold text-xs">
                                {{ __('Warning') }}
                            </h5>
                            <span class="counter" id='aper'>0</span>
                        </div>
                        <div
                            class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-green-500">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- END contador Apercibimiento--}}


    @push('js')

    @endpush
@endsection
