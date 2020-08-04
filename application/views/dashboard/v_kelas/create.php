<main>
	<h3>Create Kelas</h3>
	<form class="form-input" action="<?=base_url()?>dashboard/kelas/create" method="POST">
		<div class="input-field">
			<label for="id_kelas">ID Kelas</label>
			<input type="text" id="id_kelas" name="id_kelas" value="<?=$this->db->get('kelas')->num_rows()+1?>">
			<?= form_error('id_kelas', '<span style="font-size: 13px; color: crimson;" class="left">', '</span>'); ?>
		</div>
		<div class="input-field">
			<label for="nama_kelas">Nama Kelas</label>
			<input type="text" id="nama_kelas" name="nama_kelas">
			<?= form_error('nama_kelas', '<span style="font-size: 13px; color: crimson;" class="left">', '</span>'); ?>
		</div>
		<div class="input-field">
			<label for="kompetensi_keahlian">Kompetensi Keahlian</label>
			<input type="text" id="kompetensi_keahlian" name="kompetensi_keahlian">
			<?= form_error('kompetensi_keahlian', '<span style="font-size: 13px; color: crimson;" class="left">', '</span>'); ?>
		</div>
		<button type="submit" class="btn indigo darken-4 right">Submit</button>
	</form>
</main>