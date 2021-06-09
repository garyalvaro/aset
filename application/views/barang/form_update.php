<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Form update barang</title>
</head>
<body>

	<?php echo form_open_multipart('barang/editStok/'.$barang->id_barang); ?>
	<br>
	<h1>Form Update Stok Data Barang <?=$barang->nama_barang?></h1>
	<br><br>
	<table>
		<!-- <tr>
			<td>id_barang</td>
			<td>
				<input type="text" name="id_barang" value="<?php echo set_value('id_barang', $data->id_barang);?>"></td>
		</tr> -->
		<tr>
			<td>Stok sekarang : <?= $this->M_data->cek_stok($barang->id_barang) ?></td>
		</tr>
		<tr>
			<td> 
				<select class="form-control" id="id_action" name="id_action">
   					<?php $p = set_value('nama_action'); ?>
					<option value="" disabled>Pilih Salah Satu</option>
					<?php foreach($action as $row):?>
						<option value="<?= $row->id_action; ?>" <?php if($p==$row->nama_action){ echo 'selected'; } ?> >
							<?= ucfirst($row->nama_action); ?>
						</option>
   					<?php endforeach; ?>
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