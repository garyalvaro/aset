<!DOCTYPE html>
<html>
<head>
    <title>form Tambah</title>  
</head>
<body>
    <?php echo form_open_multipart('user/edit_user/'.$user->id_user); ?>
    <br>
    <h1>Form Ubah Data User</h1>
    <br><br>
    <table>
            <tr>
                <td> Username </td>
                <td> <input type="text" name="username" value="<?php echo set_value('username', $user->username);?>">
                </td>
            </tr>

            <tr>
                <td> Nama</td>
                <td> <input type="text" name="nama" required value="<?php echo set_value('nama', $user->nama); ?>" >
                </td>
            </tr>

             <tr>
                <td> Email</td>
                <td> <input type="text" name="email" required value="<?php echo set_value('email', $user->email); ?>" >
                </td>
            </tr>
            <tr>
                <td>Aktif</td>
                <td>
                    <select class="form-control" id="active" name="active">
                    <?php $p = set_value('active',$user->active); ?>
                                    
                                    <?php foreach($active as $row):?>
                                        <option value="<?= $row->active; ?>" <?php if($p==$row->active){ echo 'selected'; } ?> >
                                            <?= ucfirst($row->active); ?>
                                        </option>
                    <?php endforeach; ?>
                </td>
            </tr>

            <!--  <tr>
                <td>Aktif</td>
                <td><?php echo form_dropdown('active',array('1'=>'AKTIF','0'=>'TIDAK AKTIF'),"class='form-control'");?></td>
             </tr>   
        -->

</table>

<hr>
    <input class="ubah" type="submit" name="submit" value="Ubah">
    <a href="<?php echo base_url();?>">
    <input class="batal" type="button" value="Batal"></a>
    <?php echo form_close(); ?></div>

<!-- <div>
    <?php echo form_open_multipart('barang/editFoto/'.$barang->id_barang); ?>
    <table>
        <tr>
            <td>Foto barang</td>
            <td><input type="file" name="foto" id="foto" accept="image/jpeg"> 
                </td>
        </tr>
    </table>
    <input class="ubah" type="submit" name="submit" value="Ubah">
    <a href="<?php echo base_url();?>">
    <input class="batal" type="button" value="Batal"></a>
<?php echo form_close(); ?></div>

<div>
    <?php echo form_open_multipart('barang/hapus/'.$barang->id_barang); ?>
    <?php echo 
    "<a href=".base_url("barang/hapus/".$barang->id_barang)."><button class='hapus'>Hapus</button></a>"
    ?>
    <?php echo form_close(); ?></div> -->
    
</body>
</html>

