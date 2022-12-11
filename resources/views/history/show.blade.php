@extends('layouts.app')
{{-- Nombre en el title --}}
@section('title')
    {{ __('Historial de pedidos') }}
@endsection
{{-- Nombre en el header --}}
@section('header')
    {{ __('Historial de pedidos') }}
@endsection
{{-- Contenido --}}
@section('content')
    <x-crud
        title="{{ __('Orden #').$pedido->id}}"
        icon="fas fa-coffee"
        {{-- route='' --}}
        form='history.form'
        :item='$pedido'
        :create='false'
        :show='true'
        :edit='false'>
    </x-crud>
@endsection
