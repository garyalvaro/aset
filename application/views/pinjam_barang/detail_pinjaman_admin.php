<?php $this->load->view('layout/headerA'); ?>
<!-- CSS PLUGINS START  -->
<!-- Bootstrap Touchspin css -->
<link href="<?=base_url();?>assets/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />
<!-- Sweet Alert -->
<link href="<?=base_url()?>assets/plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css">
<!-- CSS PLUGINS END  -->
<?php $this->load->view('layout/headerB'); ?>

<?php $this->load->view('layout/navbar'); ?>

<?php
if($this->session->userdata('level')!=1)
	redirect('');
?>

<div class="wrapper">
	<div class="container-fluid">
		<div class="row">

			<!-- Kolom 1 -->
			<div class="col-md-4">
				<div class="card m-b-20">
					<div class="card-body">
						<h4 class="mt-0 header-title">Barang Pinjaman</h4>
						<img src="<?php echo base_url()."assets/images/barang/".$detail->foto_barang;?>" alt="" width=100%>
						<h4><?=$detail->nama_barang;?></h4>
						<span class="font-18"><?=$detail->qty." ".$detail->satuan;?></span>
					</div>
				</div>
			</div>

			<!-- Kolom 2 -->
			<div class="col-md-4">
				<div class="card m-b-20">
					<div class="card-body">
						<h4 class="mt-0 header-title">Peminjam</h4>
						<a href="<?php echo base_url('Pinjam_barang/user/'.$detail->id_user)?>">
							<img src="<?php echo base_url()."assets/images/user/".$detail->foto_user;?>" alt="" class="rounded-circle"  style="width:50px; height:50px; object-fit:cover; object-position:0 0;">
							<b class="font-18 ml-2"><?=$detail->nama;?></b>
						</a>
					</div>
				</div>
				<div class="card m-b-20">
					<div class="card-body">
						<h4 class="mt-0 mb-3 header-title">Tanggal Peminjaman</h4>
						<p>
							<b class="font-20"><?=$detail->tgl_pinjam;?> </b>
							s.d. 
							<b class="font-20"><?=$detail->tgl_pengembalian;?> </b>
						</p>
					</div>
				</div>
				<div class="card m-b-20">
					<div class="card-body">
						<h4 class="mt-0 header-title">Alasan Meminjam</h4>
						<p><?=$detail->alasan_pinjam;?></p>
						<p><i>Terekam di sistem pada: <?=$detail->action_datetime;?></i></p>
					</div>
				</div>
			</div>

			<!-- Kolom 3 -->
			<div class="col-md-4">
				<?php if($detail->status_peminjaman == 0) :?>
					<div class="card m-b-20">
						<div class="card-body">
							<h4 class="mt-0 header-title">Persetujuan Admin</h4>
							<p>Apakah peminjaman diterima atau ditolak?</p> 
							
							<?php echo form_open_multipart('pinjam_barang/acc/'.$detail->id_pinjamBarang); ?>
								<label for="">Catatan: (<i>Opsional</i>)</label>
								<textarea name="deskripsi_acc" rows="5" class="form-control"></textarea>
								<br>
								<input type="submit" name="terima" class="btn btn-success btn-block" value="Terima">
								<input type="submit" name="tolak" class="btn btn-danger btn-block" value="Tolak"> 
							<?php echo form_close(); ?>
						</div>
					</div>
				<?php elseif($detail->status_peminjaman == 1): ?>
					<div class="card m-b-20">
						<div class="card-body">
							<h4 class="mt-0 header-title">Persetujuan Admin</h4>
							<p>Apakah peminjaman sudah selesai?</p> 

							<div class="custom-control custom-checkbox my-3">
								<input type="checkbox" class="custom-control-input" value="1" id="ok" onclick="ok_changed(this)">
								<label class="custom-control-label text-muted" for="ok">Benar, peminjaman atas nama <?=$detail->nama;?> sudah dikembalikan.</label>
							</div>
							<button class="btn btn-success btn-block" id="ok_button" disabled=TRUE>Selesaikan</button>
							<script>
								function ok_changed(okCheckBox){
									if(okCheckBox.checked){
										document.getElementById("ok_button").disabled = false;
									} else{
										document.getElementById("ok_button").disabled = true;
									}
								}
							</script>

						</div>
					</div>
				<?php elseif($detail->status_peminjaman == 2): ?>
					<div class="card m-b-20">
						<div class="card-body">
							<h4 class="mt-0 header-title">Keterangan</h4>
							<p>Bagaimana peminjamannya?</p> 
							<div class="alert alert-danger">
								Peminjaman <strong>Ditolak</strong>, dengan alasan: 
								<?php 
									if($detail->deskripsi_acc == "")
										echo "-----";
									else
										echo $detail->deskripsi_acc;
								?>
							</div>
						</div>
					</div>
				<?php elseif($detail->status_peminjaman == 3): ?>
					<div class="card m-b-20">
						<div class="card-body">
							<h4 class="mt-0 header-title">Keterangan</h4>
							<div class="alert alert-info">
								Peminjaman <strong>Sudah Selesai</strong>.
							</div>
						</div>
					</div>
					<div class="card m-b-20">
						<div class="card-body">
							<h4 class="mt-0 header-title">Kerusakan Barang</h4>
							<?php echo form_open_multipart('barang/rusak/'.$detail->id_barang); ?>
								<?php if (empty($rusak)) { ?>
									<div class="form-group row">
										<label for="deskripsi" class="col-sm-12 col-form-label">Jumlah</label>
										<div class="col-sm-12">
											<input id="qty" type="number" name="qty" value="1" max="<?=$detail->qty?>">
										</div>
									</div>
									<label for="">Deskripsi kerusakan :</label>
									<input type="text" name="id_user" value="<?=$detail->id_user;?>" hidden>
									<input type="text" name="id_pinjamBarang" value="<?=$detail->id_pinjamBarang;?>" hidden>
									<textarea name="deskripsi_rusak" rows="5" class="form-control" required></textarea>
									<br>
									<input type="submit" name="submit" class="btn btn-primary btn-block" value="Submit">
								<?php } else{ ?>
									<div class="table-responsive">
										<table class="table mb-0">

											<thead>
												<tr>
													<th>Barang</th>
													<th>Qty</th>
													<th width="65%">Deskripsi</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<th scope="row"><?=$detail->nama_barang?></th>
													<td><?=$rusak->qty?></td>
													<td><?=$rusak->deskripsi?></td>
												</tr>
											</tbody>
										</table>
									</div>
								<?php } ?>
							<?php echo form_close(); ?>
						</div>
					</div>
				<?php endif; ?>
			</div>

		</div><!-- end row gede -->
	</div>
</div>


<?php $this->load->view('layout/footerA'); ?>
<!-- JS PLUGINS START  -->


<!-- Sweet-Alert  -->
<script src="<?=base_url()?>assets/plugins/sweet-alert2/sweetalert2.min.js"></script>
<script>
	var link = '<?=base_url('pinjam_barang/selesaikan/'.$detail->id_pinjamBarang);?>';
	$('#ok_button').on('click',function(e){
		e.preventDefault();
		
		Swal.fire({
			title: "Selesaikan?",
			text: "Pastikan aset pinjaman sudah dikembalikan ya.",
			type: "question",
			showCancelButton: true,
			confirmButtonColor: "#58db83",
			cancelButtonColor: "#ec536c",
			confirmButtonText: "Selesai"
			}).then(function (result) {
			if (result.value) {
				Swal.fire("Berhasil!", "", "success");
				window.location.href = link;
			}
		});
	});
</script>
<script src="<?=base_url()?>assets/plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js"></script>
<script type="text/javascript">
!function($) {
	"use strict";

	var AdvancedForm = function() {};
	
	AdvancedForm.prototype.init = function() {

		$("input[name='qty']").TouchSpin({
			min: 1,
			step: 1,
			max: <?php echo $detail->qty ?>,
			buttondown_class: 'btn btn-secondary',
			buttonup_class: 'btn btn-secondary'
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