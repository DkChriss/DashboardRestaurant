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
        {{ Form::label('lastname', 'Apellido: ', ['class'=>'control-lable']) }}
        {{ Form::text('lastname', '', [
            'id'=>'lastname', 
            'class'=>'form-control form-control-sm',
            'placeholder' => 'ingrese su apellido'
        ]) }}
    </div>
</div>
<div class="form-row">
    <div class="form-group col">
        {{ Form::label('email', 'Correo Electronico: ', ['class'=>'control-label'] )}}
        {{ Form::email('email', '', [
            'id'=>'email',
            'class'=>'form-control form-control-sm',
            'placeholder'=>'Ingrese su correo electronico'
        ]) }}
    </div>
    <div class="form-group col">
        {{ Form::label('username', 'Username: ', ['class'=>'control-label'] )}}
        {{ Form::text('username', '', [
            'id' => 'username',
            'class'=>'form-control form-control-sm',
            'placeholder' => 'Ingrese su nombre de usuario'
        ]) }}
    </div>
</div>
<div class="form-row">
    <div class="form-group col">
        {{ Form::label('password', 'Contraseña: ', ['class'=>'control-label']) }}
        {{ Form::password('password', [
            'id' => 'password', 
            'class'=>'form-control form-control-sm', 
            'placeholder'=>'Ingrese su contraseña'
        ]) }}
    </div>
    <div class="form-group col">
        {{ Form::label('password_confirmation', 'Confirmar contraseña: ', ['class'=>'control-label']) }}
        {{ Form::password('password_confirmation', [
            'id'=>'password_confirmation',
            'class'=>'form-control form-control-sm',
            'placeholder'=>'Confirme la contraseña'
        ]) }}
    </div>
</div>
<div class="form-group">
    {{ Form::label('phone', 'Celular/Telefono: ', ['class'=>'control-label'] )}}
    {{ Form::text('phone', '', [
        'id'=>'phone',
        'class' => 'form-control form-control-sm',
        'placeholder'=>'Ingrese un numero de telefono'
    ]) }}
</div>
<div class="form-group">
    {{ Form::label('address', 'Direccion: ', ['class'=>'control-label']) }}
    {{ Form::textarea('address', '', [
        'id'=>'address',
        'class'=>'form-control form-control-sm',
        'rows'=>'3',
        'placeholder'=>'Ingrese una direccion domiciliaria'
    ]) }}
</div>
