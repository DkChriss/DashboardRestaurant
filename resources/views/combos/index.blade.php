@extends('adminlte::page')

@section('title', 'Combos')
@section('content_top_nav_left')
    <span
        class="pt-1 font-weight-bold text-uppercase text-black" style="margin-top: 3px;">
        Combos
    </span>
@endsection

@section('content')
@php
$columns = [
        [ 'title'=>'Nombre',                     'data' => 'name',       'name'=>'name'],
        [ 'title'=>'Precio',                     'data' => 'price',       'name'=>'price'],
        [ 'title'=>'Plato',                      'data' => 'dish',       'name'=>'dish'],
        [ 'title'=>'Bebida',                     'data' => 'drink',       'name'=>'drink'],
        [ 'title' => 'Descripción',   'data' => 'description', 'name' => 'description'],
        [ 'title' => 'Fecha Creación',            'data' => 'created_at', 'name' => 'created_at'],
        [ 'title' => 'Fecha Actualización',     'data' => 'updated_at', 'name' => 'updated_at'],
        [ 'title'=>'id',                       'data' => 'DT_RowId',   'name' => 'DT_RowId','visible' => false ],
    ];

    $crud = [
        'config_file'   => 'combos.partials.config',
        'uri'           => 'combo', // user.create
        'crud_template' => 'combos.partials.form',
        'modal' => [
            'size'         => 'lg', //xl, lg, sm
            'bg'           => '',
            'create_title'  => 'Nuevo Combo',
            'update_title' => 'Actualizar datos del Combo'
        ]
    ];

@endphp

<x-datatable
    id="combo-table"
    route="combo.list"
    :crud="$crud"
    :columns="$columns"
/>
@stop
