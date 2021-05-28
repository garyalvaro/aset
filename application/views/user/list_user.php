<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>List User</title>
</head>
<body>
	<h1> Tabel User </h1>
	<div class="table">
		<table border="1">
			<tr>
				<th>Foto</th>
				<th>Username </th>
				<th>Nama</th>
				<th>Email</th>
				<th>Aktif</th>
				<th colspan="2">Action</th>
			</tr>

			<?php
			if( ! empty($user))
		{
			
			foreach($user as $data)
			{
				 $active = $data->active==1?'AKTIF':'TIDAK AKTIF';
				  ?>
			<?php	  
				echo"<tr>
				<td> <img src='".base_url("assets/uploads/".$data->foto)." ' /></td>
				
				<td>".$data->username."</td>
				<td>".$data->nama."</td>
				<td> <center>".$data->email."</center></td>
				<td>".$active."</td>
				<td><a href=".base_url("user/edit_user/".$data->id_user)."><button class='ubah'>Ubah</button></a></td>
				<td><a href= ".base_url("user/hapus_user/".$data->id_user)." ><button class='hapus'>Hapus</button></a></td>
				</tr>";
			}
		}
			?>
		</table>
	</div>

</body>
</html>