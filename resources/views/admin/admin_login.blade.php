<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>管理后台 | 登录</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">l
    <!-- Bootstrap 3.3.6 -->

    <link rel="stylesheet" href="{{ asset("AdminLTE/bootstrap/css/bootstrap.min.css") }}">
    <!-- Font Awesome -->

    <link rel="stylesheet" href="{{ asset("AdminLTE/plugins/font-awesome-4.7.0/css/font-awesome.min.css") }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset("AdminLTE/plugins/ionicons-2.0.1/css/ionicons.min.css") }}">


    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset("AdminLTE/dist/css/AdminLTE.min.css") }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset("AdminLTE/plugins/iCheck/square/blue.css") }}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	<style>
	.icheck{
		-webkit-user-select:none; -moz-user-select:none; -ms-user-select:none; user-select:none;
		/* 修复双击选中文字*/
	}
	</style> 
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="#"><b>管理后台</b>登录</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <!-- <p class="login-box-msg">Sign in to start your session</p> -->

        <form action="{{ url('/admin/login') }}" method="post">
            {!! csrf_field() !!}
            <div class="form-group has-feedback">
                <input type="text" name="name" class="form-control" placeholder="用户名">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" name="password" class="form-control" placeholder="密码">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="form-group">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul style=";">
                            @foreach ($errors->all() as $error)
                                {{ $error }}
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
                <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox" name="remember">{{ trans('auth.rememberme') }}
                        </label>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">登录</button>
                </div>
                <!-- /.col -->
            </div>
        </form>

<!--
        <div class="social-auth-links text-center">
            <p>- OR -</p>
            <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
                Facebook</a>
            <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
                Google+</a>
        </div>
        <!-- /.social-auth-links - ->

        <a href="#">I forgot my password</a><br>
        <a href="register.html" class="text-center">Register a new membership</a>
-->
    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="{{ asset("AdminLTE/plugins/jQuery/jquery-2.2.3.min.js") }}"></script>
<!-- Bootstrap 3.3.6 -->
<script src="{{ asset("AdminLTE/bootstrap/js/bootstrap.min.js") }}"></script>
<!-- iCheck -->
<script src="{{ asset("AdminLTE/plugins/iCheck/icheck.min.js") }}"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
           // increaseArea: '50%' // optional
        });
    });
</script>
</body>
</html>
