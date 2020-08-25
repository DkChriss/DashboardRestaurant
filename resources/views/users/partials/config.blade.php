    <script>
            const asignPermissionFn = (evt, rows, dt) => {
        let uri = `{{route("user-permission.show", "##")}}`;
        let firstRow = selectedRow[SELECTED_ROW];
        let url = _.replace(uri, '##', firstRow.id);
        $('#userPermisoCrudForm').trigger('reset');
        $.ajax({
            type: 'GET',
            url,
            dataType: "JSON",
            success: function ({ data, code}) {
                _.forEach(data, function (value) {
                    var nombre = "#" + value.name;
                    $(nombre).prop('checked', true);
                });
                $('#userPermisoCrudModalTitle').html("Asignar Permisos");
                $('#userPermisoCrudModal').modal('show');
            },
            error: data =>  {
                console.log(data);
            }
        });
    }
    const asignRoleFn  = (evt, rows, dt) => {
        let uri = `{{route("user-role.show", "##")}}`;
        let firstRow = selectedRow[SELECTED_ROW];
        let url = _.replace(uri, '##', firstRow.id);
        $('#userRolCrudForm').trigger('reset');
        $.ajax({
            type: 'GET',
            url,
            dataType: "JSON",
            success: function ({ data, code}) {
                _.forEach(data, function (value) {
                    var nombre = "#" + value.name;
                    $(nombre).prop('checked', true);
                });
                $('#userRolCrudModalTitle').html("Asignar Roles");
                $('#userRolCrudModal').modal('show');
            },
            error: data =>  {
                console.log(data);
            }
        });
    }
    const activacion = () => {
        $("#asignPermissionBtn-{{ $id }}").attr('disabled', false);
        $("#asignRolBtn-{{ $id }}").attr('disabled', false);
    }
    const desactivacion = () => {
        $("#asignPermissionBtn-{{ $id }}").attr('disabled', true);
        $("#asignRolBtn-{{ $id }}").attr('disabled', true);
    }
    const datatable = {
        buttons: [{
            type : "asignPermission",
            text: 'Asignar Permisos',
            icon: 'fas fa-plus-square',
            className: 'btn btn-info btn-sm',
            action: asignPermissionFn,
            attr:  {
                title: 'Asignar Permisos Al Usuario Seleccionado',
                id: 'asignPermissionBtn',
                disabled: true
            },
        },{
            type : "asignRol",
            text: 'Asignar Rol',
            icon: 'fas fa-plus-square',
            className: 'btn btn-info btn-sm',
            action: asignRoleFn,
            attr:  {
                title: 'Asignar Roles Al Usuario Seleccionado',
                id: 'asignRolBtn',
                disabled: true
            },
        }],
        selectActions : {
            onSelect: activacion,
            onDeselect: desactivacion,
        },
        crud: {
            buttons: ['delete', 'edit', 'create'],
            fields: {
                username: {
                    type: 'input'
                },
                password: {
                    type: 'input'
                },
                pássword_confirm: {
                    type: 'input'
                },
                name: {
                    type: 'input'
                },
                lastname: {
                    type: 'input'
                },
                email: {
                    type: 'input'
                },
                address: {
                    type: 'textarea'
                },
                phone: {
                    type: 'input'
                }
            },
            validator: {
                rules: {
                    name: {
                        required: true,
                        lettersonly: true,
                        normalizer: function(value) {
                            return $.trim(value);
                        }
                    },
                    lastname: {
                        required: true,
                        lettersonly: true,
                        normalizer: function(value) {
                            return $.trim(value);
                        }
                    },
                    email: {
                        required: true,
                        email: true,
                    },
                    username: {
                        required: true,
                    },
                    address: {
                        required: true,
                    },
                    phone: {
                        required: true,
                        digits: true
                    },
                    password: {
                        required: {
                            depends: function () {
                                return modalMode === MODAL_CREATE;
                            }
                        },
                        minlength: 6,
                    },
                    password_confirmation:{
                        required:{
                            depends: function () {
                                return modalMode === MODAL_CREATE;
                            }
                        },
                        equalTo: "#password",
                        minlength: 6,
                    },
                },
                messages:{
                    name: {
                        required:"Ingrese el nombre completo",
                        lettersonly: jQuery.validator.addMethod("lettersonly", function(value, element) {
                            return this.optional(element) || /^[a-zA-ZñÑáéíóúÁÉÍÓÚ, ]+$/i.test(value);
                        }, "Solo se permiten letras"),
                    },
                    lastname: {
                        required:"Ingrese el apellido completo",
                        lettersonly: jQuery.validator.addMethod("lettersonly", function(value, element) {
                            return this.optional(element) || /^[a-zA-ZñÑáéíóúÁÉÍÓÚ, ]+$/i.test(value);
                        }, "Solo se permiten letras"),
                    },
                    phone:{
                        required: "Ingrese el numero de telefono",
                        digits: "Solo se permite numeros"
                    },
                    address: {
                        required:"Ingrese su direccion domiciliaria"
                    },
                    email: {
                        required: "El correo electronico es requerido",
                        email: "El correo electrónico no es válido",
                    },
                    username: {
                        required: "El nombre de usuario es requerido",
                    },
                    password: {
                        required: "La contraseña es requerida",
                        minlength: jQuery.validator.format("Requiere mas de {0} caracateres!"),
                    },
                    password_confirmation: {
                        required: "Ingrese la confirmación de la contraseña",
                        equalTo: "Las contraseñas no coinciden",
                        minlength: jQuery.validator.format("Requiere mas de {0} caracateres!"),
                    },
                },
            }
        }
    }
    $(document).ready(function () {
        $('#userPermisoSubmitButton').click(function (e) {
            let uri = `{{route("user-permission.update", "##")}}`;
            let firstRow = selectedRow[SELECTED_ROW];
            let url = _.replace(uri, '##', firstRow.id);
            $(this).html('Enviando...');
            $.ajax({
                type: 'PATCH',
                url,
                data: $('#userPermisoCrudForm').serialize(),
                dataType: "JSON",
                success: function ({ data, code}) {
                        Swal.fire({
                            title: '¡Exito!',
                            text: data,
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        $('#userPermisoSubmitButton').html(`<i class="fas fa-share-square"></i> {{ __('Asignar') }}`);
                        $('#userPermisoCrudForm').trigger('reset');
                        $('#userPermisoCrudModal').modal('hide');
                },
                error: data =>  {
                        $('#userPermisoSubmitButton').html(`<i class="fas fa-share-square"></i> {{ __('Asignar') }}`);
                        errorMessage(data);
                        $("#userPermisoCrudForm").validate().showErrors(data.responseJSON);
                }
            });
        });
        $('#userRolSubmitButton').click(function (e) {
            let uri = `{{route("user-role.update", "##")}}`;
            let firstRow = selectedRow[SELECTED_ROW];
            let url = _.replace(uri, '##', firstRow.id);
            $(this).html('Enviando...');
            $.ajax({
                type: 'PATCH',
                url,
                data: $('#userRolCrudForm').serialize(),
                dataType: "JSON",
                success: function ({ data, code}) {
                        Swal.fire({
                            title: '¡Exito!',
                            text: data,
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        $('#userRolSubmitButton').html(`<i class="fas fa-share-square"></i> {{ __('Asignar') }}`);
                        $('#userRolCrudForm').trigger('reset');
                        $('#userRolCrudModal').modal('hide');
                },
                error: data =>  {
                        $('#userRolSubmitButton').html(`<i class="fas fa-share-square"></i> {{ __('Asignar') }}`);
                        errorMessage(data);
                        $('#userRolCrudForm').validate().showErrors(data.responseJSON);
                }
            });
        });
    });
</script>
@include('users/partials/permission_form')
@include('users/partials/roles_form')
