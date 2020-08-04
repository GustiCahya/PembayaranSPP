<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Petugas extends CI_Model
{
    private $table = 'petugas';
    public function find(){
        return $this->db->get($this->table)->result_array();
    }
    public function findOne($key){
        if(is_array($key)){
            return $this->db->get_where($this->table, $key)->row_array();
        }else{
            return $this->db->get_where($this->table, ['id_petugas' => $key])->row_array();
        }
    }
    public function findList($limit, $start){
		return $this->db->get($this->table, $limit, $start)->result_array();
	}
    public function insert($data){
        return $this->db->insert($this->table, $data);
    }
    public function update($key, $data){
        $this->db->where(['id_petugas' => $key]);
        return $this->db->update($this->table, $data);
    }
    public function delete($key){
        $this->db->where(['id_petugas' => $key]);
        return $this->db->delete($this->table);
    }
}
