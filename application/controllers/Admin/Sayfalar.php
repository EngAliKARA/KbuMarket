<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Sayfalar extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            redirect(base_url() . "Admin\Login");
        }
        else {
            if ($this->session->userdata('Yetki')!=2) {
                $this->session->set_flashdata("Message", "Bu Bölüme Girmeye Yetkili Değilsiniz!!!");
                redirect(base_url() . "Admin\Home");
            }
        }
        $this->load->model('Sayfa_Model');
        $this->load->library('user_agent');
    }
    public  function  Index()
    {
        $data["Sayfalar"]=$this->Sayfa_Model->GetSayfaList();
        $this->load->view("Admin/Sayfalar/Sayfa_List",$data);
    }
    public  function  Duzenle ($Id){
        $data["Sayfa"] = $this->Sayfa_Model->GetSayfaDetay($Id);
        $this->load->view("Admin/Sayfalar/SayfaDuzenle",$data);
    }
    public function  Guncelle(){
        $Id = $this->security->xss_clean($this->input->post("ID"));
        $Sayfa = array(
            'Konum' => $this->security->xss_clean($this->input->post("Konum")),
            'Sira' => $this->security->xss_clean($this->input->post("Sira")),
            'SayfaAdi' => $this->security->xss_clean($this->input->post("SayfaAdi")),
            'SayfaIcerik' => $this->security->xss_clean($this->input->post("SayfaIcerik")),
            'Durum' => $this->security->xss_clean($this->input->post("Durum")),
            'Tarih' =>  date('Y-m-d H:i:s'),
        );
        $Sonuc = $this->Sayfa_Model->SetUpdateSayfalar($Sayfa,$Id);
        if ($Sonuc==1){
            $this->session->set_flashdata("Message", "Sayfa Güncelleme İşlemi Başarıyla Yapıldı !");
            $this->session->set_flashdata("Kod", "0");
            redirect(base_url("Admin\Sayfalar"));
        }
        else{
            $this->session->set_flashdata("Message", "Sayfa Güncelleme İşlemi Yapılamadı !");
            $this->session->set_flashdata("Kod", "3");
            redirect(base_url("Admin\Sayfalar"));
        }
    }
    public  function  Yeni(){
        $this->load->view("Admin/Sayfalar/YeniSayfa");
    }
    public function  Kaydet(){
        $Sayfa = array(
            'Konum' => $this->security->xss_clean($this->input->post("Konum")),
            'Sira' => $this->security->xss_clean($this->input->post("Sira")),
            'SayfaAdi' => $this->security->xss_clean($this->input->post("SayfaAdi")),
            'SayfaIcerik' => $this->security->xss_clean($this->input->post("SayfaIcerik")),
            'Durum' => $this->security->xss_clean($this->input->post("Durum")),
            'Tarih' =>  date('Y-m-d H:i:s'),
        );
        $Sonuc = $this->Sayfa_Model->SetInsertSayfa($Sayfa);
        if ($Sonuc==1){
            $this->session->set_flashdata("Message", "Yeni Sayfa Kaydetme İşlemi Başarıyla Yapıldı !");
            $this->session->set_flashdata("Kod", "0");
            redirect(base_url("Admin\Sayfalar"));
        }
        else{
            $this->session->set_flashdata("Message", "Yeni Sayfa Kaydetme İşlemi Yapılamadı !");
            $this->session->set_flashdata("Kod", "3");
            redirect(base_url("Admin\Sayfalar"));
        }
    }
    public  function  Sil ($Id){
        $Sonuc = $this->Sayfa_Model->SetDeleteSayfalar($Id);
        if ($Sonuc==1){
            $this->session->set_flashdata("Message", "Sayfa Silme İşlemi Başarıyla Yapıldı !");
            $this->session->set_flashdata("Kod", "0");
            redirect(base_url("Admin\Sayfalar") );
        }
        else{
            $this->session->set_flashdata("Message", "Sayfa Silme İşlemi Yapılamadı !");
            $this->session->set_flashdata("Kod", "3");
            redirect(base_url("Admin\Sayfalar") );
        }
    }
}