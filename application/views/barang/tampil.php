<?php $this->load->view('layout/headerA'); ?>
<!-- CSS PLUGINS START  -->

	<!-- Bootstrap Touchspin css -->
	<link href="<?=base_url();?>assets/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />

<!-- CSS PLUGINS END  -->
<?php $this->load->view('layout/headerB'); ?>

<?php $this->load->view('layout/navbar'); ?>



<div class="wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="card m-b-30 card-body">
                            <h4 class="card-title font-16 mt-0">Tambah Aset</h4>
                            <a href="<?= base_url("barang/tambahBrg") ?>" class="btn btn-primary waves-effect waves-light"><i class="mdi mdi-plus-circle-outline"></i> Tambah</a>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="card m-b-30 card-body">
                            <h4 class="card-title font-16 mt-0">Cari Barang</h4>
                            <input type="text" placeholder="Apa yang ingin dicari?" class="form-control form-control-lg" id="myInput" onkeyup="search()">
                        </div>
                    </div>
                </div>
                
                
                <div class="row"> 
                    <?php if( ! empty($barang)): ?>
                        <?php foreach($barang as $data): ?>  
                            <div class="col-6 col-md-6 col-lg-6 col-xl-3 divBesar">
                                <!-- Simple card -->
                                <div class="card m-b-30">
                                    <img class="card-img-top img-fluid" src="<?= base_url("assets/uploads/".$data->foto); ?>" alt="">
                                    <div class="card-body">
                                        <h4 class="card-title font-16 mt-0 judul"><?= $data->nama_barang; ?></h4>
                                        <p>Tersisa <b><?= $this->M_data->cek_stok($data->id_barang)?></b></p>
                                        <p class="card-text"><?= $data->deskripsi; ?></p>
                                        <a href="<?=base_url("barang/editBarang/".$data->id_barang);?>" class="btn btn-outline-secondary waves-effect waves-light m-b-10">Edit Data</a>
                                        <button type="button" class="btn btn-primary waves-effect waves-light m-b-10" data-toggle="modal" data-target=".bs-example-modal-sm<?= $data->id_barang; ?>">Update Stok</button>
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

        
        <?php if( ! empty($barang)): ?>
        <?php foreach($barang as $data): ?> 
        <div class="modal fade bs-example-modal-sm<?= $data->id_barang; ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0" id="mySmallModalLabel">Edit Stok <?= $data->nama_barang; ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <?php echo form_open_multipart('barang/editStok/'.$data->id_barang); ?>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    Stok sekarang: <?= $this->M_data->cek_stok($data->id_barang) ?> 
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="alasan" class="col-sm-12 col-form-label">Alasan Ubah Stok</label>
                                <div class="col-sm-12">
                                    <select class="form-control" id="id_action" name="id_action" required>
                                        <?php $p = set_value('nama_action'); ?>
                                        <option value="" disabled>Pilih Alasan</option>
                                        <?php foreach($action as $row):?>
                                            <option value="<?= $row->id_action; ?>" <?php if($p==$row->nama_action){ echo 'selected'; } ?> >
                                                <?= ucfirst($row->nama_action); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="deskripsi" class="col-sm-12 col-form-label">Deskripsi</label>
                                <div class="col-sm-12">
                                    <textarea class="form-control" id="deskripsi" name="deskripsi" autocomplete="off"></textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="deskripsi" class="col-sm-12 col-form-label">Jumlah</label>
                                <div class="col-sm-12">
                                    <input id="qty" type="text" name="qty" value="1">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-12 text-right m-t-20">
                                    <button class="btn btn-outline-secondary" data-dismiss="modal" aria-hidden="true">Batal</button>
                                    &nbsp; &nbsp;
                                    <input class="btn btn-primary" type="submit" name="submit" value="Simpan">
                                </div>
                            </div>

                        <?php echo form_close(); ?></div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <?php endforeach; ?>
        <?php endif; ?> 

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


<!-- Bootstrap Touchpin js -->
<script src="<?=base_url()?>assets/plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js"></script>
<script type="text/javascript">
!function($) {
    "use strict";

    var AdvancedForm = function() {};
    
    AdvancedForm.prototype.init = function() {

		$("input[name='qty']").TouchSpin({
			min: 1,
			step: 1,
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