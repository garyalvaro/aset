<!DOCTYPE html>
<html>
<head>
    <title>Profile User</title>  
</head>
<body>
        <br>
    <h1>Profile User</h1>
    
            <table class="table table-bordered">
          
       
        <?php echo"<tr><td> <img src=' ".base_url("assets/uploads/".$foto)." ' /></td> "?>      
        <tr><td>Username</td><td>:</td><td><?php echo $username; ?></td></tr>
        <tr><td>Nama</td><td>:</td><td><?php echo $nama; ?></td></tr>
        <tr><td>NIM</td><td>:</td><td><?php echo $nim; ?></td></tr>
        <tr><td>Email</td><td>:</td><td><?php echo $email; ?></td></tr>

      
               
    </table>
</body>
</html>

