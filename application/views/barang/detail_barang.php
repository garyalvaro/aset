</head>
<body>
	<h1> Detail Peminjaman Barang </h1>
	<div class="table">
		<table>
			<tr>
                <td> <img src="<?php echo base_url('assets/uploads/'.$detail->foto);?> " width = 200 px> <td>
            </tr>
            <tr>
				<th>Nama Barang</th>
                <td><?php echo $detail->nama_barang ?></td> 
            </tr>
            <tr>
				<th>Deskripsi</th>
                <td><?php echo $detail->deskripsi ?></td> 
            </tr>

            <form method="post" action="tgllahirproses.php">
        
            <tr>
            <td>
                <form action="/action_page.php">
                    <label for="birthday">Tanggal Peminjaman:</label>
                    <td>
                    <input type="date" id="birthday" name="birthday">                   
                    </td>
                </form>
            </td>
            </tr>
        
    </form>

             <tr>
             <td>
                <form action="/action_page.php">
                     <label for="birthday">Tanggal Pengembalian:</label>
                     <td>
                     <input type="date" id="birthday" name="birthday">
                     </td>
                </form>
             <td>
             </tr>

    </form>

            <tr>
                <td>
                <form action="/action_page.php">
                <label for="quantity">Quantity :</label>
                    </td>
                <td>
                <input type="number" id="quantity" name="quantity" min="1" max="10">
                    </td>
                </form>
                    </td>
                    </tr>
                <tr>
                    <td>
                <input type="submit">
                    </td>
            </tr>
				<!-- bagian xixil 
				<th>Stok</th>
				-->

			
			

			
		</table>

</body>
</html>