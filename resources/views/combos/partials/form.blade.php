<div class="form-row">
    <div class="form-group col">
        {{ Form::label('name', 'Nombre: ', ['class'=>'control-label']) }}
        {{ Form::text('name', '', [
            'id'=>'name',
            'class'=>'form-control form-control-sm',
            'placeholder'=>'Ingrese nombre del combo'
        ]) }}
    </div>
    <div class="form-group col">
        {{ Form::label('price', 'Precio: ', ['class'=>'control-label']) }}
        {{ Form::number('price', '', [
            'id'=>'price',
            'class'=>'form-control form-control-sm',
            'placeholder' => 'Ingrese el precio del combo'
        ] ) }}
    </div>
</div>
<div class="form-row">
    <div class="form-group col">
        {{ Form::label('dish_id', 'Plato: ', ['class'=>'control-label']) }}
        <x-select-remote-data
        route='dish.filter'
        configFile="combos.partials.selectDish.config"
        configVarName="selectRemoteDataDish"
        id="dish_id"
        name="dish_id"/>
    </div>
    <div class="form-group col">
        {{ Form::label('drink_id', 'Bebida: ', ['class'=>'control-label']) }}
        <x-select-remote-data
        route='drink.filter'
        configFile="combos.partials.selectDrink.config"
        configVarName="selectRemoteDataDrink"
        id="drink_id"
        name="drink_id"/>
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