<?php
/**
 * Created by PhpStorm.
 * User: QuanVH
 * Date: 02/11/2016
 * Time: 15:20 CH
 */
        ?>
        <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="{!! asset('plugin/bootstrap/css/bootstrap.min.css') !!}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{!! asset('plugin/font-awesome/css/font-awesome.min.css') !!}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{!! asset('plugin/_adminLTE/css/AdminLTE.min.css') !!}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{!! asset('plugin/iCheck/square/blue.css') !!}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="{!! route('admin.login') !!}"><b>Alium.vn</b> Đăng nhập</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Đăng nhập để bắt đầu sử dụng</p>

        <form action="" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            @if( Session::has('error_message'))
                <div class="validation-summary-errors text-danger">
                    <ul>
                        <li>{{ Session::get('error_message') }}</li>
                    </ul>
                </div>
            @endif
            @if (count($errors) > 0)
                <div class="validation-summary-errors text-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="form-group has-feedback">
                <input type="text" class="form-control" name="username" placeholder="Id">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" name="password" placeholder="Password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox"> Nhớ mật khẩu
                        </label>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Đăng nhập</button>
                </div>
                <!-- /.col -->
            </div>
        </form>

    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="{!! asset('plugin/jQuery/jquery-2.2.3.min.js') !!}"></script>
<!-- Bootstrap 3.3.6 -->
<script src="{!! asset('plugin/jQuery/jquery-2.2.3.min.js') !!}"></script>
<!-- iCheck -->
<script src="{!! asset('plugin/iCheck/icheck.min.js') !!}"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
</script>
</body>
</html>

