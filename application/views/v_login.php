<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Pembayaran SPP</title>
	<link
			rel="stylesheet"
			href="<?=base_url()?>assets/vendor/materialize-css/css/material-icons.css"
	/>
	<link
			rel="stylesheet"
			href="<?=base_url()?>assets/vendor/materialize-css/css/materialize.min.css"
	/>
	<link rel="shortcut icon" href="<?=base_url()?>assets/images/favicon.png" type="image/x-icon">
	<link rel="stylesheet" href="<?=base_url()?>assets/css/style.css" />
	<script src="<?=base_url()?>assets/vendor/fontawesome/all.min.js"></script>
	<script src="<?=base_url()?>assets/vendor/materialize-css/js/materialize.min.js"></script>
	<script defer src="<?=base_url()?>assets/js/main.js"></script>
</head>
<body>
<div class="login">
	<div class="login-box">
		<h3>LOGIN</h3>
		<form action="<?=base_url()?>auth/login" method="POST">
			<div class="input-field">
				<label for="username">Username</label>
				<input type="text" id="username" name="username">
				<?= form_error('username', '<span style="font-size: 13px; color: salmon;" class="left">', '</span>'); ?>
			</div>
			<div class="input-field">
				<label for="password">Password</label>
				<input type="password" id="password" name="password">
				<?= form_error('password', '<span style="font-size: 13px; color: salmon;" class="left">', '</span>'); ?>
			</div>
			<?= $this->session->flashdata('message');?>
			<button class="btn waves-effect indigo darken-4">Submit</button>
		</form>
	</div>
</div>
</body>
</html>
