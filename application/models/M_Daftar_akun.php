<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_Daftar_akun extends CI_Model
{

  
    public function rulesData()
    {
        return [
            [
                'field' => 'link',
                'label' => 'Link',
                'rules' => 'required', // Add any additional validation rules here
            ],
            [
                'field' => 'cek',
                'label' => 'Cek',
                'rules' => 'required', // Add any additional validation rules here
            ],
            [
                'field' => 'id',
                'label' => 'ID',
                'rules' => 'required|integer', // Add any additional validation rules here
            ],
        ];
    }

    public function rulesBayar2()
    {
        return [
            [
                'field' => 'status_catering',
                'label' => 'Status_catering',
                'rules' => 'required|numeric'
            ]
        ];
    }

    public function getAll()
    {
        //return $this->db->get($this->_table)->result();
        $sql = "SELECT * FROM daftar_akun";

        return $this->db->query($sql)->result();
    }

    public function getAllDeptHRD()
    {
        //return $this->db->get($this->_table)->result();
        $sql = "SELECT * FROM daftar_akun WHERE dept=1";

        return $this->db->query($sql)->result();
    }


    public function getAllDeptALL()
    {
        //return $this->db->get($this->_table)->result();
        $sql = "SELECT * FROM daftar_akun WHERE dept=2";

        return $this->db->query($sql)->result();
    }


    public function getByNomor($no)
    {
        // $this->db->select("s.nama_siswa, s.kelas, CONCAT(s.kelas,s.nama_kelas) as kelas_nama, b.*");
        // $this->db->where("b.NIS", "s.NIS", FALSE);
        // $this->db->where("b.no_bayar_catering", $no, FALSE);
        // return $this->db->get("bayar_catering as b, data_siswa as s")->row();


        $this->db->select('*'); 
        $this->db->from('spmi');
        $this->db->where('id', $no);
        $query = $this->db->get();
        return $query->row();
        

    }

    public function update()
    {
        $post = $this->input->post();
    
        // Validate input data
        $data = [
            'link' => $post['link'],
            'cek' => $post['cek'],
        ];
    
        $this->db->where('id', $post['id']);
        $this->db->update('spmi', $data);

        // if (!$this->db->update('spmi', $data)) {
        //     echo $this->db->error(); // Tampilkan pesan kesalahan dari database
        // }

        // var_dump($post); // Tampilkan data yang diterima dari input
        // echo $this->db->last_query(); // Tampilkan query yang dihasilkan

    }
    
    // public function konfirmasiBayarCatering()
    // {
    //     $post = $this->input->post();
    //     $this->db->set("tanggal_bayar_catering", $post["tanggal_bayar_catering"]);
    //     $this->db->set("status_catering", 1, FALSE);
    //     $this->db->where("no_bayar_catering", $post["no_bayar_catering"]);
    //     $this->db->update('bayar_catering');

    // }

    public function delete($no)
    {
        return $this->db->delete($this->_table, array("no_bayar_catering" => $no));
    }


}