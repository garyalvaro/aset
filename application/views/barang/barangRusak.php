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
if($this->session->userdata('level')!=1)
    redirect('Barang/tampil_barang_users');
?>
<div class="wrapper">
	<div class="container-fluid">

		<!-- Div Card -->
		<div class="card">
			<div class="card-body">
				<h4 class="mt-0 header-title">Peminjaman</h4>
				<table id="datatable" class="table dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
					<thead>
						<tr>
							<td>Barang Rusak</td>
							<td>Qty</td>
							<td>Penanggung Jawab</td>
							<td>Tanggal Laporan</td>
							<td>Aksi</td>
						</tr>
					</thead>

					<tbody>
						<?php foreach($rusak as $data) :?>
							<tr>
								<td><?=$data->nama_barang?></td>
								<td><?=$data->qty?></td>
								<td><?=$data->nama?></td>
								<td><?=$data->action_datetime?></td>
								<td>
									<a href="<?=base_url('Pinjam_barang/detail/'.$data->id_pinjamBarang)?>" class="btn btn-info">Detail</a>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>

					<tfoot>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
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
            $('#datatable').DataTable()
        } );
    </script>

<!-- JS PLUGINS END  -->
<?php $this->load->view('layout/footerB'); ?>