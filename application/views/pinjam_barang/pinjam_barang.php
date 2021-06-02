</head>
<body>

	<h1> Detail Peminjaman Barang </h1>
    <?php echo form_open_multipart(); ?>
	<div class="table">
		<table>
			<tr>
                <td> <img src="<?php echo base_url('assets/images/barang/'.$detail->foto);?> " width = 200 px> <td>
            </tr>
            <tr>
				<th>Nama Barang</th>
                <td> <input type="text" name="input_namaBrg" value="<?php echo set_value('nama_barang', $detail->nama_barang);?>" required></td> 
            </tr>
           <!--  <tr>
				<th>Deskripsi</th>
                <td><input type="text" name="input_deskripsiBrg" required value="<?php echo set_value('deskripsi', $detail->deskripsi); ?>" accept="image/jpeg"></td> 
            </tr> -->
        
            <tr>
            <td> Tgl Pinjam</td>
                  <td> <input type="date" id="tgl_pinjam" name="tgl_pinjam" value="<?php echo set_value('tgl_pinjam');?>" >                   
                  </td>
            </td>
            </tr>

             <tr>
                <td> Tanggal Kembali</td>
                     <td>
                     <input type="date" id="tgl_pengembalian" name="tgl_pengembalian" value="<?php echo set_value('tgl_pengembalian');?>">
                     </td>
             </tr>

            <tr>
            <td> Jumlah </td>
                  <td>  <input type="number" id="qty" name="qty" min="1" max="10" value="<?php echo set_value('qty');?>">
                    </td>
                
            </tr>

            <tr>
            <td> alasan pinjam </td>
                     <td>
                    <input type="text" name="alasan_pinjam" value="<?php echo set_value('alasan_pinjam');?>">
                     </td>
            </tr>
<br>
            <tr>

                    <td>
                        <!--<input type="hidden" name="ïd_barang" value="<?php echo $id_barang; ?>" /> -->
                    <input type="submit" value="submit" name="submit">
                    </td>
            </tr>

            
				<!-- bagian xixil 
				<th>Stok</th>
				-->

			
			

			
		</table>

</body>
</html>