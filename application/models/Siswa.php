<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa extends CI_Model
{
	private $table = 'siswa';
	public function find(){
		return $this->db->get($this->table)->result_array();
	}
	public function findWithFkList($limit, $start){
		return $this->db->query("SELECT siswa.nisn, siswa.nis, 
			siswa.nama, siswa.id_kelas, kelas.nama_kelas, siswa.alamat,
			siswa.no_telp, siswa.id_spp, spp.tahun 
			FROM siswa 
			INNER JOIN kelas ON siswa.id_kelas=kelas.id_kelas
			INNER JOIN spp ON siswa.id_spp=spp.id_spp
			LIMIT ?, ?
		", [$start, $limit])->result_array();
	}
	public function findOne($key){
		if(is_array($key)){
            return $this->db->get_where($this->table, $key)->row_array();
        }else{
			return $this->db->get_where($this->table, ['nisn' => $key])->row_array();
		}
	}
	public function findList($limit, $start){
		return $this->db->get($this->table, $limit, $start)->result_array();
	}
	public function insert($data){
		return $this->db->insert($this->table, $data);
	}
	public function update($key, $data){
		$this->db->where(['nisn' => $key]);
		return $this->db->update($this->table, $data);
	}
	public function delete($key){
		$this->db->where(['nisn' => $key]);
		return $this->db->delete($this->table);
	}
}
