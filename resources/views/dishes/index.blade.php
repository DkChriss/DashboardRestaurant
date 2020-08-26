@extends('adminlte::page')

@section('title', 'Platos')

@section('content_top_nav_left')
    <span
        class="pt-1 font-weight-bold text-uppercase text-black" style="margin-top: 3px;">
        Platos
    </span>
@endsection

@section('content')
@php
$columns = [
        [ 'title' => 'Nombre',        'data' => 'name',  'name' => 'name' ],
        [ 'title' => 'Precio',        'data' => 'price', 'name' => 'price'],
        [ 'title' => 'Descripción',   'data' => 'description', 'name' => 'description'],
        [ 'title' => 'Fecha Creación',            'data' => 'created_at', 'name' => 'created_at'],
        [ 'title' => 'Fecha Actualización',     'data' => 'updated_at', 'name' => 'updated_at'],
        [ 'title'=>'id',                       'data' => 'DT_RowId',   'name' => 'DT_RowId','visible' => false ],
    ];

    $crud = [
        'config_file'   => 'dishes.partials.config',
        'uri'           => 'dish', // user.create
        'crud_template' => 'dishes.partials.form',
        'modal' => [
            'size'         => 'md', //xl, lg, sm
            'bg'           => '',
            'create_title' => 'Nuevo Plato',
            'update_title' => 'Actualizar datos del Plato'
        ]
    ];

@endphp

<x-datatable
    id="dish-table"
    route="dish.list"
    :crud="$crud"
    :columns="$columns"
/>
@stop
