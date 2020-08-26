@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_top_nav_left')
    <span
        class="pt-1 font-weight-bold text-uppercase text-black" style="margin-top: 3px;">
        Usuarios
    </span>
@endsection

@section('content')
@php
$columns = [
        [ 'title' => 'Nombre Completo',        'data' => 'full-name',  'name' => 'full-name' ],
        [ 'title' => 'Usuario',                'data' => 'username',   'name' => 'username' ],
        [ 'title' => 'Correo Electronico',     'data' => 'email',      'name' => 'email' ],
        [ 'title' => 'Fecha de creacion',      'data' => 'created_at', 'name' => 'created_at' ],
        [ 'title' => 'Fecha de actualizacion', 'data' => 'updated_at', 'name' => 'updated_at' ],
        [ 'title'=>'id',                       'data' => 'DT_RowId',   'name' => 'DT_RowId','visible' => false ],
    ];

    $crud = [
        'config_file'   => 'users.partials.config',
        'uri'           => 'user', // user.create
        'crud_template' => 'users.partials.form',
        'modal' => [
            'size'         => 'lg', //xl, lg, sm
            'bg'           => '',
            'create_title' => 'Nuevo usuario',
            'update_title' => 'Actualizar datos del usuario'
        ]
    ];

@endphp

<x-datatable
    id="user-table"
    route="user.list"
    :crud="$crud"
    :columns="$columns"
/>
@stop
