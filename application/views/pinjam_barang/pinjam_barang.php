	<link rel="stylesheet" type="text/css" media="all" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/themes/smoothness/jquery-ui.css"/>
	
</head>
<body>

	<h1> Detail Peminjaman Barang </h1>
	<?php echo form_open('pinjam_barang/pinjam_user/'.$detail->id_barang) ?>
	<div class="table">
		<table>
			<tr>
				<td> <img src="<?php echo base_url('assets/images/barang/'.$detail->foto);?> " width = 200 px> </td>
			</tr>
			<tr>
				<td>Nama Barang</td>
				<td> <input type="text" name="input_namaBrg" value="<?php echo set_value('nama_barang', $detail->nama_barang);?>" required></td> 
			</tr>
		   <!--  <tr>
				<th>Deskripsi</th>
				<td><input type="text" name="input_deskripsiBrg" required value="<?php echo set_value('deskripsi', $detail->deskripsi); ?>" accept="image/jpeg"></td> 
			</tr> -->
		
			<tr>
				<td> Tgl Pinjam</td>
				<td>
				  	<input type="text" autocomplete="false" name="tgl_pinjam" id="tgl_pinjam" placeholder="tgl_pinjam" required value="<?php echo set_value('tgl_pinjam');?>" onchange="myFunction()" > 
				  </td>
			</tr>

			 <tr>
				<td> Tanggal Kembali</td>
				<td>
					<input type="text" autocomplete="false" name="tgl_pengembalian" id="tgl_pengembalian" placeholder="tgl_pengembalian" required value="<?php echo set_value('tgl_pengembalian');?>" onchange="myFunction()">
					<!-- <input type="date" id="tgl_pengembalian" name="tgl_pengembalian" value="<?php echo set_value('tgl_pengembalian');?>"> -->
				</td>
			 </tr>

			<tr>
				<td> Jumlah </td>
				<td>  
					<input type="number" id="qty" name="qty" min="1" max="10" value="<?php echo set_value('qty');?>">
				</td>
				
			</tr>
			<tr>
			<td> alasan pinjam </td>
				<td>
					<input type="text" name="alasan_pinjam" value="<?php echo set_value('alasan_pinjam');?>">
				</td>
			</tr>
			<tr>
				<td>
					<br>
					<input type="text" name="id_barang" value="<?= $detail->id_barang ?>" hidden>
					<input type="submit" value="cek stok" name="cek_stok">
					<input type="submit" value="pinjam" name="submit" disabled>
				</td>
			</tr>
		</table>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
	<script type="text/javascript">
		$(function() {
			var $dp1 = $("#tgl_pinjam");
			$dp1.datepicker({
				changeYear: true,
				changeMonth: true,
				minDate:0,
				dateFormat: "yy-m-dd",
				yearRange: "-100:+20",
			});

			var $dp2 = $("#tgl_pengembalian");
			$dp2.datepicker({
				changeYear: true,
				changeMonth: true,
				minDate:0,
				yearRange: "-100:+20",
				dateFormat: "yy-m-dd",
			});
		});
	</script>
	<?php echo form_close(); ?>
	
</body>
</html>