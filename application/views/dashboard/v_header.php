<?php
	$username = $this->session->userdata('user');
	$role = $this->db->get_where('petugas', ['username' => $username])->row_array()['level'];
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
	<body class="admin-panel">
		<ul class="side-navigation">
			<li>
				<div class="user">
					<div class="user-img">
						<img src="<?=base_url()?>assets/images/sidebar/user.png" alt="user" width="50" />
					</div>
					<div class="user-content">
						<p class="user-content__name"><?= $username ?></p>
						<p class="user-content__role">Role: <?= $role?></p>
					</div>
				</div>
			</li>
			<li>
				<a href="<?=base_url()?>dashboard/index">
					<img src="<?=base_url()?>assets/images/sidebar/home.svg" alt="user" width="35" />
					<p>Home</p>
				</a>
			</li>
			<li>
				<a href="<?=base_url()?>dashboard/siswa">
					<img src="<?=base_url()?>assets/images/sidebar/siswa.svg" alt="user" width="40" />
					<p>Siswa</p>
				</a>
			</li>
			<li>
				<a href="<?=base_url()?>dashboard/petugas">
					<img src="<?=base_url()?>assets/images/sidebar/petugas.svg" alt="user" width="40" />
					<p>Petugas</p>
				</a>
			</li>
			<li>
				<a href="<?=base_url()?>dashboard/kelas">
					<img src="<?=base_url()?>assets/images/sidebar/kelas.svg" alt="user" width="40" />
					<p>Kelas</p>
				</a>
			</li>
			<li>
				<a href="<?=base_url()?>dashboard/spp">
					<img src="<?=base_url()?>assets/images/sidebar/spp.svg" alt="user" width="40" />
					<p>SPP</p>
				</a>
			</li>
			<li>
				<ul class="collapsible black">
					<li>
						<div class="collapsible-header">
							<a href="#">
								<img src="<?=base_url()?>assets/images/sidebar/pembayaran.svg" alt="user" width="40" />
								<p>Pembayaran</p>
								<i class="fas fa-chevron-down"></i>
							</a>
						</div>
						<ul class="collapsible-body">
							<li>
								<a href="#">Transaksi Pembayaran</a>
							</li>
							<li>
								<a href="#">History Pembayaran</a>
							</li>
							<li>
								<a href="#">Laporan Pembayaran</a>
							</li>
						</ul>
					</li>
				</ul>
			</li>
		</ul>
		<div id="main-application">
			<header>
				<nav class="black">
					<div class="nav-wrapper">
						<a href="<?=base_url()?>dashboard" class="brand-logo left">Pembayaran SPP</a>
						<ul class="right">
							<li><a href="<?=base_url()?>auth/logout" class="logout">Logout</a></li>
						</ul>
					</div>
				</nav>
			</header>