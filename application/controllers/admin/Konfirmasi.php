<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Konfirmasi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("M_Upload_perusahaan");
        $this->load->library('form_validation');
        $this->load->helper('rupiah_helper');
        $this->load->model("user_model");
        $this->load->model("M_Daftar_akun");
        $this->load->model("M_ami");
        $this->load->helper(array('form', 'url'));
        if ($this->user_model->isNotLogin())
            redirect(site_url('login'));
    }

    public function addVlidasi()
    {

        // Ambil data dari AJAX


        $post = $this->input->post();

        $data = [
            'komentar' => $post['data'],
            'status_upload' => 1,
        ];

        $this->db->where('no_list', $post['noList']);
        $this->db->where('id_perusahaan', $post['kodePerusahaan']);
        $this->db->update('upload_perusahaan', $data);

        // $this->session->set_flashdata('success', $akunValue . ' Berhasil diUpload');
        // redirect('admin/Upload_Perusahaan/addperushaan');

        // Kirim respon balik ke AJAX
        //  echo json_encode(['status' => 'success']);
    }

    public function aksi_upload()
    {
        $kode_perusahaan = $this->input->post('id_perusahaan');
        $kode_dept = $this->input->post('dept');
        $status_pages = $this->input->post('status_pages_upload');
        $akun = $this->input->post('akun');


        // Tentukan path direktori berdasarkan kode_perusahaan
        $uploadPath = './uploads/' . $kode_perusahaan . '/' . $kode_dept;

        // Cek apakah direktori sudah ada, jika belum, buat direktori
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0777, true); // 0777 memberikan hak akses penuh, true untuk membuat direktori secara rekursif
        }

        $config['upload_path'] = $uploadPath;
        $config['allowed_types'] = 'gif|jpg|png|pdf|doc|docx|zip|rar'; // Tambahkan zip dan rar
        $config['max_size'] = 5120; // Ubah menjadi 5 MB        
        $this->load->library('upload', $config);


        if (!$this->upload->do_upload('fileToUpload')) {
            $error = array('error' => $this->upload->display_errors());

            // Log error untuk debugging
            log_message('error', 'File upload error: ' . $this->upload->display_errors());

            // Tampilkan error
            //   $this->load->view('imageupload_form', $error);
            $this->session->set_flashdata('error', 'Upload Gagal');
            redirect('admin/Upload_Perusahaan/addperushaan');


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



            // Simpan path file ke database
            $uploadData = array(
                'file_path' => $filePath,
                'id_perusahaan' => $this->input->post('id_perusahaan'),
                'akun' => $this->input->post('akun'),
                'dept' => $this->input->post('dept'),
                'no_akun' => $this->input->post('no_akun'),
                'no_list' => $this->input->post('no_list'),
                'nama_file' => $fileName,
                'tanggal_upload' => $date
            );

            if ($status_pages == "Add") {

                $this->M_Upload_perusahaan->insert_upload($uploadData);

            } else {

                $this->M_Upload_perusahaan->update_upload($uploadData);

            }

            $this->session->set_flashdata('success', $akun . ' Berhasil diUpload');
            redirect('admin/Upload_Perusahaan/addperushaan');
        }

    }


    public function aksi_upload_SPM()
    {
        $kode_perusahaan = $this->input->post('id_perusahaan');
        $id_spm = $this->input->post('segement3');
        $segement3 = $this->input->post('id_spm');


        // Tentukan path direktori berdasarkan kode_perusahaan
        $uploadPath = './SPM/uploads/' . $kode_perusahaan . '/' . $id_spm;

        // Cek apakah direktori sudah ada, jika belum, buat direktori
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0777, true); // 0777 memberikan hak akses penuh, true untuk membuat direktori secara rekursif
        }

        $config['upload_path'] = $uploadPath;
        $config['allowed_types'] = 'gif|jpg|png|pdf|doc|docx|zip|rar'; // Tambahkan zip dan rar
        $config['max_size'] = 5120; // Ubah menjadi 5 MB        
        $this->load->library('upload', $config);


        if (!$this->upload->do_upload('fileToUpload')) {
            $error = array('error' => $this->upload->display_errors());

            // Log error untuk debugging
            log_message('error', 'File upload error: ' . $this->upload->display_errors());

            // Tampilkan error
            //   $this->load->view('imageupload_form', $error);
            $this->session->set_flashdata('error', 'Upload Gagal');
            redirect('admin/Upload_Perusahaan/addperushaan');


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



            // Simpan path file ke database
            $uploadData = array(
                'file_path_new' => $filePath,
                'id_perusahaan' => $this->input->post('id_perusahaan'),
                'nama_file_new' => $fileName,
                'status_upload' => 1
            );

            $this->db->where('id', $id_spm);
            $this->db->update('spm', $uploadData);


            $this->session->set_flashdata('success', $akun . ' Berhasil diUpload');
            //   redirect('admin/Upload_Perusahaan/addperushaanaudit/' . $segment3);

            redirect('Admin/Upload_Perusahaan/addperushaanaudit');

            //  $this->load->view("admin/Upload_perusahaan/addperushaanaudit" . $segment3);


        }

    }


    public function index()
    {
        $data["data_role"] = $this->M_Upload_perusahaan->getAll();


        $perusahaan = $this->db->query("SELECT user_id FROM perusahaan WHERE user_id = '" . $this->session->userdata('id') . "'")->result_array();

        // Panggil ID Perusahaan
        $user_id = array_column($perusahaan, 'user_id');

        if (empty($user_id)) {
            // Handle the case when user_id is empty  
            $data['user_id'] = ''; // or any default value  
        } else {
            $data['user_id'] = $user_id[0];
        }

        $data["data_menu"] = $this->user_model->getMenu();
        $data["user_role"] = $this->user_model->getRole();

        $this->load->view("admin/Upload_perusahaan/list", $data);
    }

    public function view_data($kode_perusahaan)
    {
        if (!isset($kode_perusahaan))
            redirect('admin/Upload_Perusahaan');
        $data["data_menu"] = $this->user_model->getMenu();
        $data["user_role"] = $this->user_model->getRole();


        $data["view_akun"] = $this->M_Upload_perusahaan->get_data_by_id_view($kode_perusahaan);

        $perusahaan = $this->db->query("SELECT kode_perusahaan, nama_perusahaan FROM perusahaan WHERE kode_perusahaan = '$kode_perusahaan'")->result_array();

        // Panggil ID Perusahaan
        $id_perusahaan = array_column($perusahaan, 'kode_perusahaan');
        $data['id_perusahaan'] = $id_perusahaan[0];

        // Panggil Nama  Perusahaan
        $nama_perusahaan = array_column($perusahaan, 'nama_perusahaan');
        $data['nama_perusahaan'] = $nama_perusahaan[0];


        $getMenu = $this->M_Upload_perusahaan;
        $validation = $this->form_validation;
        $validation->set_rules($getMenu->rulesData());
        if ($validation->run()) {
            $getMenu->update();
            $this->session->set_flashdata('success', 'Berhasil disimpan');

        }
        $data["Data_role"] = $this->M_Upload_perusahaan->getDataRole();
        $data["Data_icon"] = $this->M_Upload_perusahaan->getIcon();

        $data["Data_Upload"] = $this->M_Upload_perusahaan->getDataRole();


        $data["edit_menu"] = $getMenu->getByNomor($kode_perusahaan);
        if (!$data["edit_menu"])
            show_404();
        $this->load->view("admin/Upload_Perusahaan/view", $data);
    }



    public function addAkunPerusahaan()
    {
        // $getMenu = $this->M_Upload_perusahaan;



        $data["data_menu"] = $this->user_model->getMenu();
        $data["user_role"] = $this->user_model->getRole();


        $date = date("Y-m-d H:i:s"); // Current date and time  

        $kode_perusahaan = $this->input->post('kode_perusahaan');
        $nama_perusahaan = $this->input->post('nama_perusahaan');
        $tahun_audit = $this->input->post('tahun_audit');
        $user_id = $this->input->post('user_id');


        if ($this->M_Upload_perusahaan->check_duplicate_name($nama_perusahaan)) {
            $data['error_message'] = 'Nama perusahaan sudah ada, silakan gunakan nama yang lain.';
            $data['kode_perusahaan'] = $kode_perusahaan;
            $this->load->view('admin/upload_perusahaan/list', $data);
        } else {

            $data = array(
                'kode_perusahaan' => $kode_perusahaan,
                'nama_perusahaan' => $nama_perusahaan,
                'tahun_audit' => $tahun_audit,
                'tanggal_input' => $date,
                'user_id' => $user_id
            );

            $this->db->insert('perusahaan', $data);

            $this->db->query("INSERT INTO upload_perusahaan SELECT * FROM temp_upload_perusahaan");
            $this->db->query("DELETE FROM temp_upload_perusahaan");


        }

        redirect("admin/Upload_Perusahaan/addperushaan");
    }

    public function addperushaan()
    {
        $getMenu = $this->M_Upload_perusahaan;
        $data["data_menu"] = $this->user_model->getMenu();
        $data["user_role"] = $this->user_model->getRole();
        $validation = $this->form_validation;


        // $data["Get_Legal_HRD"] = $this->M_Upload_perusahaan->getDataRole();

        $data['user_perusahaan'] = "";

        // Panggil data perusahaan yang sudah ada

        $perusahaan = $this->db->query("SELECT perusahaan.user_id as user_id, perusahaan.kode_perusahaan as kode_perusahaan
        FROM user user INNER JOIN perusahaan perusahaan ON user.user_id = perusahaan.user_id WHERE perusahaan.user_id = '" . $this->session->userdata('id') . "'")->result_array();

        // Panggil ID Perusahaan
        $user_id = array_column($perusahaan, 'user_id');
        $kode_perusahaan = array_column($perusahaan, 'kode_perusahaan');



        // Membuat Data Yang sudah ada
        if ($this->session->userdata('role') == 3) {

            if (empty($user_id)) {

                // Tambah Kode Perushaan
                $count = $this->M_Upload_perusahaan->get_count_perusahaan();
                $kode_number = str_pad($count + 1, 4, '0', STR_PAD_LEFT);
                $kode_perusahaan = 'RAJAAUDIT' . $kode_number;

                $data['kode_perusahaan'] = $kode_perusahaan;
            } else {

                // Tambah Kode Perushaan
                $data['kode_perusahaan'] = $kode_perusahaan[0];
            }


        } else {
            // Tambah Kode Perushaan
            $count = $this->M_Upload_perusahaan->get_count_perusahaan();
            $kode_number = str_pad($count + 1, 4, '0', STR_PAD_LEFT);
            $kode_perusahaan = 'RAJAAUDIT' . $kode_number;

            $data['kode_perusahaan'] = $kode_perusahaan;
        }


        // Panggil Header

        $sum_Rincian = $this->db->query("SELECT SUM(rincian) AS total_rincian
            FROM (
                SELECT COALESCE(rincian, 0) AS rincian FROM `konfirmasi_bank_rupiah`
                UNION ALL
                SELECT COALESCE(rincian, 0) AS rincian FROM `konfirmasi_bank_USD`
            ) AS combined_rincian;")->result_array();

        // Panggil ID Perusahaan
        $total_rincian = array_column($sum_Rincian, 'total_rincian');
        $data["total_rincian"] = $total_rincian[0];

        // Bank
        $data["Get_Data_Konfirmasi_Bank"] = $this->M_Upload_perusahaan->get_data_konfirmasi_bank();

        // Piutang Usaha
        $data["Het_data_piutang_usaha"] = $this->M_Upload_perusahaan->get_data_konfirmasi_piutang_usaha();



        // SPM
        $data["get_SPM"] = $this->M_Upload_perusahaan->getTableSPM();

        $validation->set_rules($getMenu->rulesData());
        if ($validation->run()) {
            $getMenu->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');

        }

        $data["Data_role"] = $this->M_Upload_perusahaan->getDataRole();
        $data["daftar_akun_HRD"] = $this->M_Daftar_akun->getAllDeptHRD();
        $data["daftar_akun_ALL"] = $this->M_Daftar_akun->getAllDeptALL();

        $data["Get_data_perusahaan"] = $this->M_Upload_perusahaan->GerUserPerusahaan();


        $data["Data_icon"] = $this->M_Upload_perusahaan->getIcon();
        $this->load->view("admin/konfirmasi/tambah_data", $data);
    }


    public function upload()
    {
        $data = array();
        $data["data_menu"] = $this->user_model->getMenu();
        $data["user_role"] = $this->user_model->getRole();
        // Load form validation library
        $this->load->library('form_validation');
        $this->form_validation->set_rules('fileURL', 'Upload File', 'callback_checkFileValidation');

        // If file uploaded
        if (!empty($_FILES['fileURL']['name'])) {
            // get file extension
            $extension = pathinfo($_FILES['fileURL']['name'], PATHINFO_EXTENSION);

            if ($extension == 'csv') {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
            } elseif ($extension == 'xlsx') {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            } else {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
            }
            // file path
            $spreadsheet = $reader->load($_FILES['fileURL']['tmp_name']);
            $allDataInSheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

            // array Count
            $arrayCount = count($allDataInSheet);
            $flag = 0;

            // $createArray = array('NIS', 'Nama_Siswa', 'Kelas', 'Nama_Kelas', 'Biaya_SPP');
            // $makeArray = array('NIS' => 'NIS', 'Nama_Siswa' => 'Nama_Siswa', 'Kelas' => 'Kelas', 'Nama_Kelas' => 'Nama_Kelas','Biaya_SPP' => 'Biaya_SPP');

            $createArray = array('Company_name', 'Account_No', 'Opening_Balance', 'MTB_Debet', 'MTB_Kredit', 'SU_Ending_Balance', 'JR_Debet', 'JR_Kredit');
            $makeArray = array(
                'Company_name' => 'Company_name',
                'Account_No' => 'Account_No',
                'Opening_Balance' => 'Opening_Balance',
                'MTB_Debet' => 'MTB_Debet',
                'MTB_Kredit' => 'MTB_Kredit',
                'SU_Ending_Balance' => 'SU_Ending_Balance',
                'JR_Debet' => 'JR_Debet',
                'JR_Kredit' => 'JR_Kredit'
            );


            $SheetDataKey = array();
            foreach ($allDataInSheet as $dataInSheet) {
                foreach ($dataInSheet as $key => $value) {
                    if (in_array(trim($value), $createArray)) {
                        $value = preg_replace('/\s+/', '', $value);
                        $SheetDataKey[trim($value)] = $key;
                    }
                }
            }
            $dataDiff = array_diff_key($makeArray, $SheetDataKey);
            if (empty($dataDiff)) {
                $flag = 1;
            }


            $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
            $Company_name = $sheetData[1]['B'];
            $Start_date = date('Y-m-d', strtotime($sheetData[2]['B']));
            $Last_date = date('Y-m-d', strtotime($sheetData[3]['B']));


            // match excel sheet column
            if ($flag == 1) {
                for ($i = 2; $i <= $arrayCount; $i++) {
                    $addresses = array();
                    // $NIS = $SheetDataKey['NIS'];
                    // $nama_siswa = $SheetDataKey['Nama_Siswa'];
                    // $kelas = $SheetDataKey['Kelas'];
                    // $nama_kelas = $SheetDataKey['Nama_Kelas'];
                    // $biaya_spp = $SheetDataKey['Biaya_SPP'];

                    // Data Benar 
                    // $Company_name = $SheetDataKey['Company_name'];
                    // $Account_No = $SheetDataKey['Account_No'];
                    // $Opening_Balance = $SheetDataKey['Opening_Balance'];
                    // $MTB_Debet = $SheetDataKey['MTB_Debet'];
                    // $MTB_Kredit = $SheetDataKey['MTB_Kredit'];
                    // $SU_Ending_Balance = $SheetDataKey['SU_Ending_Balance'];
                    // $JR_Debet = $SheetDataKey['JR_Debet'];
                    // $JR_Kredit = $SheetDataKey['JR_Kredit'];

                    // $NIS = filter_var(trim($allDataInSheet[$i][$NIS]), FILTER_SANITIZE_STRING);
                    // $nama_siswa = filter_var(trim($allDataInSheet[$i][$nama_siswa]), FILTER_SANITIZE_STRING);
                    // $kelas = filter_var(trim($allDataInSheet[$i][$kelas]), FILTER_SANITIZE_EMAIL);
                    // $nama_kelas = filter_var(trim($allDataInSheet[$i][$nama_kelas]), FILTER_SANITIZE_STRING);
                    // $biaya_spp = filter_var(trim($allDataInSheet[$i][$biaya_spp]), FILTER_SANITIZE_STRING);

                    // // Data Benar
                    // $Company_name = filter_var(trim($allDataInSheet[$i][$Company_name]), FILTER_SANITIZE_STRING);
                    // $Account_No = filter_var(trim($allDataInSheet[$i][$Account_No]), FILTER_SANITIZE_STRING);
                    // $Opening_Balance = filter_var(trim($allDataInSheet[$i][$Opening_Balance]), FILTER_SANITIZE_EMAIL);
                    // $MTB_Debet = filter_var(trim($allDataInSheet[$i][$MTB_Debet]), FILTER_SANITIZE_STRING);
                    // $MTB_Kredit = filter_var(trim($allDataInSheet[$i][$MTB_Kredit]), FILTER_SANITIZE_STRING);
                    // $SU_Ending_Balance = filter_var(trim($allDataInSheet[$i][$SU_Ending_Balance]), FILTER_SANITIZE_STRING);
                    // $JR_Debet = filter_var(trim($allDataInSheet[$i][$JR_Debet]), FILTER_SANITIZE_STRING);
                    // $JR_Kredit = filter_var(trim($allDataInSheet[$i][$JR_Kredit]), FILTER_SANITIZE_STRING);


                    //     $fetchData[] = array('Company_name' => $Company_name,
                    //      'Account_No' => $Account_No, 
                    //      'Opening_Balance' => $Opening_Balance, 
                    //      'MTB_Debet' => $MTB_Debet, 
                    //      'MTB_Kredit' => $MTB_Kredit, 
                    //      'SU_Ending_Balance' => $SU_Ending_Balance, 
                    //      'JR_Debet' => $JR_Debet, 
                    //      'JR_Kredit' => $JR_Kredit);
                    // }

                    $fetchData[] = array(
                        'Company_name' => $Company_name,
                        'Start_date' => $Start_date,
                        'Last_date' => $Last_date
                    );
                }

                $data['data_upload'] = $fetchData;
                $this->M_Upload_WS->setBatchImport($fetchData);
                $this->M_Upload_WS->importData();
            } else {
                echo "Please import correct file, did not match excel sheet column";
            }
            $this->load->view('admin/Upload_WS/hasil_import', $data);
        }

    }

    public function addperushaanaudit($user_id = NULL)
    {

        $getMenu = $this->M_Upload_perusahaan;
        $data["data_menu"] = $this->user_model->getMenu();
        $data["user_role"] = $this->user_model->getRole();
        $validation = $this->form_validation;

        if ($user_id !== NULL) {
            // Tambahkan debug

            // Panggil Segment
            $data['segement3'] = $this->uri->segment(4); // Third segment

            // Panggil data perusahaan yang sudah ada

            $perusahaan = $this->db->query("SELECT perusahaan.user_id as user_id_perusahaan, perusahaan.kode_perusahaan as kode_perusahaan
            FROM user user INNER JOIN perusahaan perusahaan ON user.user_id = perusahaan.user_id WHERE perusahaan.user_id = '" . $user_id . "'")->result_array();

            // Debugging: Tampilkan query terakhir
            //  echo $this->db->last_query();

            // Tampilkan hasil
//            print_r($perusahaan);

            // Panggil ID Perusahaan
            $user_id_perusahaan = array_column($perusahaan, 'user_id_perusahaan');
            $kode_perusahaan_audit = array_column($perusahaan, 'kode_perusahaan');

            $data['kode_perusahaan'] = $kode_perusahaan_audit[0];
            $data['user_perusahaan'] = $user_id;

            // Panggil Data Upload
            $tabel_data_upload = empty($user_id_perusahaan) ? "temp_upload_perusahaan" : "upload_perusahaan";
            $status_pages = empty($user_id_perusahaan) ? "Add" : "Edit";
            $data['status_pages'] = $status_pages;


            // HRD & LEGAL , DEPT , ACC , TAX & ETC..
            $data["Get_Legal_HRD"] = $this->M_Upload_perusahaan->get_data_by_id_LegalHRD($tabel_data_upload, $data['kode_perusahaan']);
            $data["Get_Akata"] = $this->M_Upload_perusahaan->get_data_by_id_Akta($tabel_data_upload, $data['kode_perusahaan']);
            $data["Get_Laporan"] = $this->M_Upload_perusahaan->get_data_by_id_Laporan($tabel_data_upload, $data['kode_perusahaan']);
            $data["Get_Kas_Setara_Kas"] = $this->M_Upload_perusahaan->get_data_by_id_Kas_Setara_kas($tabel_data_upload, $data['kode_perusahaan']);
            $data["Get_Deposit_berjangka"] = $this->M_Upload_perusahaan->get_data_by_id_Deposit_berjangka($tabel_data_upload, $data['kode_perusahaan']);
            $data["Get_Inv_Jangka_Pendek"] = $this->M_Upload_perusahaan->get_data_by_id_Inv_Jangka_Pendek($tabel_data_upload, $data['kode_perusahaan']);
            $data["Get_Piutang_Usaha_AR"] = $this->M_Upload_perusahaan->get_data_by_id_Piutang_Usaha_AR($tabel_data_upload, $data['kode_perusahaan']);
            $data["Get_Piutang_Lain"] = $this->M_Upload_perusahaan->get_data_by_id_Piutang_Lain($tabel_data_upload, $data['kode_perusahaan']);
            $data["Het_Persediaan"] = $this->M_Upload_perusahaan->get_data_by_id_Persediaan($tabel_data_upload, $data['kode_perusahaan']);
            $data["Get_Uang_muka"] = $this->M_Upload_perusahaan->get_data_by_id_Uang_muka($tabel_data_upload, $data['kode_perusahaan']);
            $data["Get_Pajak_dibayar_dimuka"] = $this->M_Upload_perusahaan->get_data_by_Pajak_dibayar_dimuka($tabel_data_upload, $data['kode_perusahaan']);


            // SPM
            $data["get_SPM"] = $this->M_Upload_perusahaan->getTableSPM();


            // $validation->set_rules($getMenu->rulesData());
            // if ($validation->run()) {
            //     $getMenu->save();
            //     $this->session->set_flashdata('success', 'Berhasil disimpan');

            // }

            $data["Data_role"] = $this->M_Upload_perusahaan->getDataRole();
            $data["daftar_akun_HRD"] = $this->M_Daftar_akun->getAllDeptHRD();
            $data["daftar_akun_ALL"] = $this->M_Daftar_akun->getAllDeptALL();

            $data["Get_data_perusahaan"] = $this->M_Upload_perusahaan->GerUserPerusahaan();


            $data["Data_icon"] = $this->M_Upload_perusahaan->getIcon();
            $this->load->view("admin/Upload_perusahaan/tambah_data", $data);

            //   echo "User ID yang diterima: " .  $tabel_data_upload;
            //   echo "User ID yang diterima: " .  $data['kode_perusahaan'];


            // echo "User ID yang diterima: " .  $kode_perusahaan[0];
            // die(); // Hentikan eksekusi untuk melihat hasil ini di browser

            // print_r($perusahaan);
            // // or  
            // var_dump($perusahaan);

        } else {
            show_error('User ID tidak valid atau tidak ada');
        }
    }



    public function get_data()
    {
        $id = $this->input->post('id');

        // $perusahaan = $this->db->query("SELECT nama_akun from daftar_akun WHERE no = '$id'")->result_array();

        // // Panggil ID Perusahaan
        // $nama_akun = array_column($perusahaan, 'nama_akun');
        // $data['nama_akun_header'] = $nama_akun[0];

        $data = $this->M_Upload_perusahaan->get_data_by_id_akun($id);

        if ($data) {
            echo json_encode(['status' => 'success', 'data' => $data]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No data found']);
        }
    }


}