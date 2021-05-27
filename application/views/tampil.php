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
	<h1> List Barang </h1>
	<div class="table">
		<table>
			<tr>
				<th>Nama </th>
				<th>Deskripsi</th>
				<th>Foto</th>
				<th>Satuan</th>
			</tr>

			<?php
			if( ! empty($barang))
		{
			foreach($barang as $data)
			{
				echo"<tr>
				<td>".$data->nama_barang."</td>
				<td>".$data->deskripsi."</td>
				<td> <img src='".base_url('images/bebek.jpg')."'/></td>
				<td>".$data->id_satuan."</td>
				</tr>";
			}
		}
			?>
		</table>

</body>
</html>