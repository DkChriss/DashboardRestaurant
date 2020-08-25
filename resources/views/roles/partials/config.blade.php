<script>
    const asignPermissionFn = (evt, rows, dt) => {
        let uri = `{{route("role-permission.show", "##")}}`;
        let firstRow = selectedRow[SELECTED_ROW];
        let url = _.replace(uri, '##', firstRow.id);
        $('#rolPermisoCrudForm').trigger('reset');
        $.ajax({
            type: 'GET',
            url,
            dataType: "JSON",
            success: function ({ data, code}) {
                _.forEach(data, function (value) {
                    var nombre = "#" + value.name;
                    $(nombre).prop('checked', true);
                });
                $('#rolPermisoCrudModalTitle').html("Asignar Permisos");
                $('#rolPermisoCrudModal').modal('show');
            },
            error: data =>  {
                console.log(data);
            }
        });
    }
    const activacion = () => {
        $("#asignPermissionBtn-{{ $id }}").attr('disabled', false);
    }
    const desactivacion = () => {
        $("#asignPermissionBtn-{{ $id }}").attr('disabled', true);
    }
    const datatable = {
        buttons: [{
            type : "asignPermission",
            text: 'Asignar Permisos',
            icon: 'fas fa-plus-square',
            className: 'btn btn-info btn-sm',
            action: asignPermissionFn,
            attr:  {
                title: 'Asignar Permisos Al Rol Seleccionado',
                id: 'asignPermissionBtn',
                disabled: true
            },
            hasPermission: @json(auth()->user()->can('show-role-permission'))
        }],
        selectActions : {
            onSelect: activacion,
            onDeselect: desactivacion,
        },
        crud: {
            buttons: ['delete', 'edit', 'create'],
            fields: {
                name: {
                    type: 'input' // 'textarea', 'checkbox'
                },
            },
            validator: {
                rules: {
                    name: {
                        required: true,
                    },
                },
                messages:{
                    name: {
                        required: "Ingrese el nombre del Rol",
                    },
                },
            }
        },
        select: {
            info: false,
            style: 'single',
        },
    }
    $(document).ready(function () {
        $('#rolPermisoSubmitButton').click(function (e) {
            let uri = `{{route("role-permission.update", "##")}}`;
            let firstRow = selectedRow[SELECTED_ROW];
            let url = _.replace(uri, '##', firstRow.id);
            $(this).html('Enviando...');
            $.ajax({
                type: 'PATCH',
                url,
                data: $('#rolPermisoCrudForm').serialize(),
                dataType: "JSON",
                success: function ({ data, code}) {
                     Swal.fire({
                         title: '¡Exito!',
                         text: data,
                         icon: 'success',
                          showConfirmButton: false,
                          timer: 1500
                    });
                     $('#rolPermisoSubmitButton').html(`<i class="fas fa-share-square"></i> {{ __('Asignar') }}`);
                     $('#rolPermisoCrudForm').trigger('reset');
                     $('#rolPermisoCrudModal').modal('hide');
                },
                error: data =>  {
                    $('#rolPermisoSubmitButton').html(`<i class="fas fa-share-square"></i> {{ __('Asignar') }}`);
                    errorMessage(data);
                    $("#rolPermisoCrudForm").validate().showErrors(data.responseJSON);
                }
            });
        });
    });
</script>
@include('roles/partials/permission_form')
