<?php
	$user = $this->session->userdata('user');
	if(is_integer($user)){
		$name = $this->db->get('siswa',['nisn'=>$user])->row_array()['nama'];
		$role = 'siswa';
	}else{
		$this->load->model('petugas');
		$name = $this->petugas->findOne(['username' => $user])['nama_petugas'];
		$role = $this->petugas->findOne(['username' => $user])['level'];
	}
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
		<script>
			const $ = (target) => {
			const elems = document.querySelectorAll(target);
			return (elems.length > 1) ? elems : document.querySelector(target);  
		}
		</script>
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
						<p class="user-content__name"><?= $name ?></p>
						<p class="user-content__role">Role: <?= $role?></p>
					</div>
				</div>
			</li>

			<?php if($role == 'admin'):?>
			<li>
				<a href="<?=base_url()?>dashboard/pembayaran/transaksi">
					<img src="<?=base_url()?>assets/images/sidebar/pembayaran.svg" alt="user" width="40" />
					<p>Transaksi Pembayaran</p>
				</a>
			</li>
			<li>
				<a href="<?=base_url()?>dashboard/pembayaran">
					<img src="<?=base_url()?>assets/images/sidebar/history.svg" alt="user" width="40" />
					<p>History Pembayaran</p>
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
			<?php endif;?>
			
			<?php if($role == 'petugas'):?>
				<li>
					<a href="<?=base_url()?>dashboard/pembayaran/transaksi">
						<img src="<?=base_url()?>assets/images/sidebar/pembayaran.svg" alt="user" width="40" />
						<p>Transaksi Pembayaran</p>
					</a>
				</li>
				<li>
					<a href="<?=base_url()?>dashboard/pembayaran">
						<img src="<?=base_url()?>assets/images/sidebar/history.svg" alt="user" width="40" />
						<p>History Pembayaran</p>
					</a>
				</li>
			<?php endif;?>

			<?php if($role == 'siswa'):?>
				<li>
					<a href="<?=base_url()?>dashboard/pembayaran">
						<img src="<?=base_url()?>assets/images/sidebar/history.svg" alt="user" width="40" />
						<p>History Pembayaran</p>
					</a>
				</li>
			<?php endif;?>

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