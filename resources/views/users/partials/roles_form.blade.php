<div class="modal fade" id="userRolCrudModal">
    <form id="userRolCrudForm">
        @csrf
        <div class="modal-dialog modal-lg">
            <div class="modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header bg">
                        <h5 class="modal-title" id="userRolCrudModalTitle"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card-body p-1">
                            <div class="form-row">
                                <div class="form-group col">
                                    @php
                                    $roles = get_roles();
                                    @endphp
                                    @foreach ($roles as $role)
                                    <div class="checkbox icheck-success icheck-inline p-2 m-2">
                                        {{
                                            Form::checkbox(
                                                'role_id[]',
                                                $role->name,
                                                false,
                                                ['id' => $role->name, 'class' => 'form-check-input'])
                                        }}
                                        {{
                                            Form::label(
                                               $role->name,
                                               $role->name,
                                               ['class'=>'form-check-label'])
                                         }}
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            <i class="fas fa-window-close"></i> {{ __('Cancelar') }}
                        </button>
                        <button type="button" id="userRolSubmitButton" class="btn btn-info">
                            <i class="fas fa-share-square"></i> {{ __('Asignar') }}
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </form>
</div>
