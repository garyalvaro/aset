<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Peminjam</title>
</head>
<body>

<body>
	<h1> Daftar Peminjam </h1>
	<div class="table">
		<table>
			<tr>
				<th>ID Peminjaman </th>
				<th>Peminjam</th>
				<th>Barang</th>
				<th>Tanggal Peminjaman</th>
				<th>Tanggal Pengembalian</th>
				<th>Jumlah</th>
				<th>Status Peminjaman</th>
				<th>Alasan Peminjaman</th>
				<th>Deskripsi Persetujuan</th>
				<th>Waktu Peminjaman </th>
				

				<th colspan="3">Action</th>
			</tr>

			<?php
			if( ! empty($pinjam_barang)) :  ?>  
		
			<?php foreach($pinjam_barang as $data) :?>  
			
				<tr>
				<td><?php echo$data->id_pinjamBarang ?></td>
				<td><?php echo$data->id_user ?></td>
				<td><?php echo$data->id_barang ?></td>
				<td><?php echo$data->tgl_pinjam ?></td>
				<td><?php echo$data->tgl_pengembalian ?></td>
				<td><?php echo$data->qty ?></td>
				<td><?php echo$data->status_peminjaman ?></td>
				<td><?php echo$data->alasan_pinjam ?></td>
				<td><?php echo$data->deskripsi_acc ?></td>
				<td><?php echo$data->action_datetime?></td>
				<td class="text-center">
					
					<a href="<?php echo base_url('pinjam_barang/pinjam_setujui/'. $data->id_pinjamBarang); ?>"><input type="submit" name="submit" value="Setujui"> </a>
                            <!-- <form action="<?php echo base_url('pinjam_barang/pinjam_setujui') ?>" method="post">
										          <input type="hidden" name="id" value="<?php echo $data->id_pinjamBarang ?>">
										          <button class="btn btn-success btn-xs btn-edit" type="submit" data-original-title="Ubah" data-placement="top" data-toggle="tooltip"><i class="fa fa-check"></i> Setujui</button>
								 	          </form>
                          </td>
						  <td class="text-center">
                            <form action="<?php echo base_url('pinjam_barang/pinjam_tolak') ?>" method="post">
                              <input type="hidden" name="id_pinjam" value="<?php echo $data->id_pinjamBarang ?>">
                              <input type="hidden" name="id_peminjam" value="<?php echo $data->id_user ?>">
                              <input type="hidden" name="id_barang" value="<?php echo $data->id_barang ?>">
                              <input type="hidden" name="jml" value="<?php echo $data->qty ?>">
                              <input type="hidden" name="tgl_pinjam" value="<?php echo $data->tgl_pinjam ?>">
                              <input type="hidden" name="tgl_kembali" value="<?php echo $data->tgl_pengembalian ?>">
										          <input type="hidden" name="status" value="0">
										          <button class="btn btn-danger btn-xs btn-delete" type="submit" data-original-title="delete" data-placement="top" data-toggle="tooltip"><i class="fa fa-times"></i> Tolak</button>
								 	          </form>
                          </td> -->
				<td><a href="<?php echo base_url('pinjam_barang/pinjam_tolak/'. $data->id_pinjamBarang); ?>"><input type="submit" name="submit" value="Tolak"> </a> </td>
				<td><a href="<?php echo base_url('pinjam_barang/pinjam_selesaikan/'. $data->id_pinjamBarang); ?>"><input type="submit" name="submit" value="Selesaikan"> </a> </td>
				</tr>;
			<?php endforeach; ?>
		<?php endif; ?>
			
		</table>

</body>
</html>
    
</body>
</html>