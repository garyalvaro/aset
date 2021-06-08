<?php $this->load->view('layout/headerA'); ?>
    <!-- CSS PLUGINS START  -->

    

    <!-- CSS PLUGINS END  -->
<?php $this->load->view('layout/headerB'); ?>

<?php $this->load->view('layout/navbar'); ?>


<div class="wrapper">
	<div class="container-fluid">
		<div class="row">
            <div class="col-sm-7">
                <div class="card m-b-20 p-3">
					<div class="card-body">
                        <img src="<?= base_url(); ?>assets/images/logo.png" alt="" width="200px" class="mb-3">
                        <h4 class="mt-0 header-title">
                            Fakultas Ilmu Komputer dan Teknologi Informasi <br>
                            Universitas Sumatera Utara
                        </h4>
                        <br>
                        <address>
                            <strong class="text-muted">Alamat</strong><br>
                            Jalan Universitas No. 9A, Kampus USU <br>
                            Padang Bulan, Medan, Sumatera Utara 20155
                        </address>
                        <br>
                        <address>
                            <strong class="text-muted">Telp: </strong>(061) 8210077 <br>
                            <strong class="text-muted">Email: </strong><a href="mailto:fasilkom-ti@usu.ac.id">fasilkom-ti@usu.ac.id</a>
                        </address>
                        <br>
                        <a href="https://www.instagram.com/fasilkomti_usu/"><span class="mdi mdi-instagram font-30 mr-3"></span></a>
                        <a href="https://www.youtube.com/channel/UC7qoM5FlUkKzRfTl74bvNug"><span class="ti-youtube font-30 mr-3"></span></a>
                        <a href="https://www.facebook.com/fasilkomti.official/"><span class="mdi mdi-facebook font-30 mr-3"></span></a>
                    </div>
                </div>
            </div>

            <div class="col-sm-5">
                <div class="card m-b-20">
                    <div class="card-body">
                        <h4 class="mt-0 header-title">Peta Lokasi Alamat</h4>
                        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d497.7634536956341!2d98.6593324!3d3.5626871!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30312fdfa236d79d%3A0xed59d4a111e7331!2sFaculty%20of%20Computer%20Science%20and%20Information%20Technology!5e0!3m2!1sen!2sid!4v1623155933888!5m2!1sen!2sid" width="100%" height="350px" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
            </div>

            
			

        </div>
    </div>
</div>

<?php $this->load->view('layout/footerA'); ?>
<!-- JS PLUGINS START  -->

<!-- JS PLUGINS END  -->
<?php $this->load->view('layout/footerB'); ?>