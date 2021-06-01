<?php $this->load->view('layout/headerA'); ?>
<!-- CSS PLUGINS START  -->

	<!-- Bootstrap Touchspin css -->
	<link href="<?=base_url();?>assets/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />

<!-- CSS PLUGINS END  -->
<?php $this->load->view('layout/headerB'); ?>

<?php $this->load->view('layout/navbar'); ?>



<div class="wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-6">
				<div class="card m-b-20">
					<div class="card-body">

						<h4 class="mt-0 header-title">Edit Data <?=$barang->nama_barang?></h4>
						<p class="text-muted m-b-30 "></p>

						<?php echo form_open_multipart('barang/editBarang/'.$barang->id_barang); ?>

						<div class="form-group row">
							<label for="input_namaBrg" class="col-sm-2 col-form-label">Nama Aset</label>
							<div class="col-sm-10">
								<input class="form-control" type="text" id="input_namaBrg" name="input_namaBrg" autocomplete="off" value="<?=$barang->nama_barang?>" required>
							</div>
                            <label class="error col-sm-12"><?php echo form_error('input_namaBrg'); ?></label>
						</div>
											
						<div class="form-group row">
							<label for="input_deskripsiBrg" class="col-sm-2 col-form-label">Deskripsi</label>
							<div class="col-sm-10">
                                <textarea class="form-control" type="text" id="input_deskripsiBrg" name="input_deskripsiBrg" required><?=$barang->deskripsi?></textarea>
							</div>
                            <label class="error col-sm-12"><?php echo form_error('input_deskripsiBrg'); ?></label>
						</div>

						<div class="form-group row">
							<label for="qty" class="col-sm-2 col-form-label">Satuan</label>
							<div class="col-sm-10">
								<select class="form-control" id="id_satuan" name="id_satuan" required>
								<option value="" disabled>Pilih Satuan</option>
								<?php foreach($sat as $row):?>
									<option value="<?= $row->id_satuan; ?>" >
										<?= ucfirst($row->satuan); ?>
									</option>
								<?php endforeach; ?>
								</select>
							</div>
                            <label class="error col-sm-12"><?php echo form_error('id_satuan'); ?></label>
						</div>

						<div class="form-group row">
							<div class="col-sm-12 text-right">
								<a class="btn btn-outline-secondary" href="<?php echo base_url();?>barang/tampil_barang">Batal</a>
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
                        <h4 class="mt-0 header-title"> Foto</h4>
                        <p class="text-muted m-b-30 ">Gani Foto <?=$barang->nama_barang?>
                        </p>

                        <?php echo form_open_multipart('barang/editFoto/'.$barang->id_barang); ?>

                        <div class="form-group row">
							<div class="col-sm-6 m-b-10">
                                <img src="<?php echo base_url()."assets/uploads/".$barang->foto;?>" id="upfile1" style="cursor:pointer" width=100%>
							</div>
							<div class="col-sm-6">
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


<?php $this->load->view('layout/footerA'); ?>
<!-- JS PLUGINS START  -->

<script>
$("#upfile1").click(function () {
    $("#foto").trigger('click');
});
</script>

                        
<!-- JS PLUGINS END  -->
<?php $this->load->view('layout/footerA'); ?>