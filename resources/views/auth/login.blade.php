@extends('auth.layout')
@section('content')
    <div class="login-box">
        <div class="login-logo">
            <a href="{{route('login.form')}}"><b>Admin</b>LTE</a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">

            @include('flash')

            <p class="login-box-msg">Sign in to start your session</p>

            <form role="form" method="POST" id="contact" action="{{ route('login.action') }}">
                {{csrf_field()}}
                <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
                    <input type="email" name="email" class="form-control" placeholder="Email">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    {!! $errors->first('email', '<em for="username" class="help-block">:message</em>') !!}
                </div>
                <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
                    <input type="password" name="password" class="form-control" placeholder="Password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    {!! $errors->first('password', '<em for="password" class="help-block">:message</em>') !!}
                </div>
                <div class="row">
                    <div class="col-xs-8">
                        <div class="checkbox icheck">
                            <label>
                                <input type="checkbox" value="On" name="remember"> Remember Me
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <a href="{{route('forgotPassword.form')}}">I forgot my password</a><br>
            <a href="{{route('register.form')}}" class="text-center">Register a new membership</a>

        </div>
        <!-- /.login-box-body -->
    </div>
@stop
