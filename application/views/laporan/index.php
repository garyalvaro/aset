<?php $this->load->view('layout/headerA'); ?>
    <!-- CSS PLUGINS START  -->

    

    <!-- CSS PLUGINS END  -->
<?php $this->load->view('layout/headerB'); ?>

<?php $this->load->view('layout/navbar'); ?>


<?php
if($this->session->userdata('level')!=1)
    redirect('Barang/tampil_barang_users');
?>


<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card m-b-20">
                    <div class="card-body">

                        <div class="row">
                            <div class="col-12">
                                <div class="invoice-title">
                                    <h4 class="float-right font-16 text-right">
                                        <br><strong>Laporan Peminjaman</strong>
                                    </h4>
                                    <h3 class="mt-0">
                                        <img src="<?=base_url()?>assets/images/logo.png" alt="logo" height="60"/>
                                    </h3>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-6">
                                        <address>
                                            <strong>Fakultas Ilmu Komputer dan Teknologi Informasi</strong><br>
                                            <strong>Universitas Sumatera Utara</strong><br>
                                            Jl. Alumni No.3 <br>
                                            Padang Bulan, Medan Baru <br>
                                            Kota Medan <br>
                                            Sumatera Utara 20155
                                        </address>
                                    </div>
                                    <div class="col-6 text-right">
                                        <address>
                                            <strong>Periode</strong><br>
                                            <?=$tgl_mulai;?> &nbsp; s.d. &nbsp; <?=$tgl_selesai;?>
                                        </address>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div>
                                    <div class="p-2">
                                        <h3 class="font-16"><strong>Ringkasan Peminjaman</strong></h3>
                                    </div>
                                    <div class="">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                <tr>
                                                    <td><strong>Item</strong></td>
                                                    <td class="text-center"><strong>Jumlah</strong></td>
                                                    <td class="text-center"><strong>Peminjam</strong></td>
                                                    <td class="text-center"><strong>Durasi Peminjaman</strong></td>
                                                    <td class="text-center"><strong>Waktu Peminjaman</strong></td>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach($laporan as $data) :?>
                                                        <tr>
                                                            <td><?=$data->nama_barang?></td>
                                                            <td class="text-center"><?=$data->qty?></td>
                                                            <td class="text-center"><?=$data->nama?></td>
                                                            <td class="text-center"><?=$data->durasi?> hari</td>
                                                            <td class="text-center"><?=$data->action_datetime?></td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>

                                        <div>
                                            <h3 class="font-14"><strong>Total Peminjaman :</strong><?=$record;?></h3>
                                        </div>

                                        <div class="row my-5">
                                            <div class="col-sm-8"></div>
                                            <div class="col-sm-4 text-center">
                                                Medan, <?=date('d F Y');?>
                                                <br><br><br><br>
                                                (<u><?=$this->session->userdata('nama')?></u>)
                                            </div>
                                        </div>

                                        <div class="d-print-none">
                                            <div class="float-right">
                                                <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light"><i class="fa fa-print"></i> Cetak</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div> <!-- end row -->

                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->


    </div> <!-- end container-fluid -->
</div>
<!-- end wrapper -->



<?php $this->load->view('layout/footerA'); ?>
<!-- JS PLUGINS START  -->



<!-- JS PLUGINS END  -->
<?php $this->load->view('layout/footerB'); ?>