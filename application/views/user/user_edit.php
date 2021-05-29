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
                 <td> <input type="text" name="active" required value="<?php echo set_value('active', $user->active); ?>" >
                </td>
            </tr>

            <!--  <tr>
                <td>Aktif</td>
                <td><?php echo form_dropdown('active',array('1'=>'AKTIF','0'=>'TIDAK AKTIF'),"class='form-control'");?></td>
             </tr>   
        -->



</table> <hr>
    <input class="ubah" type="submit" name="submit" value="Ubah">
    <a href="<?php echo base_url();?>">
    <input class="batal" type="button" value="Batal"></a>
    <?php echo form_close(); ?></div>
</hr> 
  
<div>
    <?php echo form_open_multipart('user/ubah_foto/'.$user->id_user); ?>
    <table>
        <tr>
            <td>Ganti Foto</td>
            <td><input type="file" name="foto" id="foto" accept="image/jpeg"> 
                </td>
        </tr>
    </table>
    <input class="ubah" type="submit" name="submit" value="Ubah">
    <a href="<?php echo base_url();?>">
    <input class="batal" type="button" value="Batal"></a>
<?php echo form_close(); ?></div>




    
</body>
</html>

