<?php $this->load->view('layout/headerA'); ?>
<!-- CSS PLUGINS START  -->

<!-- Sweet Alert -->
<link href="<?=base_url()?>assets/plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css">

<!-- CSS PLUGINS END  -->
<?php $this->load->view('layout/headerB'); ?>

<?php $this->load->view('layout/navbar'); ?>

<?php
    $level = $this->session->userdata('level');
    $id_user = $this->session->userdata('id_user');
    $id_url = $this->uri->segment(3);
?>

<?php
// Alert Edit Sukses 
if($this->session->flashdata())
{
    if($this->session->flashdata('edit_sukses'))
        echo "<span id='edit_sukses'></span>";
    
}
?>


<?php if($id_user == $id_url): ?>
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
							<label for="username" class="col-sm-4 col-form-label">Username</label>
							<div class="col-sm-8">
								<input class="form-control" type="text" id="username" name="username" autocomplete="off" value="<?=$user->username?>" required>
							</div>
                            <label class="error col-sm-12"><?php echo form_error('username'); ?></label>
						</div>
											
						<div class="form-group row">
							<label for="nama" class="col-sm-4 col-form-label">Nama</label>
							<div class="col-sm-8">
								<input class="form-control" type="text" id="nama" name="nama" autocomplete="off" value="<?=$user->nama?>" required>
							</div>
                            <label class="error col-sm-12"><?php echo form_error('nama'); ?></label>
						</div>

                        <div class="form-group row">
							<label for="email" class="col-sm-4 col-form-label">Email</label>
							<div class="col-sm-8">
								<input class="form-control" type="email" id="email" name="email" autocomplete="off" value="<?=$user->email?>" required>
							</div>
                            <label class="error col-sm-12"><?php echo form_error('email'); ?></label>
						</div>

                        <div class="form-group row">
							<label for="nim" class="col-sm-4 col-form-label">Nomor Induk Mahasiswa</label>
							<div class="col-sm-8">
								<input class="form-control" type="text" id="nim" name="nim" autocomplete="off" value="<?=$user->nim?>" required>
							</div>
                            <label class="error col-sm-12"><?php echo form_error('nim'); ?></label>
						</div>
											
						<div class="form-group row">
							<label for="password" class="col-sm-4 col-form-label">Password Baru</label>
							<div class="col-sm-8">
								<input class="form-control" type="password" id="password" name="password" autocomplete="off" placeholder="Masukkan password baru">
							</div>
                            <label class="error col-sm-12"><?php echo form_error('password'); ?></label>
						</div>

                        <div class="form-group row">
							<label for="konfirmasi_password" class="col-sm-4 col-form-label">Konfirmasi Password Baru</label>
							<div class="col-sm-8">
								<input class="form-control" type="password" id="konfirmasi_password" name="konfirmasi_password" autocomplete="off" placeholder="Masukkan konfirmasi password baru">
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


<?php elseif($level == 1): ?>
<div class="wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-3">
				<div class="card m-b-20">
					<img src="<?php echo base_url()."assets/images/user/".$user->foto;?>" width=100% class="card-img-top img-fluid">
                </div>
            </div>

            <div class="col-sm-6">
                <div class="card m-b-20 px-3">
					<div class="card-body">
                        <h3><b><?=$user->nama?></b></h3>
                        <p class="font-18"><mark class="text-muted">@<?=$user->username?></mark></p>
                        <br>
                        <h6>Email</h6>
                        <p><?=$user->email?></p><br>
                        <h6>Nomor Induk Mahasiswa</h6>
                        <p><?=$user->nim?></p>
                    </div>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="card m-b-20">
					<div class="card-body">
                        <h5>Status Pengguna</h5>
                        <br>
                        <?php if($user->active == 1): ?>
                            <a href="<?= base_url('User/update_status_byid/'.$user->id_user.'/'.$user->active); ?>" class="btn btn-success btn-block">Aktif</a>
                        <?php else:  ?>
                            <a href="<?= base_url('User/update_status_byid/'.$user->id_user.'/'.$user->active); ?>" class="btn btn-danger btn-block">Nonaktif</a>
                        <?php endif; ?>
                    </div>
                </div>

				<div class="card m-b-20 pb-2">
					<div class="card-body">
                        <h5>Hapus Akun Pengguna</h5>
                        <br>
                        <button onclick="pencet()" class="btn btn-outline-danger btn-block"><span class="typcn typcn-trash"></span> Hapus</button>
						<div id="kotakhapus" style="display:none;">
							<div class="custom-control custom-checkbox my-3">
								<input type="checkbox" class="custom-control-input" value="1" id="del" onclick="del_changed(this)">
								<label class="custom-control-label text-muted" for="del">Saya paham dan mengerti bahwa akun yang sudah dihapus tidak dapat dikembalikan lagi.</label>
							</div>
							<?php echo form_open("user/hapus_user/".$user->id_user); ?>
								<button type="submit" class="btn btn-danger" id="del_button" disabled=TRUE>Hapus</button>
							<?php echo form_close();?>
							<script>
								function del_changed(delCheckBox){
									if(delCheckBox.checked){
										document.getElementById("del_button").disabled = false;
									} else{
										document.getElementById("del_button").disabled = true;
									}
								}
							</script>
						</div>
                    </div>
                </div>
            </div>
			

        </div>
    </div>
</div>
<?php else: ?>
    <?php redirect('') ?>
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

<script>
function pencet(){
	var x = document.getElementById("kotakhapus");
	if (x.style.display == "none")
		x.style.display = "block";
	else
		x.style.display = "none";
}

function ceklis(checker){
	var sendbtn = document.getElementById('btn-hapus');
	if(checker.checked)
		sendbtn.disabled=FALSE;
	else
		sendbtn.disabled=TRUE;
}
</script>


<!-- Sweet-Alert  -->
<script src="<?=base_url()?>assets/plugins/sweet-alert2/sweetalert2.min.js"></script>
<script>
$('#edit_sukses').show(function () {
    Swal.fire(
        {
            title: 'Berhasil!',
            text: 'Data berhasil diubah!',
            type: 'success',
            confirmButtonColor: "#58db83"
        }
    )
});

</script>

<!-- JS PLUGINS END  -->
<?php $this->load->view('layout/footerB'); ?>