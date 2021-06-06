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

		<div class="card">
			<div class="card-body">

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
							<td>Status Peminjaman</td>
							<td>Aksi</td>
						</tr>
					</thead>

					<tbody>
						<?php for ($i=0; $i<4 ; $i++): ?> 
						<?php foreach($pinjam_barang as $data) :?>
						<?php if($data->status_peminjaman==$i): ?> 
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
										elseif ($data->status_peminjaman==3) { echo "Pinjaman telah dikembalikan"; }
									?>
								</td>
								<td>
									<a href="<?=base_url('Pinjam_barang/detail/'.$data->id_pinjamBarang)?>" class="btn btn-info">Detail</a>
								</td>
							</tr>
						<?php endif; ?>
						<?php endforeach; ?>
						<?php endfor; ?>
					</tbody>
				</table>

			</div>
		</div>

		<!-- Div Card Kedua -->
		<div class="card">
			<div class="card-body">
				<h4 class="mt-0 header-title">Peminjaman</h4>
				<p class="text-muted m-b-30"></p>

				<!-- Nav tabs -->
				<ul class="nav nav-tabs" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" data-toggle="tab" href="#stat0" role="tab">
							<span class="d-block d-sm-none">Baru</span>
							<span class="d-none d-sm-block">Peminjaman Baru</span> 
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#stat1" role="tab">
							<span class="d-block d-sm-none">Diterima</span>
							<span class="d-none d-sm-block">Peminjaman Diterima</span> 
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#stat2" role="tab">
							<span class="d-block d-sm-none">Ditolak</span>
							<span class="d-none d-sm-block">Peminjaman Ditolak</span>   
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#stat3" role="tab">
							<span class="d-block d-sm-none">Selesai</span>
							<span class="d-none d-sm-block">Peminjaman Selesai</span>    
						</a>
					</li>
				</ul>

				<!-- Tab panes -->
				<div class="tab-content">
					
					<?php for ($i=0; $i<4 ; $i++): ?> 	
					<div class="tab-pane p-3 <?php if($i==0) echo "active";?>" id="stat<?=$i?>" role="tabpanel">
						<table id="datatable<?=$i?>" class="table dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
							<thead>
								<tr>
									<td>Barang</td>
									<td>Jumlah</td>
									<td>Peminjam</td>
									<td>Tanggal Peminjaman</td>
									<td>Tanggal Pengembalian</td>
									<td>Waktu Peminjaman</td>
									<td>Aksi</td>
								</tr>
							</thead>

							<tbody>
								<?php foreach($pinjam_barang as $data) :?>
								<?php if($data->status_peminjaman==$i): ?> 
									<tr>
										<td><?=$data->nama_barang?></td>
										<td><?=$data->qty?></td>
										<td><?=$data->nama?></td>
										<td><?=$data->tgl_pinjam?></td>
										<td><?=$data->tgl_pengembalian?></td>
										<td><?=$data->action_datetime?></td>
										<td>
											<a href="<?=base_url('Pinjam_barang/detail/'.$data->id_pinjamBarang)?>" class="btn btn-info">Detail</a>
										</td>
									</tr>
								<?php endif; ?>
								<?php endforeach; ?>
							</tbody>

							<tfoot>
								<tr>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
							</tfoot>
						</table>
					</div>
					<?php endfor; ?>
					
				
					
				</div>

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
            $('#datatable0').DataTable();
			$('#datatable1').DataTable();
			$('#datatable2').DataTable();
			$('#datatable3').DataTable();
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