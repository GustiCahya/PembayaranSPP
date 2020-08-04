<main>
	<h3>Kelas</h3>
	<a href="<?=base_url()?>dashboard/kelas/create" 
	class="btn waves-effect waves-light blue darken-4">Create kelas</a>
	<table>
		<tr>
			<th>ID kelas</th>
			<th>Nama kelas</th>
			<th>Kompetensi Keahlian</th>
			<th>Action</th>
		</tr>
		<?php foreach($kelas as $key => $value):?>
		<tr>
			<td><?=$value['id_kelas']?></td>
			<td><?=$value['nama_kelas']?></td>
			<td><?=$value['kompetensi_keahlian']?></td>

			<td>
				<a href="<?=base_url()?>dashboard/kelas/update?key=<?=$value['id_kelas']?>" class="btn waves-effect waves-light yellow darken-3">
					<i class="fas fa-pencil"></i>
				</a>
				<a href="<?=base_url()?>dashboard/kelas/delete?key=<?=$value['id_kelas']?>" class="btn waves-effect waves-light red darken-3">
					<i class="fas fa-trash"></i>
				</a>
			</td>
		</tr>
		<?php endforeach;?>
	</table>
	<?=$pagination?>
</main> 