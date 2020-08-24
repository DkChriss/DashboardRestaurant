<script>
    const datatable = {
        crud: {
            buttons: ['delete', 'edit', 'create'],
            fields: {
                ci: {
                    type: 'input'
                },
                name: {
                    type: 'input'
                },
                lastname: {
                    type: 'input'
                }
            },
            validator: {
                rules: {
                    ci: {
                        required: true,
                    },
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
                    }
                },
                messages: {
                    ci: {
                        required: "Ingrese su carnet de identidad"
                    },
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
                    }
                },
            }
        }
    }
</script>