<?php $this->load->view('layout/headerA'); ?>
<!-- CSS PLUGINS START  -->

    <!-- DataTables -->
    <link href="<?= base_url(); ?>assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url(); ?>assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="<?= base_url(); ?>assets/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

	<!-- Sweet Alert -->
	<link href="<?=base_url()?>assets/plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css">

<!-- CSS PLUGINS END  -->
<?php $this->load->view('layout/headerB'); ?>

<?php $this->load->view('layout/navbar'); ?>

<?php
if($this->session->flashdata())
{
    if($this->session->flashdata('acc_berhasil'))
        echo "<span id='acc_berhasil'></span>";
	if($this->session->flashdata('selesai_berhasil'))
        echo "<span id='selesai_berhasil'></span>";
}
?>

<div class="wrapper">
	<div class="container-fluid">
		<h4 class="font-20">Peminjaman Baru</h4>
		<table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
			<thead>
				<tr>
					<td>Barang</td>
					<td>Jumlah</td>
					<td>Peminjam</td>
					<td>Tanggal Peminjaman</td>
					<td>Tanggal Pengembalian</td>
					<td>Waktu Peminjaman</td>
					<th>Status Peminjaman</th>

					<td>Aksi</td>
				</tr>
			</thead>

			<tbody>
				<?php if(!empty($pinjam_barang)): ?> 
				<?php foreach($pinjam_barang as $data) :?>
					<tr>
						<td><?=$data->nama_barang?></td>
						<td><?=$data->qty?></td>
						<td><?=$data->nama?></td>
						<td><?=$data->tgl_pinjam?></td>
						<td><?=$data->tgl_pengembalian?></td>
						<td><?=$data->action_datetime?></td>
						<td>
						    <?php
						    	if ($data->status_peminjaman==0) { echo "Dalam proses pemeriksaan"; }
						    	elseif ($data->status_peminjaman==1) { echo "Pinjaman diterima"; }
						    	elseif ($data->status_peminjaman==2) { echo "Pinjaman ditolak"; }
						    	elseif ($data->status_peminjaman==4) { echo "Pinjaman telah dikembalikan"; }
						    ?>
						</td>
						<td>
							<a href="<?=base_url('Pinjam_barang/detail/'.$data->id_pinjamBarang)?>" class="btn btn-info">Detail</a>
						</td>
					</tr>
				<?php endforeach; ?>
				<?php endif; ?>
			</tbody>
		</table>
		
	</div>
</div>

<?php $this->load->view('layout/footerA'); ?>
<!-- JS PLUGINS START  -->


    <!-- Required datatable js -->
    <script src="<?= base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url(); ?>assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
    <!-- Responsive examples -->
    <script src="<?= base_url(); ?>assets/plugins/datatables/dataTables.responsive.min.js"></script>
    <script src="<?= base_url(); ?>assets/plugins/datatables/responsive.bootstrap4.min.js"></script>

    <!-- Datatable Init -->
    <script>
        $(document).ready(function() {
            $('#datatable').DataTable();
        } );
    </script>

	<!-- Sweet Alert  -->
	<script src="<?=base_url()?>assets/plugins/sweet-alert2/sweetalert2.min.js"></script>
	<script>
	$('#selesai_berhasil').show(function(){
		Swal.fire({
			title: "Selesai!",
			text: "Proses peminjaman sudah kelar!",
			type: "success"
		});
	});
	$('#acc_berhasil').show(function(){
		Swal.fire({
			title: "Done!",
			text: "ACC berhasil!",
			type: "success"
		});
	});
	</script>



<!-- JS PLUGINS END  -->
<?php $this->load->view('layout/footerB'); ?>