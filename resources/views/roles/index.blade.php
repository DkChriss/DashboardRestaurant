@extends('adminlte::page')

@section('title', 'Roles')

@section('content_top_nav_left')
    <span 
        class="pt-1 font-weight-bold text-uppercase text-white">
        Roles
    </span>
@endsection

@section('content')
@php
$columns = [
        [ 'title' => 'Nombre',                 'data' => 'name',      'name' => 'name' ],
        [ 'title' => 'Fecha de creación',      'data' => 'created_at',  'name' => 'created_at' ],
        [ 'title' => 'Fecha de actualización', 'data' => 'updated_at',  'name' => 'updated_at' ],
        [ 'title' => 'id',                     'data' => 'DT_RowId',    'name' => 'DT_RowId', 'visible' => false ],
    ];
    $crud = [
        'config_file'   => 'roles.partials.config',
        'uri'           => 'role', // user.create
        'crud_template' => 'roles.partials.form',
        'modal' => [
            'size'         => 'md', //xl, lg, sm
            'bg'           => '',
            'create_title' => 'Registrar nuevo rol',
            'update_title' => 'Actualizar datos del rol'
        ]
    ];

@endphp
<x-datatable
    id="roleTable"
    route="role.list"
    :crud="$crud"
    :columns="$columns"
/>
@stop
