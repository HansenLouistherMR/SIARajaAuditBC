<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Data_perusahaan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("M_data_perusahaan");
        $this->load->library('form_validation');
        $this->load->helper('rupiah_helper');
        $this->load->model("user_model");

    }

    public function index()
    {
        $data["data_role"] = $this->M_data_perusahaan->getAll();
        $data["data_menu"] = $this->user_model->getMenu();
        $data["user_role"] = $this->user_model->getRole();
        $this->load->view("admin/Data_perusahaan/list", $data);
    }

    public function edit($no)
    {
        if (!isset($no))
            redirect('admin/Data_perusahaan');
        $data["data_menu"] = $this->user_model->getMenu();
        $data["user_role"] = $this->user_model->getRole();
        $getMenu = $this->M_data_perusahaan;
        $validation = $this->form_validation;
        $validation->set_rules($getMenu->rulesData());
        if ($validation->run()) {
            $getMenu->update();
            $this->session->set_flashdata('success', 'Berhasil disimpan');

        }
        $data["Data_role"] = $this->M_data_perusahaan->getDataRole();
        $data["Data_icon"] = $this->M_data_perusahaan->getIcon();
        $data["edit_menu"] = $getMenu->getByNomor($no);
        if (!$data["edit_menu"])
            show_404();
        $this->load->view("admin/Data_perusahaan/edit", $data);
    }



    public function add()
    {
        $getMenu = $this->M_data_perusahaan;

        $data["data_tahun_buku"] = $this->M_data_perusahaan->getTahunBuku();
        $data["data_daftar_akun"] = $this->M_data_perusahaan->getDaftarAkun();


        $data["data_menu"] = $this->user_model->getMenu();
        $data["user_role"] = $this->user_model->getRole();
        $validation = $this->form_validation;
        $validation->set_rules($getMenu->rulesData());
        if ($validation->run()) {
            $getMenu->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');

        }

        $data["Data_role"] = $this->M_data_perusahaan->getDataRole();
        $data["Data_icon"] = $this->M_data_perusahaan->getIcon();
        $this->load->view("admin/Data_perusahaan/tambah", $data);
    }

    public function addTahunBuku()
    {


        // Simpan path file ke database
        $uploadData = array(
            'tahun' => $this->input->post('tahun_buku')
        );

        $this->M_data_perusahaan->insert_tahun_buku($uploadData);

        redirect('admin/Data_perusahaan/add');
    }

    public function getDataRoleAkun()
    {
        $id_akun = $this->input->get('id_akun'); // Tangkap id_perusahaan dari request AJAX

        // $data['data_role'] = $this->Data_perusahaan_model->get_akun_by_list($id_akun);
        $data["data_role"] = $this->M_data_perusahaan->get_akun_by_list($id_akun);

        
        $this->load->view('admin/Data_perusahaan/data_akun_view', $data);
       
    }


}