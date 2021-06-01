<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>List User</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>
	<h1> Tabel User </h1>

	<table class="table" border="1">
  	<thead>
  		<tr class="btn-primary">
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
  		<?php 
	  		$i = 1;
	  		foreach ($list_user as $user) {
  		?>
  		<tr>
  			<td><?php echo $i; ?></td>
  			<?php echo"<td><img src='".base_url("assets/images/user/".$user->foto)." ' /></td>"?>	
  			<td><?php echo $user->username; ?></td>
  			<td><?php echo $user->nama; ?></td>
  			<td><?php echo $user->email; ?></td>
  			<?php echo"
  				<td>
				<a href=".base_url("user/profile_user/".$user->id_user)."><button class='detail'>Detail</button></a>
				<a href=".base_url("user/edit_user/".$user->id_user)."><button class='ubah'>Ubah</button></a>
				<a href=".base_url("user/hapus_user/".$user->id_user)."><button class='hapus'>Hapus</button></a>
				</td>"?>
  			
  			<td>

  				<?php 
  				$active = $user->active;
  				if($active == 1)
  				{ ?>

  			  <a href="user/update_status?sid=<?php echo $user->id_user;?>&sval=<?php echo $user->active; ?>" class="btn btn-success">Aktif</a>
  			  <?php }else{ ?>

    		 <a href="user/update_status?sid=<?php echo $user->id_user;?>&sval=<?php echo $user->active; ?>" class="btn btn-danger">Nonaktif</a>

				<?php } ?>

  				
  			</td>
  		</tr>
  		<?php $i++; } ?>
  	</tbody>
</table>


	 <!-- <table class="table table-bordered" border="1">

				<th>NO</th>
				<th>Foto</th>
				<th>Username </th>
				<th>Nama</th>
				<th>Email</th>
				<th>Status</th>
				<th colspan="3">Aksi</th>
				<th>Aktif</th>
			</tr>

			<?php 
			$start = 0;
			if( ! empty($user))
		{
			
			foreach($user as $data)
			{
				 $active = $data->active==1?'AKTIF':'TIDAK AKTIF'; 
				 
				  ?>
				<?php echo"<tr>
				 
			    <td>".++$start."</td>
				<td><img src='".base_url("assets/uploads/".$data->foto)." ' /></td>	
				<td>".$data->username."</td>
				<td>".$data->nama."</td>
				<td> <center>".$data->email."</center></td>
				<td>".$active."</td>
				<td>
				<a href=".base_url("user/profile_user/".$data->id_user)."><button class='detail'>Detail</button></a>
				<a href=".base_url("user/edit_user/".$data->id_user)."><button class='ubah'>Ubah</button></a>
				<a href=".base_url("user/hapus_user/".$data->id_user)."><button class='hapus'>Hapus</button></a>
				</td>

				</tr>";
			}
		}
			?>
			<td> <select class="form-control" id="action" name="action">
				<option value="" disabled>Pilih Salah Satu</option>
				<option value="1" name="aktif">Aktif</option>
				<option value="0" name="nonaktif">Nonaktif</option>
				
			</select>
		</td>
		</table> -->
	</div>

</body>
</html>