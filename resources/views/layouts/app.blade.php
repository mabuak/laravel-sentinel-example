<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <title>{{config('app.name')}}</title>
    <meta name="keywords" content="Sentinel Example Demo" />
    <meta name="description" content="Demo Page For Sentinel Example">
    <meta name="author" content="ramadhan">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{asset('adminLTE/plugins/bootstrap/dist/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('adminLTE/plugins/font-awesome/css/font-awesome.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset('adminLTE/plugins/Ionicons/css/ionicons.min.css')}}">
    <!-- App CSS -->
    <link rel="stylesheet" href="{{asset('css/custom.css')}}">


@stack('css')

    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('adminLTE/dist/css/AdminLTE.min.css')}}">

    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset('adminLTE/dist/css/skins/_all-skins.min.css')}}">
    <!-- Morris chart -->
    <link rel="stylesheet" href="{{asset('adminLTE/plugins/morris.js/morris.css')}}">
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{asset('adminLTE/plugins/jvectormap/jquery-jvectormap.css')}}">
    <!-- Date Picker -->
    <link rel="stylesheet" href="{{asset('adminLTE/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{asset('adminLTE/plugins/bootstrap-daterangepicker/daterangepicker.css')}}">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{{asset('adminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <!-- Ladda -->
    <link rel="stylesheet" type="text/css" href="{{asset('adminLTE/plugins/ladda/ladda.min.css')}}">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{asset('assets/img/favicon.ico')}}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <!-- jQuery 3 -->
    <script src="{{asset('adminLTE/plugins/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{asset('adminLTE/plugins/bootstrap/dist/js/bootstrap.min.js')}}"></script>

    <!-- Embed browser icon -->
    <link rel="icon" href="{!! asset('favicon.ico') !!}"/>

    <style type="text/css">
        .form-group {
            margin-bottom: 5px !important;
        }
    </style>
</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

@include('layouts.header')
@include('layouts.sidebar')

<!-- Start: Main -->
@yield('content')
<!-- End: Main -->

<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
    reserved.
</footer>

</div>

<!-- Remove Modal -->
<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close btn-sm" data-dismiss="modal" aria-hidden="true">x</button>
                <h4 class="modal-title custom_align text-danger" id="titles"><i class="fa fa-warning"></i> Attention</h4>
            </div>
            <form action="" method="post" id="remove-form">
                {!! csrf_field() !!}

                <input name="_method" type="hidden" id="method" value="DELETE">

                <div class="modal-body">
                    <div class="alert alert-micro alert-border-left alert-danger alert-dismissable">
                        <i class="fa fa-info" style="padding-right: 10px"></i>
                        <span id="message"></span>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-flat ladda-button btn-success btn-sm send-request" data-style="zoom-in">
                        <span class="ladda-label"><span class="fa fa-check"></span> Yes</span>
                        <span class="ladda-spinner"><div class="ladda-progress" style="width: 0px;"></div></span></button>
                    <button type="button" class="btn btn-flat btn-default btn-sm" data-dismiss="modal"><span class="fa fa-times"></span> No</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- Alert Modal -->
<div class="modal fade" id="alertModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="padding-top: 2%">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title text-danger" id="myModalLabel"><i class="fa fa-warning"></i> Attention</h4>
            </div>
            <div class="modal-body">
                <p id="modal-text"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-flat btn-danger btn-sm btn-flat pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    (function () {
        window.alert = function () {
            $("#alertModal #modal-text").text(arguments[0]);
            $("#alertModal").modal('show');
        };
    })();

    $('#delete').on('show.bs.modal', function (e) {
        var removedLinkFull = $(e.relatedTarget).data('href');
        var message         = $(e.relatedTarget).data('message');
        var title           = $(e.relatedTarget).data('title');
        var method          = $(e.relatedTarget).data('method');

        $('#title').text(title);
        $('#message').text(message);
        $('#method').val(method);

        $('#remove-form').attr('action', removedLinkFull);
    });

</script>

@stack('scripts')

<!-- Loading Button -->
<script src="{{asset('adminLTE/plugins/ladda/ladda.min.js')}}"></script>
<script>
    // Init Ladda Plugin on buttons
    Ladda.bind('.ladda-button', {
        timeout: 2000
    });

    // Bind progress buttons and simulate loading progress. Note: Button still requires ".ladda-button" class.
    Ladda.bind('.progress-button', {
        callback: function (instance) {

            $(function () {
                $('form select').select2({
                    theme            : "bootstrap",
                    placeholder      : "Select",
                    containerCssClass: ':all:',
                });
            });

            var progress = 0;
            var interval = setInterval(function () {
                progress = Math.min(progress + Math.random() * 0.1, 1);
                instance.setProgress(progress);

                if (progress === 1) {
                    instance.stop();
                    clearInterval(interval);
                }
            }, 200);
        }
    });
</script>

</body>

</html>
