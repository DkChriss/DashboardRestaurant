@push('components-css_stack')
    <style>
        td.details-control {
            background: url("/vendor/img/details_open.png") no-repeat center center;
            cursor: pointer;
            min-width: 30px;
        }
        tr.details td.details-control {
            background: url("/vendor/img/details_close.png") no-repeat center center;
            min-width: 30px;
        }
        table{
            line-height: 1.2;
            font-size: 14px;
        }
        table.dataTable tbody tr{
            background-color: #fdfdfd;
        }
        table.dataTable thead tr{
            background-color: #f2f2f2;
        }
        .pagination li>a .active {
            color: black;
            background-color: red;
        }

        div>p{
            font-size: 12px;
        }
        div>span{
            font-size: 13px;
            font-weight: bold;
            cursor: pointer;
            color:black;
        }
        .paginate_button:hover{
            color:#66b3ff;
        }
        .crud-buttons > .dt-buttons:nth-child(2) {
            padding-left: .5em;
        }

        table > tbody > tr.selected > td,
        table > tbody > tr.selected > th {
            background-color: #14A2B8;
            color: #ffffff
        }
        .custom-pagination label{
            font-size: 12px;
        }
        .dataTables_scrollBody::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
            background-color: #F5F5F5;
            border-radius: 10px;
            width: 100%;
        }

        .dataTables_scrollBody::-webkit-scrollbar {
            width: 5px;
            height: 5px;
            background-color: #F5F5F5;
        }

        .dataTables_scrollBody::-webkit-scrollbar-thumb {
            background-color: #777;
            border-radius: 10px;
        }
        .pageinate_input_box{
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
    </style>
@endpush
<div class="card">
    <div class="card-body table-responsive">
        <table id="{{$id}}" class="table table-sm table-bordered table-hover w-100">
            <thead>
            </thead>
            <tbody>
                {{-- Body --}}
            </tbody>
        </table>
    </div>
</div>
@push('components-js_stack')
    @include('components/datatable/crud-buttons/js-functions')
    @include($crud['config_file'])
    <script>
        var table;

        $(document).ready(function (){
            table = $('#{{$id}}').DataTable({
                processing: true,
                serverSide: true,
                ordering: true,
                lengthMenu: [[10, 25, 50, -1], [10, 25, 50, 'Todo']],
                buttons: generateButtons('{{ $id }}', crudConfig),
                select: datatable.select || 'single',
                dom:
                    "<'row'<'col-md-6 crud-buttons'B><'col-md-6'f>>" +
                    "<'row'<'col-sm-12 col-12't<'p-5'r>>>" +
                    "<'row custom-pagination'<'col-sm-12 col-md-2 mt-3'l><'col-sm-12 col-md-7 d-flex justify-content-center'i><'col-sm-12 col-md-3 mt-3'p>>",
                language: {
                    sProcessing: `Procesando... <br>
                        <img src=\"{{ asset('dataTable/img/loading_bar.gif') }}\" alt='animated' />`,
                    url: "{{asset('dataTable/lang/es.json')}}"
                },
                ajax: "{{ route($route) }}",
                columns: @json($columns),
                order: @json($order),
                drawCallback: function () {
                    $('#{{$id}}_paginate ul.pagination').addClass("pagination-sm");
                    $('.dataTables_scrollBody').css('min-height','63vh');
                },
                initComplete: function(settings, json) {
                    $('input[type=search]').attr('placeholder', 'Buscar...')
                    $('.dataTables_scrollBody').addClass('bg-light');
                    table.buttons(0, null).container().appendTo(`#{{ $id }}_wrapper .crud-buttons`);
                    var parentNode = document.getElementById('{{$id}}_processing').parentNode;
                    parentNode.classList.remove("p-5");
                    $('#{{$id}}').DataTable()
                    .columns.adjust()
                    .responsive.recalc();
                }
            });
            new $.fn.dataTable.Buttons( table, {
                buttons: generateButtons('{{ $id }}', datatable)
            });
        })
    </script>
    @include('components/datatable/crud-buttons/select-event')
    @include('components/datatable/crud-buttons/config')
    @include('components/datatable/crud-buttons/form-modal')
@endpush
