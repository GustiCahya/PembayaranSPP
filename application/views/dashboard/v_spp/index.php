<main>
	<h3>SPP</h3>
	<a href="<?=base_url()?>dashboard/spp/create" 
	class="btn waves-effect waves-light blue darken-4">Create SPP</a>
	<table>
		<tr>
			<th>ID SPP</th>
			<th>Tahun</th>
			<th>Nominal</th>
			<th>Action</th>
		</tr>
		<?php foreach($spp as $key => $value):?>
		<tr>
			<td><?=$value['id_spp']?></td>
			<td><?=$value['tahun']?></td>
			<td><?=$value['nominal']?></td>

			<td>
				<a href="<?=base_url()?>dashboard/spp/update?key=<?=$value['id_spp']?>" class="btn waves-effect waves-light yellow darken-3">
					<i class="fas fa-pencil"></i>
				</a>
				<a href="<?=base_url()?>dashboard/spp/delete?key=<?=$value['id_spp']?>" class="btn waves-effect waves-light red darken-3">
					<i class="fas fa-trash"></i>
				</a>
			</td>
		</tr>
		<?php endforeach;?>
	</table>
	<?=$pagination?>
</main> 