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
        title="{{ __('Ver Producto')}}"
        icon="fas fa-images"
        {{-- route='' --}}
        form='products.form'
        :item='$product'
        :create='false'
        :show='true'
        :edit='false'>
    </x-crud>
@endsection
