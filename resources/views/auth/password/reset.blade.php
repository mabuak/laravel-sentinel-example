@extends('auth.layout')
@section('content')
    <div class="register-box">
        <div class="register-logo">
            <a href="{{route('login.form')}}"><b>Admin</b>LTE</a>
        </div>

        <div class="register-box-body">

            @include('flash')

            <p class="login-box-msg">@lang('auth.reset_password_heading')</p>

            <form method="POST" action="{{ route('resetPassword.action', [request('userId'), request('code')]) }}">
                {{ csrf_field() }}

                <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
                    <input type="password" name="password" class="form-control" placeholder="@lang('auth.form_user_password_label')">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    {!! $errors->first('password', '<em for="password" class="help-block">:message</em>') !!}
                </div>

                <div class="form-group has-feedback {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                    <input type="password" name="password_confirmation" class="form-control" placeholder="@lang('auth.form_user_password_confirm_label')">
                    <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                    {!! $errors->first('password_confirmation', '<em for="password_confirmation" class="help-block">:message</em>') !!}
                </div>

                <div class="row">
                    <div class="col-xs-8">&nbsp;</div>
                    <!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">@lang('auth.reset_password_submit_btn')</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
        </div>
        <!-- /.form-box -->
    </div>
@stop