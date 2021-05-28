<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Form update barang</title>
</head>
<body>

	<?php echo form_open_multipart('barang/editStok/'.$barang->id_barang); ?>
	<br>
	<h1>Form Update Stok Data Barang</h1>
	<br><br>
	<table>
		<!-- <tr>
			<td>id_barang</td>
			<td>
				<input type="text" name="id_barang" value="<?php echo set_value('id_barang', $data->id_barang);?>"></td>
		</tr> -->
		<tr>
			<td> <select class="form-control" id="action" name="action">
				<option value="" disabled>Pilih Salah Satu</option>
				<option value="rusak" name="0">Rusak</option>
				<option value="1" name="pinjam">Pinjam</option>
				<option value="2" name="kembalikan">Kembalikan</option>
				<option value="3" name="tambah">Tambah</option>
			</select>
		</td>
		</tr> 
		<tr>
			<td>Deskripsi</td>
			<td><input type="text" name="deskripsi"></td>
		</tr>
		<tr>
			<td>Jumlah</td>
			<td><input type="text" name="qty"></td>
		</tr>
	</table>
<hr>
	<input class="ubah" type="submit" name="submit" value="ubah">
	<?php echo form_close(); ?></div>

</body>
</html>