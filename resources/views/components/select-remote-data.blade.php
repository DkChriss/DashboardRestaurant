@push('components-css_stack')
<style>
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        margin-top: -9px;
    }
    .select2-results__option.loading-results,
    .select2-results__option.select2-results__option--load-more {
        background-image: url('{{ asset("images/loading.gif")}}');
        background-repeat: no-repeat;
        padding-left: 15px;
        background-position: 50% 50%;
    }
    .select2-selection__choice {
        background-color: #6c757d !important;
        border-color: #aab2bb !important;
        color: #fff !important;
    }
    .select2-selection__choice__remove {
        color: #fff !important;
    }
</style>
@endpush
<br>
<select class="form-control select2" name="{{$name}}" id="{{$id}}" style="width: 100%">
</select>
@push('components-js_stack')
@include($configFile)
    <script>
        $(document).ready(function () {
            let config = {{$configVarName}} || {};
            let multiple = config && config.multiple;
            
            if(multiple) {
                $("#{{$id}}").attr('multiple','multiple');
            }
            $("#{{$id}}").select2({
                language: "es",
                ajax: {
                    url: "{{ route($route) }}",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        let requestParams = {
                            queryFilter: params.term,
                            page: params.page
                        };

                        if (config && config.extraParams) {
                            _.assign(requestParams, config.extraParams);
                        }

                        return requestParams;
                    },
                    processResults: function ({ data }, params) {
                        params.page = params.page || 1;
                        let hasFields = config.fields &&
                            config.fields.id &&
                            config.fields.text;

                        let result;

                        if (config.fields && config.fields.textExtra) {
                            result = data.map(current => {
                                return {
                                    id: current[config.fields.id],
                                    text: current[config.fields.textExtra]+" - "+current[config.fields.text]
                                }
                            });
                        } else if (hasFields) {
                            result = data.map(current => {
                                return {
                                    id: current[config.fields.id],
                                    text: current[config.fields.text]
                                }
                            });
                        }

                        return {
                            results: result || data,
                            pagination: {
                                more: (params.page * 30) < data.total_count
                            }
                        };
                    },
                    cache: true
                },
                allowClear: true,
                placeholder: config.placeholder || 'Buscar elemento',
                minimumInputLength: config.minimumInputLength || 2,
                templateResult: config.formatSelectOptions,
                templateSelection: config.formatSelection
            });
        });
    </script>
@endpush
