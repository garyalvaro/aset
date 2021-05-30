<!DOCTYPE html>
<html>
<head>
	<title>LOGIN</title>
</head>
<body>
	<?php echo form_open('Account/login') ?>
	<div>
		<input type="text" name="username" placeholder="Username">
	</div>
	<div>
		<input type="password" name="password" placeholder="Password">
	</div>
	<div>
		<button type="submit">LOGIN</button>
		<br>
		<a href="<?php echo base_url('Account/register'); ?>">Tambah Akun</a>
	</div>
	<?php echo form_close() ?>
</body>
</html>