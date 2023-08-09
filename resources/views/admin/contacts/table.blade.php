@section('third_party_stylesheets')
    @include('admin.layouts.datatables_css')

    <style>
        #dataTableBuilder_length{float: left;}
        #dataTableBuilder_filter{float: right;}
    </style>
@endsection

{!! $dataTable->table(['width' => '100%', 'class' => 'table table-striped table-bordered']) !!}

@push('third_party_scripts')
    @include('admin.layouts.datatables_js')
    {!! $dataTable->scripts() !!}
@endpush




@push('page_css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{!! asset('/adminlte/plugins/datatables/css/dataTables.bootstrap4.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('/adminlte/plugins/datatables/css/responsive.bootstrap4.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('/adminlte/plugins/datatables/css/buttons.bootstrap4.min.css') !!}">
@endpush

@push('page_scripts')
    <!-- DataTables  & Plugins -->
    <script src="{!! asset('/adminlte/plugins/datatables/js/jquery.dataTables.min.js') !!}"></script>
    <script src="{!! asset('/adminlte/plugins/datatables/js/dataTables.bootstrap4.min.js') !!}"></script>
    <script src="{!! asset('/adminlte/plugins/datatables/js/dataTables.responsive.min.js') !!}"></script>
    <script src="{!! asset('/adminlte/plugins/datatables/js/responsive.bootstrap4.min.js') !!}"></script>
    <script src="{!! asset('/adminlte/plugins/datatables/js/dataTables.buttons.min.js') !!}"></script>
    <script src="{!! asset('/adminlte/plugins/datatables/js/buttons.bootstrap4.min.js') !!}"></script>
    <script src="{!! asset('/adminlte/plugins/datatables/js/jszip_jszip.min.js') !!}"></script>
    <script src="{!! asset('/adminlte/plugins/datatables/js/pdfmake.min.js') !!}"></script>
    <script src="{!! asset('/adminlte/plugins/datatables/js/vfs_fonts.js') !!}"></script>
    <script src="{!! asset('/adminlte/plugins/datatables/js/buttons.html5.min.js') !!}"></script>
    <script src="{!! asset('/adminlte/plugins/datatables/js/buttons.print.min.js') !!}"></script>
    <script src="{!! asset('/adminlte/plugins/datatables/js/buttons.colVis.min.js') !!}"></script>
@endpush

