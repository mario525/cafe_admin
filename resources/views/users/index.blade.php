@extends('layouts.app')
{{-- Nombre en el title --}}
@section('title')
    {{ __('Usuarios') }}
@endsection
{{-- Nombre en el header --}}
@section('header')
    {{ __('Usuarios') }}
@endsection
{{-- Contenido --}}
@section('content')
<x-table.grid-js
        title="{{ __('Clientes') }}"
        icon="fas fa-users"
        url="usuarios"
        parameter="usuario"
        :create="true"
        masivo="true"
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
                id: 'name',
                name: "{{ __('Nombre') }}"
            },
            {
                id: 'email',
                name: "{{ __('Correo') }}"
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
