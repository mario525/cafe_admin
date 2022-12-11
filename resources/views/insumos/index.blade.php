@extends('layouts.app')
{{-- Nombre en el title --}}
@section('title')
    {{ __('Insumos') }}
@endsection
{{-- Nombre en el header --}}
@section('header')
    {{ __('Insumos') }}
@endsection
{{-- Contenido --}}
@section('content')
    <x-js-grid title="{{ __('Insumos') }}" icon="fas fa-cookie-bite" url="insumos" parameter="insumo" edit="true" delete="true"
        create="true">
          {{-- Aquí se pone algún código extra que necesite el jsGrid --}}
          <x-slot name="extras">
            db.status = [{
            title: "ACTIVO",
            value: "ACTIVO",
            id: 0
            },
            {
            title: "INACTIVO",
            value: "INACTIVO",
            id: 1
            }
            ];
        </x-slot>
        {{-- Aquí se pone las columnas jsGrid --}}
        <x-slot name="columns">
            {
            name: "id",
            type: "number",
            width: 1
            },
            {
            title: "{{ __('Nombre') }}",
            name: "nombre",
            type: "text",
            validate: {
            message: "{{ __('Name is required') }}",
            validator: function(value) {
            return value != "";
            }
            },
            },
            {
                title: "{{ __('Precio') }}",
                name: "precio",
                type: "number",
                validate: {
                message: "{{ __('Precio es requerido') }}",
                validator: function(value) {
                return value != "";
                }
                },
                },
            {
            title: "{{ __('Ultima Actualizacion') }}",
            name: "updated_at",
            editing: false,
            readonly: true,
            width: 100,
            itemTemplate: function(value) {
            return formatDate(value);
            },
            },
            {
                title: "Estatus",
                name: "estatus",
                type: "select",
                items: db.status,
                selectedIndex: 0,
                valueField: 'title',
                textField: 'title',
                validate: {
                    message: "{{ __('Estatus es requerido') }}",
                    validator: function(value) {
                        return value != "";
                    }
                },
            },

        </x-slot>

    </x-js-grid>
@endsection
