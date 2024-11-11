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

        // Panggil data User

        // Hitung jumlah baris dalam tabel 'user'
        $countuser = $this->db->count_all('user');

        // Tambahkan 1 pada jumlah yang ada, lalu format dengan padding nol di kiri
        $kode_user = str_pad($countuser + 1, 4, '0', STR_PAD_LEFT);

        // Gabungkan prefix 'USER' dengan nomor yang telah dipad
        $kode_user_show = 'USER' . $kode_user;

        $data = array(
            'fullname' => $post["fullname"],
            'password' => $password_baru_hash,
            'username' => $post["username"],
            'pass_text' => $post["password"],
            'role' => 3,
            'kode_user' => $kode_user_show

        );

        $this->db->insert('user', $data);


        // Otomatis Save

        $date = date("Y-m-d H:i:s"); // Current date and time  

        // Tambah Kode Perushaan
        $this->load->model("M_Upload_perusahaan");

        $count = $this->M_Upload_perusahaan->get_count_perusahaan();
        $kode_number = str_pad($count + 1, 4, '0', STR_PAD_LEFT);
        $kode_perusahaan = 'RAJAAUDIT' . $kode_number;

        $nama_perusahaan = $this->input->post('nama_perusahaan');
        $tahun_buku = $this->input->post('tahun_buku');
        //  $user_id = $this->input->post('user_id');

        $data = array(
            'kode_perusahaan' => $kode_perusahaan,
            'nama_perusahaan' => $post["fullname"],
            'tahun_audit' => $tahun_buku,
            'tanggal_input' => $date,
            'user_id' => $kode_user_show
        );

        $this->db->insert('perusahaan', $data);


        $daftar_akun = $this->input->post('daftar_akun[]');

        // Pastikan ada akun yang dipilih
        // Siapkan array untuk menyimpan data yang akan dimasukkan ke database
        $data = array();

        foreach ($daftar_akun as $kode_akun) {
            // Memasukkan setiap data ke dalam array
            $data[] = array(
                'kode_akun' => $kode_akun,
                'created_at' => date('Y-m-d H:i:s'), // Timestamp (opsional)
                'kode_perusahaan' => $kode_perusahaan,
            );
        }

        // Masukkan data ke database menggunakan insert_batch
        $this->db->insert_batch('role_akun_perusahaan', $data);

        // Tampilkan pesan sukses dan redirect ke halaman tertentu
        $this->session->set_flashdata('message', 'Data akun berhasil disimpan!');
        redirect('akun/index');

    }


    public function delete($no)
    {
        return $this->db->delete($this->_table, array("no_bayar_catering" => $no));
    }

    public function getTahunBuku()
    {
        //return $this->db->get($this->_table)->result();
        $sql = "SELECT * FROM tahun_buku";

        return $this->db->query($sql)->result();
    }

    public function getDaftarAkun()
    {
        //return $this->db->get($this->_table)->result();
        $sql = "SELECT daftar_akun.nama_akun AS nama_akun, 
       daftar_akun.kode_akun AS kode_akun
            FROM list_akun 
            LEFT JOIN daftar_akun 
            ON list_akun.kode_akun = daftar_akun.kode_akun
            WHERE daftar_akun.kode_akun IS NOT NULL
            GROUP BY daftar_akun.nama_akun, daftar_akun.kode_akun;";

        return $this->db->query($sql)->result();
    }

    public function insert_tahun_buku($data)
    {
        $this->db->insert('tahun_buku', $data); // Ganti 'uploads' dengan nama tabel tempat menyimpan data upload
    }

    public function get_akun_by_list($id_akun)
    {
        $this->db->where('Kode_akun', $id_akun);
        $query = $this->db->get('list_akun'); // Ganti 'data_role' dengan tabel yang sesuai
        return $query->result();
    }



}