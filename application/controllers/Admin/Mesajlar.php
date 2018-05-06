<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mesajlar extends  CI_Controller
{
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
        $this->load->model('Main_Model');
        $this->load->library('user_agent');
    }
    public function Index() {
        $data["Mesajlar"]=$this->Main_Model->GetMesajList(0);
        $this->load->view("Admin/Mesajlar/Mesaj_List",$data);
    }
    public function Duzenle($Id) {
        $data["Mesaj"] = $this->Main_Model->GetMesajDetay($Id);
        $this->load->view("Admin/Mesajlar/Mesaj_Duzenle",$data);
    }
    public function Yanitla(){
        $Mesaj = array(
            'UstID' =>  $this->security->xss_clean($this->input->post("UstID")),
            'Konu' => "",
            'Mesaj' => $this->security->xss_clean($this->input->post("Mesaj")),
        );
        $Sonuc = $this->Main_Model->MesajKaydet($Mesaj);
        if ($Sonuc) {
            $this->session->set_flashdata("Message", "Mesaj Başarıyla Yanıtlanmıştır. ".
                "İletişim Mesajları bölümünden Takip edebilirsiniz");
            $this->session->set_flashdata("Kod", "0");
            redirect($this->agent->referrer());
        }
        else {
            $this->session->set_flashdata("Message", "Mesaj Yanıtınız İletilemedi, Lütfen Yetkililer ile İritabata Geçiniz...");
            $this->session->set_flashdata("Kod", "3");
            redirect($this->agent->referrer());
        }
    }
    public function Sil($Id){
        $Sonuc = $this->Main_Model->SetDeleteMesaj($Id);
        if ($Sonuc==1){
            $this->session->set_flashdata("Message", "Mesaj Silme İşlemi Başarıyla Yapıldı !");
            $this->session->set_flashdata("Kod", "0");
            redirect($this->agent->referrer());
        }
        else{
            $this->session->set_flashdata("Message", "Mesaj Silme İşlemi Yapılamadı !");
            $this->session->set_flashdata("Kod", "3");
            redirect($this->agent->referrer());
        }
    }
    public function YanitSil($Id){
        $Sonuc = $this->Main_Model->SetDeleteYanit($Id);
        if ($Sonuc==1){
            $this->session->set_flashdata("Message", "Mesaj Yanıtınızı Silme İşlemi Başarıyla Yapıldı !");
            $this->session->set_flashdata("Kod", "0");
            redirect($this->agent->referrer());
        }
        else{
            $this->session->set_flashdata("Message", "Mesaj Yanıtınızı Silme İşlemi Yapılamadı !");
            $this->session->set_flashdata("Kod", "3");
            redirect($this->agent->referrer());
        }
    }
}