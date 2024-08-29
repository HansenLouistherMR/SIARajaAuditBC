<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_data_perusahaan extends CI_Model
{

    private $_table = "role";

    public function rulesData()
    {
        return [
            [
                'field' => 'fullname',
                'label' => 'fullname',
                'rules' => 'required', // Add any additional validation rules here
            ],
            [
                'field' => 'username',
                'label' => 'username',
                'rules' => 'required', // Add any additional validation rules here
            ],
            [
                'field' => 'password',
                'label' => 'kode_role',
                'rules' => 'required|integer', // Add any additional validation rules here
            ],
            // [
            //     'field' => 'kd_icon',
            //     'label' => 'kd_icon',
            //     'rules' => 'required|integer', // Add any additional validation rules here
            // ],
        ];
    }


    public function getAll()
    {
        //return $this->db->get($this->_table)->result();
        $sql = "SELECT * FROM USER a LEFT JOIN role b ON a.role=b.id;";

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
        $this->db->from('user');
        $this->db->where('user_id ', $no);
        $query = $this->db->get();
        return $query->row();


    }

    public function update()
    {
        $post = $this->input->post();
        $password_baru_hash = password_hash($post["password"], PASSWORD_DEFAULT);


        // Validate input data
        $data = array(
            'fullname' => $post["fullname"],
            'password' => $password_baru_hash,
            'username' => $post["username"],
            'pass_text' => $post["password"]
        );

        $this->db->where('user_id ', $post['id']);
        $this->db->update('user', $data);

    }

    public function save()
    {
        $post = $this->input->post();
        // $password_baru = $post["password"];
        $password_baru_hash = password_hash($post["password"], PASSWORD_DEFAULT);

        $data = array(
            'fullname' => $post["fullname"],
            'password' => $password_baru_hash,
            'username' => $post["username"],
            'pass_text' => $post["password"],
            'role' => 3
        );

        $this->db->insert('user', $data);
        // echo "berhasil";
    }


    public function delete($no)
    {
        return $this->db->delete($this->_table, array("no_bayar_catering" => $no));
    }


}