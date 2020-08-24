<div class="form-row">
    <div class="form-group col">
        {{ Form::label('name', 'Name: ', ['class' => 'control-label']) }}
        {{ Form::text('name', '', [
            'id' => 'name',
            'class' => 'form-control form-control-sm',
            'placeholder' => 'Ingrese el nombre del plato'
        ]) }}
    </div>
    <div class="form-group col">
        {{ Form::label('price', 'Precio: ', ['class'=>'control-label'] ) }}
        {{ Form::number('price', '', [
            'id' => 'price',
            'class' => 'form-control form-control-sm',
            'placeholder' => 'Ingrese el precio del plato'
        ]) }}
    </div>
</div>
<div class="form-group">
    {{ Form::label('description', 'Descripción: ', ['class' => 'control-label' ])}}
    {{ Form::textarea('description', '', [
        'id'=>'description',
        'class'=>'form-control form-control-sm',
        'placeholder'=>'Ingrese una descripción',
        'rows'=>'3'
    ]) }}
</div>