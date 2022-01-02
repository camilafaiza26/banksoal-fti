<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Master_model extends CI_Model
{
    public function __construct()
    {
        $this->db->query("SET sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''));");
    }

    public function create($table, $data, $batch = false)
    {
        if ($batch === false) {
            $insert = $this->db->insert($table, $data);
        } else {
            $insert = $this->db->insert_batch($table, $data);
        }
        return $insert;
    }

    public function update($table, $data, $pk, $id = null, $batch = false)
    {
        if ($batch === false) {
            $insert = $this->db->update($table, $data, array($pk => $id));
        } else {
            $insert = $this->db->update_batch($table, $data, $pk);
        }
        return $insert;
    }

    public function delete($table, $data, $pk)
    {
        $this->db->where_in($pk, $data);
        return $this->db->delete($table);
    }


    /**
     * Data Jurusan
     */

    public function getDataJurusan()
    {
        $this->datatables->select('id_jurusan, nama_jurusan');
        $this->datatables->from('jurusan');
        $this->datatables->add_column('bulk_select', '<div class="text-center"><input type="checkbox" class="check" name="checked[]" value="$1"/></div>', 'id_jurusan, nama_jurusan');
        return $this->datatables->generate();
    }

    public function getJurusanById($id)
    {
        $this->db->where_in('id_jurusan', $id);
        $this->db->order_by('nama_jurusan');
        $query = $this->db->get('jurusan')->result();
        return $query;
    }

    /**
     * Data Mahasiswa
     */

    public function getDataMahasiswa()
    {
        $this->datatables->select('a.id_mahasiswa, a.nama, a.nim, a.email, b.nama_jurusan');
        $this->datatables->select('(SELECT COUNT(id) FROM users WHERE username = a.nim) AS ada');
        $this->datatables->from('mahasiswa a');
        $this->datatables->join('jurusan b', 'a.jurusan_id=b.id_jurusan');
        return $this->datatables->generate();
    }

    public function getMahasiswaById($id)
    {
        $this->db->select('*');
        $this->db->from('mahasiswa');
        $this->db->join('jurusan', 'mahasiswa.jurusan_id= jurusan.id_jurusan');
        $this->db->where(['id_mahasiswa' => $id]);
        return $this->db->get()->row();
    }

    public function getAllJurusan($id = null)
    {
        if ($id === null) {
            $this->db->order_by('nama_jurusan', 'ASC');
            return $this->db->get('jurusan')->result();
        } else {
            $this->db->select('jurusan_id');
            $this->db->from('jurusan_matkul');
            $this->db->where('matkul_id', $id);
            $jurusan = $this->db->get()->result();
            $id_jurusan = [];
            foreach ($jurusan as $j) {
                $id_jurusan[] = $j->jurusan_id;
            }
            if ($id_jurusan === []) {
                $id_jurusan = null;
            }
            
            $this->db->select('*');
            $this->db->from('jurusan');
            $this->db->where_not_in('id_jurusan', $id_jurusan);
            $matkul = $this->db->get()->result();
            return $matkul;
        }
    }



 

    /**
     * Data Matkul
     */

    public function getDataMatkul()
    {
        $this->datatables->select('id_matkul, nama_matkul, semester');
        $this->datatables->from('matkul');
        return $this->datatables->generate();
    }

    public function getAllMatkul()
    {
        return $this->db->get('matkul')->result();
    }

    public function getMatkulById($id, $single = false)
    {
        if ($single === false) {
            $this->db->where_in('id_matkul', $id);
            $this->db->order_by('nama_matkul');
            $this->db->order_by('semester');
            $query = $this->db->get('matkul')->result();
        } else {
            $query = $this->db->get_where('matkul', array('id_matkul'=>$id))->row();
        }
        return $query;
    }

  

    public function getJurusanMatkul()
    {
        $this->datatables->select('jurusan_matkul.id, matkul.id_matkul, matkul.nama_matkul, jurusan.id_jurusan, GROUP_CONCAT(jurusan.nama_jurusan) as nama_jurusan');
        $this->datatables->from('jurusan_matkul');
        $this->datatables->join('matkul', 'matkul_id=id_matkul');
        $this->datatables->join('jurusan', 'jurusan_id=id_jurusan');
        $this->datatables->group_by('matkul.nama_matkul');
        return $this->datatables->generate();
    }

    public function getMatkul($id = null)
    {
        $this->db->select('matkul_id');
        $this->db->from('jurusan_matkul');
        if ($id !== null) {
            $this->db->where_not_in('matkul_id', [$id]);
        }
        $matkul = $this->db->get()->result();
        $id_matkul = [];
        foreach ($matkul as $d) {
            $id_matkul[] = $d->matkul_id;
        }
        if ($id_matkul === []) {
            $id_matkul = null;
        }

        $this->db->select('id_matkul, nama_matkul,semester');
        $this->db->from('matkul');
        $this->db->where_not_in('id_matkul', $id_matkul);
        return $this->db->get()->result();
    }

    public function getJurusanByIdMatkul($id)
    {
        $this->db->select('jurusan.id_jurusan');
        $this->db->from('jurusan_matkul');
        $this->db->join('jurusan', 'jurusan_matkul.jurusan_id=jurusan.id_jurusan');
        $this->db->where('matkul_id', $id);
        $query = $this->db->get()->result();
        return $query;
    }
}