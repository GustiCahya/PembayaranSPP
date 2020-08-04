<main>
	<h3>Create Siswa</h3>
	<form class="form-input" action="<?=base_url()?>dashboard/siswa/create" method="POST">
		<div class="input-field">
			<label for="nisn">NISN</label>
			<input type="text" id="nisn" name="nisn">
			<?= form_error('nisn', '<span style="font-size: 13px; color: crimson;" class="left">', '</span>'); ?>
		</div>
		<div class="input-field">
			<label for="nis">NIS</label>
			<input type="text" id="nis" name="nis">
			<?= form_error('nis', '<span style="font-size: 13px; color: crimson;" class="left">', '</span>'); ?>
		</div>
		<div class="input-field">
			<label for="nama">Nama</label>
			<input type="text" id="nama" name="nama">
			<?= form_error('nama', '<span style="font-size: 13px; color: crimson;" class="left">', '</span>'); ?>
		</div>
		<div class="input-field">
			<select name="id_kelas" id="id_kelas">
				<?php
					$options = $this->db->get('kelas')->result_array();
					$output = '';
					for( $i=0; $i<count($options); $i++ ) {
					  $output .= '<option value="'.$options[$i]['id_kelas'].'">' 
								 . $options[$i]['nama_kelas'] 
								 . '</option>';
					}
					echo $output;
				?>
			</select>
			<label for="id_kelas">Kelas</label>
			<?= form_error('id_kelas', '<span style="font-size: 13px; color: crimson;" class="left">', '</span>'); ?>
		</div>
		<div class="input-field">
			<label for="alamat">Alamat</label>
			<input type="text" id="alamat" name="alamat">
			<?= form_error('alamat', '<span style="font-size: 13px; color: crimson;" class="left">', '</span>'); ?>
		</div>
		<div class="input-field">
			<label for="no_telp">Nomor Telepon</label>
			<input type="text" id="no_telp" name="no_telp">
			<?= form_error('no_telp', '<span style="font-size: 13px; color: crimson;" class="left">', '</span>'); ?>
		</div>
		<div class="input-field">
			<select name="id_spp" id="id_spp">
				<?php
					$options = $this->db->get('spp')->result_array();
					$output = '';
					for( $i=0; $i<count($options); $i++ ) {
					  $output .= '<option value="'.$options[$i]['id_spp'].'">' 
								 . $options[$i]['tahun'] 
								 . '</option>';
					}
					echo $output;
				?>
			</select>
			<label for="id_spp">Tahun SPP</label>
			<?= form_error('id_spp', '<span style="font-size: 13px; color: crimson;" class="left">', '</span>'); ?>
		</div>
		<button type="submit" class="btn indigo darken-4 right">Submit</button>
	</form>
</main>