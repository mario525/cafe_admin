@extends('layouts.app')
{{-- Nombre en el title --}}
@section('title')
    {{ __('Productos') }}
@endsection
{{-- Nombre en el header --}}
@section('header')
    {{ __('Productos') }}
@endsection
{{-- Contenido --}}
@section('content')
<x-table.grid-js
        title="{{ __('Productos') }}"
        icon="fas fa-utensils"
        url="product"
        parameter="product"
        :create="true"
        :show="true"
        :edit="true"
        :delete="true">

        {{-- Aquí se ponen las columnas GridJs --}}
        <x-slot name="columns">
            {
                id: 'id',
                name: "{{ __('ID') }}",
                hidden: true
            },
            {
                id: 'estatus',
                name: "{{ __('Estatus') }}",
                hidden: true
            },
            {
                id: 'imagen',
                name: "{{ __('Imagen') }}",
                formatter: (cell, row) => {
                    srcStr = row.cells[2].data;

                    var img = h('img', {
                        src: srcStr,
                        className: 'm-2 object-cover',
                        style: 'height: 77px;'
                    }, '');
                    return img;
                }
            },
            {
                id: 'nombre',
                name: "{{ __('Nombre') }}"
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
