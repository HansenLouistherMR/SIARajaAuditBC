<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Target extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("M_Target");
        $this->load->model("M_menu");

        $this->load->library('form_validation');
        $this->load->helper('rupiah_helper');
        $this->load->model("user_model");

        if($this->user_model->isNotLogin()) redirect(site_url('login'));


    }

    public function index()
    {
        $data["data_target"] = $this->M_Target->getAll();
        $data["data_menu"] = $this->user_model->getMenu();
        $data["user_role"] = $this->user_model->getRole();
        $data["Get_data_perusahaan"] = $this->M_Target->GerUserPerusahaan();

        $this->load->view("admin/Target/list", $data);

        // echo $this->db->last_query();


    }

    public function edit($no)
    {
        if (!isset($no)) redirect('admin/spmi');
        $data["data_menu"] = $this->user_model->getMenu();
        $data["user_role"] = $this->user_model->getRole();
        $getMenu = $this->M_menu;
        $validation = $this->form_validation;
        $validation->set_rules($getMenu->rulesData());
        if ($validation->run()) {
            $getMenu->update();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
            
        }
        $data["Data_role"] = $this->M_menu->getDataRole();
        $data["Data_icon"] = $this->M_menu->getIcon();
        $data["edit_menu"] = $getMenu->getByNomor($no);
        if (!$data["edit_menu"]) show_404();
        $this->load->view("admin/menu/edit", $data);
    }

    public function add()
    {
        $getMenu = $this->M_Target;
        $data["data_menu"] = $this->user_model->getMenu();
        $data["user_role"] = $this->user_model->getRole();
        $validation = $this->form_validation;
        $validation->set_rules($getMenu->rulesData());
        if ($validation->run()) {
            $getMenu->save();
            echo $this->db->last_query();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
            
        }

        $data["Data_role"] = $this->M_menu->getDataRole();
        $data["Data_icon"] = $this->M_menu->getIcon();
        // $this->load->view("admin/Target", $data);
        redirect('admin/Target', 'location', 301);

    }
   

}