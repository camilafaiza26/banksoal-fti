<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sisteminformasi_model extends CI_Model {

    public function getDataSoal($id)
    {
        $this->datatables->select('a.id_soal, a.soal, b.nama_matkul, a.tahun, FROM_UNIXTIME(a.created_on) as created_on');
        $this->datatables->from('sisteminformasi a');
        $this->datatables->join('matkul b', 'b.id_matkul=a.matkul_id');
        if ($id!==null) {
            $this->datatables->where('a.matkul_id', $id);            
        }
        return $this->datatables->generate();
    }

    public function getSoalById($id)
    {
        return $this->db->get_where('sisteminformasi', ['id_soal' => $id])->row();
    }


    public function getAllMatkul()
    {
        $this->db->select('b.id_matkul, b.nama_matkul');
        $this->db->from('jurusan_matkul a');
        $this->db->join('matkul b ', 'b.id_matkul = a.matkul_id');
        $this->db->join('jurusan c', 'c.id_jurusan = a.jurusan_id');
        $this->db->where('c.id_jurusan' ,1);
        return $this->db->get()->result();
    }

    public function getAllDosen()
    {
        $this->db->select('*');
        $this->db->from('dosen a');
        $this->db->join('matkul b', 'a.matkul_id=b.id_matkul');
        return $this->db->get()->result();
    }
}