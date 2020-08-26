@extends('adminlte::page')

@section('title', 'Bebidas')

@section('content_top_nav_left')
    <span
        class="pt-1 font-weight-bold text-uppercase text-black" style="margin-top: 3px;">
        Bebidas
    </span>
@endsection

@section('content')
@php
$columns = [
        [ 'title' => 'Nombre',                 'data' => 'name',  'name' => 'name' ],
        [ 'title' => 'Precio',                 'data' => 'price', 'name' => 'price'],
        [ 'title' => 'Descripción',   'data' => 'description', 'name' => 'description'],
        [ 'title' => 'Fecha Creación',         'data' => 'created_at', 'name' => 'created_at'],
        [ 'title' => 'Fecha Actualización',    'data' => 'updated_at', 'name' => 'updated_at'],
        [ 'title'=>'id',                       'data' => 'DT_RowId',   'name' => 'DT_RowId','visible' => false ],
    ];

    $crud = [
        'config_file'   => 'drinks.partials.config',
        'uri'           => 'drink', // user.create
        'crud_template' => 'drinks.partials.form',
        'modal' => [
            'size'         => 'md', //xl, lg, sm
            'bg'           => '',
            'create_title' => 'Nueva Bebida',
            'update_title' => 'Actualizar datos de la bebida'
        ]
    ];

@endphp

<x-datatable
    id="drink-table"
    route="drink.list"
    :crud="$crud"
    :columns="$columns"
/>

@stop

