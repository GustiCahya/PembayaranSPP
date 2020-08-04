<main>
	<h3>Siswa</h3>
	<a href="<?=base_url()?>dashboard/siswa/create" 
	class="btn waves-effect waves-light blue darken-4">Create Siswa</a>
	<table>
		<tr>
			<th>No.</th>
			<th>NISN</th>
			<th>NIS</th>
			<th>Nama</th>
			<th>Kelas</th>
			<th>Alamat</th>
			<th>No telp.</th>
			<th>SPP</th>
			<th>Action</th>
		</tr>
		<?php foreach($siswa as $key => $value):?>
		<tr>
			<td><?=$key+1?></td>
			<td><?=$value['nisn']?></td>
			<td><?=$value['nis']?></td>
			<td><?=$value['nama']?></td>
			<td><?=$value['nama_kelas']?></td>
			<td><?=$value['alamat']?></td>
			<td><?=$value['no_telp']?></td>
			<td><?=$value['tahun']?></td>
			<td>
				<a href="<?=base_url()?>dashboard/siswa/update?key=<?=$value['nisn']?>" class="btn waves-effect waves-light yellow darken-3">
					<i class="fas fa-pencil"></i>
				</a>
				<a href="<?=base_url()?>dashboard/siswa/delete?key=<?=$value['nisn']?>" class="btn waves-effect waves-light red darken-3">
					<i class="fas fa-trash"></i>
				</a>
			</td>
		</tr>
		<?php endforeach;?>
	</table>
	<?=$pagination?>
</main> 