<?php $this->load->view('layout/headerA'); ?>
    <!-- CSS PLUGINS START  -->

    <!-- Bootstrap Datepicker CSS -->
	<link href="<?= base_url(); ?>assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">

    <!-- CSS PLUGINS END  -->
<?php $this->load->view('layout/headerB'); ?>

<?php $this->load->view('layout/navbar'); ?>


<div class="wrapper">
	<div class="container-fluid">
		<div class="card m-b-30 card-body pb-3">
			<div class="row">

				<div class="col-sm-5 px-5">
					<img src="<?php echo base_url('assets/images/barang/'.$detail->foto);?>" alt="<?=$detail->nama_barang?>" width=100%>
				</div>

				<div class="col-sm-7 px-3 pt-2">
					<h3><?=$detail->nama_barang?></h3>
					<p><?=$detail->deskripsi?></p>
					<br>
					<?php echo form_open('pinjam_barang/pinjam_user/'.$detail->id_barang) ?>
						<label class="font-16">Cek Ketersediaan</label>
						<div class="row">
							<div class="col-12 col-sm-7 mb-2">
								<div class="input-daterange input-group" id="date-range">
									<input type="text" class="form-control" name="tgl_pinjam" value="<?php echo set_value('tgl_pinjam');?>" placeholder="Tanggal Peminjaman" required>
									<input type="text" class="form-control" name="tgl_pengembalian" value="<?php echo set_value('tgl_pengembalian');?>" placeholder="Tanggal Pengembalian" required>
								</div>
							</div>
							<div class="col-7 col-sm-3 mb-2">
								<input type="text" class="form-control" placeholder="Jumlah" id="qty" name="qty" value="<?php echo set_value('qty');?>" required>
							</div>
							<div class="col-5 col-sm-2 mb-2 d-flex flex-column">
								<input type="submit" value="Cek" class="btn btn-outline-primary mt-auto" name="cek_stok">
							</div>
						</div>
					<?php echo form_close(); ?>	
				</div>

			</div>
		</div>

	</div>
</div>


<?php $this->load->view('layout/footerA'); ?>
<!-- JS PLUGINS START  -->

<!-- Bootstrap Datepicker JS -->
<script src="<?= base_url(); ?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

<script>
	!function($) {
		"use strict";
		var AdvancedForm = function() {};
		AdvancedForm.prototype.init = function() {
			// Date Picker
			jQuery('#date-range').datepicker({
				toggleActive: true,
				format: 'yyyy-mm-dd',
				startDate: "dateToday"
			});
			jQuery('#date-range').on("change", function (){

				var fromdate = $(this).val();
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
<?php $this->load->view('layout/footerB'); ?>