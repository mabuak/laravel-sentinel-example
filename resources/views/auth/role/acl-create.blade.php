<div class="checkbox checkbox-success">
    <input type="checkbox" name="acl_all" value="ok" class="styled acl" id="acl-all"
            style="margin-left: 0;" {{ old('acl_all') ? 'checked' : ''}}>
    <label for="acl-all">Checked All</label>
</div>

<table class="table table-bordered table-hover table-striped table-condensed" id="acl-table" cellspacing="0"
        width="100%">
    <thead>
    <tr>
        <th class="text-center" style="vertical-align: middle">@lang('global.module_name')</th>
        <th class="text-center" width="80">@lang('global.create')</th>
        <th class="text-center" width="80">@lang('global.update')</th>
        <th class="text-center" width="80">@lang('global.view')</th>
        <th class="text-center" width="80" style="color: red">@lang('global.delete')</th>
        <th class="text-center">@lang('global.miscellaneous')</th>
    </tr>
    </thead>

    <tbody>

    <!-- User -->
    <tr>
        <td>{{str_plural(trans('auth.form_user_heading'))}}</td>
        <td class="text-center">
            <div class="checkbox checkbox-success">
                <input type="checkbox" value="ok" class="styled acl"
                        name="user_create" {{ old('user_create') ? 'checked' : ''}}>
                <label></label>
            </div>
        </td>
        <td class="text-center">
            <div class="checkbox checkbox-success">
                <input type="checkbox" value="ok" class="styled acl"
                        name="user_edit" {{ old('user_edit') ? 'checked' : ''}}>
                <label></label>
            </div>
        </td>
        <td class="text-center">
            <div class="checkbox checkbox-success">
                <input type="checkbox" value="ok" class="styled acl"
                        name="user_show" {{ old('user_show') ? 'checked' : ''}}>
                <label></label>
            </div>
        </td>
        <td class="text-center">
            <div class="checkbox checkbox-success">
                <input type="checkbox" value="ok" class="styled acl"
                        name="user_destroy" {{ old('user_destroy') ? 'checked' : ''}}>
                <label></label>
            </div>
        </td>
        <td>
            <div class="checkbox checkbox-success">
                <input type="checkbox" value="ok" id="user_status" class="styled acl"
                        name="user_status" {{ old('user_status') ? 'checked' : ''}}>
                <label for="user_status">@lang('auth.index_status_th')</label>
            </div>
        </td>
    </tr>

    <!-- Roles -->
    <tr>
        <td>{{trans('auth.index_roles')}}</td>
        <td class="text-center">
            <div class="checkbox checkbox-success">
                <input type="checkbox" value="ok" class="styled acl"
                        name="role_create" {{ old('role_create') ? 'checked' : ''}}>
                <label></label>
            </div>
        </td>
        <td class="text-center">
            <div class="checkbox checkbox-success">
                <input type="checkbox" value="ok" class="styled acl"
                        name="role_edit" {{ old('role_edit') ? 'checked' : ''}}>
                <label></label>
            </div>
        </td>
        <td class="text-center">
            <div class="checkbox checkbox-success">
                <input type="checkbox" value="ok" class="styled acl"
                        name="role_show" {{ old('role_show') ? 'checked' : ''}}>
                <label></label>
            </div>
        </td>
        <td class="text-center">
            <div class="checkbox checkbox-success">
                <input type="checkbox" value="ok" class="styled acl"
                        name="role_destroy" {{ old('role_destroy') ? 'checked' : ''}}>
                <label></label>
            </div>
        </td>
        <td>&nbsp;</td>
    </tr>

    </tbody>
</table>

<!-- DataTables -->
<link rel="stylesheet" href="{{asset('adminLTE/plugins/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
<script src="{{asset('adminLTE/plugins/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('adminLTE/plugins/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>

<script>
    $(function () {
        var oTable = $('#acl-table').DataTable({
            aaSorting: [[0, 'asc']],
            stateSave: true,
            bPaginate: false,
            bInfo: false,
            responsive: true,
            processing: true,
            bFilter: false,
            fixedHeader: true,
            columns: [
                {orderable: true, searchable: true},
                {orderable: false, searchable: false},
                {orderable: false, searchable: false},
                {orderable: false, searchable: false},
                {orderable: false, searchable: false},
                {orderable: false, searchable: false},
            ]

        });
    });

    $('#acl-all').on('click', function () {
        var all = $('#acl-all');
        if (all.is(":checked")) {
            $('.acl').prop('checked', true);
        } else {
            $('.acl').prop('checked', false);
        }
    });
</script>