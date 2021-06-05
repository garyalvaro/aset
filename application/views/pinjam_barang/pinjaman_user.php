<?php $this->load->view('layout/headerA'); ?>
<!-- CSS PLUGINS START  -->

<!-- Table css -->
<link href="<?= base_url(); ?>assets/plugins/RWD-Table-Patterns/dist/css/rwd-table.min.css" rel="stylesheet" type="text/css" media="screen">

<!-- CSS PLUGINS END  -->
<?php $this->load->view('layout/headerB'); ?>

<?php $this->load->view('layout/navbar'); ?>


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
                                <span class="d-block d-sm-none"><i class="fas fa-question"></i></span>
                                <span class="d-none d-sm-block">Belum Disetujui</span> 
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#stat1" role="tab">
                                <span class="d-block d-sm-none"><i class="fas fa-clipboard-check"></i></span>
                                <span class="d-none d-sm-block">Peminjaman Diterima</span> 
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#stat2" role="tab">
                                <span class="d-block d-sm-none"><i class="fas fa-times"></i></span>
                                <span class="d-none d-sm-block">Peminjaman Ditolak</span> 
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#stat3" role="tab">
                                <span class="d-block d-sm-none"><i class="far fa-thumbs-up"></i></span>
                                <span class="d-none d-sm-block">Peminjaman Selesai</span>  
                            </a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        
                        <?php for ($i=0; $i<4 ; $i++): ?>
                        <div class="tab-pane p-3 <?php if($i==0) echo "active";?> " id="stat<?=$i?>" role="tabpanel">
                            <div class="table-rep-plugin">
                                <div class="table-responsive mb-0" data-pattern="priority-columns">
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
                                                <tr>
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


<?php $this->load->view('layout/footerA'); ?>
<!-- JS PLUGINS START  -->


<!-- Responsive-table RWD-->
<script src="<?= base_url(); ?>assets/plugins/RWD-Table-Patterns/dist/js/rwd-table.min.js"></script>
<script>
    $(function() {
        $('.table-responsive').responsiveTable({
            addDisplayAllBtn: 'btn btn-secondary'
        });
    });
</script>

<!-- JS PLUGINS END  -->
<?php $this->load->view('layout/footerB'); ?>