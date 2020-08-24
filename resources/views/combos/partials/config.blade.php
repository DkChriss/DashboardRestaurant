<script>
    const datatable = {
        crud: {
            buttons: ['delete', 'edit', 'create'],
            fields: {
                name: {
                    type: 'input'
                },
                price: {
                    type: 'input'
                },
                drink_id: {
                    type: 'select2'
                },
                dish_id: {
                    type: 'select2'
                },
                description: {
                    type: 'textarea'
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
                    price: {
                        required: true,
                        digits: true,
                        min: 1
                    },
                    drink_id: {
                        required: true,
                    },
                    dish_id: {
                        required: true,
                    },
                    description: {
                        required: true
                    }
                },
                messages: {
                    name: {
                        required:"Ingrese el nombre del combo",
                        lettersonly: jQuery.validator.addMethod("lettersonly", function(value, element) {
                            return this.optional(element) || /^[a-zA-ZñÑáéíóúÁÉÍÓÚ, ]+$/i.test(value);
                        }, "Solo se permiten letras"),
                    },
                    price: {
                        required: "Ingrese el precio del combo",
                        digits: "Solo se permiten numeros",
                        min: "Debe tener un valor positivo"
                    },
                    drink_id: {
                        required: "Seleccione una bebida"
                    },
                    dish_id: {
                        required: "Seleccione un plato"
                    },
                    description: {
                        required: "Ingrese una descripción"
                    }
                },
            }
        }
    }
</script>