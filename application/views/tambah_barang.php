<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>form tambah barang </title>
</head>
<body>
	
	<?php echo form_open_multipart('barang/tambahBrg'); ?>
	<div class="table">
		<table>
			<tr>
				<td> Nama Barang </td>
				<td> <input type="text" name="input_namaBrg" value="<?php echo set_value('input_namaBrg');?>">
				</td>
			</tr>

			<tr>
				<td> Foto </td>
				<td> <input type="file" name="foto" id="foto" > 
				</td>
			</tr>

			<tr>
				<td> Deskripsi </td>
				<td> <input type="text" name="input_deskripsiBrg" required value="<?php echo set_value('foto_brg'); ?>" accept="image/jpeg">
				</td>
			</tr>

			<tr>
				<td>Id Satuan</td>
				<td>
					<select class="form-control" id="id_satuan" name="id_satuan">
   					<?php $p = set_value('satuan'); ?>
									<option value="" disabled>Pilih Salah Satu</option>
									<?php foreach($sat as $row):?>
										<option value="<?= $row->id_satuan; ?>" <?php if($p==$row->satuan){ echo 'selected'; } ?> >
											<?= ucfirst($row->satuan); ?>
										</option>
   					<?php endforeach; ?>
				</td>
			</tr>


		</table>
	

<input class="simpan" type="submit" name="submit" value="Simpan">
	<a href="<?php echo base_url();?>">
	<input class="batal" type="button" value="Batal"></a></div>
	<?php echo form_close(); ?>



	

</body>
</html>