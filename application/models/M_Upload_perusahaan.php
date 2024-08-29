<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_Upload_perusahaan extends CI_Model
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
                'field' => 'nama_perusahaan',
                'label' => 'nama_perusahaan',
                'rules' => 'required', // Add any additional validation rules here
            ],
            [
                'field' => 'tahun_audit',
                'label' => 'tahun_audit',
                'rules' => 'required|integer', // Add any additional validation rules here
            ],
            [
                'field' => 'pic',
                'label' => 'pic',
                'rules' => 'required', // Add any additional validation rules here
            ],
        ];
    }


    public function getAll()
    {
        //return $this->db->get($this->_table)->result();

        if ($this->session->userdata('role') == 3) {
            $sql = "SELECT *  
            FROM perusahaan  
            WHERE user_id = '" . $this->session->userdata('id') . "'";
        } else {
            $sql = "SELECT *  
            FROM perusahaan";
        }

        return $this->db->query($sql)->result();
    }


    public function GerUserPerusahaan()
    {
        //return $this->db->get($this->_table)->result();
        $sql = "SELECT *  
            FROM user WHERE role=3";

        return $this->db->query($sql)->result();
    }



    public function insert_upload($data)
    {
        $this->db->insert('temp_upload_perusahaan', $data); // Ganti 'uploads' dengan nama tabel tempat menyimpan data upload
    }

    public function update_upload($data)
    {
        $this->db->insert('upload_perusahaan', $data); // Ganti 'uploads' dengan nama tabel tempat menyimpan data upload
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


    public function get_data_by_id_view($kode_perusahaan)
    {

        $sql = "SELECT a.no as no_akun, a.nama_akun as nama_akun, b.no as no_list, b.list as list, c.no_akun as no_akun_temp, c.id_perusahaan, c.file_path as file_path
        FROM daftar_akun a 
        LEFT JOIN list_akun b 
        ON a.no = b.no_akun
        LEFT JOIN (SELECT no_akun, file_path, no_list , id_perusahaan FROM upload_perusahaan) c 
        ON a.no = c.no_akun AND b.NO = c.no_list
        WHERE C.id_perusahaan = '$kode_perusahaan'";

        return $this->db->query($sql)->result();


    }


    public function get_data_by_id_LegalHRD($tabel_data_upload, $kode_perusahaan)
    {
        $sql = "SELECT a.no AS no_akun, a.nama_akun AS nama_akun, b.no AS no_list, b.list AS list,   
                   c.no_akun AS no_akun_temp, c.file_path AS file_path,   
                   c.nama_file AS nama_file, c.tanggal_upload AS tanggal_upload , c.komentar as komentar, c.status_upload
            FROM daftar_akun a   
            LEFT JOIN list_akun b   
            ON a.no = b.no_akun  
            LEFT JOIN (SELECT no_akun, id_perusahaan, file_path, no_list, nama_file, tanggal_upload, komentar, status_upload 
            FROM $tabel_data_upload WHERE id_perusahaan =  '$kode_perusahaan') c   
            ON a.no = c.no_akun AND b.no = c.no_list  
            WHERE a.no = 45";

        return $this->db->query($sql)->result();
    }


    public function get_data_by_id_Akta($tabel_data_upload, $kode_perusahaan)
    {
        $sql = "SELECT a.no AS no_akun, a.nama_akun AS nama_akun, b.no AS no_list, b.list AS list,   
                   c.no_akun AS no_akun_temp, c.file_path AS file_path,   
                   c.nama_file AS nama_file, c.tanggal_upload AS tanggal_upload  
            FROM daftar_akun a   
            LEFT JOIN list_akun b   
            ON a.no = b.no_akun  
            LEFT JOIN (SELECT no_akun, id_perusahaan, file_path, no_list, nama_file, tanggal_upload 
            FROM $tabel_data_upload WHERE id_perusahaan =  '$kode_perusahaan') c   
            ON a.no = c.no_akun AND b.no = c.no_list  
            WHERE a.no = 46";

        return $this->db->query($sql)->result();
    }



    public function get_data_by_id_Laporan($tabel_data_upload, $kode_perusahaan)
    {

        $sql = "SELECT a.no AS no_akun, a.nama_akun AS nama_akun, b.no AS no_list, b.list AS list,   
                c.no_akun AS no_akun_temp, c.file_path AS file_path,   
                c.nama_file AS nama_file, c.tanggal_upload AS tanggal_upload  
            FROM daftar_akun a   
            LEFT JOIN list_akun b   
            ON a.no = b.no_akun  
         LEFT JOIN (SELECT no_akun, id_perusahaan, file_path, no_list, nama_file, tanggal_upload 
            FROM $tabel_data_upload WHERE id_perusahaan =  '$kode_perusahaan') c   
            ON a.no = c.no_akun AND b.no = c.no_list  
        WHERE a.no = 47";

        return $this->db->query($sql)->result();


    }

    public function get_data_by_id_Kas_Setara_kas($tabel_data_upload, $kode_perusahaan)
    {

        $sql = "SELECT a.no AS no_akun, a.nama_akun AS nama_akun, b.no AS no_list, b.list AS list,   
                c.no_akun AS no_akun_temp, c.file_path AS file_path,   
                c.nama_file AS nama_file, c.tanggal_upload AS tanggal_upload  
            FROM daftar_akun a   
            LEFT JOIN list_akun b   
            ON a.no = b.no_akun  
            LEFT JOIN (SELECT no_akun, id_perusahaan, file_path, no_list, nama_file, tanggal_upload 
            FROM $tabel_data_upload WHERE id_perusahaan =  '$kode_perusahaan') c   
            ON a.no = c.no_akun AND b.no = c.no_list  
        WHERE a.no = 48";

        return $this->db->query($sql)->result();
    }

    public function get_data_by_id_Deposit_berjangka($tabel_data_upload, $kode_perusahaan)
    {

        $sql = "SELECT a.no AS no_akun, a.nama_akun AS nama_akun, b.no AS no_list, b.list AS list,   
        c.no_akun AS no_akun_temp, c.file_path AS file_path,   
        c.nama_file AS nama_file, c.tanggal_upload AS tanggal_upload  
    FROM daftar_akun a   
    LEFT JOIN list_akun b   
    ON a.no = b.no_akun  
       LEFT JOIN (SELECT no_akun, id_perusahaan, file_path, no_list, nama_file, tanggal_upload 
            FROM $tabel_data_upload WHERE id_perusahaan =  '$kode_perusahaan') c   
    ON a.no = c.no_akun AND b.no = c.no_list  
        WHERE a.no = 49";

        return $this->db->query($sql)->result();
    }

    public function get_data_by_id_Inv_Jangka_Pendek($tabel_data_upload, $kode_perusahaan)
    {

        $sql = "SELECT a.no AS no_akun, a.nama_akun AS nama_akun, b.no AS no_list, b.list AS list,   
                c.no_akun AS no_akun_temp, c.file_path AS file_path,   
                c.nama_file AS nama_file, c.tanggal_upload AS tanggal_upload  
            FROM daftar_akun a   
            LEFT JOIN list_akun b   
            ON a.no = b.no_akun  
           LEFT JOIN (SELECT no_akun, id_perusahaan, file_path, no_list, nama_file, tanggal_upload 
            FROM $tabel_data_upload WHERE id_perusahaan =  '$kode_perusahaan') c  
            ON a.no = c.no_akun AND b.no = c.no_list  
        WHERE a.no = 50";

        return $this->db->query($sql)->result();
    }

    public function get_data_by_id_Piutang_Usaha_AR($tabel_data_upload, $kode_perusahaan)
    {

        $sql = "SELECT a.no AS no_akun, a.nama_akun AS nama_akun, b.no AS no_list, b.list AS list,   
        c.no_akun AS no_akun_temp, c.file_path AS file_path,   
        c.nama_file AS nama_file, c.tanggal_upload AS tanggal_upload  
    FROM daftar_akun a   
    LEFT JOIN list_akun b   
    ON a.no = b.no_akun  
     LEFT JOIN (SELECT no_akun, id_perusahaan, file_path, no_list, nama_file, tanggal_upload 
            FROM $tabel_data_upload WHERE id_perusahaan =  '$kode_perusahaan') c     
    ON a.no = c.no_akun AND b.no = c.no_list  
        WHERE a.no = 51";

        return $this->db->query($sql)->result();
    }

    public function get_data_by_id_Piutang_Lain($tabel_data_upload, $kode_perusahaan)
    {

        $sql = "SELECT a.no AS no_akun, a.nama_akun AS nama_akun, b.no AS no_list, b.list AS list,   
        c.no_akun AS no_akun_temp, c.file_path AS file_path,   
        c.nama_file AS nama_file, c.tanggal_upload AS tanggal_upload  
    FROM daftar_akun a   
    LEFT JOIN list_akun b   
    ON a.no = b.no_akun  
      LEFT JOIN (SELECT no_akun, id_perusahaan, file_path, no_list, nama_file, tanggal_upload 
            FROM $tabel_data_upload WHERE id_perusahaan =  '$kode_perusahaan') c     
    ON a.no = c.no_akun AND b.no = c.no_list  
        WHERE a.no = 52";

        return $this->db->query($sql)->result();
    }

    public function get_data_by_id_Persediaan($tabel_data_upload, $kode_perusahaan)
    {

        $sql = "SELECT a.no AS no_akun, a.nama_akun AS nama_akun, b.no AS no_list, b.list AS list,   
        c.no_akun AS no_akun_temp, c.file_path AS file_path,   
        c.nama_file AS nama_file, c.tanggal_upload AS tanggal_upload  
    FROM daftar_akun a   
    LEFT JOIN list_akun b   
    ON a.no = b.no_akun  
   LEFT JOIN (SELECT no_akun, id_perusahaan, file_path, no_list, nama_file, tanggal_upload 
            FROM $tabel_data_upload WHERE id_perusahaan =  '$kode_perusahaan') c     
    ON a.no = c.no_akun AND b.no = c.no_list  
        WHERE a.no = 53";

        return $this->db->query($sql)->result();
    }

    public function get_data_by_id_Uang_muka($tabel_data_upload, $kode_perusahaan)
    {

        $sql = "SELECT a.no AS no_akun, a.nama_akun AS nama_akun, b.no AS no_list, b.list AS list,   
                c.no_akun AS no_akun_temp, c.file_path AS file_path,   
                c.nama_file AS nama_file, c.tanggal_upload AS tanggal_upload  
            FROM daftar_akun a   
            LEFT JOIN list_akun b   
            ON a.no = b.no_akun  
            LEFT JOIN (SELECT no_akun, id_perusahaan, file_path, no_list, nama_file, tanggal_upload 
            FROM $tabel_data_upload WHERE id_perusahaan =  '$kode_perusahaan') c     
            ON a.no = c.no_akun AND b.no = c.no_list  
        WHERE a.no = 54";

        return $this->db->query($sql)->result();
    }

    public function get_data_by_Pajak_dibayar_dimuka($tabel_data_upload, $kode_perusahaan)
    {

        $sql = "SELECT a.no AS no_akun, a.nama_akun AS nama_akun, b.no AS no_list, b.list AS list,   
                c.no_akun AS no_akun_temp, c.file_path AS file_path,   
                c.nama_file AS nama_file, c.tanggal_upload AS tanggal_upload  
            FROM daftar_akun a   
            LEFT JOIN list_akun b   
            ON a.no = b.no_akun  
              LEFT JOIN (SELECT no_akun, id_perusahaan, file_path, no_list, nama_file, tanggal_upload 
            FROM $tabel_data_upload WHERE id_perusahaan =  '$kode_perusahaan') c     
            ON a.no = c.no_akun AND b.no = c.no_list  
        WHERE a.no = 55";

        return $this->db->query($sql)->result();
    }


    public function getTableSPM()
    {

        $sql = "SELECT * FROM SPM";

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

    public function check_duplicate_name($nama_perusahaan)
    {
        $this->db->where('nama_perusahaan', $nama_perusahaan);
        $query = $this->db->get('perusahaan');
        return $query->num_rows() > 0;
    }



    public function getByNomor($kode_perusahaan)
    {

        $sql = "SELECT * FROM  perusahaan a 
		LEFT JOIN temp_upload_perusahaan b
		ON a.kode_perusahaan = b.id_perusahaan
        WHERE a.kode_perusahaan = '$kode_perusahaan'";

        return $this->db->query($sql)->result();


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

    public function savePerusahaan()
    {
        //   $post = $this->input->post();

        // $date=date("Y-d-m");

        // $data = array(
        //     'kode_perusahaan' => $post["kode_perusahaan"],
        //     'nama_perusahaan' => $post["nama_perusahaan"],
        //     'tahun_audit' => $post["tahun_audit"],
        //     'kd_icon' => $post["kd_icon"],
        // );

        $this->db->insert('perusahaan', $data);

    }


    public function delete($no)
    {
        return $this->db->delete($this->_table, array("no_bayar_catering" => $no));
    }

    public function get_count_perusahaan()
    {
        return $this->db->count_all('perusahaan');
    }


}