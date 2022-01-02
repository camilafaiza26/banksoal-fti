<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Soal_model extends CI_Model {
    
    public function getDataSoal($id, $matkul)
    {
        $this->datatables->select('a.id_soal, a.soal, FROM_UNIXTIME(a.created_on) as created_on, FROM_UNIXTIME(a.updated_on) as updated_on, b.nama_matkul');
        $this->datatables->from('tb_soal a');
        $this->datatables->join('matkul b', 'b.id_matkul=a.matkul_id');
        if ($id!==null && $matkul===null) {
            $this->datatables->where('a.matkul_id', $id);            
        }
        return $this->datatables->generate();
    }

    public function getSoalById($id)
    {
        return $this->db->get_where('tb_soal', ['id_soal' => $id])->row();
    }

    public function getMatkulDosen()
    {
        $this->db->select('id_matkul, nama_matkul');
        $this->db->from('matkul');
        return $this->db->get()->row();
    }

}