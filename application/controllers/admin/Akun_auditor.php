<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Akun_auditor extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("M_akun_auditor");
        $this->load->library('form_validation');
        $this->load->helper('rupiah_helper');
        $this->load->model("user_model");
        $this->load->model("M_Daftar_akun");


    }

    public function index()
    {
        $data["data_role"] = $this->M_akun_auditor->GetDataAkun();
        $data["data_menu"] = $this->user_model->getMenu();
        $data["user_role"] = $this->user_model->getRole();
        $this->load->view("admin/Akun_auditor/list", $data);
    }

    public function edit($no)
    {
        if (!isset($no)) redirect('admin/Akun_auditor');

        $data["data_menu"] = $this->user_model->getMenu();
        $data["user_role"] = $this->user_model->getRole();

        $getMenu = $this->M_akun_auditor;

        $validation = $this->form_validation;
        $validation->set_rules($getMenu->rulesData());
        if ($validation->run()) {
            $getMenu->update();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
            
        }
        $data["Data_akun"] = $this->M_akun_auditor->GetDataAkunEdit();
        // $data["Data_icon"] = $this->M_akun_auditor->getIcon();
        $data["edit_akun"] = $getMenu->getByNomor($no);
        if (!$data["edit_akun"]) show_404();
        $this->load->view("admin/Akun_auditor/edit", $data);
    }



    public function add()
    {
        $getMenu = $this->M_akun_auditor;
        $data["data_menu"] = $this->user_model->getMenu();
        $data["user_role"] = $this->user_model->getRole();

        $data["daftar_akun"] = $this->M_Daftar_akun->getAll();  

        $validation = $this->form_validation;
        $validation->set_rules($getMenu->rulesData());
        if ($validation->run()) {
            $getMenu->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
            
        }

     //  $data["Data_role"] = $this->M_akun_auditor->getDataRole();
     //   $data["Data_icon"] = $this->M_akun_auditor->getIcon();
        $this->load->view("admin/Akun_auditor/tambah_akun", $data);
    }

    public function delete($no=null)
    {
        if (!isset($no)) show_404();
            if ($this->M_akun_auditor->delete($no)) {
                redirect(site_url('admin/Akun_auditor'));
        }
    }

   

}