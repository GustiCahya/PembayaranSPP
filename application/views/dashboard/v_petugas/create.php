<main>
	<h3>Create Petugas</h3>
	<form class="form-input" action="<?=base_url()?>dashboard/petugas/create" method="POST">
	<div class="input-field">
			<label for="id_petugas">ID Petugas</label>
			<input type="text" id="id_petugas" name="id_petugas">
			<?= form_error('id_petugas', '<span style="font-size: 13px; color: crimson;" class="left">', '</span>'); ?>
		</div>
		<div class="input-field">
			<label for="username">Username</label>
			<input type="text" id="username" name="username">
			<?= form_error('username', '<span style="font-size: 13px; color: crimson;" class="left">', '</span>'); ?>
		</div>
		<div class="input-field">
			<label for="password">Password</label>
			<input type="password" id="password" name="password">
			<?= form_error('username', '<span style="font-size: 13px; color: crimson;" class="left">', '</span>'); ?>
		</div>
		<div class="input-field">
			<label for="nama_petugas">Nama Petugas</label>
			<input type="text" id="nama_petugas" name="nama_petugas">
			<?= form_error('nama_petugas', '<span style="font-size: 13px; color: crimson;" class="left">', '</span>'); ?>
		</div>
		<div class="input-field">
			<select name="level" id="level">
				<?php
					$options = [ 'admin', 'petugas' ];
					$output = '';
					for( $i=0; $i<count($options); $i++ ) {
					  $output .= '<option>' 
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