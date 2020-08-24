<script>
    $(document).ready(function () {
        $('#{{ $id }}').DataTable().on( 'deselect', function ( e, dt, type, indexes ) {
            if ( type === 'row' ) {
                if (dt.rows( { selected: true } ).data().count() === 0) {
                    $("#editBtn-{{ $id }}").attr('disabled', true);
                    $("#deleteBtn-{{ $id }}").attr('disabled', true);
                    selectedRow = null;
                }

                if (dt.rows( { selected: true } ).data().count() === 1) {
                    $("#editBtn-{{ $id }}").attr('disabled', false);
                }
                if(datatable.selectActions){
                    datatable.selectActions.onDeselect();
                }
            }
        });

        $('#{{ $id }}').DataTable().on( 'select', function ( e, dt, type, indexes ) {
            if ( type === 'row' ) {
                if (dt.rows( { selected: true } ).data().count() === 1) {
                    $("#editBtn-{{ $id }}").attr('disabled', false);
                } else {
                    $("#editBtn-{{ $id }}").attr('disabled', true);
                }

                if (dt.rows( { selected: true } ).data().count() > 0) {
                    $("#deleteBtn-{{ $id }}").attr('disabled', false);
                    selectedRow = dt.rows( { selected: true } ).data();
                }
                if(datatable.selectActions){
                    datatable.selectActions.onSelect();
                }
            }
        });

        $('#{{ $id }}').DataTable().on( 'order.dt',  function () {
            $("#editBtn-{{ $id }}").attr('disabled', true);
            $("#deleteBtn-{{ $id }}").attr('disabled', true);
        });

        $('#{{ $id }}').DataTable().on('page', function () {
            $("#editBtn-{{ $id }}").attr('disabled', true);
            $("#deleteBtn-{{ $id }}").attr('disabled', true);
        } );
    });
</script>
