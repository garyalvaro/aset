<?php $this->load->view('layout/headerA'); ?>
    <!-- CSS PLUGINS START  -->

    <!-- DataTables -->
    <link href="<?= base_url(); ?>assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url(); ?>assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="<?= base_url(); ?>assets/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <!-- CSS PLUGINS END  -->
<?php $this->load->view('layout/headerB'); ?>

<?php $this->load->view('layout/navbar'); ?>


<div class="wrapper">
    <div class="container-fluid">
        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Foto</th>
                    <th>Username</th> 
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Aksi</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>
                <?php $i=1; foreach ($list_user as $user) : ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><img src="<?=base_url("assets/images/user/".$user->foto)?>" alt="" style="width:100px; height:100px; object-fit:cover; object-position:0 0; border-radius:50%;"></td>	
                    <td><?php echo $user->username; ?></td>
                    <td><?php echo $user->nama; ?></td>
                    <td><?php echo $user->email; ?></td>
                    <td>
                        <a href="<?=base_url("user/profile_user/".$user->id_user)?>" class="btn btn-primary">Detail</a>
                        <a href="<?=base_url("user/edit_user/".$user->id_user)?>" class="btn btn-info"><span class="mdi mdi-pencil"></span></a>
                        <a href="<?=base_url("user/hapus_user/".$user->id_user)?>" class="btn btn-danger"><span class="mdi mdi-delete"></span></a>
                    </td>
                                        
                    <td>
                        <?php if($user->active == 1): ?>
                            <a href="<?= base_url('User/update_status_byid/'.$user->id_user.'/'.$user->active); ?>" class="btn btn-success">Aktif</a>
                        <?php else:  ?>
                            <a href="<?= base_url(); ?>user/update_status?sid=<?php echo $user->id_user;?>&sval=<?php echo $user->active; ?>" class="btn btn-danger">Nonaktif</a>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php $i++; endforeach; ?>
            </tbody>
        </table>
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
            $('#datatable').DataTable();
        } );
    </script>
<!-- JS PLUGINS END  -->
<?php $this->load->view('layout/footerB'); ?>