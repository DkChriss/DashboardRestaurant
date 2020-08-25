<div class="modal fade" id="userPermisoCrudModal">
    <form id="userPermisoCrudForm">
        @csrf
        <div class="modal-dialog modal-xl">
            <div class="modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header bg">
                        <h5 class="modal-title" id="userPermisoCrudModalTitle"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card-body p-1">
                            <div class="form-group">
                                <div class="row">
                                    @php
                                     $permissionsType = get_permissionsType();
                                    @endphp
                                    @foreach ($permissionsType as $permissionType)
                                        <div class="card m-2">
                                            <div class="card-header">
                                                <h3 class="card-title float-none text-center font-weight-bold">
                                                    {{ucfirst($permissionType->type)}}
                                                </h3>
                                            </div>
                                            <div class="card-body">
                                                @php
                                                    $permissions = get_permissions()
                                                        ->where('type', $permissionType->type);
                                                @endphp
                                                @foreach ($permissions as $permission)
                                                    <div class="checkbox icheck-success p-2 m-2">
                                                        {{
                                                            Form::checkbox(
                                                                'permission_id[]',
                                                                $permission->name,
                                                                false,
                                                                ['id'=>$permission->name,'class'=>'form-check-input'])
                                                        }}
                                                        {{
                                                           Form::label(
                                                              $permission->name,
                                                              $permission->name,
                                                              ['class'=>'form-check-label'])
                                                        }}
                                                    </div>
                                                @endforeach
                                            </div>
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
                        <button type="button" id="userPermisoSubmitButton" class="btn btn-info">
                            <i class="fas fa-share-square"></i> {{ __('Asignar') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
