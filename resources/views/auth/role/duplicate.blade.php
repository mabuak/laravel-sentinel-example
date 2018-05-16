@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            @include('flash')
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">@lang('auth.index_roles')</h3>
                </div>
                <!-- /.box-header -->

                <form action="{{route('roles.store')}}" method="post">
                    <div class="box-body">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <label for="name">@lang('global.name') <span style="color: red">*</span></label>
                            <input type="text" name="name" class="form-control input-sm" placeholder="@lang('global.name')" value="{{ old('name') }}">
                            {!! $errors->first('name', '<em for="name" class="help-block">:message</em>') !!}
                        </div>

                        <div class="tab-block mb25">
                            <ul class="nav tabs-left tabs-border">
                                <li role="presentation" class="active"><a href="#auth" aria-controls="auth" role="tab" data-toggle="tab">Access Control List</a></li>
                            </ul>
                            <div class="tab-content">
                                <!-- For Auth Form -->
                                <div role="tabpanel" class="tab-pane active" id="auth">
                                    @include('auth.role.acl-update')
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="box-footer">
                        <input type="hidden" value="{{old('previousUrl') ? old('previousUrl') : url()->previous()}}" name="previousUrl">
                        <a href="{{old('previousUrl') ? old('previousUrl') : url()->previous()}}" class="btn btn-flat btn-default btn-sm"><i class="fa fa-reply"></i> @lang('auth.form_user_cancel_btn')</a>

                        <div class="pull-right">
                            <button type="submit" class="btn ladda-button btn-success btn-sm" data-style="zoom-in">
                                <span class="ladda-label"><i class="fa fa-save"></i> @lang('auth.create_role_submit_btn')</span>
                                <span class="ladda-spinner"><div class="ladda-progress" style="width: 0px;"></div></span></button>
                        </div>

                        <div class="clearfix"></div>
                    </div>
                </form>
            </div>
        </section>
    </div>
@stop
