<!DOCTYPE html>
<html>
<head>
    <title>Edit Profile User</title>  
</head>
<body>
      
         <div style="color: red;"><?php echo validation_errors(); ?></div>
     

    <?php echo form_open_multipart('user/edit_user/'.$user->id_user); ?>
    <br>
    <h1>Edit Profile User</h1>
    <br><br>
    <table>
            <tr>
                <td>Username</td>
                <td> <input type="text" name="username" required value="<?php echo set_value('username', $user->username);?>" placeholder="Masukan Username">
                </td>
            </tr>

            <tr>
                 <td>Nama</td>            
                 <td><input type="text" name="nama" required value="<?php echo set_value('nama', $user->nama); ?>" placeholder="Masukan Nama">
                </td>
            </tr>

             <tr>
                <td>Email</td>
                 <td> <input type="email" name="email" required value="<?php echo set_value('email', $user->email); ?>"placeholder="Masukan Email" >
                </td>
            </tr>
             <tr>
                <td>NIM</td>
                <td> <input type="text" name="nim" required value="<?php echo set_value('nim', $user->nim); ?>"placeholder="Masukan NIM">
                </td>
            </tr>
             <tr>
                <td>Password</td>
                <td> <input type="password" name="password" required value="<?php echo set_value('password', $user->password); ?>"placeholder="Masukan Password" >
                </td>
            </tr> 
             <tr>
                <td>Konfirmasi Password</td>
                <td> <input type="password" name="konfirmasi_password" required placeholder="Masukan Password terbaru" >
                </td>
            </tr> 


</table> <hr>
    <input class="ubah" type="submit" name="submit" value="Ubah">
    <a href="<?php echo base_url("user");?>">
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
    <a href="<?php echo base_url("user");?>">
    <input class="batal" type="button" value="Batal"></a>
<?php echo form_close(); ?></div>




    
</body>
</html>

