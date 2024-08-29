<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Overview extends CI_Controller 
{
    public function __construct()
    {
		parent::__construct();
		$this->load->model("dashboard_model");
		// $this->load->model("bayar_spp_model");
		$this->load->model("user_model");
		// $this->load->model("bayar_catering_model");
		// $this->load->model("daftar_ulang_model");
		// $this->load->model("pemasukkan_lain_model");
		// $this->load->model("pengeluaran_model");

        if($this->user_model->isNotLogin()) redirect(site_url('login'));
	}

	public function index()
	{	
        $data["data_menu"] = $this->user_model->getMenu();
        $data["user_role"] = $this->user_model->getRole();
         $this->load->view("admin/overview", $data);

	}
}