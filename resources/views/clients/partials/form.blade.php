
{{ Form::hidden('user_id', '1') }}
<div class="form-group col">
    {{ Form::label('ci','CI: ', ['class'=>'control-label']) }}
    {{ Form::text('ci','', [
        'id'=>'ci',
        'class' => 'form-control form-control-sm',
        'placeholder'=>'Ingrese su carnet de identidad'
    ])}}
</div>
<div class="form-row">
    <div class="form-group col">
        {{ Form::label('name', 'Nombre: ', ['class'=>'control-label']) }}
        {{ Form::text('name', '', [
            'id'=>'name',
            'class'=>'form-control form-control-sm',
            'placeholder'=>'Ingrese su nombre'
        ]) }}
    </div>
    <div class="form-group col">
        {{ Form::label('lastname', 'Apellido', ['class'=>'control-label']) }}
        {{ Form::text('lastname', '', [
            'id'=>'lastname',
            'class'=>'form-control form-control-sm',
            'placeholder'=>'Ingrese su apellido'
        ])}}
    </div>
</div>