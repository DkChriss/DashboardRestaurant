@extends('adminlte::page')

@section('title', 'Ordenes Platillos')

@section('content_top_nav_left')
    <span
        class="pt-1 font-weight-bold text-uppercase text-black" style="margin-top: 3px;">
        Ordenes Platillos
    </span>
@endsection

@section('content')
@php
$columns = [
        [ 'title' => 'Carnet Identidad',       'data' => 'ci',          'name' => 'ci' ],
        [ 'title' => 'Nombre Completo',        'data' => 'fullName',    'name' => 'fullName'],
        [ 'title' => 'Plato',                  'data' => 'dish',        'name' => 'dish'],
        [ 'title' => 'Cantidad',               'data' => 'quantity',    'name' => 'quantity'],
        [ 'title' => 'Total',                  'data' => 'total',       'name' => 'total']
    ];

    $crud = [
        'config_file'   => 'orders-dishes.partials.config',
        'uri'           => 'client',  // user.create
    ];

@endphp

<x-datatable
    id="order-dishes-table"
    route="order-dishes.list"
    :crud="$crud"
    :columns="$columns"
/>

@stop

