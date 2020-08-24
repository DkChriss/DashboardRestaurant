<script>
    const datatable = {
        crud: {
            buttons: ['delete', 'edit', 'create'],
            fields: {
                name: {
                    type: 'input'
                },
                quantity: {
                    type: 'input'
                },
                price: {
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
                    price: {
                        required: true,
                        digits: true,
                        min: 1
                    },
                    quantity: {
                        required: true,
                        digits: true,
                        min: 1
                    }
                },
                messages:{
                    name: {
                        required:"Ingrese el nombre del plato",
                        lettersonly: jQuery.validator.addMethod("lettersonly", function(value, element) {
                            return this.optional(element) || /^[a-zA-ZñÑáéíóúÁÉÍÓÚ, ]+$/i.test(value);
                        }, "Solo se permiten letras"),
                    },
                    price: {
                        required: "Ingrese el precio del plato",
                        digits: "Solo numeros",
                        min: "El precio debe tener un valor positivo"
                    },
                    quantity: {
                        required: "Ingrese el precio del plato",
                        digits: "Solo numeros",
                        min: "El precio debe tener un valor positivo"
                    }
                },
            }
        }
    }
</script>