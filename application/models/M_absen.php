<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_absen extends CI_Model
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

    public function getAll()
    {
        //return $this->db->get($this->_table)->result();
        $sql = "SELECT 
        cte.*,
        (cte.Hitung / 8.0) * 100 AS presentase
    FROM 
        (SELECT 
            absen_dosen_view_web.NIDN,
            absen_dosen_view_web.NAMA_DOSEN,
            absen_dosen_view_web.PRODI,
            absen_dosen_view_web.KD_MK,
            absen_dosen_view_web.NAMA_MK,
            absen_dosen_view_web.sks,
            absen_dosen_view_web.pertemuan_1,
            absen_dosen_view_web.pertemuan_2,
            absen_dosen_view_web.pertemuan_3,
            absen_dosen_view_web.pertemuan_4,
            absen_dosen_view_web.pertemuan_5,
            absen_dosen_view_web.pertemuan_6,
            absen_dosen_view_web.pertemuan_7,
            absen_dosen_view_web.pertemuan_8,
        
            (CASE WHEN absen_dosen_view_web.pertemuan_1 IS NULL THEN 0 ELSE 1 END) +
            (CASE WHEN absen_dosen_view_web.pertemuan_2 IS NULL THEN 0 ELSE 1 END) +
            (CASE WHEN absen_dosen_view_web.pertemuan_3 IS NULL THEN 0 ELSE 1 END) +
            (CASE WHEN absen_dosen_view_web.pertemuan_4 IS NULL THEN 0 ELSE 1 END) +
            (CASE WHEN absen_dosen_view_web.pertemuan_5 IS NULL THEN 0 ELSE 1 END) +
            (CASE WHEN absen_dosen_view_web.pertemuan_6 IS NULL THEN 0 ELSE 1 END) +
            (CASE WHEN absen_dosen_view_web.pertemuan_7 IS NULL THEN 0 ELSE 1 END) +
            (CASE WHEN absen_dosen_view_web.pertemuan_8 IS NULL THEN 0 ELSE 1 END) AS Hitung
        
        FROM 
            absen_dosen_view_web
        WHERE 
            absen_dosen_view_web.NAMA_DOSEN NOT IN ('')
        ) AS cte
    ORDER BY 
        cte.NAMA_DOSEN ASC;";

        return $this->db->query($sql)->result();
    }

    public function getRepositoryTersedia()
    {
        $sql = "SELECT 
        cte.*,
        (cte.Hitung / 8.0) * 100 AS presentase
    FROM 
        (SELECT 
            absen_dosen_view_web.NIDN,
            absen_dosen_view_web.NAMA_DOSEN,
            absen_dosen_view_web.PRODI,
            absen_dosen_view_web.KD_MK,
            absen_dosen_view_web.NAMA_MK,
            absen_dosen_view_web.sks,
            absen_dosen_view_web.pertemuan_1,
            absen_dosen_view_web.pertemuan_2,
            absen_dosen_view_web.pertemuan_3,
            absen_dosen_view_web.pertemuan_4,
            absen_dosen_view_web.pertemuan_5,
            absen_dosen_view_web.pertemuan_6,
            absen_dosen_view_web.pertemuan_7,
            absen_dosen_view_web.pertemuan_8,
        
            (CASE WHEN absen_dosen_view_web.pertemuan_1 IS NULL THEN 0 ELSE 1 END) +
            (CASE WHEN absen_dosen_view_web.pertemuan_2 IS NULL THEN 0 ELSE 1 END) +
            (CASE WHEN absen_dosen_view_web.pertemuan_3 IS NULL THEN 0 ELSE 1 END) +
            (CASE WHEN absen_dosen_view_web.pertemuan_4 IS NULL THEN 0 ELSE 1 END) +
            (CASE WHEN absen_dosen_view_web.pertemuan_5 IS NULL THEN 0 ELSE 1 END) +
            (CASE WHEN absen_dosen_view_web.pertemuan_6 IS NULL THEN 0 ELSE 1 END) +
            (CASE WHEN absen_dosen_view_web.pertemuan_7 IS NULL THEN 0 ELSE 1 END) +
            (CASE WHEN absen_dosen_view_web.pertemuan_8 IS NULL THEN 0 ELSE 1 END) AS Hitung
        
        FROM 
            absen_dosen_view_web
        WHERE 
            absen_dosen_view_web.NAMA_DOSEN NOT IN ('')
        ) AS cte
    WHERE 
        (cte.Hitung / 8.0) * 100 > 50
    ORDER BY 
        cte.NAMA_DOSEN ASC;";
        return $this->db->query($sql)->result();

    }

    public function getRepositorybelumTersedia(){
        $sql = "SELECT 
        cte.*,
        (cte.Hitung / 8.0) * 100 AS presentase
    FROM 
        (SELECT 
            absen_dosen_view_web.NIDN,
            absen_dosen_view_web.NAMA_DOSEN,
            absen_dosen_view_web.PRODI,
            absen_dosen_view_web.KD_MK,
            absen_dosen_view_web.NAMA_MK,
            absen_dosen_view_web.sks,
            absen_dosen_view_web.pertemuan_1,
            absen_dosen_view_web.pertemuan_2,
            absen_dosen_view_web.pertemuan_3,
            absen_dosen_view_web.pertemuan_4,
            absen_dosen_view_web.pertemuan_5,
            absen_dosen_view_web.pertemuan_6,
            absen_dosen_view_web.pertemuan_7,
            absen_dosen_view_web.pertemuan_8,
        
            (CASE WHEN absen_dosen_view_web.pertemuan_1 IS NULL THEN 0 ELSE 1 END) +
            (CASE WHEN absen_dosen_view_web.pertemuan_2 IS NULL THEN 0 ELSE 1 END) +
            (CASE WHEN absen_dosen_view_web.pertemuan_3 IS NULL THEN 0 ELSE 1 END) +
            (CASE WHEN absen_dosen_view_web.pertemuan_4 IS NULL THEN 0 ELSE 1 END) +
            (CASE WHEN absen_dosen_view_web.pertemuan_5 IS NULL THEN 0 ELSE 1 END) +
            (CASE WHEN absen_dosen_view_web.pertemuan_6 IS NULL THEN 0 ELSE 1 END) +
            (CASE WHEN absen_dosen_view_web.pertemuan_7 IS NULL THEN 0 ELSE 1 END) +
            (CASE WHEN absen_dosen_view_web.pertemuan_8 IS NULL THEN 0 ELSE 1 END) AS Hitung
        
        FROM 
            absen_dosen_view_web
        WHERE 
            absen_dosen_view_web.NAMA_DOSEN NOT IN ('')
        ) AS cte
    WHERE 
        (cte.Hitung / 8.0) * 100 < 50
    ORDER BY 
        cte.NAMA_DOSEN ASC;";
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


}