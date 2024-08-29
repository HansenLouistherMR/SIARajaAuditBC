<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class jadwal_kuliah extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("m_kuliah");
        $this->load->library('form_validation');
        $this->load->helper('rupiah_helper');
    }

    public function index()
    {
        $data["data_kuliah"] = $this->m_kuliah->getAll();
        $this->load->view("admin/kuliah/list", $data);
    }

    public function edit($no)
    {
        if (!isset($no)) redirect('admin/spmi');
        $getLPPM = $this->m_kuliah;
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