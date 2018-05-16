@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    @include('flash')
                </div>

                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">@lang('auth.index_roles')</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <a href="{{route('roles.create')}}"
                               class="btn btn-flat btn-success btn-sm">@lang('auth.index_create_link')</a>
                            <hr>
                            <table class="table table-striped table-bordered table-hover table-condensed"
                                   id="users-table" width="100%">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>@lang('auth.index_name_th')</th>
                                    <th>@lang('auth.index_slug_th')</th>
                                    <th>@lang('auth.index_created_at')</th>
                                    <th>@lang('auth.index_updated_at')</th>
                                    <th>@lang('auth.index_action_th')</th>
                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
@stop

@push('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('adminLTE/plugins/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
@endpush

@push('scripts')
<!-- DataTables -->
<script src="{{asset('adminLTE/plugins/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('adminLTE/plugins/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>

<script>
    $(function () {
        $('#users-table').DataTable({
            aaSorting: [[0, 'desc']],
            iDisplayLength: 25,
            stateSave: true,
            responsive: true,
            processing: true,
            serverSide: true,
            pagingType: "full_numbers",
            ajax: {
                url: '{!! route('roles.ajax.data') !!}',
                dataType: 'json'
            },
            columns: [
                {data: 'id', name: 'id', visible: false},
                {data: 'name', name: 'name'},
                {data: 'slug', name: 'slug'},
                {data: 'created_at', name: 'created_at'},
                {data: 'updated_at', name: 'updated_at'},
                {
                    data: 'action', name: 'action', orderable: false, searchable: false,
                    "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                        //  console.log( nTd );
                        $("a", nTd).tooltip({container: 'body'});
                    }
                }
            ]
        });
    });
</script>
@endpush
