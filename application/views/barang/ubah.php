<!DOCTYPE html>
<html>
<head>
	<title>form Ubah</title>	
</head>
<body>
	<div style="color: red;"><?php echo validation_errors(); ?></div>
	<?php echo form_open_multipart('barang/editBarang/'.$barang->id_barang); ?>
	<br>
	<h1>Form Ubah Data Barang</h1>
	<br><br>
	<table>
		<tr>
				<td> Nama Barang </td>
				<td> <input type="text" name="input_namaBrg" value="<?php echo set_value('nama_barang', $barang->nama_barang);?>" required>
				</td>
			</tr>

			<tr>
				<td> Deskripsi </td>
				<td> <input type="text" name="input_deskripsiBrg" required value="<?php echo set_value('deskripsi', $barang->deskripsi); ?>" accept="image/jpeg">
				</td>
			</tr>

			<tr>
				<td>Id Satuan</td>
				<td>
					<select class="form-control" id="id_satuan" name="id_satuan">
   					<?php $p = set_value('satuan',$barang->satuan); ?>
									<option value="" disabled>Pilih Salah Satu</option>
									<?php foreach($sat as $row):?>
										<option value="<?= $row->id_satuan; ?>" <?php if($p==$row->satuan){ echo 'selected'; } ?>>
											<?= ucfirst($row->satuan); ?>
										</option>
   					<?php endforeach; ?>
				</td>
			</tr>
</table>

<hr>
	<input class="ubah" type="submit" name="submit" value="Ubah">
	<a href="<?php echo base_url('barang/tampil_barang');?>">
	<input class="batal" type="button" value="Batal"></a>
	<?php echo form_close(); ?></div>

<div>
	<?php echo form_open_multipart('barang/editFoto/'.$barang->id_barang); ?>
	<table>
		<tr>
			<td>Foto barang</td>
			<td><input type="file" name="foto" id="foto" accept="image/jpeg"> 
				</td>
		</tr>
	</table>
	<input class="ubah" type="submit" name="submit" value="Ubah">
	<a href="<?php echo base_url('barang/tampil_barang');?>">
	<input class="batal" type="button" value="Batal"></a>
<?php echo form_close(); ?></div>

<div>
	<?php echo form_open_multipart('barang/hapus/'.$barang->id_barang); ?>
	<?php echo 
	"<a href=".base_url("barang/hapus/".$barang->id_barang)."><button class='hapus'>Hapus</button></a>"
	?>
	<?php echo form_close(); ?></div>
	
</body>
</html>

