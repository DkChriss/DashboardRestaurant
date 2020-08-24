{{ Form::hidden('user_id', '1') }}
<div class="form-row">
    <div class="form-group col">
        {{ Form::label('name', 'Nombre: ', ['class'=>'control-label']) }}
        {{ Form::text('name', '', [
            'id'=>'name',
            'class'=>'form-control form-control-sm',
            'placeholder'=>'Ingrese el nombre'
        ])}}
    </div>
    <div class="form-group col">
        {{ Form::label('quantity', 'Cantidad: ', ['class'=>'control-label']) }}
        {{ Form::number('quantity', '', [
            'id'=>'quantity',
            'class'=>'form-control form-control-sm',
            'placeholder'=>'Ingrese la cantidad'
        ])}}
    </div>
</div>
<div class="form-group">
    {{ Form::label('price', 'Precio: ', ['class'=>'control-label']) }}
    {{ Form::number('price', '', [
        'id'=>'price',
        'class'=>'form-control form-control-sm',
        'placeholder' =>'Ingrese el precio'
    ])}}
</div>