<?php
	$user = $this->session->userdata('user');
	if(is_integer($user)){
		$role = 'siswa';
	}else{
		$this->load->model('petugas');
		$role = $this->petugas->findOne(['username' => $user])['level'];
	}
	$daftarBulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
?>

<style>
	.laporan__title{
		display: none;
	}
	@media print {
		body * {
			visibility: hidden;
		}
		.laporan *{
			visibility: visible;
		}
		.laporan h3{
			text-align: center;
		}
		.laporan .btn-generate,
		.laporan .history__title{
			display: none;
		}
		.laporan .laporan__title{
			display: block;
		}
		.laporan{
			position: absolute;
			width: 100vw;
			left: 50%;
			transform: translateX(-50%);
		}
		.aksi{
			display: none;
		}
	}
</style>
<main class="laporan">
	<h3 class="laporan__title">Laporan Pembayaran</h3>
	<h3 class="history__title">History Pembayaran</h3>

	<?php if($role == 'admin'): ?>
	<button onClick="window.print()" 
		class="btn waves-effect waves-light indigo darken-4 btn-generate">
		Generate Laporan
	</button>
	<?php endif;?>


    <table>
		<tr>
			<th>ID Pembayaran</th>
			<th>ID Petugas</th>
			<th>Nama Petugas</th>
			<th>NISN</th>
			<th>Nama Siswa</th>
			<th>Tanggal Bayar</th>
			<th>Bulan Dibayar</th>
            <th>Tahun Dibayar</th>
			<th>Jumlah Bayar</th>
			<th class="aksi">Action</th>
		</tr>
		<?php foreach($history as $key => $value):?>
		<?php $idPembayaran = $value['id_pembayaran']; ?>
		<tr>
			<td><?=$idPembayaran?></td>
			<td><?=$value['id_petugas']?></td>
			<td><?=$value['nama_petugas']?></td>
			<td><?=$value['nisn']?></td>
			<td><?=$value['nama']?></td>
			<td><?=(new DateTime($value['tgl_bayar']))->format('d/m/Y')?></td>
			<td><?=$daftarBulan[$value['bulan_dibayar']-1]?></td>
			<td><?=$value['tahun_dibayar']?></td>
			<td><?=number_format($value['jumlah_bayar'], 0, ',', '.')?></td>
			<td class="aksi"><a href="<?=base_url("dashboard/pembayaran/delete?id=$idPembayaran")?>" class="btn red waves-effect waves-light"><i class="fas fa-trash"></i></a></td>
		</tr>
		<?php endforeach;?>
	</table>
</main>