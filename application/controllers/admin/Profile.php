<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("user_model");
        $this->load->library('form_validation');
        if ($this->user_model->isNotLogin())
            redirect(site_url('login'));
    }

    public function index()
    {
        $data["data_menu"] = $this->user_model->getMenu();
        $data["user_role"] = $this->user_model->getRole();
        $this->load->view("admin/profile", $data);
    }

    public function edit($no)
    {
        $data["data_menu"] = $this->user_model->getMenu();
        $data["user_role"] = $this->user_model->getRole();
        $post = $this->input->post();
        if (!isset($no))
            show_404();

        $user_model = $this->user_model;
        $validation = $this->form_validation;
        $validation->set_rules($user_model->rules());

        if ($validation->run()) {
            if ($post["password_baru"] == $post["password_baru_konfirm"]) {
                $user_model->update($no);
            } else {
                $this->session->set_flashdata('error', 'konfirmasi password baru tidak sama');
            }
        }
        redirect(site_url('admin/profile', $data));
    }



}