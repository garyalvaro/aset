<!DOCTYPE html>
<html>
<head>
	<title>Setujui Peminjaman</title>	
</head>
<body>
	
	<br>
	<h1>Form Persetujuan Peminjaman</h1>
	<br><br>
	<?php echo form_open_multipart('pinjam_barang/pinjam_setujui/'.$data->id_pinjamBarang); ?>
	<table>
		<tr>
				<td> ID Pinjam Barang </td>
				<td> <input type="text" name="id_pinjamBarang" value="<?php echo set_value('nama_barang', $data->id_pinjamBarang);?>"readonly>
				</td>
			</tr>

			<tr>
				<td> ID User </td>
				<td> <input type="text" name="id_user" required value="<?php echo set_value('id_user', $data->id_user); ?>"readonly>
				</td>
			</tr>

            <tr>
				<td> ID Barang</td>
				<td> <input type="text" name="id_barang" required value="<?php echo set_value('id_barang', $data->id_barang); ?>"readonly>
				</td>
			</tr>
            <tr>
				<td> Tanggal Pinjam</td>
				<td> <input type="text" name="tgl_pinjam" required value="<?php echo set_value('tgl_pinjam', $data->tgl_pinjam); ?>" readonly>
				</td>
			</tr>

            <tr>
				<td> Tanggal Pengembalian</td>
				<td> <input type="text" name="tgl_pengembalian" required value="<?php echo set_value('tgl_pengembalian', $data->tgl_pengembalian); ?>" readonly>
				</td>
			</tr>

            <tr>
				<td> Jumlah</td>
				<td> <input type="text" name="qty" required value="<?php echo set_value('qty', $data->qty); ?>"readonly>
				</td>
			</tr>

            <tr>
				<td> Status Peminjaman</td>
				<td> <input type="text" name="status_peminjaman" required value="<?php echo set_value('status_peminjaman', $data->status_peminjaman); ?>"readonly>
				</td>
			</tr>

            <tr>
				<td> Alasan Peminjaman</td>
				<td> <input type="text" name="alasan_peminjaman" required value="<?php echo set_value('alasan_peminjaman', $data->alasan_pinjam); ?>"readonly>
				</td>
			</tr>

            <tr>
				<td> Deskripsi Persetujuan</td>
				<td> <input type="text" name="deskripsi_acc" required value="<?php echo set_value('deskripsi_acc', $data->deskripsi_acc); ?>" readonly>
				</td>
			</tr>

            <tr>
				<td> Action Datetime</td>
				<td> <input type="text" name="action_datetime" required value="<?php echo set_value('action_datetime', $data->action_datetime); ?>" readonly>
				</td>
			</tr>

			
</table>

<hr>
	<input class="ubah" type="submit" name="submit" value="Setujui">
	<a href="<?php echo base_url();?>">
	<input class="batal" type="button" value="Batal"></a>
	<?php echo form_close(); ?></div>




	
</body>
</html>