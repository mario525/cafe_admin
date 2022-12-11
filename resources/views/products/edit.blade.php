@extends('layouts.app')
{{-- Nombre en el title --}}
@section('title')
    {{ __('Banners') }}
@endsection
{{-- Nombre en el header --}}
@section('header')
    {{ __('Banners') }}
@endsection
{{-- Contenido --}}
@section('content')
    <x-crud
        title="{{ __('Editar Producto')}}"
        icon="fas fa-images"
        route='product.update'
        form='products.form'
        :item='$product'
        :create='false'
        :show='false'
        :edit='true'>
    </x-crud>
@endsection
