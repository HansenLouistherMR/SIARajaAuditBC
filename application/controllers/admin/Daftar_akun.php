<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Daftar_akun extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("M_Daftar_akun");
        $this->load->library('form_validation');
        $this->load->helper('rupiah_helper');
        $this->load->model("user_model");

    }

    public function index()
    {
        $data["daftar_akun"] = $this->M_Daftar_akun->getAll();  

        $data["data_menu"] = $this->user_model->getMenu();
        $data["user_role"] = $this->user_model->getRole();
        
        $this->load->view("admin/Daftar_akun/list", $data);
    }

    public function edit($no)
    {
        if (!isset($no)) redirect('admin/spmi');
        $data["data_menu"] = $this->user_model->getMenu();
        $data["user_role"] = $this->user_model->getRole();
        $getLPPM = $this->m_spmi;
        $validation = $this->form_validation;
        $validation->set_rules($getLPPM->rulesData());
        if ($validation->run()) {
            $getLPPM->update();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
            
        }
        $data["edit_spmi"] = $getLPPM->getByNomor($no);
        if (!$data["edit_spmi"]) show_404();
        $this->load->view("admin/spmi/edit", $data);
    }



    public function add()
    {
        $bayar_catering = $this->bayar_catering_model;
        $data["data_menu"] = $this->user_model->getMenu();
        $data["user_role"] = $this->user_model->getRole();
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