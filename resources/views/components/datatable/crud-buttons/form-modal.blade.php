<div class="modal fade" id="{{$id}}CrudModal">
        <form id="{{$id}}CrudForm">
        @csrf
        <div class="modal-dialog modal-@isset($crud['modal']['size']){{$crud['modal']['size']}}@endisset">
            <div class="modal-content">
                <div class="modal-header bg-@isset($crud['modal']['bg']){{$crud['modal']['bg']}}@endisset">
                    <h5 class="modal-title" id="{{$id}}CrudModalTitle"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body p-1">
                        @isset($crud['crud_template'])
                            @include($crud['crud_template'])
                        @endisset
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-window-close"></i> {{ __('Cancelar') }}
                    </button>
                    <button type="submit" id="{{$id}}SubmitButton" class="btn btn-info">
                        <i class="fas fa-share-square"></i> {{ __('Enviar') }}
                    </button>
                </div>
            <!-- /.modal-content -->
            </div>
        <!-- /.modal-dialog -->
        </div>
    </form>
</div>
