<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class repository_lppm_universitas extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("repository_model");
        $this->load->library('form_validation');
        $this->load->helper('rupiah_helper');
        $this->load->model("user_model");

        
    }

    public function index()
    {   
      
        $repository_model = $this->repository_model;
        $data["data_menu"] = $this->user_model->getMenu();
        $data["user_role"] = $this->user_model->getRole();
        $data["r_tersedia"] = count($repository_model->getRepositoryTersedia());
        $data["r_belumtersedia"] = count($repository_model->getRepositorybelumTersedia());

        $data["repository_lppm"] = $this->repository_model->getAll();
        $this->load->view("admin/lppm_universitas/list", $data);
    }

    public function edit($no)
    {
        if (!isset($no)) redirect('admin/repository_lppm_universitas');
        $getLPPM = $this->repository_model;
        $data["user_role"] = $this->user_model->getRole();
        $validation = $this->form_validation;
        $validation->set_rules($getLPPM->rulesRepository());
        if ($validation->run()) {
            $getLPPM->update();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
            
        }
        $data["repository_lppm"] = $getLPPM->getByNomor($no);
        if (!$data["repository_lppm"]) show_404();
        $this->load->view("admin/lppm_universitas/edit", $data);
    }

    public function getCateringByNoBulanTahun()
    {
        $data["bayar_catering"] = $this->bayar_catering_model->getCateringByNoBulanTahun();
        $this->load->view("admin/bayar_catering/list_bayar_catering", $data);
    }

    public function add()
    {
        $bayar_catering = $this->bayar_catering_model;
        $validation = $this->form_validation;
        $validation->set_rules($bayar_catering->rulesBayar());
        if ($validation->run()) {
            if($bayar_catering->cekNisTransaksi() == 0){
                $this->session->set_flashdata('error', 'NIS tidak ditemukan');
            }else if($bayar_catering->cekTransaksi() > 0){
                $this->session->set_flashdata('error', 'Transaksi Sudah Tersedia');
            }else{
                $bayar_catering->save();
                $this->session->set_flashdata('success', 'Berhasil disimpan');
            }              
        }

        $data["bulan"] = date('m');
        $data["tahun"] = date('Y');
        $data["tanggal"] = date('d/m/Y');
        $data["biayaCatering"] = $bayar_catering->getTemporaryCatering() ;
        $this->load->view("admin/bayar_catering/tambah_bayar_catering", $data);
    }
   

}