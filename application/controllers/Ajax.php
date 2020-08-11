<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller{
    public function nominal(){
        $stream_clean = $this->security->xss_clean($this->input->raw_input_stream);
        $request = json_decode($stream_clean);
        $tahun = $request->tahun;

        if(!isset($tahun)){
            redirect('auth');
        }

        $this->load->model('spp');
        $nominal = $this->spp->findOne(['tahun' => $tahun])['nominal'];

        echo json_encode($nominal);
    }
}