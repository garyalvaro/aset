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

                        <?php echo form_open_multipart('Account/register1'); ?>

							<div class="user-thumb text-center m-b-30">
                                <img src="<?= base_url(); ?>assets/images/user-icon.png" class="rounded-circle img-thumbnail" alt="thumbnail" id="blah" style="cursor:pointer">
                                <input name="userfile" type="file" id="userfile" accept="image/jpeg" hidden value="">
								<div class=" col-sm-12">Ganti Foto</div>
								<label class="error col-sm-12">
									<?php 
									if($this->session->flashdata('error_upload'))
									echo $this->session->flashdata('error_upload'); ?>
								</label>
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email aktif" >
                                <label class="error text-danger"><?php echo form_error('email'); ?></label>
                            </div>

							<div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama lengkap">
                                <label class="error text-danger"><?php echo form_error('nama'); ?></label>
                            </div>

							<div class="form-group">
                                <label for="nim">NIM</label>
                                <input type="text" class="form-control" id="nim" name="nim" placeholder="Masukkan Nomor Induk Mahasiswa">
                                <label class="error text-danger"><?php echo form_error('nim'); ?></label>
                            </div>

                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username">
                                <label class="error text-danger"><?php echo form_error('username'); ?></label>
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password">
                                <label class="error text-danger"><?php echo form_error('password'); ?></label>
                            </div>

							<div class="form-group">
                                <label for="konfirmasipassword">Konfirmasi Password</label>
                                <input type="password" class="form-control" id="konfirmasipassword" name="konfirmasipassword" placeholder="Ulangi password">
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

		<!-- JS untuk preview gambar -->
		<script>
			userfile.onchange = evt => {
				const [file] = userfile.files
				if (file) {
					blah.src = URL.createObjectURL(file)
				}
			}
		</script>

		<!-- JS untuk klik foto langsung minta upload  -->
		<script>
		$("#blah").click(function () {
			$("#userfile").trigger('click');
		});
		</script>


        <!-- App js -->
        <script src="<?= base_url(); ?>assets/js/app.js"></script>

    </body>
