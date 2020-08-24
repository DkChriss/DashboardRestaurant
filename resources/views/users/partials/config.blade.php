    <script>
    const datatable = {
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
</script>