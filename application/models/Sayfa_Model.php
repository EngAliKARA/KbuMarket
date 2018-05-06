<?php
include_once (dirname(__FILE__) . "/Main_Model.php");
class Sayfa_Model extends Main_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    /*Yeni Sayfa Kayıt İşlemi */
    public function SetInsertSayfa($Sayfa){
        $result = $this->db->insert("Sayfalar",$Sayfa);
        return $result;
    }
    /* Kayıtlı Sayfa Güncelleme İşlemi*/
    public function SetUpdateSayfalar($Sayfa,$Id){
        $this->db->where("ID",$Id);
        $result = $this->db->update("Sayfalar",$Sayfa);
        return $result;
    }
    /*Kayıtlı Sayfa Silme İşlemi*/
    public  function SetDeleteSayfalar($Id){
        $this->db->where("ID",$Id);
        $result = $this->db->delete("Sayfalar");
        return $result;
    }
}