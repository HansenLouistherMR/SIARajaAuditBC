<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Absen extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("M_absen");
        $this->load->library('form_validation');
        $this->load->helper('rupiah_helper');
        $this->load->model("user_model");

    }

    public function index()
    {

        $repository_model = $this->M_absen;
        $data["data_menu"] = $this->user_model->getMenu();
        $data["user_role"] = $this->user_model->getRole();
        $data["r_tersedia"] = count($repository_model->getRepositoryTersedia());
        $data["r_belumtersedia"] = count($repository_model->getRepositorybelumTersedia());

        $data["data_ajar"] = $this->M_absen->getAll();
        $this->load->view("admin/absen/list", $data);
    }

    public function edit($no)
    {
        if (!isset($no)) redirect('admin/spmi');
        $getLPPM = $this->M_absen;
        $data["data_menu"] = $this->user_model->getMenu();
        $data["user_role"] = $this->user_model->getRole();
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

    public function printExcel(){

        $data["title"] = "Absensi Universitas Mpu Tantular";

        $repository_model = $this->M_absen;
        $data["r_tersedia"] = count($repository_model->getRepositoryTersedia());
        $data["r_belumtersedia"] = count($repository_model->getRepositorybelumTersedia());

        $data["data_ajar"] = $this->M_absen->getAll();

        // $bulan = $this->uri->segment(4);
        // $tahun = $this->uri->segment(5);
        // $tanggal = date('d F Y');

        // $rekapitulasi = $this->rekapitulasi_model;
        // $data["bulan"] = $bulan;
        // $data["tahun"] = $tahun;
        // $data["tanggal"] = $tanggal;
        // $catering = $this->bayar_catering_model->getCateringTerbayarByTanggal($bulan,$tahun);
        // $spp = $this->bayar_spp_model->getSPPTerbayarByTanggal($bulan,$tahun);
        // $daftar_ulang = $this->daftar_ulang_model->getDaftarUlangTerbayarByTanggal($bulan,$tahun);
        // $pemasukkan_lain = $this->pemasukkan_lain_model->getNominalPemasukkanLain($bulan,$tahun);
        // $pengeluaran = $this->pengeluaran_model->getNominalPengeluaran($bulan,$tahun);

        // $data["spptotal"] = $rekapitulasi->biayaTotalSPP($bulan,$tahun);
        // $data["sppkelas"] = $rekapitulasi->biayaSPPByKelas($bulan,$tahun);
        // $data["catering"] = $rekapitulasi->biayaTotalCatering($bulan,$tahun);
        // $data["daftar_ulang"] = $rekapitulasi->biayaTotalDaftarUlang($bulan,$tahun);
        // $data["pemasukkan_lain"] = $rekapitulasi->biayaTotalPemasukkanLainByKategori($bulan,$tahun);
        // $data["pengeluaran2"] = $rekapitulasi->biayaPengeluaranByKategori($bulan,$tahun);

        // $data["tes2"] = array_merge($data["spptotal"], $data["sppkelas"], $data["daftar_ulang"], $data["pemasukkan_lain"], $data["catering"] );
     


        // $data["pemasukkan"] = $catering->total + $spp->total + $daftar_ulang->total + $pemasukkan_lain->total;
        // $data["pengeluaran"] = $pengeluaran->total;
        // $data["saldo"] = $data["pemasukkan"] - $data["pengeluaran"];

        // $data["pemasukkanPengeluaranPerTanggal"] =$rekapitulasi->listPengeluaranPemasukkanByBulan($bulan,$tahun);

        $this->load->view("admin/absen/printAbsebExcel", $data);
    }

   

}