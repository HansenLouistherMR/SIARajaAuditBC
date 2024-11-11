<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_Target extends CI_Model
{

    private $_table = "role";

    public function rulesData()
    {
        return [
            [
                'field' => 'kode_perusahaan',
                'label' => 'kode_perusahaan',
                'rules' => 'required', // Add any additional validation rules here
            ],
            [
                'field' => 'nama_file',
                'label' => 'nama_file',
                'rules' => 'required', // Add any additional validation rules here
            ],
            [
                'field' => 'mulai',
                'label' => 'mulai',
                'rules' => 'required', // Add any additional validation rules here
            ],
            [
                'field' => 'keterangan',
                'label' => 'keterangan',
                'rules' => 'required', // Add any additional validation rules here
            ],
        ];
    }

    
    public function GerUserPerusahaan()
    {
        //return $this->db->get($this->_table)->result();
        $sql = "SELECT *  
            FROM user
			WHERE role=3";

        return $this->db->query($sql)->result();

    }



    public function getAll()
    {
        //return $this->db->get($this->_table)->result();
        $sql = "select * from target LEFT JOIN user ON target.kode_perusahaan = user.kode_user";

        return $this->db->query($sql)->result();
    }



    public function GetDataAkun()
    {
        //return $this->db->get($this->_table)->result();
        $sql = "SELECT list_akun.no as id,
        list_akun.list as list,
        daftar_akun.nama_akun as nama_akun
         FROM list_akun list_akun 
        LEFT JOIN daftar_akun daftar_akun
        ON list_akun.no_akun = daftar_akun.no";

        return $this->db->query($sql)->result();
    }


    public function getDataRole()
    {
        // Mengambil data dari tabel role
        $sql = "SELECT * FROM role";
        return $this->db->query($sql)->result();
    }

    public function getIcon()
    {
        // Mengambil data dari tabel role
        $sql = "SELECT * FROM icon_menu";
        return $this->db->query($sql)->result();
    }


    public function getByNomor($no)
    {

        $this->db->select('*');
        $this->db->from('menu');
        $this->db->where('id', $no);
        $query = $this->db->get();
        return $query->row();


    }

    public function update()
    {
        $post = $this->input->post();

        // Validate input data
        $data = [
            'nama_menu' => $post['nama_menu'],
            'kode_role' => $post['kode_role'],
            'kd_icon' => $post['kd_icon'],
        ];

        $this->db->where('id', $post['id']);
        $this->db->update('menu', $data);

    }

    public function save()
    {
        $post = $this->input->post();

        $data = array(
            'kode_perusahaan' => $post["kode_perusahaan"],
            'nama_file' => $post["nama_file"],
            'mulai' => $post["mulai"],
            'keterangan' => $post["keterangan"],

        );

        $this->db->insert('target', $data);

    }


    public function delete($no)
    {
        return $this->db->delete($this->_table, array("no_bayar_catering" => $no));
    }


}