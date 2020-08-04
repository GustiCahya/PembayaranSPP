<main>
	<h3>Create SPP</h3>
	<form class="form-input" action="<?=base_url()?>dashboard/spp/create" method="POST">
		<div class="input-field">
			<label for="id_spp">ID SPP</label>
			<input type="text" id="id_spp" name="id_spp" 
			value="<?=$this->db->get('spp')->num_rows()+1;?>">
			<?= form_error('id_spp', '<span style="font-size: 13px; color: crimson;" class="left">', '</span>'); ?>
		</div>
		<div class="input-field">
			<label for="tahun">Tahun</label>
			<input type="text" id="tahun" name="tahun">
			<?= form_error('tahun', '<span style="font-size: 13px; color: crimson;" class="left">', '</span>'); ?>
		</div>
		<div class="input-field">
			<label for="nominal">Nominal</label>
			<input type="text" id="nominal" name="nominal">
			<?= form_error('nominal', '<span style="font-size: 13px; color: crimson;" class="left">', '</span>'); ?>
		</div>
		<button type="submit" class="btn indigo darken-4 right">Submit</button>
	</form>
</main>