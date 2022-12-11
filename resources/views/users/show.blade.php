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
        title="{{ __('Pedido')}}"
        icon="fas fa-user"
        {{-- route='' --}}
        form='users.form'
        :item='$usuario'
        :create='false'
        :show='true'
        :edit='false'>
    </x-crud>
@endsection
