<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Siparisler extends  CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            redirect(base_url() . "Admin\Login");
        } else {
            if ($this->session->userdata('Yetki') != 2) {
                $this->session->set_flashdata("Message", "Bu Bölüme Girmeye Yetkili Değilsiniz!!!");
                redirect(base_url() . "Admin\Home");
            }
        }
        $this->load->model('Main_Model');
        $this->load->library('user_agent');
    }
    public function Index(){
        $data["Siparisler"]=$this->Main_Model->GetSiparisList(0);
        $this->load->view("Admin/Siparisler/Siparis_List",$data);
    }
    public function Detay($Id)
    {
        $data["Siparis"] = $this->Main_Model->GetSiparisDetay($Id);
        $data["Urunler"] = $this->Main_Model->GetSiparisUrunList($Id);
        $this->load->view("Admin/Siparisler/Siparis_Detay",$data);
    }
    public function Guncelle(){
        $SiparisID = $this->security->xss_clean($this->input->post("SiparisID"));
        $SiparisDurumu = $this->security->xss_clean($this->input->post("SiparisDurumu"));

        $Sonuc = $this->Main_Model->SiparisDurumGuncelle($SiparisDurumu,$SiparisID);
        if ($Sonuc) {
            $this->session->set_flashdata("Message", "Sipariş Başarıyla Güncellenmiştir...");
            $this->session->set_flashdata("Kod", "0");
            redirect($this->agent->referrer());
        }
        else {
            $this->session->set_flashdata("Message", "Sipariş Güncellenemedi, Lütfen Yetkililer ile İritabata Geçiniz...");
            $this->session->set_flashdata("Kod", "3");
            redirect($this->agent->referrer());
        }
    }
}