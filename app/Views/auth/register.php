<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 2 | Registration Page</title>
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

<body class="hold-transition register-page">
    <div class="register-box">
        <div class="register-logo">
            <a href="../../index2.html"><b>Admin</b>LTE</a>
        </div>

        <div class="register-box-body">
            <p class="login-box-msg">Register a new membership</p>

            <?php if (session()->getFlashdata('error')) : ?>
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                    <?= session()->getFlashdata('error'); ?>
                </div>
            <?php endif ?>

            <?php if (session()->getFlashdata('success')) : ?>
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-check"></i> Alert!</h4>
                    <?= session()->getFlashdata('success'); ?>
                </div>
            <?php endif ?>

            <form action="<?= base_url('/register'); ?>" method="POST" enctype="multipart/form-data">
                <div class="form-group <?= (validation_show_error('email')) ? 'has-error' : 'has-feedback'; ?>">
                    <?= (validation_show_error('email')) ? '<label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> Email
                    </label>' : ''; ?>
                    <input type="email" name="email" value="<?= old('email'); ?>" class="form-control" placeholder="Email">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    <span class="help-block">
                        <?= validation_show_error('email'); ?>
                    </span>
                </div>
                <div class="form-group <?= (validation_show_error('name')) ? 'has-error' : 'has-feedback'; ?>">
                    <?= (validation_show_error('name')) ? '<label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> Name
                    </label>' : ''; ?>
                    <input type="text" name="name" value="<?= old('name'); ?>" class="form-control" placeholder="Nama Lengkap">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    <span class="help-block">
                        <?= validation_show_error('name'); ?>
                    </span>
                </div>

                <div class="form-group <?= (validation_show_error('password')) ? 'has-error' : 'has-feedback'; ?>">
                    <?= (validation_show_error('password')) ? '<label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> Password
                    </label>' : ''; ?>
                    <input type="password" name="password" class="form-control" placeholder="Password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    <span class="help-block">
                        <?= validation_show_error('password'); ?>
                    </span>
                </div>

                <div class="form-group <?= (validation_show_error('retype_password')) ? 'has-error' : 'has-feedback'; ?>">
                    <?= (validation_show_error('retype_password')) ? '<label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> Retype Password
                    </label>' : ''; ?>
                    <input type="password" name="retype_password" class="form-control" placeholder="Ulangi password">
                    <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                    <span class="help-block">
                        <?= validation_show_error('retype_password'); ?>
                    </span>
                </div>

                <div class="form-group <?= (validation_show_error('profile_image')) ? 'has-error' : 'has-feedback'; ?>">
                    <?= (validation_show_error('profile_image')) ? '<label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> Profile Image
                    </label>' : '<label class="control-label" for="profile_image"></label>'; ?>
                    <div class="col-md-4">
                        <img src="/img/default.png" class="img-thumbnail img-preview">
                    </div>
                    <input type="file" name="profile_image" id="profile_image" class="form-control" placeholder="Foto Profil" onchange="previewImg()">
                    <span class="glyphicon glyphicon-picture form-control-feedback"></span>
                    <span class="help-block">
                        <?= validation_show_error('profile_image'); ?>
                    </span>
                </div>

                <div class="row">
                    <div class="col-xs-8">
                        Sudah Punya Akun <br><a href="/" class="text-center"> Saya ingin login</a>
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>



        </div>
        <!-- /.form-box -->
    </div>
    <!-- /.register-box -->

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
    <script>
        function previewImg() {
            const profile_image = document.querySelector('#profile_image');
            const imageLabel = document.querySelector('.control-label');
            const imgPreview = document.querySelector('.img-preview');

            imageLabel.textContent = profile_image.files[0].name;

            const fileSampul = new FileReader();
            fileSampul.readAsDataURL(profile_image.files[0]);

            fileSampul.onload = function(e) {
                imgPreview.src = e.target.result;
            }
        }
    </script>
</body>

</html>