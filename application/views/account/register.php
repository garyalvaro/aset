<!DOCTYPE html>
<html>
<head>
	<title>Form register</title>
</head>
<body>
	<?php echo form_open_multipart('Account/register1'); ?>
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
	<div>
		<input type="password" name="password" placeholder="Password">
	</div>
	<div>
		<input type="file" name="userfile">
	</div>
	<div>
		<button type="submit">SUBMIT</button>
	</div>
	<?php echo form_close(); ?>
</body>
</html>