@extends('auth.layout')
@section('content')
    <div class="register-box">
        <div class="register-logo">
            <a href="{{route('login.form')}}"><b>Admin</b>LTE</a>
        </div>

        <div class="register-box-body">
            @include('flash')

            <p class="login-box-msg">@lang('auth.forgot_password_subheading')</p>

            <form method="POST" action="{{ route('forgotPassword.action') }}">
                {{ csrf_field() }}
                <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
                    <input type="email" name="email" class="form-control" placeholder="@lang('auth.form_user_email_label')">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    {!! $errors->first('email', '<em for="email" class="help-block">:message</em>') !!}
                </div>
                <div class="row">
                    <div class="col-xs-8">&nbsp;</div>
                    <!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">@lang('auth.forgot_password_submit_btn')</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
        </div>
        <!-- /.form-box -->
    </div>
@stop

