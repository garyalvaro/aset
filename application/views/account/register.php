<!DOCTYPE html>
<html>
<head>
	<title>Form register</title>
</head>
<body>
	<?php echo validation_errors(); ?>
	<?php echo form_open_multipart('Account/register'); ?>
	<div>
		<input type="text" name="username" placeholder="Username">
	</div>
	<div>
		<input type="text" name="email" placeholder="Email">
	</div>
	<div>
		<input type="text" name="nama" placeholder="Nama">
	</div>
	<div>
		<input type="text" name="nim" placeholder="NIM">
	</div>
	<?php echo form_error('nim'); ?>
	<div>
		<input type="password" name="password" placeholder="Password">
	</div>
	<div>
		<input type="password" name="konfirmasipassword" placeholder="Konfirmasi Password">
	</div>
	<div>
		<button type="submit">SUBMIT</button>
	</div>
	<?php echo form_close(); ?>
</body>
</html>