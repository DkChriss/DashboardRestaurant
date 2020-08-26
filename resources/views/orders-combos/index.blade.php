@extends('adminlte::page')

@section('title', 'Ordenes Combos')

@section('content_top_nav_left')
    <span
        class="pt-1 font-weight-bold text-uppercase text-black" style="margin-top: 3px;">
        Ordenes Combos
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
        'config_file'   => 'orders-combos.partials.config', // user.create
        'uri'           => 'client',
    ];

@endphp

<x-datatable
    id="order-combos-table"
    route="order-combos.list"
    :crud="$crud"
    :columns="$columns"
/>

@stop

