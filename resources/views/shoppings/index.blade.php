@extends('adminlte::page')

@section('title', 'Compras')

@section('content_top_nav_left')
    <span
        class="pt-1 font-weight-bold text-uppercase text-black" style="margin-top: 3px;">
        Compras
    </span>
@endsection

@section('content')
@php
$columns = [
        [ 'title' =>'Nombre',                   'data' => 'name',       'name' =>'name'],
        [ 'title' => 'Precio',                  'data' => 'price',      'name' => 'price'],
        [ 'title' => 'Cantidad',                'data' => 'quantity',   'name' => 'quantity'],
        [ 'title' => 'Fecha Compra',            'data' => 'created_at', 'name' => 'created_at'],
        [ 'title' => 'Fecha Actualización',     'data' => 'updated_at', 'name' => 'updated_at'],
        [ 'title' =>'id',                       'data' => 'DT_RowId',   'name' => 'DT_RowId','visible' => false ],
    ];

    $crud = [
        'config_file'   => 'shoppings.partials.config',
        'uri'           => 'shopping', // user.create
        'crud_template' => 'shoppings.partials.form',
        'modal' => [
            'size'         => 'lg', //xl, lg, sm
            'bg'           => '',
            'create_title' => 'Nuevo usuario',
            'update_title' => 'Actualizar datos del usuario'
        ]
    ];

@endphp

<x-datatable
    id="shopping-table"
    route="shopping.list"
    :crud="$crud"
    :columns="$columns"
/>
@stop
