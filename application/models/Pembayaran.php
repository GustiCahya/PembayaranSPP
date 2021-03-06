<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembayaran extends CI_Model
{
    private $table = 'pembayaran';

    public function find(){
        return $this->db->get($this->table)->result_array();
    }

    public function findWithFk(){
        return $this->db->query('SELECT pembayaran.*, petugas.nama_petugas, siswa.nama 
            FROM pembayaran
            INNER JOIN petugas ON pembayaran.id_petugas=petugas.id_petugas
            INNER JOIN siswa ON pembayaran.nisn=siswa.nisn
        ')->result_array();
    }

    public function findWithFkSiswa($nisn){
        return $this->db->query('SELECT pembayaran.*, petugas.nama_petugas, siswa.nama 
            FROM pembayaran
            INNER JOIN petugas ON pembayaran.id_petugas=petugas.id_petugas
            INNER JOIN siswa ON pembayaran.nisn=siswa.nisn
            WHERE pembayaran.nisn=?
        ',[$nisn])->result_array();
    }

    public function findWithFkPetugas($id_petugas){
        return $this->db->query('SELECT pembayaran.*, petugas.nama_petugas, siswa.nama 
            FROM pembayaran
            INNER JOIN petugas ON pembayaran.id_petugas=petugas.id_petugas
            INNER JOIN siswa ON pembayaran.nisn=siswa.nisn
            WHERE petugas.username=?
        ',[$id_petugas])->result_array();
    }

    public function findOne($key){
        if(is_array($key)){
            return $this->db->get_where($this->table, $key)->row_array();
        }else{
            return $this->db->get_where($this->table, ['id_pembayaran' => $key])->row_array();
        }
    }

    public function findList($limit, $start){
		return $this->db->get($this->table, $limit, $start)->result_array();
	}

    public function insert($data){
        return $this->db->insert($this->table, $data);
    }

    public function update($key, $data){
        $this->db->where(['id_pembayaran' => $key]);
        return $this->db->update($this->table, $data);
    }

    public function delete($key){
        $this->db->where(['id_pembayaran' => $key]);
        return $this->db->delete($this->table);
    }

}
