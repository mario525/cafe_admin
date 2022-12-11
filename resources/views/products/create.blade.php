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
    <x-crud
        title="{{ __('Crear Producto')}}"
        icon="fas fa-images"
        route='product.store'
        form='products.form'
        {{-- :item='' --}}
        :create='true'
        :show='false'
        :edit='false'>
    </x-crud>
@endsection
