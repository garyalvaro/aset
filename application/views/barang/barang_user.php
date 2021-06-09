<?php $this->load->view('layout/headerA'); ?>
    <!-- CSS PLUGINS START  -->

    <!-- Sweet Alert -->
    <link href="<?=base_url()?>assets/plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css">

    <!-- CSS PLUGINS END  -->
<?php $this->load->view('layout/headerB'); ?>

<?php $this->load->view('layout/navbar'); ?>


<?php
if($this->session->flashdata())
{
    if($this->session->flashdata('pinjam_sukses'))
        echo "<span id='pinjam_sukses'></span>";
}
?>

<!-- Truncate String JS -->
<script>
    function ellipsify (str) {
        if (str.length > 20) 
            return document.write(str.substring(0, 100) + "...");
        else 
            return document.write(str);
    }
</script>

<div class="wrapper">
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-12">
                <div class="card m-b-30 card-body">
                    <h4 class="card-title font-16 mt-0">Cari Barang</h4>
                    <input type="text" placeholder="Apa yang ingin dicari?" class="form-control form-control-lg" id="myInput" onkeyup="search()">
                </div>
            </div>
        </div>
                        
        <div class="row"> 
            <?php if( ! empty($barang)): ?>
                <?php foreach($barang as $data): ?>  

                    <div class="col-md-6 col-lg-6 col-xl-3 divBesar">
                        <!-- Simple card -->
                        <div class="card m-b-30">
                            <img class="card-img-top img-fluid child" style="object-fit:cover;" src="<?= base_url("assets/images/barang/".$data->foto); ?>" alt="">
                            <div class="card-body">
                                <h4 class="card-title font-16 mt-0 judul"><?= $data->nama_barang; ?></h4>
                                <p class="card-text" id="target">
                                    <script>ellipsify("<?= $data->deskripsi; ?>");</script>
                                </p>
                                <a href="<?=base_url('pinjam_barang/pinjam_user/'.$data->id_barang);?>" class="btn btn-info waves-effect waves-light">Pinjam</a>
                            </div>
                        </div>
                    </div>

                <?php endforeach; ?>
            <?php endif; ?>    
        </div>

            
        <!-- end row -->
    </div> <!-- end container-fluid -->
</div>
<!-- end wrapper -->


<?php $this->load->view('layout/footerA'); ?>
<!-- JS PLUGINS START  -->

<!-- Search Script -->
<script>
    function search()
    {
        var judul, i, txtValue, input, filter, divBesar;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        divBesar = document.getElementsByClassName("divBesar"); 
        for (i = 0; i < divBesar.length; i++) {
            judul = divBesar[i].getElementsByClassName("judul")[0];
            
            if (judul) {
                txtValue = judul.textContent || judul.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    divBesar[i].style.display = "";
                } else {
                    divBesar[i].style.display = "none";
                }
            }       
        }
    }
</script>

<!-- Sweet-Alert  -->
<script src="<?=base_url()?>assets/plugins/sweet-alert2/sweetalert2.min.js"></script>
<script>
!function ($) {
    "use strict";
    var SweetAlert = function () {};

    SweetAlert.prototype.init = function () {
        //Success Message
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

    },
    //init
    $.SweetAlert = new SweetAlert, $.SweetAlert.Constructor = SweetAlert
}(window.jQuery),

//initializing
    function ($) {
        "use strict";
        $.SweetAlert.init()
    }(window.jQuery);
</script>
<script type="text/javascript">
    var cw = $('.child').width();
    $('.child').css({
        'height': cw + 'px'
    });
</script>

<!-- JS PLUGINS END  -->
<?php $this->load->view('layout/footerB'); ?>
