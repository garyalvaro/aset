<?php $this->load->view('layout/headerA'); ?>
<!-- CSS PLUGINS START  -->

<!-- Table css -->
<link href="<?= base_url(); ?>assets/plugins/RWD-Table-Patterns/dist/css/rwd-table.min.css" rel="stylesheet" type="text/css" media="screen">
<!-- Sweet Alert -->
<link href="<?=base_url()?>assets/plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css">


<!-- CSS PLUGINS END  -->
<?php $this->load->view('layout/headerB'); ?>

<?php $this->load->view('layout/navbar'); ?>

<?php
// Alert Pinjam Sukses 
if($this->session->flashdata())
{
    if($this->session->flashdata('pinjam_sukses'))
        echo "<span id='pinjam_sukses'></span>";
}
?>


<?php
    $level = $this->session->userdata('level');
    $id_user = $this->session->userdata('id_user');
    $id_url = $this->uri->segment(3);
?>


<?php if($id_user == $id_url): ?>
<div class="wrapper">
    <div class="container-fluid">
        <div class="col-lg-12">
            <div class="card m-b-20">
                <div class="card-body">

                    <h4 class="mt-0 header-title">Pinjaman Saya</h4>
                    <p class="text-muted m-b-30"></p>

                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#stat0" role="tab">
                                <span class="d-block d-sm-none">Pending</span>
                                <span class="d-none d-sm-block">Belum Disetujui</span> 
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
                        <div class="tab-pane p-3 <?php if($i==0) echo "active";?> " id="stat<?=$i?>" role="tabpanel">
                            <div class="table-rep-plugin">
                                <div class="table-responsive mb-0" data-pattern="priority-columns" id="tr<?=$i?>">
                                    <table id="tech-companies-1" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th data-priority="1">Barang</th>
                                                <th data-priority="1">Jumlah Pinjaman</th>
                                                <th data-priority="3">Tanggal Peminjaman</th>
                                                <th data-priority="3">Tanggal Pengembalian</th>
                                                <th data-priority="1">Waktu Order</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($pinjaman as $key): ?>
                                            <?php if($key->status_peminjaman == $i): ?>
                                                <tr class='clickable-row' data-href="<?= base_url('Pinjam_barang/detail_pinjaman/'.$key->id_pinjamBarang); ?>" style='cursor: pointer;'>
                                                    <td><?=$key->nama_barang?></td>
                                                    <td><?=$key->qty?></td>
                                                    <td><?=$key->tgl_pinjam?></td>
                                                    <td><?=$key->tgl_pengembalian?></td>
                                                    <td><?=$key->action_datetime?></td>
                                                </tr>
                                            <?php endif; ?>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <?php endfor; ?>

                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
<?php 
    else:
        redirect('Pinjam_barang/user/'.$id_user);
    endif;
?>


<?php $this->load->view('layout/footerA'); ?>
<!-- JS PLUGINS START  -->


<!-- Responsive-table RWD-->
<script src="<?= base_url(); ?>assets/plugins/RWD-Table-Patterns/dist/js/rwd-table.min.js"></script>
<script>
    $(function() {
        $('#tr0').responsiveTable({
            addDisplayAllBtn: 'btn btn-secondary'
        });
        $('#tr1').responsiveTable({
            addDisplayAllBtn: 'btn btn-secondary'
        });
        $('#tr2').responsiveTable({
            addDisplayAllBtn: 'btn btn-secondary'
        });
        $('#tr3').responsiveTable({
            addDisplayAllBtn: 'btn btn-secondary'
        });
    });
</script>

<script type="text/javascript">
    jQuery(document).ready(function($) {
        $(".clickable-row").click(function() {
            window.location = $(this).data("href");
        });
    });
</script>


<!-- Sweet-Alert  -->
<script src="<?=base_url()?>assets/plugins/sweet-alert2/sweetalert2.min.js"></script>
<script>
$('#pinjam_sukses').show(function () {
    Swal.fire(
        {
            title: 'Berhasil!',
            text: 'Peminjaman Anda akan kami proses!',
            type: 'success',
            confirmButtonColor: "#58db83"
        }
    )
});
</script>

<!-- JS PLUGINS END  -->
<?php $this->load->view('layout/footerB'); ?>