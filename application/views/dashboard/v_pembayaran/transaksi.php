<?php
    $this->load->model('petugas');
    $this->load->model('spp');
	$username = $this->session->userdata('user');
	$petugas = $this->petugas->findOne(['username' => $username]);
?>
<main>
    <h3>Transaksi Pembayaran</h3>
    <form class="form-input" action="<?=base_url()?>dashboard/pembayaran/transaksi" method="POST">
        <div class="input-field">
            <label for="id_pembayaran">ID Pembayaran</label>
            <input type="text" id="id_pembayaran" name="id_pembayaran" 
            value="<?=$this->db->get('pembayaran')->num_rows()+1?>">
        </div>
        <div class="input-field">
            <select name="id_petugas" id="id_petugas">
                <option value="<?=$petugas['id_petugas']?>"><?=$petugas['nama_petugas']?></option>
            </select>
            <label for="id_petugas">Petugas</label>
            <?= form_error('id_petugas', '<span class="left" style="color: crimson; font-size: 13px;">' 
                            ,'</span>'); ?>
        </div>
        <div class="input-field">
            <select name="nisn" id="nisn">
                <?php
                    $options = $this->db->get('siswa')->result_array();
                    $output = '';
                    foreach($options as $key => $option){
                        $output .= '<option value="'.$option['nisn'].'">'
                                    .$option['nisn'].' - '.$option['nama']
                                    .'</option>';
                    }
                    echo $output;
                ?>
            </select>
            <label for="nisn">NISN</label>
            <?= form_error('nisn', '<span class="left" style="color: crimson; font-size: 13px;">' 
                            ,'</span>'); ?>
        </div>
        <div class="input-field">
            <label for="tgl_bayar">📅 Tanggal Bayar</label>
            <input type="text" class="datepicker" style="cursor:pointer;"
                id="tgl_bayar" name="tgl_bayar">
            <?= form_error('tgl_bayar', '<span class="left" style="color: crimson; font-size: 13px;">' 
                        ,'</span>'); ?>
        </div>
        <div class="input-field">
            <label for="jumlah_bayar">Jumlah Bayar</label>
            <input type="text" id="jumlah_bayar" name="jumlah_bayar">
            <span class="minimum_bayar" style="display: block; font-size:13px; letter-spacing: 0.03rem;"></span>
            <?= form_error('jumlah_bayar', '<span class="left" style="color: crimson; font-size: 13px;">' 
                        ,'</span>'); ?>
        </div>
        <?= $this->session->flashdata('message')?>
        <button class="btn indigo darken-4 right">SUBMIT</button>
    </form>
</main>
<script>

    let tahun = (new Date($('#tgl_bayar').value)).getFullYear();
    getNominal(tahun);
    $('#tgl_bayar').addEventListener('change', function(event){
        tahun = event.target.value;
        getNominal(tahun);
    });
    $('#jumlah_bayar').focus();

    function getNominal(val) {
        fetch('<?=base_url()?>ajax/nominal', {
            method: 'post',
            headers : {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({tahun})
        })
        .then(response => response.json())
        .then(value => $('.minimum_bayar').innerHTML = "Biaya SPP : "+parseInt(value).toLocaleString());
    }
    
</script>