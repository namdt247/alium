<?php
/**
 * Created by PhpStorm.
 * User: QuanVH
 * Date: 08/12/2016
 * Time: 11:16 SA
 */
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="/plugin/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/plugin/font-awesome/css/font-awesome.min.css">
    <!-- bootstrap datatable -->
    <link rel="stylesheet" href="/plugin/datatables/dataTables.bootstrap.css">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="/plugin/datepicker/datepicker3.css">
    <link rel="stylesheet" href="/plugin/daterangepicker/daterangepicker.css">

    <link rel="stylesheet" href="/plugin/select2/select2.min.css">
    <link rel="stylesheet" href="/plugin/bootstrap-toggle/css/bootstrap-toggle.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/plugin/_adminLTE/css/AdminLTE.min.css">

    <link rel="stylesheet" href="/plugin/dropzone/basic.css">
    <link rel="stylesheet" href="/plugin/dropzone/dropzone.css">
    <link rel="stylesheet" href="/plugin/iCheck/all.css">
    <link rel="stylesheet" href="/css/admin/admin.css">

    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{!! asset('plugin/_adminLTE/css/skins/_all-skins.min.css') !!}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="{{ asset('plugin/ckeditor/ckeditor.js') }}"></script>
    {{--<script src="{{ asset('plugin/ckfinder/ckfinder.js') }}"></script>--}}

    <script>
        var baseURL = "{!! url('/') !!}";
    </script>
    <script src="{{ asset('plugin/func_ckfinder.js') }}"></script>
</head>
<body class="hold-transition skin-blue-light sidebar-mini">
<div class="wrapper">
    <style>
        .checked {
            color: orange;
        }
    </style>
    @include('admin.include.header')

    @include('admin.include.main_sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        @if (count($errors) > 0)
            <div class="box-body">
                <div class="box box-danger box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">Lỗi</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="remove">
                                <i class="fa fa-times"></i>
                            </button>
                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        @endif

        <!-- Flash message -->
        @if( \Illuminate\Support\Facades\Session::has('success_message'))
            <div class="box-body">
                <div class="box box-success box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">Thành công</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="remove">
                                <i class="fa fa-times"></i></button>
                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        {{ \Illuminate\Support\Facades\Session::get('success_message') }}
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        @endif

        @if( \Illuminate\Support\Facades\Session::has('error_message'))
            <div class="box-body">
                <div class="box box-danger box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">Lỗi</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="remove">
                                <i class="fa fa-times"></i></button>
                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        {{ \Illuminate\Support\Facades\Session::get('error_message') }}
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        @endif
        {{--<!-- end flash message -->--}}

        <section class="content-header clearfix">
            @yield('main-header')
        </section>

        <!-- Main content -->
        <section class="content">
            @yield('main-content')
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    @include('admin.include.footer')

</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="/plugin/jQuery/jquery-2.2.3.min.js" type="text/javascript"></script>
<!-- jQuery UI 1.11.4 -->
<script src="/plugin/jQueryUI/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.6 -->
<script src="/plugin/bootstrap/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="/plugin/datatables/jquery.dataTables.min.js"></script>
<script src="/plugin/datatables/dataTables.bootstrap.min.js"></script>
<!-- bootstrap datepicker -->
<script src="/plugin/datepicker/bootstrap-datepicker.js"></script>

<script src="/plugin/daterangepicker/moment.min.js"></script>
<script src="/plugin/daterangepicker/daterangepicker.js"></script>
<script src="/plugin/validate/jquery.validate.js"></script>
<script src="/plugin/select2/select2.full.min.js"></script>
<script src="/plugin/input-mask/jquery.inputmask.bundle.js"></script>
<script src="/plugin/bootstrap-toggle/js/bootstrap-toggle.min.js"></script>
<script src="/plugin/dropzone/dropzone.js"></script>
<script src="/plugin/iCheck/icheck.min.js"></script>

<!-- AdminLTE App -->
<script src="{!! asset('plugin/_adminLTE/js/app.min.js') !!}"></script>

<!-- Main admin js -->
<script src="{!! asset('js/admin/admin.js?v=0.2') !!}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        var url = window.location;
        $('.sidebar-menu a').filter(function() {
            return this.href == url;
        }).parent().addClass('active').parent().parent().addClass('active');

    });
</script>

@yield('main-script')

</body>
</html>

