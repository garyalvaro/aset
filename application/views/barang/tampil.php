<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>List Barang Admin</title>
</head>
<body>
	<h1> List Barang </h1>
	<div class="table">
		<table>
			<tr>
				<th>Nama </th>
				<th>Deskripsi</th>
				<th>Foto</th>
				
				<!-- bagian xixil 
				<th>Stok</th>
				-->

				<th colspan="2">Action</th>
			</tr>

			<?php
			if( ! empty($barang))
		{
			foreach($barang as $data)
			{
				echo"<tr>
				<td>".$data->nama_barang."</td>
				<td>".$data->deskripsi."</td>
				<td> <img src='".base_url("assets/images/barang/".$data->foto)."'/></td>

				<td><a href=".base_url("barang/editBarang/".$data->id_barang)."><button class='ubah'>Ubah</button></a></td>
				<td><a href= ".base_url("barang/editStok/".$data->id_barang)." ><button class='hapus'>Update Stok</button></a></td>
				</tr>";
			}
		}
			?>
		</table>

</body>
</html>