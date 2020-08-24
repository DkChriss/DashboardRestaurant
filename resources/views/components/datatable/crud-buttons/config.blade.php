<script>
    const MODAL_CREATE = 'create';
    const MODAL_EDIT   = 'edit';
    const SELECTED_ROW = 0;

    var validator,
        modalMode; // edit, create
    // DELETE
    const deleteFn = (evt, rows, dt) => {

        let selectedRowsCount = dt.rows( { selected: true } ).count();
        let url, params;
        
        params = {
            _token: "{{ csrf_token() }}"
        }

        if (selectedRowsCount > 1) { 
            let selectedRows = dt.rows( { selected: true } ).data();
            let ids = [];
            selectedRows.toArray().forEach(currentRow => ids.push(currentRow.id));
            url = `{{ isset($crud['uri']) && Route::has("{$crud['uri']}.destroy-multiple") 
                    ? route("{$crud['uri']}.destroy-multiple") 
                    : ''}}`;

            if (url.length == 0) return;

            params['ids'] = ids;
        } else {
            let uri = `{{ isset($crud['uri']) ? route("{$crud['uri']}.destroy", "##") : ''}}`;
            let firstRow = dt.rows( { selected: true } ).data()[SELECTED_ROW];
            url = _.replace(uri, '##', firstRow.id);
        }

        if (selectedRowsCount > 0) {
            Swal.fire({
                title: '¿Está seguro de eliminar los elementos seleccionados?',
                text: "El registro no estará disponible",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Eliminar'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: 'DELETE',
                        url,
                        data: params,
                        dataType: "JSON",
                        success: function ({ data, code}) {
                            dt.ajax.reload();
                            dt.rows().deselect();
                            Swal.fire({
                                title: '¡Exito!',
                                text: data,
                                icon: 'success',
                                showConfirmButton: false,
                                timer: 1500
                            });
                        },
                        error: data => {
                            Swal.fire({
                                title: 'Error!',
                                text: data.responseJSON.message,
                                icon: 'error',
                                showConfirmButton: false,
                                timer: 2000
                            });
                        }
                    });
                }
            });
        }
    }

    // CREATE
    const createFn = (evt, rows, dt) => {
        let modalTitle = "{{ isset($crud['modal']['create_title']) ? $crud['modal']['create_title'] : '' }}";
        modalMode = MODAL_CREATE;
        resetForm();

        $('#{{$id}}CrudModalTitle').html(modalTitle);
        $('#{{$id}}CrudModal').modal('show');
    }

    const editFn = (evt, row, dt) => {
        const arraykey = datatable.crud.fields;
        let uri = `{{ isset($crud['uri']) ? route("{$crud['uri']}.show", "##") : ''}}`;
        let firstRow = dt.rows( { selected: true } ).data()[SELECTED_ROW];
        let url = _.replace(uri, '##', firstRow.id);
        let modalTitle = "{{ isset($crud['modal']['update_title']) ? $crud['modal']['update_title'] : '' }}";

        modalMode = MODAL_EDIT;
        resetForm();

        $.ajax({
            type: 'GET',
            url,
            dataType: "JSON",
            success: function ({ data, code }) {
                $('#{{$id}}CrudModalTitle').html(modalTitle);
                _.forEach(arraykey, function (value, key) {
                    if (value.type === 'checkbox') {
                        $('#{{$id}}CrudModal').find(`input[name = ${key}]`).prop("checked", data[key]);
                    }

                    if (value.type === 'textarea') {
                        $('#{{$id}}CrudModal').find(`textarea[name = ${key}]`).val(data[key]);
                    }

                    if (value.type === 'select') {
                        $('#{{$id}}CrudModal').find(`select[name = ${key}]`).val(data[key]);
                    }

                    if(value.type === 'select2')
                    {
                        let newKey = key.split('_');
                        let dates = data[newKey[0]];
                        let option = {
                            id: dates.id,
                            text: dates.name + ' ' + '('+dates.price+')'
                        }
                        let newOption = new Option(option.text, option.id, false, false);
                        $('#{{$id}}CrudModal').find(`select[name = ${key}]`).append(newOption).trigger('change');
                    }

                    if (!value.type || value.type === 'input') {
                        $('#{{$id}}CrudModal').find(`input[name = ${key}]`).val(data[key]);
                    }
                });
                $('#{{$id}}CrudModal').modal('show');
            },
            error: data =>  {
                console.log(data);
            }
        });
    }

    let buttons = [{
        type: 'create',
        text: 'Crear',
        icon: 'fas fa-plus-square',
        className: 'btn btn-secondary btn-sm',
        action: createFn,
        attr:  {
            title: 'Crea un nuevo elemento',
            id: 'createBtn'
        }
    }, {
        type: 'edit',
        text: 'Editar',
        icon: 'fas fa-edit',
        className: 'btn btn-warning btn-sm edit-btn',
        action: editFn,
        attr:  {
            title: 'Edita el elemento seleccionado',
            id: 'editBtn',
            disabled: true
        }
    }, {
        type: 'delete',
        text: 'Eliminar',
        icon: 'fas fa-trash-alt',
        className: 'btn btn-danger btn-sm delete-btn',
        action: deleteFn,
        attr:  {
            title: 'Elimina el o los elementos seleccionados',
            id: 'deleteBtn',
            disabled: true
        }
    }];

    let crudActions =
        datatable.crud &&
        datatable.crud.buttons &&
        datatable.crud.buttons.length > 0;

    if ( crudActions ) {
        buttons = _.filter(buttons, function(action) {
            return _.includes( datatable.crud.buttons, action.type);
        });
    } else {
        buttons = []
    }

    const crudConfig = {
        buttons
    }


    // AJAX REQUEST

    $(document).ready(function () {
        if (datatable.crud && datatable.crud.validator) {
            validator = $('#{{$id}}CrudForm').validate({
                rules: datatable.crud.validator.rules,
                messages: datatable.crud.validator.messages,
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
                    $("#{{$id}}SubmitButton").prop("disabled", true);
                    $("#{{$id}}SubmitButton").html(`
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Enviando...`
                    );
                    if (modalMode === MODAL_CREATE) {
                        create(form);
                    }

                    if (modalMode === MODAL_EDIT) {
                        edit(form);
                    }
                }
            });
        }
    });

    function create(form) {
        let url = `{{ isset($crud['uri']) ? route("{$crud['uri']}.store") : ''}}`;
        $.ajax({
            type: 'POST',
            url: url,
            data: serializeData(form),
            dataType: "JSON",
            success: function ({ data, code}) {
                table.ajax.reload();
                table.rows().deselect();
                Swal.fire({
                    title: '¡Exito!',
                    text: data,
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 1500
                });
                changeButton(form);
                $(form).trigger('reset');
                $('#{{$id}}CrudModal').modal('hide');

            },
            error: data =>  {
                changeButton(form)
                errorMessage(data);
                $(form).validate().showErrors(data.responseJSON);
            }
        });
    }

    function edit(form) {
        let uri = `{{ isset($crud['uri']) ? route("{$crud['uri']}.update", "##") : ''}}`;
        let firstRow = selectedRow[SELECTED_ROW];
        let url = _.replace(uri, '##', firstRow.id);
        $.ajax({
            type: 'PATCH',
            url,
            data: serializeData(form),
            cache: false,
            dataType: 'JSON',
            success: function ({ data, code}) {
                table.ajax.reload();
                table.rows().deselect();
                Swal.fire({
                    title: '¡Exito!',
                    text: data,
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 1500
                });
                changeButton(form);
                $(form).trigger('reset');
                $('#{{$id}}CrudModal').modal('hide');
            },
            error: data =>  {
                const arraykey = datatable.crud.fields;
                changeButton(form)
                errorMessage(data);
                $(form).validate().showErrors(data.responseJSON.errors);
            }
        });
    }

    function errorMessage (data) {
        Swal.fire({
            title: '¡Error!',
            text: 'Ha ocurrido un error inesperado',
            icon: 'error',
            showConfirmButton: false,
            timer: 3000
        });
    }

    function resetForm () {
        validator.reset();
        validator.resetForm();
        $('#{{$id}}CrudForm').trigger('reset');
        $('#{{$id}}CrudForm').find('select').prop('selectedIndex',0);
    }

    function changeButton (form) {
        $("#{{$id}}SubmitButton").prop("disabled", false);
        $("#{{$id}}SubmitButton").html(`
            <i class="fas fa-share-square"></i> {{ __('Enviar') }}
        `);
    }

    function serializeData (form) {
        let customSerialize =
            datatable &&
            datatable.crud &&
            datatable.crud.serializeData;

        if (customSerialize) {
            let serialize = datatable.crud.serializeData;
            return serialize(form);
        }

        let data = $(form).serializeArray();

        $("#{{$id}}CrudModal input:checkbox").each(function (key, value) {
            data.push({ name: value.name, value: value.checked ? '1' : '0' });
        });
        return data;
    }

</script>
