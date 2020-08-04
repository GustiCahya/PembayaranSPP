<main>
	<h3>Petugas</h3>
	<a href="<?=base_url()?>dashboard/petugas/create" 
	class="btn waves-effect waves-light blue darken-4">Create Petugas</a>
	<table>
		<tr>
			<th>No.</th>
			<th>ID Petugas</th>
			<th>Username</th>
			<th>Nama Petugas</th>
			<th>Level</th>
		</tr>
		<?php foreach($petugas as $key => $value):?>
		<tr>
			<td><?=$key+1?></td>
			<td><?=$value['id_petugas']?></td>
			<td><?=$value['username']?></td>
			<td><?=$value['nama_petugas']?></td>
			<td><?=$value['level']?></td>

			<td>
				<a href="<?=base_url()?>dashboard/petugas/update?key=<?=$value['id_petugas']?>" class="btn waves-effect waves-light yellow darken-3">
					<i class="fas fa-pencil"></i>
				</a>
				<a href="<?=base_url()?>dashboard/petugas/delete?key=<?=$value['id_petugas']?>" class="btn waves-effect waves-light red darken-3">
					<i class="fas fa-trash"></i>
				</a>
			</td>
		</tr>
		<?php endforeach;?>
	</table>
	<?=$pagination?>
</main> 