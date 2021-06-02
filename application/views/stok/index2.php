<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>List Barang</title>
	<link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/themes/smoothness/jquery-ui.css" rel="stylesheet" />
	
</head>
<body>
	<?php echo form_open('stok/cek_stok');?>
		<input type="text" name="id_barang" id="id_barang" placeholder="id barang" required value="<?=$_POST['id_barang']?>" onchange="myFunction()"><br>
		<input type="text" name="tgl_pinjam" id="tgl_pinjam" placeholder="tgl_pinjam" required value="<?=$_POST['tgl_pinjam']?>" onchange="myFunction()"><br>
		<input type="text" name="tgl_kembali" id="tgl_kembali" placeholder="tgl_kembali" required value="<?=$_POST['tgl_kembali']?>" onchange="myFunction()"><br>
		<input type="text" name="qty" id="qty" placeholder="qty" required value="<?=$_POST['qty']?>" onchange="myFunction()"><br>
		<button onclick="myFunction()" type="submit">Cek Stok</button>
	<?php echo form_close(); ?>
	
	<?php if ($status->stok == 1) {
		echo "Stok tersedia<br>";
		echo "<button type='submit' id='ini'>Pinjam</button>";
	} 
	else{
		echo "Stok tidak tersedia<br>";
		echo "<button type='submit' disabled>Pinjam</button>";
	}
	?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
	<script>
		function myFunction() {
			document.getElementById("ini").disabled = true;
		}
	</script>
	<!-- <script>
		function myFunction() {
			var id_barang = document.getElementById("id_barang").value;
			var tgl_pinjam = document.getElementById("tgl_pinjam").value;
			var tgl_kembali = document.getElementById("tgl_kembali").value;
			var qty = document.getElementById("qty").value;

			document.getElementById("demo").innerHTML = "tanggal pinjam : "+tgl_pinjam+", tanggal kembali : "+tgl_kembali
			document.getElementById("ini").disabled = false;
		}
	</script> -->
	<!-- Mendapatkan saved form
	<script type="text/javascript">
		window.onbeforeunload = function() {
		    localStorage.setItem("id_barang", $('#id_barang').val());
		    localStorage.setItem("tgl_pinjam", $('#tgl_pinjam').val());
		    localStorage.setItem("tgl_kembali", $('#tgl_kembali').val());
		    localStorage.setItem("qty", $('#qty').val());
		}
		window.onload = function() {
		    var id_barang = localStorage.getItem("id_barang");
		    var tgl_pinjam = localStorage.getItem("tgl_pinjam");
		    var tgl_kembali = localStorage.getItem("tgl_kembali");
		    var qty = localStorage.getItem("qty");
		    if (id_barang !== null) $('#id_barang').val(id_barang);
		    if (tgl_pinjam !== null) $('#tgl_pinjam').val(tgl_pinjam);
		    if (tgl_kembali !== null) $('#tgl_kembali').val(tgl_kembali);
		    if (qty !== null) $('#qty').val(qty);
		}
	</script>-->
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

			var $dp2 = $("#tgl_kembali");
			$dp2.datepicker({
				changeYear: true,
				changeMonth: true,
				minDate:0,
				yearRange: "-100:+20",
				dateFormat: "yy-m-dd",
			});
		});
	</script>
</body>
</html>