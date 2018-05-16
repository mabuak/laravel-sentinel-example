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
                            <h3 class="box-title">@lang('auth.index_users')</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <a href="{{route('users.create')}}" class="btn btn-flat btn-success btn-sm">@lang('auth.index_create_link')</a>
                            <hr>
                            <table class="table table-striped table-bordered table-hover table-condensed" id="users-table" width="100%">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>@lang('auth.index_fname_th')</th>
                                    <th>@lang('auth.index_lname_th')</th>
                                    <th>@lang('auth.index_email_th')</th>
                                    <th>@lang('auth.index_roles')</th>
                                    <th>@lang('auth.index_last_login')</th>
                                    <th>@lang('auth.index_status_th')</th>
                                    <th>@lang('auth.index_created_at')</th>
                                    <th>@lang('auth.index_updated_at')</th>
                                    <th>@lang('auth.index_action_th')</th>
                                </tr>
                                </thead>
                                <tbody></tbody>
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

            var table = $('#users-table').DataTable({
                aaSorting     : [[0, 'desc']],
                iDisplayLength: 25,
                stateSave     : true,
                responsive    : true,
                fixedHeader   : true,
                processing    : true,
                serverSide    : true,
                pagingType    : "full_numbers",
                ajax          : {
                    url     : '{!! route('users.ajax.data') !!}',
                    dataType: 'json'
                },
                columns       : [
                    {data: 'id', name: 'users.id', visible: false},
                    {
                        data: 'first_name', name: 'first_name'
                    },
                    {
                        data: 'last_name', name: 'last_name'
                    },
                    {data: 'email', name: 'email'},
                    {data: 'role', name: 'roles.name', defaultContent: ''},
                    {data: 'last_login', name: 'last_login'},
                    {
                        data: 'status', name: 'status', fnCreatedCell: function (nTd, sData, oData, iRow, iCol) {
                            //  console.log( nTd );
                            $("a", nTd).tooltip({container: 'body'});
                        }
                    },
                    {data: 'created_at', name: 'created_at', visible: false},
                    {data: 'updated_at', name: 'updated_at', visible: false},
                    {
                        data         : 'action', name: 'action', orderable: false, searchable: false,
                        fnCreatedCell: function (nTd, sData, oData, iRow, iCol) {
                            //  console.log( nTd );
                            $("a", nTd).tooltip({container: 'body'});
                        }
                    }
                ],
            });
        });
    </script>
@endpush
