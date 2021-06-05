<?php $this->load->view('layout/headerA'); ?>
<!-- CSS PLUGINS START  -->

<!-- CSS PLUGINS END  -->
<?php $this->load->view('layout/headerB'); ?>

<?php $this->load->view('layout/navbar'); ?>

<?php
    $level = $this->session->userdata('level');
    $id_user = $this->session->userdata('id_user');
    $id_url = $this->uri->segment(3);
?>


<?php if($level == 1 && $id_user == $id_url): ?>
<div class="wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-6">
				<div class="card m-b-20">
					<div class="card-body">

						<h4 class="mt-0 header-title">Edit Profil</h4>
						<p class="text-muted m-b-30 "></p>

						<?php echo form_open_multipart('user/edit_user/'.$user->id_user); ?>

						<div class="form-group row">
							<label for="username" class="col-sm-2 col-form-label">Username</label>
							<div class="col-sm-10">
								<input class="form-control" type="text" id="username" name="username" autocomplete="off" value="<?=$user->username?>" required>
							</div>
                            <label class="error col-sm-12"><?php echo form_error('username'); ?></label>
						</div>
											
						<div class="form-group row">
							<label for="nama" class="col-sm-2 col-form-label">Nama</label>
							<div class="col-sm-10">
								<input class="form-control" type="text" id="nama" name="nama" autocomplete="off" value="<?=$user->nama?>" required>
							</div>
                            <label class="error col-sm-12"><?php echo form_error('nama'); ?></label>
						</div>

                        <div class="form-group row">
							<label for="email" class="col-sm-2 col-form-label">Email</label>
							<div class="col-sm-10">
								<input class="form-control" type="email" id="email" name="email" autocomplete="off" value="<?=$user->email?>" required>
							</div>
                            <label class="error col-sm-12"><?php echo form_error('email'); ?></label>
						</div>

                        <div class="form-group row">
							<label for="nim" class="col-sm-2 col-form-label">Nomor Induk Mahasiswa</label>
							<div class="col-sm-10">
								<input class="form-control" type="text" id="nim" name="nim" autocomplete="off" value="<?=$user->nim?>" required>
							</div>
                            <label class="error col-sm-12"><?php echo form_error('nim'); ?></label>
						</div>
											
						<div class="form-group row">
							<label for="password" class="col-sm-2 col-form-label">Password Baru</label>
							<div class="col-sm-10">
								<input class="form-control" type="password" id="password" name="password" autocomplete="off" value="<?=$user->password?>" required>
							</div>
                            <label class="error col-sm-12"><?php echo form_error('password'); ?></label>
						</div>

                        <div class="form-group row">
							<label for="konfirmasi_password" class="col-sm-2 col-form-label">Konfirmasi Password Baru</label>
							<div class="col-sm-10">
								<input class="form-control" type="password" id="konfirmasi_password" name="konfirmasi_password" autocomplete="off" value="<?=$user->konfirmasi_password?>" required>
							</div>
                            <label class="error col-sm-12"><?php echo form_error('konfirmasi_password'); ?></label>
						</div>

						<div class="form-group row">
							<div class="col-sm-12 text-right">
								<a class="btn btn-outline-secondary" href="<?php echo base_url();?>User">Batal</a>
								&nbsp; &nbsp;
								<input class="btn btn-primary" type="submit" name="submit" value="Simpan">
							</div>
						</div>

						<?php echo form_close(); ?>

					</div>
				</div>
			</div> <!-- end col -->                                
            
            <div class="col-sm-6">
                <div class="card m-b-20">
                    <div class="card-body">
                        <h4 class="mt-0 header-title m-b-30"> Foto Profil</h4>

                        <?php echo form_open_multipart('user/ubah_foto/'.$user->id_user); ?>

                        <div class="form-group row">
							<div class="col-sm-4 m-b-10">
                                <img src="<?php echo base_url()."assets/images/user/".$user->foto;?>" id="upfile1" style="cursor:pointer; object-fit:cover; object-position:0 0; border-radius: 50%;" width=200px height=200px>
							</div>
							<div class="col-sm-8">
								<input name="foto" type="file" id="foto" accept="image/jpeg" required>
							</div>
						</div>

                        <div class="form-group-row">
                            <div class="col-sm-12 text-right">
                                <input class="btn btn-primary" type="submit" name="submit" value="Simpan">
                            </div>
                        </div>

                        <?php echo form_close(); ?>

                    </div>
                </div>
            </div> <!-- end col -->

		</div> <!-- end row -->

	</div> <!-- end container-fluid -->
</div>
<!-- end wrapper -->
<?php endif; ?>




<?php $this->load->view('layout/footerA'); ?>
<!-- JS PLUGINS START  -->

<!-- JS untuk preview gambar -->
<script>
    foto.onchange = evt => {
        const [file] = foto.files
        if (file) {
            upfile1.src = URL.createObjectURL(file)
        }
    }
</script>

<script>
$("#upfile1").click(function () {
    $("#foto").trigger('click');
});
</script>

<!-- JS PLUGINS END  -->
<?php $this->load->view('layout/footerB'); ?>