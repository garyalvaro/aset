
        <!-- Navigation Bar-->
        <header id="topnav">
            <div class="topbar-main">
                <div class="container-fluid">

                    <!-- Logo container-->
                    <div class="logo">
                        
                        <a href="<?= base_url(); ?>" class="logo">
                            <img src="<?= base_url(); ?>assets/images/logo-sm.png" alt="" class="logo-small">
                            <img src="<?= base_url(); ?>assets/images/logo.png" alt="" class="logo-large">
                        </a>

                    </div>
                    <!-- End Logo container-->


                    <div class="menu-extras topbar-custom">

                        <ul class="float-right list-unstyled mb-0 ">
                            
                            <li class="dropdown notification-list">
                                <div class="dropdown notification-list nav-pro-img">
                                    <a class="dropdown-toggle nav-link arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                        <?php $foto = $this->session->userdata('foto'); ?>
                                        <img src="<?= base_url(); ?>assets/images/user/<?= $this->session->userdata('foto'); ?>" alt="user" class="rounded-circle" style="object-fit:cover; object-position:0 0;">
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                                        <!-- item-->
                                        <h6 class="dropdown-item"><?= $this->session->userdata('username'); ?></h6>
                                        <a class="dropdown-item" href="<?= base_url(); ?>User/edit_user/<?= $this->session->userdata('id_user'); ?>"><i class="mdi mdi-account-circle m-r-5"></i> Profile</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item text-danger" href="<?= base_url(); ?>Account/logout"><i class="mdi mdi-power text-danger"></i> Logout</a>
                                    </div>                                                                    
                                </div>
                            </li>
                            <li class="menu-item">
                                <!-- Mobile menu toggle-->
                                <a class="navbar-toggle nav-link" id="mobileToggle">
                                    <div class="lines">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </div>
                                </a>
                                <!-- End mobile menu toggle-->
                            </li>    
                        </ul>
                    </div>
                    <!-- end menu-extras -->

                    <div class="clearfix"></div>

                </div> <!-- end container -->
            </div>
            <!-- end topbar-main -->

            <div class="container-fluid">
                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <h4 class="page-title">Hai, <?= $this->session->userdata('nama') ?></h4>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active">
                                    Selamat Datang di Sistem Informasi Aset Fasilkom-TI USU
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <?php if($this->session->userdata('level')==1): ?>
            <!-- MENU Admin -->
            <div class="navbar-custom">
                <div class="container-fluid">
                    <div id="navigation">
                        <!-- Navigation Menu-->
                        <ul class="navigation-menu">
                            <li class="has-submenu">
                                <a href="<?=base_url()?>Pinjam_barang/tampil_peminjam"><i class="ti-receipt"></i>Transaksi</a>
                            </li>

                            <li class="has-submenu">
                                <a href="<?=base_url()?>Barang/tampil_barang"><i class="ti-package"></i>Daftar Aset</a>
                            </li>

                            <li class="has-submenu">
                                <a href="<?=base_url()?>Barang/tambahBrg"><i class="ti-plus"></i>Tambah Aset</a>
                            </li>

                            <li class="has-submenu">
                                <a href="<?=base_url()?>Barang/barangRusak"><i class="ti-archive"></i>Aset Rusak</a>
                            </li>

                            <li class="has-submenu">
                                <a href="<?=base_url()?>User"><i class="ti-user"></i>Pengguna</a>
                            </li>
                            
                            <li class="has-submenu">
                                <a href="<?=base_url('Welcome/AboutUs')?>"><i class="ti-agenda"></i>Tentang Kami</a>
                            </li>


                        </ul>
                        <!-- End navigation menu -->
                    </div> <!-- end navigation -->
                </div> <!-- end container-fluid -->
            </div> <!-- end navbar-custom -->

            <?php else: ?>
            <!-- MENU User Biasa -->
            <div class="navbar-custom">
                <div class="container-fluid">
                    <div id="navigation">
                        <!-- Navigation Menu-->
                        <ul class="navigation-menu">
                        
                            <li class="has-submenu">
                                <a href="<?=base_url()?>Barang/tampil_barang_users"><i class="ti-package"></i>Daftar Aset</a>
                            </li>

                            <li class="has-submenu">
                                <a href="<?=base_url('Pinjam_barang/user/'.$this->session->userdata('id_user'))?>"><i class="ti-receipt"></i>Pinjaman Saya</a>
                            </li>

                            <li class="has-submenu">
                                <a href="<?=base_url('User/edit_user/'.$this->session->userdata('id_user'))?>"><i class="ti-user"></i>Ubah Profil</a>
                            </li>

                            <li class="has-submenu">
                                <a href="<?=base_url('Welcome/AboutUs')?>"><i class="ti-agenda"></i>Tentang Kami</a>
                            </li>

                        </ul>
                        <!-- End navigation menu -->
                    </div> <!-- end navigation -->
                </div> <!-- end container-fluid -->
            </div> <!-- end navbar-custom -->
            <?php endif; ?>



        </header>
        <!-- End Navigation Bar-->
