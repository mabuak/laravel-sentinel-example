@extends('auth.layout')
@section('content')
    <section id="content" class="pn">
        <div class="center-block mt50 mw800">
            <h1 class="error-title"> 404! </h1>
            <h2 class="error-subtitle">Page Not Found.</h2>
        </div>
        <div class="mid-section">
            <div class="mid-content clearfix">
                <input class="form-control" placeholder="Ask me a question!" value="Let Me Help You Search!" type="text">
                <div class="pull-left">
                    <img src="assets/img/logos/logo_grey.png" class="img-responsive mt20 w225" alt="logo">
                </div>
                <div class="pull-right mt20">
                    <a href="#" title="facebook link">
                        <i class="fa fa-facebook-square fs40 text-primary mr15"></i>
                    </a>
                    <a href="#" title="twitter link">
                        <i class="fa fa-twitter-square fs40 text-info mr15"></i>
                    </a>
                    <a href="#" title="google plus link">
                        <i class="fa fa-google-plus-square fs40 text-danger-light mr15"></i>
                    </a>
                    <a href="#" title="email link">
                        <i class="fa fa-envelope-square fs40 text-warning"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>
@show