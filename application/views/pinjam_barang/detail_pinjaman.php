<?php $this->load->view('layout/headerA'); ?>
<!-- CSS PLUGINS START  -->

    <!-- Sweet Alert -->
    <link href="<?=base_url()?>assets/plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css">

<!-- CSS PLUGINS END  -->
<?php $this->load->view('layout/headerB'); ?>

<?php $this->load->view('layout/navbar'); ?>

<?php
if($this->session->userdata('level')==1)
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
                        <img src="<?php echo base_url()."assets/images/user/".$detail->foto_user;?>" alt="" class="rounded-circle"  style="width:50px; height:50px; object-fit:cover; object-position:0 0;">
                        <b class="font-18 ml-2"><?=$detail->nama;?></b>
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
                            <h4 class="mt-0 header-title">Status peminjaman Anda pada saat ini :</h4>
                            <div class="alert alert-warning">
                                Peminjaman sedang <strong>dalam proses Persetujuan Admin</strong>.
                            </div>
                            <p>Mohon menunggu pemberitahuan selanjutnya melalui email.</p>
                            <div class="d-grid">
                                <button class="btn btn-lg btn-outline-secondary waves-effect"  style="width: 100%" id="batalkan">Batalkan Request Pinjaman</button>
                            </div>
                        </div>
                    </div>
                <?php elseif($detail->status_peminjaman == 1): ?>
                    <div class="card m-b-20">
                        <div class="card-body">
                            <h4 class="mt-0 header-title">Status peminjaman Anda pada saat ini :</h4>
                            <div class="alert alert-success">
                                Peminjaman <strong>Diterima</strong>, dengan alasan: <br>
                                <p style='margin-bottom:0; color:#666'>
                                <?php 
                                    if($detail->deskripsi_acc == "")
                                        echo "Selamat, peminjaman anda diterima";
                                    else
                                        echo $detail->deskripsi_acc;
                                ?>
                                </p>
                            </div>
                            <p>Mohon melakukan pengambilan barang pada waktu yang ditentukan pada jadwal berikut ini.</p>
                            <table style="float: left; display: contents;">
                                <tr>
                                    <td width="15%">Tanggal </td>
                                    <td>: </td>
                                    <td><?=$detail->tgl_pinjam?></td>
                                </tr>
                                <tr>
                                    <td>Waktu </td>
                                    <td>: </td>
                                    <td>08.00 - 15.00 </td>
                                </tr>
                                <tr>
                                    <td style="float: left">Lokasi </td>
                                    <td style="vertical-align: -webkit-baseline-middle;">: </td>
                                    <td>Gedung Fasilkom-TI USU<br>Jl. Alumni No.3, Padang Bulan, Medan Baru, Medan City, North Sumatra 20155</td>
                                </tr>
                            </table>
                            <br>
                            <p>Mohon siapkan <b>Kartu Tanda Pengenal</b> Anda sebagai Jaminan Peminjaman Barang di Sistem Informasi Aset Fasilkom-TI USU.</p>

                        </div>
                    </div>
                <?php elseif($detail->status_peminjaman == 2): ?>
                    <div class="card m-b-20">
                        <div class="card-body">
                            <h4 class="mt-0 header-title">Status peminjaman Anda pada saat ini :</h4>
                            <div class="alert alert-danger">
                                Peminjaman <strong>Ditolak</strong>
                                
                                <?php 
                                    if($detail->deskripsi_acc != "")
                                        echo ", dengan alasan: <br><p style='margin-bottom:0; color:#666'>".$detail->deskripsi_acc."</p>";
                                ?>
                            </div>
                            <p style='margin-bottom:0;'>Mohon maaf peminjaman Anda belum diterima pada saat ini.</p>
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
                    <?php if (!empty($rusak)) { ?>
                        <div class="card m-b-20">
                            <div class="card-body">
                                <h4 class="mt-0 header-title">Kerusakan Barang</h4>
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
                            </div>
                        </div>
                    <?php } //Tutup If empty ?>
                    
                    <div class="card m-b-20">
                        <div class="card-body">
                            <h4 class="mt-0 header-title">Lanjutkan Peminjaman?</h4>
                            <div class="d-grid">
                                <a href="<?php echo base_url('pinjam_barang/pinjam_user/').$detail->id_barang;;?>" class="btn btn-info btn-lg waves-effect"  style="width: 100%">Request Pinjaman lagi</a>
                            </div>
                        </div>
                    </div>
                <?php endif; //Tutup If status peminjaman ?>
            </div>

        </div><!-- end row gede -->
    </div>
</div>


<?php $this->load->view('layout/footerA'); ?>
<!-- JS PLUGINS START  -->

<!-- Sweet-Alert  -->
<script src="<?=base_url()?>assets/plugins/sweet-alert2/sweetalert2.min.js"></script>
<script>
    var nama = "<?=$this->session->userdata('nama')?>";
    var barang = "<?=$detail->nama_barang?>";
    var tgl_pinjam = "<?=$detail->tgl_pinjam?>";
    var tgl_pengembalian = "<?=$detail->tgl_pengembalian?>";
    var link = '<?=base_url('pinjam_barang/batalkan/'.$detail->id_pinjamBarang);?>';
    $('#batalkan').on('click',function(e){
        e.preventDefault();
        
        Swal.fire({
            title: "Apakah Anda yakin ingin membatalkan?",
            text: "Peminjaman "+barang+" atas nama "+nama+" dari tanggal "+tgl_pinjam+" sampai "+tgl_pengembalian+"?",
            type: "question",
            showCancelButton: true,
            confirmButtonColor: "#58db83",
            cancelButtonColor: "#ec536c",
            confirmButtonText: "Benar, Lanjutkan!"
            }).then(function (result) {
            if (result.value) {
                window.location.href = link;
            }
        });
    });
</script>



<!-- JS PLUGINS END  -->
<?php $this->load->view('layout/footerB'); ?>