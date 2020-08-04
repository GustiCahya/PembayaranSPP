<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller{
    public function nominal(){
        $stream_clean = $this->security->xss_clean($this->input->raw_input_stream);
        $request = json_decode($stream_clean);
        $id_spp = $request->id_spp;

        if(!isset($id_spp)){
            redirect('auth');
        }

        $this->load->model('spp');
        $nominal = $this->spp->findOne($id_spp)['nominal'];

        echo json_encode($nominal);
    }
}