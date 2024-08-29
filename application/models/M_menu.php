<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_menu extends CI_Model
{

    private $_table = "role";

    public function rulesData()
    {
        return [
            [
                'field' => 'nama_menu',
                'label' => 'nama_menu',
                'rules' => 'required', // Add any additional validation rules here
            ],
            [
                'field' => 'link',
                'label' => 'link',
                'rules' => 'link', // Add any additional validation rules here
            ],
            [
                'field' => 'kode_role',
                'label' => 'kode_role',
                'rules' => 'required|integer', // Add any additional validation rules here
            ],
            [
                'field' => 'kd_icon',
                'label' => 'kd_icon',
                'rules' => 'required|integer', // Add any additional validation rules here
            ],
        ];
    }


    public function getAll()
    {
        //return $this->db->get($this->_table)->result();
        $sql = "SELECT 
        menu.id as id,
        menu.nama_menu as nama_menu,
        menu.kode_role as kode_role,
        menu.link as link,
        menu.kd_icon as kd_icon,
        roles.nama_role as nama_role,
        roles.Keterangan as Keterangan,
        icon_menu.nama_icon as nama_icon,
        icon_menu.icon_desc as icon_desc
         FROM menu menu 
        INNER JOIN role roles 
        ON roles.kode_role=menu.kode_role
        INNER JOIN icon_menu icon_menu
        ON menu.kd_icon=icon_menu.id";

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
            'nama_menu' => $post["nama_menu"],
            'kode_role' => $post["kode_role"],
            'link' => $post["link"],
            'kd_icon' => $post["kd_icon"],

        );

        $this->db->insert('menu', $data);

    }


    public function delete($no)
    {
        return $this->db->delete($this->_table, array("no_bayar_catering" => $no));
    }


}