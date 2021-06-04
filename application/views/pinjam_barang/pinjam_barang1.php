<?php $this->load->view('layout/headerA'); ?>
    <!-- CSS PLUGINS START  -->

    <!-- Bootstrap Datepicker CSS -->
	<link href="<?= base_url(); ?>assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">
    
	<!-- Sweet Alert -->
    <link href="<?=base_url()?>assets/plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css">

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

				<div class="col-sm-7 px-33 pt-2">
					<h3><?=$detail->nama_barang?></h3>
					<p><?=$detail->deskripsi?></p>
					<br>
					<?php echo form_open('pinjam_barang/pinjam_user/'.$detail->id_barang, ['id'=>'form']) ?>
						<label class="font-16">Cek Ketersediaan</label>
						<div class="row">
							<div class="col-12 col-sm-7 mb-2">
								<div class="input-daterange input-group" id="date-range">
									<input type="text" class="form-control" name="tgl_pinjam" id="tgl_pinjam" value="<?php echo set_value('tgl_pinjam');?>" placeholder="Tanggal Peminjaman">
									<input type="text" class="form-control" name="tgl_pengembalian" id="tgl_pengembalian" value="<?php echo set_value('tgl_pengembalian');?>" placeholder="Tanggal Pengembalian">
								</div>
							</div>
							<div class="col-7 col-sm-3 mb-2">
								<input type="number" class="form-control" placeholder="Jumlah" id="qty" name="qty" value="<?php echo set_value('qty');?>">
							</div>
							<div class="col-5 col-sm-2 mb-2 d-flex flex-column">
								<input type="submit" value="Cek" class="btn btn-outline-primary mt-auto" name="cek_stok">
							</div>

							<!-- Alert -->
							<?php if($status->stok == 1): ?>
								<div class="col-12">
									<div class="alert alert-success alert-dismissible fade show" role="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close">
											<span aria-hidden="true">×</span>
										</button>
										<strong>Stok Tersedia.</strong> Silahkan isi alasan peminjaman ya.
									</div>
								</div>
							<?php else: ?>
								<div class="col-12">
									<div class="alert alert-danger alert-dismissible fade show" role="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close">
											<span aria-hidden="true">×</span>
										</button>
										<strong>Stok Tidak Tersedia.</strong>
									</div>
								</div>
							<?php endif; ?>

						</div>
					
					<!-- Munculkan form isi alasan ketika stok tersedia  -->
					<?php if($status->stok == 1): ?>
						<div class="row mt-3">
							<div class="col-12 col-sm-8 mb-2">
								<label for="alasan_pinjam">Alasan Peminjaman</label>
								<textarea name="alasan_pinjam" id="alasan_pinjam" rows="3" class="form-control" placeholder="Tuliskan alasan peminjaman yang jelas" onchange="enable()"><?php echo set_value('alasan_pinjam');?></textarea>
							</div>
							<div class="col-12 col-sm-4 mb-2 d-flex flex-column">
								<input type="button" value="Pinjam Sekarang" class="btn btn-primary mt-auto" id="konfirmasi" onclick="konfirmasi()" disabled=TRUE>
								<input type="submit" name="submit" id="second" hidden>
							</div>
						</div>
					<?php endif; ?>

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
				format: 'yyyy-mm-dd'
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

<script>
// function konfirmasi()
// {
// 	$("#kkonfirmasi").click(function(){
//     	$("#second").click(); 
//     	return false;
// 	});
// }
</script>


<!-- Sweet-Alert  -->
<script src="<?=base_url()?>assets/plugins/sweet-alert2/sweetalert2.min.js"></script>
<script>
	var nama = "<?=$this->session->userdata('nama')?>";
	var barang = "<?=$detail->nama_barang?>";
	var tgl_pinjam = document.getElementById("tgl_pinjam").value;
	var tgl_pengembalian = document.getElementById("tgl_pengembalian").value;
	var qty = document.getElementById("qty").value;
	var alasan = document.getElementById("alasan_pinjam").value;

	$('#konfirmasi').on('click',function(e){
		e.preventDefault();
		
		Swal.fire({
			title: "Apakah Benar?",
			text: "Peminjaman "+qty+" "+barang+" atas nama "+nama+" dari tanggal "+tgl_pinjam+" sampai "+tgl_pengembalian+"?",
			type: "question",
			showCancelButton: true,
			confirmButtonColor: "#58db83",
			cancelButtonColor: "#ec536c",
			confirmButtonText: "Benar, Lanjutkan!"
			}).then(function (result) {
			if (result.value) {
				Swal.fire("Berhasil!", "Peminjaman Anda segera kami proses!", "success");
				$("#second").click(); 
    			return false;
			}
		});
	});
</script>

<!-- Enable Button After Input Deskripsi  -->
<script>
function enable(){
	if(document.getElementById("alasan_pinjam").value.trim() != "")
		konfirmasi.disabled = false;
	else
		konfirmasi.disabled = true;
}
</script>


<!-- JS PLUGINS END  -->
<?php $this->load->view('layout/footerB'); ?>