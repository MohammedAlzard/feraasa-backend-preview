<table id="example1" class="table table-striped table-bordered" style="width:100%">
    <thead>
    <tr>
        <th>#ID</th>
        <th>@lang('admin.Image')</th>
        <th>@lang('admin.Name')</th>
        <th>@lang('admin.Job')</th>
        <th>@lang('admin.Order_By')</th>
        <th>@lang('admin.Created_At')</th>
        <th>@lang('admin.Action')</th>
    </tr>
    </thead>
    <tbody>
    @foreach($testimonials as $index=>$testimonial)
        <tr>
            <td>{{ $index+1 }}</td>
            <td><img src="{!! url($testimonial->image) !!}" width="80px" alt="Loading Image"></td>
            <td>{{ $testimonial->name }}</td>
            <td>{{ $testimonial->job }}</td>
            <td>{{ $testimonial->order_by }}</td>
            <td>{!! $testimonial->created_at->toDayDateTimeString() !!}</td>
            <td>
                {!! Form::open(['route' => ['Admin::testimonials.destroy', $testimonial->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{{ route('Admin::testimonials.show', [$testimonial->id]) }}" class='btn btn-default btn-xs'>
                        <i class="far fa-eye"></i>
                    </a>
                    <a href="{{ route('Admin::testimonials.edit', [$testimonial->id]) }}" class='btn btn-default btn-xs'>
                        <i class="far fa-edit"></i>
                    </a>
                    {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('".trans('dashboard.Are_you_sure')."')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <th>#ID</th>
        <th>@lang('admin.Image')</th>
        <th>@lang('admin.Name')</th>
        <th>@lang('admin.Job')</th>
        <th>@lang('admin.Order_By')</th>
        <th>@lang('admin.Created_At')</th>
        <th>@lang('admin.Action')</th>
    </tr>
    </tfoot>
</table>


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
    <script>
        $(function () {
            $("#example1").DataTable({
                // "paging": true,
                // "searching": false,
                "ordering": true,
                // "info": true,
                "responsive": true, "lengthChange": true, "autoWidth": false,
                // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
    </script>
@endpush
