@extends('adminlte::page')

@section('title', 'Ordenes Bebidas')

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
        'config_file'   => 'orders-drinks.partials.config',
        'uri'           => 'client', // user.create
    ];

@endphp

<x-datatable
    id="order-drinks-table"
    route="order-drinks.list"
    :crud="$crud"
    :columns="$columns"
/>

@stop

