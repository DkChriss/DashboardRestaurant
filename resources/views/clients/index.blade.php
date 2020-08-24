@extends('adminlte::page')

@section('title', 'Clientes')

@section('content')
@php
$columns = [
        [ 'title' => 'Carnet Identidad',       'data' => 'ci',         'name' => 'ci' ],
        [ 'title' => 'Nombre',                 'data' => 'name',       'name' => 'name'],
        [ 'title' => 'Apellido',               'data' => 'lastname',  'name' => 'lastname'],
        [ 'title' => 'Atendido por',           'data' => 'usuario',     'name' => 'usuario'],
        [ 'title' => 'Fecha Creación',            'data' => 'created_at', 'name' => 'created_at'],
        [ 'title' => 'Fecha Actualización',     'data' => 'updated_at', 'name' => 'updated_at'],
        [ 'title'=>'id',                       'data' => 'DT_RowId',   'name' => 'DT_RowId','visible' => false ],
    ];

    $crud = [
        'config_file'   => 'clients.partials.config',
        'uri'           => 'client', // user.create
        'crud_template' => 'clients.partials.form',
        'modal' => [
            'size'         => 'lg', //xl, lg, sm
            'bg'           => '',
            'create_title' => 'Nuevo Cliente',
            'update_title' => 'Actualizar datos del Cliente'
        ]
    ];

@endphp

<x-datatable
    id="client-table"
    route="client.list"
    :crud="$crud"
    :columns="$columns"
/>
@stop
