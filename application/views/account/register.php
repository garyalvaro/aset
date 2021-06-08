<!-- START HEADER  -->

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>Fasilkom-TI USU</title>
        <link rel="shortcut icon" href="<?= base_url(); ?>assets/images/favicon.ico">
		<link href="<?= base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="<?= base_url(); ?>assets/css/icons.css" rel="stylesheet" type="text/css">
        <link href="<?= base_url(); ?>assets/css/style.css" rel="stylesheet" type="text/css">
    </head>

<!-- END HEADER  -->

<?php
if($this->session->userdata('LoggedIN'))
    redirect('');
?>


    <body>

        <!-- Begin page -->
        <div class="wrapper-page">
            <div class="card">
                <div class="card-body">

                    <h3 class="text-center m-0">
                        <div class="logo logo-admin"><img src="<?= base_url(); ?>assets/images/logo.png" height="60" alt="logo"></div>
                    </h3>

                    <div class="p-3">
                        <h4 class="text-muted font-18 m-b-5 text-center">Registrasi Akun</h4>
                        <p class="text-muted text-center">Sistem Informasi Aset Fasilkom-TI USU</p>

                        <?php echo form_open_multipart('Account/register'); ?>

                            <div class="m-b-10">
                                <label for="email">Email Aktif</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Misalnya : example@example.com" value="<?php echo set_value('email'); ?>">
                                <label class="error text-danger"><?php echo form_error('email'); ?></label>
                            </div>

							<div class="m-b-10">
                                <label for="nama">Nama Lengkap</label>
                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama lengkap" value="<?php echo set_value('nama'); ?>">
                                <label class="error text-danger"><?php echo form_error('nama'); ?></label>
                            </div>

							<div class="m-b-10">
                                <label for="nim">NIM/NIP</label>
                                <input type="text" class="form-control" id="nim" name="nim" placeholder="Masukkan NIM atau NIP" value="<?php echo set_value('nim'); ?>">
                                <label class="error text-danger"><?php echo form_error('nim'); ?></label>
                            </div>

                            <div class="m-b-10">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username" value="<?php echo set_value('username'); ?>">
                                <label class="error text-danger"><?php echo form_error('username'); ?></label>
                            </div>

                            <div class="m-b-10">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password" value="<?php echo set_value('password'); ?>">
                                <label class="error text-danger"><?php echo form_error('password'); ?></label>
                            </div>

							<div class="m-b-10">
                                <label for="konfirmasipassword">Konfirmasi Password</label>
                                <input type="password" class="form-control" id="konfirmasipassword" name="konfirmasipassword" placeholder="Ulangi password" value="<?php echo set_value('konfirmasipassword'); ?>">
                                <label class="error text-danger"><?php echo form_error('konfirmasipassword'); ?></label>
                            </div>

                            <div class="form-group row m-t-20">
                                <div class="col-12 text-right">
                                    <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Register</button>
                                </div>
                            </div>

						<?php echo form_close(); ?>
                    </div>

                </div>
            </div>

            <div class="m-t-40 text-center">
                <p>Sudah Punya Akun ? <a href="<?= base_url(); ?>Account" class=" text-primary"> Login </a> </p>
                <p>© 2021 Team A1 <span class="d-none d-sm-inline-block"> - Sistem Informasi Aset Fasilkom-TI USU</span>.</p>
            </div>
        </div>


        <!-- jQuery  -->
        <script src="<?= base_url(); ?>assets/js/jquery.min.js"></script>
        <script src="<?= base_url(); ?>assets/js/bootstrap.bundle.min.js"></script>
        <script src="<?= base_url(); ?>assets/js/jquery.slimscroll.js"></script>
        <script src="<?= base_url(); ?>assets/js/waves.min.js"></script>

        <!-- App js -->
        <script src="<?= base_url(); ?>assets/js/app.js"></script>

    </body>
</html>