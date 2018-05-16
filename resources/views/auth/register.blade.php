@extends('auth.layout')
@section('content')
    <div class="register-box">
        <div class="register-logo">
            <a href="{{route('login.form')}}"><b>Admin</b>LTE</a>
        </div>

        <div class="register-box-body">

            @include('flash')

            <p class="login-box-msg">Register a new membership</p>

            <form method="post" action="{{route('register.action')}}">
                {{csrf_field()}}

                <div class="form-group has-feedback {{ $errors->has('first_name') ? 'has-error' : '' }}">
                    <input type="text" name="first_name" class="form-control" placeholder="@lang('auth.form_user_fname_label')" value="{{old('first_name')}}">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    {!! $errors->first('first_name', '<em for="first_name" class="help-block">:message</em>') !!}
                </div>

                <div class="form-group has-feedback {{ $errors->has('last_name') ? 'has-error' : '' }}">
                    <input type="text" name="last_name" class="form-control" placeholder="@lang('auth.form_user_lname_label')" value="{{old('last_name')}}">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    {!! $errors->first('last_name', '<em for="last_name" class="help-block">:message</em>') !!}
                </div>

                <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
                    <input type="email" name="email" class="form-control" placeholder="@lang('auth.form_user_email_label')" value="{{old('email')}}">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    {!! $errors->first('email', '<em for="username" class="help-block">:message</em>') !!}
                </div>

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
                        <button type="submit" class="btn btn-primary btn-block btn-flat">@lang('auth.account_creation_register')</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
        </div>
        <!-- /.form-box -->
    </div>

@stop
