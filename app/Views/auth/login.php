<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 2 | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?= base_url(); ?>/template/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url(); ?>/template/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?= base_url(); ?>/template/bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url(); ?>/template/dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?= base_url(); ?>/template/plugins/iCheck/square/blue.css">


    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href=""><b>Project</b>Root</a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">Sign in to start your session</p>
            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                    <?= session()->getFlashdata('pesan'); ?>
                </div>
            <?php endif ?>

            <?php if (session()->getFlashdata('success')) : ?>
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-check"></i> Alert!</h4>
                    <?= session()->getFlashdata('success'); ?>
                </div>
            <?php endif ?>

            <form action="<?= base_url('/login'); ?>" method="POST">
                <div class="form-group <?= (validation_show_error('email')) ? 'has-error' : 'has-feedback'; ?>">
                    <?= (validation_show_error('email')) ? '<label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> Email
                    </label>' : ''; ?>
                    <input type="email" id="inputError" name="email" class="form-control" placeholder="Email">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    <span class="help-block">
                        <?= validation_show_error('email'); ?>
                    </span>
                </div>
                <div class="form-group <?= (validation_show_error('password')) ? 'has-error' : 'has-feedback'; ?>">
                    <?= (validation_show_error('password')) ? '<label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> Password
                    </label>' : ''; ?>
                    <input type="password" id="inputError" name="password" class="form-control" placeholder="Password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    <span class="help-block">
                        <?= validation_show_error('password'); ?>
                    </span>
                </div>
                <div class="row">
                    <div class="col-xs-8">

                    </div>
                    <!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Login</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>



            <a href="/forgot">Lupa Password</a><br>
            <a href="/register" class="text-center">Daftar Akun Baru</a>

        </div>
        <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery 3 -->
    <script src="<?= base_url(); ?>/template/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="<?= base_url(); ?>/template/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="<?= base_url(); ?>/template/plugins/iCheck/icheck.min.js"></script>
    <script>
        $(function() {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' /* optional */
            });
        });
    </script>
</body>

</html>