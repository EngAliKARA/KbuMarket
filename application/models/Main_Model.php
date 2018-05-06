<?php
class Main_Model extends CI_Model{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('captcha');
        $this->load->helper('string');
    }
    public function SetUpdateUrun($Urun,$Id){
        $this->db->where("ID",$Id);
        $result = $this->db->update("Urunler",$Urun);
        return $result;
    }

    /*Recursive Ürün Çağırma */
    public function GetUrunList($Id)
    {
        $uruns = $this->db->query("SELECT U.ID,U.Kategori_ID,K.KategoriAdi,U.UrunAdi,U.Kodu,U.SatisFiyat,U.Birim,U.Resim, " .
            " CASE WHEN DATEDIFF(CURDATE(),U.Tarih)<7 THEN 1 ELSE 0 END AS Yeni " .
            " FROM Urunler U INNER JOIN Kategoriler K ON U.Kategori_ID=K.KategoriID Where U.Kategori_ID=$Id ")->result();

        $this->db->select("KategoriID")->where("Aktif", "1")->where("Ust_ID", $Id);
        $childs = $this->db->get('Kategoriler')->result();
        if ($childs) {
            foreach ($childs as $child) {
                $alturuns = $this->GetUrunList($child->KategoriID);
                foreach ($alturuns as $alturun) {
                    array_push($uruns, $alturun);
                }
            }
        }
        return $uruns;
    }
    Public function GetUrunDetay($Id)
    {
        $this->db->where("ID", $Id);
        $result = $this->db->get("Urunler");
        if ($result->num_rows() > 0)
            return $result->first_row();
        else
            return null;
    }
    Public function GetUrunResimList($UrunId)
    {
        $query = $this->db->query("SELECT * FROM UrunResimler WHERE UrunID=$UrunId ORDER BY ID ASC");
        return $query->result();
    }

    /* Menü Listeleme İşlemleri*/
    public function GetKategoriler($Id){

        $this->db->select("KategoriID,KategoriAdi")->where("Aktif","1")->where("Ust_ID",$Id);
        $parent=$this->db->get('Kategoriler');


        $categories = $parent->result();
        foreach($categories as $cat){
            $cat->sub = $this->GetKategoriler($cat->KategoriID);
        }
        return $categories;
    }
    public function GetKategoriDetay($Id){
        $this->db->where("KategoriID",$Id);
        $result= $this->db->get("Kategoriler");
        if ($result->num_rows()>0)
            return $result->first_row();
        else
            return null;
    }
    public function GetAyarDetay(){
        $query = $this->db->query("SELECT  * FROM Ayarlar WHERE Aktif = 1  LIMIT 1");
        return $query->row(0);
    }
    public function GetSettings() {
        $query = $this->db->query("SELECT Adi,TamAdi,Telefon,Email,VergiNo,Adres,Sehir,Keywords,Aciklama ".
            " FROM Ayarlar where Aktif=1 LIMIT 1");
        return $query->row(0);
    }
    public function GetCaptcha() {
		$values = array(
            'word' => '',   
            'word_length' => 5, 
            'img_path' =>  './Uploads/Images/',
            'img_url' => base_url().'Uploads/Images/',
            'font_path' => './system/fonts/captcha5.ttf',
            'img_width' => '150',   
            'img_height' => 40,  
            'font_size' => 20,
            'expiration' => 3600,
            'colors' => array(
                'background' => array (0,0,0),
                'border' => array (255,255,255),
                'text' => array (255,255,255),
                'grid' => array (255,0,0),
            )
		);

        $data = create_captcha($values);
        $this->session->unset_userdata('Captcha');
        $this->session->set_userdata('Captcha',$data['word']);
        return $data;
    }
    /* Yorum İşlemleri */
    public function SetInsertYorum($Yorum) {
        $result = $this->db->insert("Yorumlar",$Yorum);
        return $result;
    }
    public  function SetDeleteYorum($Id){
        $this->db->where("Durum",0)->where("YorumID",$Id);
        $result = $this->db->delete("Yorumlar");
        return $result;
    }
    public function GetYorumPuan($Id) {
        $query = $this->db->query("SELECT IFNULL(ROUND(SUM(PUAN)/COUNT(*),2),0) Puans FROM Yorumlar WHERE UrunID=$Id");
        return $query->row(0)->Puans;
    }
    public function GetYorumList($Id) {
        if ( $Id > 0 ) {
            $query = $this->db->query("SELECT Y.Tarih,Y.YorumID,Y.Baslik,Y.Yorum,Y.Durum,Y.Puan,U.Kodu,U.UrunAdi,M.AdSoyad FROM Yorumlar Y " .
                "INNER JOIN Urunler U ON Y.UrunID=U.ID INNER JOIN Musteriler M ON Y.CustomerID=M.ID WHERE Y.Durum='1' AND Y.UrunID = $Id");
            return $query->Result();
        }
        else
        {
            $query = $this->db->query("SELECT Y.Tarih,Y.YorumID,Y.Baslik,Y.Durum,Y.Puan,U.Kodu,U.UrunAdi,M.AdSoyad FROM Yorumlar Y ".
                "INNER JOIN Urunler U ON Y.UrunID=U.ID INNER JOIN Musteriler M ON Y.CustomerID=M.ID");
            return $query->Result();
        }
    }
    public function YorumGuncelle($YorumID,$YorumNeden,$Durum) {
        $this->db->set('YorumNeden', $YorumNeden);
        $this->db->set('Durum', $Durum);
        $this->db->where('YorumID', $YorumID);
        $result = $this->db->update('Yorumlar');
        return $result;
    }
    public function GetCustomerYorumList($Id) {
        $query = $this->db->query("SELECT Y.Tarih,Y.YorumID,Y.Baslik,Y.Yorum,Y.Durum,Y.Puan,U.Kodu,U.UrunAdi FROM Yorumlar Y ".
            "INNER JOIN Urunler U ON Y.UrunID=U.ID WHERE Y.Durum='1' AND Y.CustomerID = $Id");
        return $query->Result();
    }
    public function GetYorumDetay($Id) {
        $query = $this->db->query("SELECT Y.*,U.Kodu,U.UrunAdi,M.AdSoyad,Y.YorumNeden FROM Yorumlar Y ".
            "INNER JOIN Urunler U ON Y.UrunID=U.ID INNER JOIN Musteriler M ON Y.CustomerID=M.ID WHERE Y.YorumID=$Id");
        return $query->row(0);
    }

    /*İletişim Mesajları */
    public function MesajKaydet($Mesaj){
        $result = $this->db->insert("Mesajlar",$Mesaj);
        return $result;
    }
    public function GetMesajList($Id) {
        if ( $Id > 0 ) {
            $query = $this->db->query("SELECT M.RecID,M.UstID,M.Tarih,M.Konu,M.Mesaj,C.AdSoyad,(SELECT COUNT(*) FROM Mesajlar W ".
                " WHERE W.CustomerID=0 AND W.UstID=M.RecID) Cevap FROM Mesajlar M INNER JOIN Musteriler C ON M.CustomerID=C.ID WHERE M.UstID=0 AND C.ID = $Id");
            return $query->Result();
        }
        else {
            $query = $this->db->query("SELECT M.RecID,M.UstID,M.Tarih,M.Konu,M.Mesaj,C.AdSoyad,(SELECT COUNT(*) FROM Mesajlar W ".
                " WHERE W.CustomerID=0 AND W.UstID=M.RecID) Cevap FROM Mesajlar M INNER JOIN Musteriler C ON M.CustomerID=C.ID WHERE M.UstID=0");
            return $query->Result();
        }
    }
    public function GetMesajDetay($Id) {
        $Mesaj = $this->db->query("SELECT M.RecID,M.UstID,M.CustomerID,M.Tarih,M.Konu,M.Mesaj,C.AdSoyad FROM Mesajlar M LEFT JOIN ".
            " Musteriler C ON M.CustomerID=C.ID WHERE M.RecID = $Id")->row(0);
        $Mesaj->Sub = $this->db->query("SELECT M.RecID,M.UstID,M.CustomerID,M.Tarih,M.Konu,M.Mesaj,C.AdSoyad FROM Mesajlar M LEFT JOIN ".
            " Musteriler C ON M.CustomerID=C.ID WHERE M.UstID = $Mesaj->RecID")->result();
        return $Mesaj;
    }
    public  function SetDeleteMesaj($Id){
        $this->db->where("RecID",$Id);
        $result = $this->db->delete("Mesajlar");
        if ($result) {
            $this->db->where("UstID",$Id);
            $this->db->delete("Mesajlar");
        }
        return $result;
    }
    public  function SetDeleteYanit($Id){
        $this->db->where("RecID",$Id);
        $result = $this->db->delete("Mesajlar");
        return $result;
    }

    /*Sayfa İşlemleri */
    public function GetSayfaList()
    {
        $result = $this->db->get("Sayfalar");
        if ($result->num_rows() > 0)
            return $result->result();
        else
            return null;
    }
    public function GetSayfaDetay($Id)
    {
        $this->db->where("ID", $Id);
        $result = $this->db->get("Sayfalar");
        if ($result->num_rows() > 0)
            return $result->first_row();
        else
            return null;
    }

    /*Sipariş - ÖDeme İşlemleri*/
    public function SiparisOdeme($Siparis){
        $result = $this->db->insert("Siparisler",$Siparis);
        if ($result)
            return $this->db->insert_id();
        else
            return 0;
    }
    public function SiparisUrunInsert($Sd) {
        $result = $this->db->insert("Siparis_Detay",$Sd);
        return $result;
    }
    public function SiparisDurumGuncelle($SiparisDurumu,$SiparisID) {
        $this->db->set('SiparisDurumu', $SiparisDurumu);
        $this->db->where('SiparisID', $SiparisID);
        $result = $this->db->update('Siparisler');
        return $result;
    }
    public function GetSiparisList($CustomerID) {
        if ($CustomerID>0)
        $query = $this->db->query("SELECT S.SiparisID,M.AdSoyad,S.Tarih,S.OdemeTuru,S.OdemeDurumu,S.SiparisDurumu,S.FaturaTelefon ".
            " FROM Siparisler S INNER JOIN Musteriler M ON S.MusteriID=M.ID WHERE S.MusteriID=$CustomerID ORDER BY S.SiparisDurumu ASC");
        else
            $query = $this->db->query("SELECT S.SiparisID,M.AdSoyad,S.Tarih,S.OdemeTuru,S.OdemeDurumu,S.SiparisDurumu,S.FaturaTelefon ".
                " FROM Siparisler S INNER JOIN Musteriler M ON S.MusteriID=M.ID ORDER BY S.SiparisDurumu ASC");
        return $query->result();
    }
    public function GetSiparisDetay($Id) {
        $this->db->where("SiparisID",$Id);
        $result= $this->db->get("Siparisler");
        if ($result->num_rows()>0)
            return $result->first_row();
        else
            return null;
    }
    public function GetSiparisUrunList($SiparisID){
        $query = $this->db->query("SELECT S.RecID,S.UrunID,S.Renk,S.Beden,U.Kodu,U.UrunAdi,S.Miktar,SatisFiyat,S.Tutar,U.Resim ".
            " FROM Siparis_Detay S INNER JOIN Urunler U ON S.UrunID=U.ID WHERE S.SiparisID=$SiparisID");
        return $query->result();
    }



}