<main>
	<h3>Update Petugas</h3>
	<form class="form-input" action="<?=base_url()?>dashboard/petugas/update?key=<?=$id_petugas?>" method="POST">
		<div class="input-field">
			<label for="id_petugas">ID Petugas</label>
			<input type="text" id="id_petugas" name="id_petugas" value="<?=$id_petugas?>" disabled>
			<?= form_error('id_petugas', '<span style="font-size: 13px; color: crimson;" class="left">', '</span>'); ?>
		</div>
		<div class="input-field">
			<label for="username">Username</label>
			<input type="text" id="username" name="username" value="<?=$username?>" disabled>
			<?= form_error('username', '<span style="font-size: 13px; color: crimson;" class="left">', '</span>'); ?>
		</div>
		<div class="input-field">
			<label for="nama_petugas">Nama Petugas</label>
			<input type="text" id="nama_petugas" name="nama_petugas" value="<?=$nama_petugas?>">
			<?= form_error('nama_petugas', '<span style="font-size: 13px; color: crimson;" class="left">', '</span>'); ?>
		</div>
		<div class="input-field">
			<select name="level" id="level">
				<?php
					$options = [ 'admin', 'petugas' ];
					$output = '';
					for( $i=0; $i<count($options); $i++ ) {
					  $output .= '<option ' 
								 . ( $level == $options[$i] ? 'selected="selected"' : '' ) . '>' 
								 . $options[$i] 
								 . '</option>';
					}
					echo $output;
				?>
			</select>
			<label for="level">level</label>
			<?= form_error('level', '<span style="font-size: 13px; color: crimson;" class="left">', '</span>'); ?>
		</div>
		<button type="submit" class="btn indigo darken-4 right">Submit</button>
	</form>
</main>