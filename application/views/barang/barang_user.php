<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>List Barang</title>
</head>
<body>
	<h1> List Barang Users </h1>
	<div class="table">
		<table>
			<tr>
				<th>Nama </th>
				<th>Deskripsi</th>
				<th>Foto</th>
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
				<td><a href=".base_url('pinjam_barang/pinjam_user/'.$data->id_barang)."><button class='ubah'>Pinjam</button></a></td>
				</tr>";
			}
		}
			?>
		</table>

</body>
</html>