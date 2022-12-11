@extends('layouts.app')
{{-- Nombre en el title --}}
@section('title')
    {{ __('Cliente') }}
@endsection
{{-- Nombre en el header --}}
@section('header')
    {{ __('Cliente') }}
@endsection
{{-- Contenido --}}
@section('content')
    <x-crud
        title="{{ __('Agregar Cliente')}}"
        icon="fas fa-user"
        route='usuarios.store'
        form='users.form'
        {{-- :item='' --}}
        :create='true'
        :show='false'
        :edit='false'>
    </x-crud>
@endsection
