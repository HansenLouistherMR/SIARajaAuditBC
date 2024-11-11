<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_internal_operasional extends CI_Model
{

    private $_table = "role";

    public function rulesData()
    {
        return [
            // [
            //     'field' => 'tipe_modul',
            //     'label' => 'tipe_modul',
            //     'rules' => 'required', // Add any additional validation rules here
            // ],
            [
                'field' => 'kode_perusahaan',
                'label' => 'kode_perusahaan',
                'rules' => 'required', // Add any additional validation rules here
            ],
            [
                'field' => 'PIC',
                'label' => 'PIC',
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


    public function getAkunAuditor()
    {
        //return $this->db->get($this->_table)->result();
        $sql = "SELECT *  
            FROM user
			WHERE role=2";

        return $this->db->query($sql)->result();
    }

    public function GetTahunBukuPerusahaan()
    {
        //return $this->db->get($this->_table)->result();
        $sql = "SELECT *  
            FROM tahun_buku";

        return $this->db->query($sql)->result();
    }




    public function GerUserPerusahaan()
    {
        //return $this->db->get($this->_table)->result();
        $sql = "SELECT *  
            FROM user
			WHERE role=3";

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

        $sql = "SELECT a.kode_akun as kode_akun, a.nama_akun as nama_akun, b.no as no_list, b.list as list, c.no_akun as no_akun_temp, c.id_perusahaan, c.file_path as file_path
        FROM daftar_akun a 
        LEFT JOIN list_akun b 
        ON a.kode_akun = b.kode_akun
        LEFT JOIN (SELECT no_akun, file_path, no_list , id_perusahaan FROM upload_perusahaan) c 
        ON a.kode_akun = c.no_akun AND b.NO = c.no_list
        WHERE C.id_perusahaan = '$kode_perusahaan'";

        return $this->db->query($sql)->result();


    }

    public function get_daily_report()
    {
        // $sql = "SELECT * FROM audit_final_io
        //     ";

        $sql = "SELECT *, c.auditor , download_io_stats.total_downloads, download_io_stats. id_io
        FROM internal_opersional 
        LEFT JOIN user 
            ON internal_opersional.kode_perusahaan = user.kode_user
        LEFT JOIN 
        (
            SELECT user_id, fullname AS auditor 
            FROM user
        ) c 
            ON internal_opersional.user_upload = c.user_id
        LEFT JOIN 
        (
            SELECT COUNT(no) AS total_downloads, id_io  
            FROM download_io 
            GROUP BY id_io
        ) AS download_io_stats
        ON internal_opersional.id = download_io_stats.id_io
        ORDER BY tanggal DESC;
    ";
        return $this->db->query($sql)->result();
    }

    public function get_daily_report_auditor()
    {
        $sql = "SELECT *, c.auditor , download_io_stats.total_downloads, download_io_stats. id_io
            FROM internal_opersional 
            LEFT JOIN user 
                ON internal_opersional.kode_perusahaan = user.kode_user
            LEFT JOIN 
            (
                SELECT user_id, fullname AS auditor 
                FROM user
            ) c 
                ON internal_opersional.user_upload = c.user_id
			LEFT JOIN 
			(
				SELECT COUNT(no) AS total_downloads, id_io  
				FROM download_io 
				GROUP BY id_io
			) AS download_io_stats
			ON internal_opersional.id = download_io_stats.id_io
			WHERE internal_opersional.user_upload = " . $this->session->userdata('id') . "
            ORDER BY tanggal DESC;
        ";

        return $this->db->query($sql)->result();

    }




    public function get_data_by_id_LegalHRD($tabel_data_upload, $kode_perusahaan)
    {
        $sql = "SELECT a.Kode_Akun AS Kode_Akun, 
        a.nama_akun AS nama_akun,  
        b.list AS list,
         c.nama_file AS nama_file, c.tanggal_upload AS tanggal_upload , c.komentar as komentar, c.status_upload, c.no_list, c.no_akun
        FROM daftar_akun a 
        LEFT JOIN list_akun b 
        ON a.Kode_Akun = b.Kode_akun  
                    LEFT JOIN (SELECT no_akun, id_perusahaan, file_path, no_list, nama_file, tanggal_upload, komentar, status_upload 
                    FROM $tabel_data_upload WHERE id_perusahaan =  '$kode_perusahaan') c   
                    ON a.Kode_akun = c.no_akun AND b.no = c.no_list 
                    WHERE a.Kode_akun = 'A11'";

        return $this->db->query($sql)->result();
    }


    public function get_data_by_id_Akta($tabel_data_upload, $kode_perusahaan)
    {

        $sql = "SELECT a.Kode_Akun AS Kode_Akun, 
        a.nama_akun AS nama_akun,  
        b.list AS list,
         c.nama_file AS nama_file, c.tanggal_upload AS tanggal_upload , c.komentar as komentar, c.status_upload, c.no_list, c.no_akun
        FROM daftar_akun a 
        LEFT JOIN list_akun b 
        ON a.Kode_Akun = b.Kode_akun  
                    LEFT JOIN (SELECT no_akun, id_perusahaan, file_path, no_list, nama_file, tanggal_upload, komentar, status_upload 
                    FROM $tabel_data_upload WHERE id_perusahaan =  '$kode_perusahaan') c   
                    ON a.Kode_akun = c.no_akun AND b.no = c.no_list 
                    WHERE a.Kode_akun = 'A12'";

        return $this->db->query($sql)->result();
    }



    public function get_data_by_id_Laporan($tabel_data_upload, $kode_perusahaan)
    {

        $sql = "SELECT a.Kode_Akun AS Kode_Akun, 
        a.nama_akun AS nama_akun,  
        b.list AS list,
         c.nama_file AS nama_file, c.tanggal_upload AS tanggal_upload , c.komentar as komentar, c.status_upload, c.no_list, c.no_akun
        FROM daftar_akun a 
        LEFT JOIN list_akun b 
        ON a.Kode_Akun = b.Kode_akun  
                    LEFT JOIN (SELECT no_akun, id_perusahaan, file_path, no_list, nama_file, tanggal_upload, komentar, status_upload 
                    FROM $tabel_data_upload WHERE id_perusahaan =  '$kode_perusahaan') c   
                    ON a.Kode_akun = c.no_akun AND b.no = c.no_list 
                    WHERE a.Kode_akun = 'B11'";

        return $this->db->query($sql)->result();


    }

    public function get_data_by_id_Kas_Setara_kas($tabel_data_upload, $kode_perusahaan)
    {

        $sql = "SELECT a.Kode_Akun AS Kode_Akun, 
        a.nama_akun AS nama_akun,  
        b.list AS list,
         c.nama_file AS nama_file, c.tanggal_upload AS tanggal_upload , c.komentar as komentar, c.status_upload, c.no_list, c.no_akun
        FROM daftar_akun a 
        LEFT JOIN list_akun b 
        ON a.Kode_Akun = b.Kode_akun  
                    LEFT JOIN (SELECT no_akun, id_perusahaan, file_path, no_list, nama_file, tanggal_upload, komentar, status_upload 
                    FROM $tabel_data_upload WHERE id_perusahaan =  '$kode_perusahaan') c   
                    ON a.Kode_akun = c.no_akun AND b.no = c.no_list 
                    WHERE a.Kode_akun = 'B12'";

        return $this->db->query($sql)->result();
    }

    public function get_data_by_id_Deposit_berjangka($tabel_data_upload, $kode_perusahaan)
    {

        $sql = "SELECT a.Kode_Akun AS Kode_Akun, 
        a.nama_akun AS nama_akun,  
        b.list AS list,
         c.nama_file AS nama_file, c.tanggal_upload AS tanggal_upload , c.komentar as komentar, c.status_upload, c.no_list, c.no_akun
        FROM daftar_akun a 
        LEFT JOIN list_akun b 
        ON a.Kode_Akun = b.Kode_akun  
                    LEFT JOIN (SELECT no_akun, id_perusahaan, file_path, no_list, nama_file, tanggal_upload, komentar, status_upload 
                    FROM $tabel_data_upload WHERE id_perusahaan =  '$kode_perusahaan') c   
                    ON a.Kode_akun = c.no_akun AND b.no = c.no_list 
                    WHERE a.Kode_akun = 'B13'";

        return $this->db->query($sql)->result();
    }

    public function get_data_by_id_Inv_Jangka_Pendek($tabel_data_upload, $kode_perusahaan)
    {

        $sql = "SELECT a.Kode_Akun AS Kode_Akun, 
        a.nama_akun AS nama_akun,  
        b.list AS list,
         c.nama_file AS nama_file, c.tanggal_upload AS tanggal_upload , c.komentar as komentar, c.status_upload, c.no_list, c.no_akun
        FROM daftar_akun a 
        LEFT JOIN list_akun b 
        ON a.Kode_Akun = b.Kode_akun  
                    LEFT JOIN (SELECT no_akun, id_perusahaan, file_path, no_list, nama_file, tanggal_upload, komentar, status_upload 
                    FROM $tabel_data_upload WHERE id_perusahaan =  '$kode_perusahaan') c   
                    ON a.Kode_akun = c.no_akun AND b.no = c.no_list 
                    WHERE a.Kode_akun = 'B14'";

        return $this->db->query($sql)->result();
    }

    public function get_data_by_id_Piutang_Usaha_AR($tabel_data_upload, $kode_perusahaan)
    {

        $sql = "SELECT a.Kode_Akun AS Kode_Akun, 
        a.nama_akun AS nama_akun,  
        b.list AS list,
         c.nama_file AS nama_file, c.tanggal_upload AS tanggal_upload , c.komentar as komentar, c.status_upload, c.no_list, c.no_akun
        FROM daftar_akun a 
        LEFT JOIN list_akun b 
        ON a.Kode_Akun = b.Kode_akun  
                    LEFT JOIN (SELECT no_akun, id_perusahaan, file_path, no_list, nama_file, tanggal_upload, komentar, status_upload 
                    FROM $tabel_data_upload WHERE id_perusahaan =  '$kode_perusahaan') c   
                    ON a.Kode_akun = c.no_akun AND b.no = c.no_list 
                    WHERE a.Kode_akun = 'B15'";

        return $this->db->query($sql)->result();
    }

    public function get_data_by_id_Piutang_Lain($tabel_data_upload, $kode_perusahaan)
    {

        $sql = "SELECT a.Kode_Akun AS Kode_Akun, 
        a.nama_akun AS nama_akun,  
        b.list AS list,
         c.nama_file AS nama_file, c.tanggal_upload AS tanggal_upload , c.komentar as komentar, c.status_upload, c.no_list, c.no_akun
        FROM daftar_akun a 
        LEFT JOIN list_akun b 
        ON a.Kode_Akun = b.Kode_akun  
                    LEFT JOIN (SELECT no_akun, id_perusahaan, file_path, no_list, nama_file, tanggal_upload, komentar, status_upload 
                    FROM $tabel_data_upload WHERE id_perusahaan =  '$kode_perusahaan') c   
                    ON a.Kode_akun = c.no_akun AND b.no = c.no_list 
                    WHERE a.Kode_akun = 'B16'";

        return $this->db->query($sql)->result();
    }

    public function get_data_by_id_Persediaan($tabel_data_upload, $kode_perusahaan)
    {

        $sql = "SELECT a.Kode_Akun AS Kode_Akun, 
        a.nama_akun AS nama_akun,  
        b.list AS list,
         c.nama_file AS nama_file, c.tanggal_upload AS tanggal_upload , c.komentar as komentar, c.status_upload, c.no_list, c.no_akun
        FROM daftar_akun a 
        LEFT JOIN list_akun b 
        ON a.Kode_Akun = b.Kode_akun  
                    LEFT JOIN (SELECT no_akun, id_perusahaan, file_path, no_list, nama_file, tanggal_upload, komentar, status_upload 
                    FROM $tabel_data_upload WHERE id_perusahaan =  '$kode_perusahaan') c   
                    ON a.Kode_akun = c.no_akun AND b.no = c.no_list 
                    WHERE a.Kode_akun = 'B17'";

        return $this->db->query($sql)->result();
    }

    public function get_data_by_id_Uang_muka($tabel_data_upload, $kode_perusahaan)
    {

        $sql = "SELECT a.Kode_Akun AS Kode_Akun, 
        a.nama_akun AS nama_akun,  
        b.list AS list,
         c.nama_file AS nama_file, c.tanggal_upload AS tanggal_upload , c.komentar as komentar, c.status_upload, c.no_list, c.no_akun
        FROM daftar_akun a 
        LEFT JOIN list_akun b 
        ON a.Kode_Akun = b.Kode_akun  
                    LEFT JOIN (SELECT no_akun, id_perusahaan, file_path, no_list, nama_file, tanggal_upload, komentar, status_upload 
                    FROM $tabel_data_upload WHERE id_perusahaan =  '$kode_perusahaan') c   
                    ON a.Kode_akun = c.no_akun AND b.no = c.no_list 
                    WHERE a.Kode_akun = 'B18'";

        return $this->db->query($sql)->result();
    }

    public function get_data_by_Pajak_dibayar_dimuka($tabel_data_upload, $kode_perusahaan)
    {

        $sql = "SELECT a.Kode_Akun AS Kode_Akun, 
        a.nama_akun AS nama_akun,  
        b.list AS list,
         c.nama_file AS nama_file, c.tanggal_upload AS tanggal_upload , c.komentar as komentar, c.status_upload, c.no_list, c.no_akun
        FROM daftar_akun a 
        LEFT JOIN list_akun b 
        ON a.Kode_Akun = b.Kode_akun  
                    LEFT JOIN (SELECT no_akun, id_perusahaan, file_path, no_list, nama_file, tanggal_upload, komentar, status_upload 
                    FROM $tabel_data_upload WHERE id_perusahaan =  '$kode_perusahaan') c   
                    ON a.Kode_akun = c.no_akun AND b.no = c.no_list 
                    WHERE a.Kode_akun = 'B19'";

        return $this->db->query($sql)->result();
    }


    public function get_data_konfirmasi_bank()
    {

        $sql = "SELECT * FROM `konfirmasi_bank_rupiah` UNION ALL SELECT * FROM `konfirmasi_bank_USD`;";

        return $this->db->query($sql)->result();
    }

    public function get_data_konfirmasi_piutang_usaha()
    {

        $sql = "SELECT * FROM `konfirmasi_piutang_usaha`";

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
    public function insert_download($kode_user, $nama_file)
    {
        $data = [
            'user_id' => $kode_user,
            'nama_file' => $nama_file,
            'tanggal' => date('Y-m-d H:i:s') // Simpan tanggal unduhan
        ];
        return $this->db->insert('download_io', $data); // Sesuaikan dengan nama tabelmu
    }

    public function SaveIO()
    {
        $post = $this->input->post();

        // Tentukan path direktori berdasarkan kode_perusahaan
        //   $uploadPath = './Internal_Opersional/uploads/' . $post["kode_perusahaan"] . '/' . $post["tahun_buku"];
        $uploadPath = './Internal_Opersional/uploads/' . $post["kode_perusahaan"];

        // $uploadPath = './Internal_Opersional/uploads/';


        // Cek apakah direktori sudah ada, jika belum, buat direktori
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0777, true); // 0777 memberikan hak akses penuh, true untuk membuat direktori secara rekursif
        }

        $config['upload_path'] = $uploadPath;
        $config['allowed_types'] = 'pdf|doc|docx|xls|xlsx|ppt|pptx|zip|rar'; // Hanya file doc, excel, pdf, zip, rar, power point
        $config['max_size'] = 15360; // Ubah menjadi 15 MB (15.360 KB)
        $this->load->library('upload', $config);


        if (!$this->upload->do_upload('fileToUpload')) {
            $error = array('error' => $this->upload->display_errors());

            // Log error untuk debugging
            log_message('error', 'File upload error: ' . $this->upload->display_errors());


        } else {
            $data = array('image_metadata' => $this->upload->data());

            // Log success untuk debugging
            log_message('info', 'File uploaded successfully: ' . json_encode($this->upload->data()));

            $data = $this->upload->data(); // Get the file upload data  
            $filePath = $data['full_path']; // Full path to the uploaded file  
            $fileName = $data['file_name']; // Name of the uploaded file  
            // $fileUrl = base_url('path/to/uploads/' . $fileName); // Create the file URL  

            date_default_timezone_set('Asia/Jakarta'); // Set timezone to Jakarta, Indonesia  
            $date = date("Y-m-d H:i:s"); // Current date and time  

            $data = array(
                // 'tipe_modul' => $post["tipe_modul"],
                'kode_perusahaan' => $post["kode_perusahaan"],
                //  'tahun_buku' => $post["tahun_buku"],
                'nama_file' => $fileName,
                'user_upload' => $post["user_upload"],
                'tanggal' => $date,
            );

            $this->db->insert('internal_opersional', $data);
        }
    }

    public function SaveIO_AF()
    {
        $post = $this->input->post();

        // Tentukan path direktori berdasarkan kode_perusahaan
        $baseDir = './Internal_Opersional/audit_final/';
        $kode_perusahaan = $post["kode_perusahaan"];

        // Buat array yang berisi nama-nama input file yang ingin diunggah

        $files = [
            'Englat' => $baseDir . $kode_perusahaan . '/Englat',
            'Surat_k_p' => $baseDir . $kode_perusahaan . '/Surat_keberatan_profesi',
            'Excel_Final' => $baseDir . $kode_perusahaan . '/Excel_Final',
            'Perset_Final' => $baseDir . $kode_perusahaan . '/Perset_Final',
            'File_Buku_Audit' => $baseDir . $kode_perusahaan . '/File_Buku_Audit',
            'PMPJ' => $baseDir . $kode_perusahaan . '/PMPJ',
            'Surat_Pembatalan' => $baseDir . $kode_perusahaan . '/Surat_Pembatalan'
        ];


        // Konfigurasi dasar upload
        $config['allowed_types'] = 'pdf|doc|docx|xls|xlsx|ppt|pptx|zip|rar';
        $config['max_size'] = 15360; // Ukuran maksimal 15 MB

        $this->load->library('upload'); // Load library upload tanpa parameter untuk diinisialisasi per file

        // Array untuk menyimpan hasil upload
        $uploaded_files = [];
        $upload_errors = [];

        // Loop setiap file yang ingin diunggah
        foreach ($files as $field_name => $uploadPath) {
            // Cek apakah direktori sudah ada, jika belum, buat direktori
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }

            // Update path upload sesuai dengan direktori spesifik untuk tiap file
            $config['upload_path'] = $uploadPath;
            $this->upload->initialize($config); // Inisialisasi konfigurasi ulang setiap kali sebelum upload

            if (!$this->upload->do_upload($field_name)) {
                // Jika upload gagal, simpan error dalam array
                $upload_errors[$field_name] = $this->upload->display_errors();
                log_message('error', 'File upload error (' . $field_name . '): ' . $this->upload->display_errors());
            } else {
                // Jika berhasil, simpan informasi file yang diunggah
                $data = $this->upload->data();
                $uploaded_files[$field_name] = [
                    'file_name' => $data['file_name'],
                    'full_path' => $data['full_path'],
                    'upload_time' => date("Y-m-d H:i:s", strtotime('now'))
                ];

                // Persiapkan data untuk insert ke database
                $dbData = [
                    'kode_perusahaan' => $post["kode_perusahaan"],
                    'pic' => $post["pic"],
                    'Englat' => $uploaded_files['Englat'] ?? null,
                    'Surat_k_p' => $uploaded_files['Surat_k_p'] ?? null,
                    'Excel_Final' => $uploaded_files['Excel_Final'] ?? null,
                    'Perset_Final' => $uploaded_files['Perset_Final'] ?? null,
                    'Tanggal_Opini' => date("Y-m-d H:i:s"),
                    'File_Buku_Audit' => $uploaded_files['File_Buku_Audit'] ?? null,
                    'PMPJ' => $uploaded_files['PMPJ'] ?? null,
                    'Surat_Pembatalan' => $uploaded_files['Surat_Pembatalan'] ?? null,
                ];

                // Simpan ke database
                $this->db->insert('audit_final_io', $dbData);


                log_message('info', 'File uploaded successfully (' . $field_name . '): ' . json_encode($data));
            }
        }

        // Check hasil upload untuk log atau aksi lain
        if (!empty($upload_errors)) {
            echo "Beberapa file gagal diunggah: ";
            print_r($upload_errors);
        } else {
            echo "Semua file berhasil diunggah!";
            print_r($uploaded_files);
        }
    }



    public function delete($no)
    {
        return $this->db->delete($this->_table, array("no_bayar_catering" => $no));
    }

    public function get_count_perusahaan()
    {
        return $this->db->count_all('perusahaan');
    }

    public function get_akun_by_list($id_akun)
    {
        $this->db->where('id_io', $id_akun);
        $query = $this->db->get('download_io'); // Ganti 'data_role' dengan tabel yang sesuai
        return $query->result();
    }



}