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
			<div class="col-12">
				<div class="card m-b-20">
					<div class="card-body">

						<h4 class="mt-0 header-title">Tambah Aset</h4>
						<p class="text-muted m-b-30 "></p>

						<?php echo form_open_multipart('barang/tambahBrg'); ?>

						<div class="form-group row">
							<label for="input_namaBrg" class="col-sm-2 col-form-label">Nama Aset</label>
							<div class="col-sm-10">
								<input class="form-control" type="text" id="input_namaBrg" name="input_namaBrg" autocomplete="off">
							</div>
							<label class="error col-sm-12"><?php echo form_error('input_namaBrg'); ?></label>
						</div>

						<div class="form-group row">
							<label for="foto" class="col-sm-2 col-form-label">Upload Foto Aset</label>
							<div class="col-sm-10">
								<input name="foto" type="file" id="foto" accept="image/jpeg">
							</div>
							<label class="error col-sm-12">
								<?php 
								if($this->session->flashdata('error_upload'))
								echo $this->session->flashdata('error_upload'); ?>
							</label>
						</div>

						<div class="form-group row">
							<label for="input_deskripsiBrg" class="col-sm-2 col-form-label">Deskripsi</label>
							<div class="col-sm-10">
								<input class="form-control" type="text" id="input_deskripsiBrg" name="input_deskripsiBrg" required>
							</div>
							<label class="error col-sm-12"><?php echo form_error('input_deskripsiBrg'); ?></label>
						</div>

						<div class="form-group row">
							<label for="qty" class="col-sm-2 col-form-label">Jumlah & Satuan</label>
							<div class="col-sm-5 col-6">
								<input id="qty" type="text" name="qty" value="1">
							</div>
							<div class="col-sm-5 col-6">
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
								<a class="btn btn-outline-secondary" href="<?php echo base_url();?>">Batal</a>
								&nbsp; &nbsp;
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

<!-- Bootstrap Touchpin js -->
<script src="<?=base_url()?>assets/plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js"></script>
<script type="text/javascript">
!function($) {
    "use strict";

    var AdvancedForm = function() {};
    
    AdvancedForm.prototype.init = function() {

		$("input[name='qty']").TouchSpin({
			min: 1,
			step: 1,
			buttondown_class: 'btn btn-primary',
			buttonup_class: 'btn btn-primary'
		});
	},
    //init
    $.AdvancedForm = new AdvancedForm, $.AdvancedForm.Constructor = AdvancedForm
}(window.jQuery),

//initializing
function ($) {
    "use strict";
    $.AdvancedForm.init();
}(window.jQuery);

</script>

<!-- JS PLUGINS END  -->
<?php $this->load->view('layout/footerA'); ?>