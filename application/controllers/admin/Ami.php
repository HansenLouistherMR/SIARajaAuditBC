<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Ami extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("M_ami");
        $this->load->library('form_validation');
        $this->load->model("user_model");

    }

    public function index()
    {
        $getMenu = $this->M_ami;
        $data["data_menu"] = $this->user_model->getMenu();
        $data["user_role"] = $this->user_model->getRole();
        $validation = $this->form_validation;
        $validation->set_rules($getMenu->rulesData());
        if ($validation->run()) {
            $getMenu->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
            
        }

        $data["Data_Standart"] = $this->M_ami->getStandart();
        $data["Area_Audit"] = $this->M_ami->getAreaAudit();
        $data["auditor"] = $this->M_ami->getAreaAudit();
        $data["auditorAnggota"] = $this->M_ami->getAreaAudit();


        $this->load->view("admin/Ami_proses/tambah", $data);
    }

    public function get_data() {
        $id = $this->input->post('id');
        $data = $this->M_ami->get_data_by_id($id);

        if ($data) {
            echo json_encode(['status' => 'success', 'data' => $data]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No data found']);
        }
    }

    public function get_divisi() {
        $user_id = $this->input->get('user_id');
        if ($user_id) {
            $this->db->select('fullname');
            $this->db->from('user');
            $this->db->where('user_id', $user_id);
            $this->db->where('divisi IS NOT NULL');
            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                $result = $query->row();
                echo "$result->fullname";
            } else {
                echo "";
            }
        } else {
            echo "";
        }
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
        $getMenu = $this->M_menu;
        $data["data_menu"] = $this->user_model->getMenu();
        $data["user_role"] = $this->user_model->getRole();
        $validation = $this->form_validation;
        $validation->set_rules($getMenu->rulesData());
        if ($validation->run()) {
            $getMenu->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
            
        }

        $data["Data_role"] = $this->M_menu->getDataRole();
        $data["Data_icon"] = $this->M_menu->getIcon();
        $this->load->view("admin/menu/tambah_menu", $data);
    }
   

}