@extends('adminlte::page')

@section('title', 'Menu')

@push('components-css_stack')
@endpush
@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card card-info">
            <div class="card-header">
                <h4 class="card-title">Datos Cliente</h4>
            </div>
            <form id="OrderForm" name="OrderForm" autocomplete="off">    
            @csrf
            <div class="card-body">
                    {{ Form::hidden('dish_id[]', '', ['id'=>'dish_id'])  }}  
                    {{ Form::hidden('drink_id[]', '', ['id'=>'drink_id']) }}
                    {{ Form::hidden('combo_id[]', '', ['id'=>'combo_id']) }}
                    {{ Form::hidden('user_id', '1', ['id'=>'user_id']) }}
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
                    <div class="card-footer justify-content-between">
                        <button type="button" class="btn btn-sm btn-danger" id="cancel-order">Cancelar orden</button>
                        <button type="submit" class="btn btn-sm btn-info">Realizar pedido</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card card-success">
            <div class="card-header">
                <div class="row">
                    <div class="col-6">
                        <h6 class="card-title">Pedido: </h6>
                    </div>
                    <div class="col-6">
                        <h6 class="card-title" id="total-order">0</h6>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <p id="void" class="text-center">Sin pedidos...</p>
                <div class="row text-center table-bordered">
                    <div class="col-8">
                        <div class="row justify-content-between">
                            <div class="col-3">
                                <h6>Pedido</h6>
                            </div>
                            <div class="col-3">
                                <h6>P.U.</h6>
                            </div>
                            <div class="col-3">
                                <h6>Cantidad</h6>
                            </div>
                            <div class="col-3">
                                <h6>Total</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <h6>Acciones</h6>
                    </div>
                </div>
                <div class="col-12 text-center" id="dish-order">

                </div>
                <div class="col-12 text-center" id="drink-order">
    
                </div>
                <div class="col-12 text-center" id="combo-order">
    
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Platos</h3>
            </div>
            <div class="card-body">
                <div class="row p-1" id="row-content-dishes">

                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Bebidas</h3>
            </div>
            <div class="card-body">
                <div class="row p-1" id="row-content-drinks" >

                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Combos</h3>
            </div>
            <div class="card-body">
                <div class="row p-1" id="row-content-combos" >
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@push('components-js_stack')
<script>
    var dish_total = [];
    var drink_total = [];
    var combo_total = [];
    var dishes = [];
    var drinks = [];
    var combos = [];
    var validator;

    $('#cancel-order').click(function (e) { 
        resetForm();
    });
    function resetForm(form) {
        validator.reset();
        validator.resetForm();
        $('#OrderForm').trigger('reset');
        $('#void').html('Sin pedidos....');
        $('#dish-order').empty();
        $('#drink-order').empty();
        $('#combo-order').empty();
        $('#total-order').html('0');
    }
    function createAjax (id, route, type) {
        $.ajax({
            type: 'GET',
            url: route,
            dataType: 'JSON',
            success: function ({data, code}) {
                let content ;
                let cont = 0;
                $('#'+id).empty();
                data.map(obj => {
                    content = `
                        <div id="${obj.id}" class="col-sm-4 p-2 order ${type}" >
                            <div class="position-relative p-3 bg-gray" style="height: 180px">
                                <div class="ribbon-wrapper ribbon-lg">
                                    <div class="ribbon bg-success text-lg price">
                                        ${obj.price}
                                    </div>
                                </div>
                                <h4 class="name">${obj.name}</h4>
                                <br />
                                <small>${obj.description}</small>
                            </div>
                        </div>
                    ` ;
                    $('#'+id).append(content);
                });
            },
            error: data => {
                console.log(data);
            }
        });
    };
    function addOrder(object, container, array, type) {
        
        let name = $(object).find('h4.name').text();
        
        let id = $(object).attr('id');

        let pos = parseInt(id);

        let price = $(object).find('div.price').text();

        if($(container).find(`#${id}`).text() != "") {
            let text =  $(`#${type}-quantity-${id}`).text();
            $(`#${type}-quantity-${id}`).html(parseInt(text)+1);
            let quantity =  $(`#${type}-quantity-${id}`).text();
            let total = parseInt(price) * parseInt(quantity);
            if(type === 'dish') {
                dish_total[pos] = parseInt(quantity);
            }
            if(type === 'drink') {
                drink_total[pos] = parseInt(quantity);
            }
            if(type === 'combo') {
                combo_total[pos] = parseInt(quantity);
            }
            $(`#total-price-${id}`).html(total);
        } else {
            if(type === 'dish') {
                dish_total[pos] = 1
            }
            if(type === 'drink') {
                drink_total[id] = 1;
            }
            if(type === 'combo') {
                combo_total[id] = 1;
            }
            $(container).append(
                `<div id="div-content-${id}" class="row">
                    <div class="col-8">
                        <div class="row justify-content-between">
                            <div class="col-3">
                                <p id="${id}">${name}</p>
                            </div>
                            <div class="col-3">
                                <p id="${type}-price-${id}">${price}</p>
                            </div>
                            <div class="col.3">
                                <p id="${type}-quantity-${id}">1</p>
                            </div>  
                            <div class="col-3">
                                <p id="total-price-${id}" class="quantity-price ${type}">${price}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <button type="button" value="${id}" id="cancel-order-${type}" class="btn btn-sm btn-danger">
                            <i class="fas fa-trash-alt"></i> Cancelar
                        </button>
                        <button type="button" value="${id}" id="down-order-${type}" class="btn btn-sm btn-info">
                            <i class="fas fa-arrow-down"></i>Reducir
                        </button>
                    </div>
                </div> `
            );
        }
        if($.inArray(id,array) === -1) {
            array.push(id);
        }
    }
    function calcTotal(type) {
        let total = 0;
        $(`p.${type}`).each(function () {
            total += parseInt($(this).text());
        });
        return total;
    }
    $(document).ready(function () {
        $('button[type=submit]').prop('disabled','disabled');
        createAjax('row-content-dishes', '{{route("order.dishes")}}', 'dish');
        createAjax('row-content-drinks', '{{route("order.drinks")}}', 'drink');
        createAjax('row-content-combos', '{{route("order.combos")}}', 'combo');

        $(document).on('click', 'div.order',function () {
            $('#void').html('FACTURA');
            $('button[type=submit]').prop('disabled',false);
            if($(this).hasClass('dish')) {
                addOrder(this, '#dish-order', dishes, 'dish');
            }
            if ($(this).hasClass('drink')) {
                addOrder(this, '#drink-order', drinks, 'drink');
            }
            if ($(this).hasClass('combo')) {
                addOrder(this, '#combo-order', combos, 'combo');
            }
            let total = 0;
            $('p.quantity-price').each(function (key,value) {
                total = total + parseInt($(this).text());
            });
            $('#total-order').html(total + 'Bs');
        });

        validator = $('#OrderForm').validate({
            rules: {
                ci: {
                    required: true
                },
                name: {
                    required: true
                },
                lastname: {
                    required: true,
                }
            },
            messages: {
                ci: {
                    required: "Ingrese el carnet de indentidad"
                },
                name: {
                    required: "Ingrese el nombre"
                },
                lastname: {
                    required: "Ingrese el apellido"
                }
            },
            errorElement: 'div',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
                // element.addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
            submitHandler: function (form) {
                $.ajax({
                    type: 'POST',
                    url: "{{route('order.store')}}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        user_id : $('#user_id').val(),
                        ci: $('#ci').val(),
                        name: $('#name').val(),
                        lastname: $('#lastname').val(),
                        dish_total: dish_total,
                        drink_total: drink_total,
                        combo_total: combo_total,
                        dish_id: dishes,
                        drink_id: drinks,
                        combo_id: combos,
                    },
                    dataType: 'JSON',
                    success: function ({data,code}) {
                        resetForm(form);
                        Swal.fire({
                            title: '¡Exito!',
                            text: data,
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    },
                    error: data => {
                        console.log(data);
                    }
                });
            }
        });
    });

    function reducirPedido(array, pos, type) {
        let p = $(`p#${type}-quantity-${pos}`).text();
        if (parseInt(p) <= 1) {
            array[pos] = 0;
            $(`div#div-content-${pos}`).html("");   
        } else {
            array[pos] = array[pos] - 1;
            $(`p#${type}-quantity-${pos}`).html(array[pos]);
        }
        let precioTotal = parseInt($(`p#${type}-price-${pos}`).text()) * parseInt($(`p#${type}-quantity-${pos}`).text());
        $(`p#total-price-${pos}`).html(precioTotal);
        let total = 0;
        $('p.quantity-price').each(function (key,value) {
            total = total + parseInt($(this).text());
        });
        $('#total-order').html(total + 'Bs');
    }

    function cancelarTotal(array, pos) {
        array[pos] = 0;
        $(`div#div-content-${pos}`).html("");
        let total = 0;
        $('p.quantity-price').each(function (key,value) {
            total = total + parseInt($(this).text());
        });
        $('#total-order').html(total + 'Bs');
    }

    $(document).on("click", "div#dish-order button", function () {
        if($(this).hasClass('btn-danger')) {
            let pos = $(this).val();
            cancelarTotal(dish_total, pos);
        }
        if($(this).hasClass('btn-info')) {
            let pos = $(this).val();
            reducirPedido(dish_total, pos,  "dish");
        }
    });

    $(document).on("click", "div#drink-order button", function () {
        if($(this).hasClass('btn-danger')) {
            let pos = $(this).val();
            cancelarTotal(drink_total, pos);
        }
        if($(this).hasClass('btn-info')) {
            let pos = $(this).val();
            reducirPedido(drink_total, pos, "drink");
        }
    });

    $(document).on("click", "#combo-order button", function () {
        if($(this).hasClass('btn-danger')) {
            let pos = $(this).val();
            cancelarTotal(combo_total, pos);
        }
        if($(this).hasClass('btn-info')) {
            let pos = $(this).val();
            reducirPedido(combo_total, pos, "combo");
        }
    });

</script>
@endpush
