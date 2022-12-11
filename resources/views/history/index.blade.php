@extends('layouts.app')
{{-- Nombre en el title --}}
@section('title')
    {{ __('Historial De Pedidos') }}
@endsection
{{-- Nombre en el header --}}
@section('header')
    {{ __('Historial De Pedidos') }}
@endsection
{{-- Contenido --}}
@section('content')
<x-table.grid-js
        title="{{ __('Historial De Pedidos') }}"
        icon="fas fa-university"
        url="pedidos"
        parameter="pedido"
        :create="false"
        masivo="false"
        :show="true"
        :edit="false"
        :delete="false">

        {{-- Aquí se ponen las columnas GridJs --}}
        <x-slot name="columns">
            {
                id: 'id',
                name: "{{ __('Orden #') }}",
                hidden: false
            },
            {
                id: 'estatus',
                name: "{{ __('Estatus') }}",
                hidden: true
            },
            {
                id: 'total',
                name: "{{ __('Precio Total') }}"
            },
            {
                id: 'nombre',
                name: "{{ __('Estatus') }}"
            },
            {
                id: 'updated_at',
                name: "{{ __('Ultima Actualizacion') }}",
                formatter: (cell, row) => {
                    return formatDate(cell)
                }
            },
        </x-slot>
    </x-table.grid-js>
@endsection
