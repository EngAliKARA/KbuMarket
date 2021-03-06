<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('includes/head'); ?>
</head>

<body>

<!-- Preloader -->
<div id="preloader">
    <div id="status"><i class="fa fa-spinner fa-spin"></i></div>
</div>

<section>
    <?php $this->load->view('includes/sidebar'); ?>
    <div class="mainpanel">
        <?php $this->load->view('includes/header'); ?>


        <div class="pageheader">
            <h2><i class="fa fa-rocket"></i> Ürün Düzenleme</h2>
            <div class="breadcrumb-wrapper">
                <span class="label">Burdasınız :</span>
                <ol class="breadcrumb">
                    <li><a href="<?php echo base_url("Admin\Home"); ?>">Admin</a></li>
                    <li class="active"><a href="<?php echo base_url("Admin\Urunler"); ?>">Ürünler</a></li>
                </ol>
            </div>
        </div>

        <div class="contentpanel">
            <form method="post" action="<?php echo base_url('Admin/Urunler/Guncelle'); ?>">
                <div class="row">
                    <div class="col-md-12">
                        <ul class="nav nav-tabs nav-dark">
                            <li class="active"><a href="#tab_1_1" data-toggle="tab"><strong>Genel Bilgiler</strong></a></li>
                            <li class=""><a href="#tab_1_2" data-toggle="tab"><strong>Detay Bilgileri</strong></a></li>
                        </ul>
                        <div class="tab-content mb30">
                            <div class="tab-pane active" id="tab_1_1">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label textRight">Kayıt No :</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="ID" class="form-control fc-sm" value="<?=$Urun->ID?>"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label textRight">Kategori :</label>
                                            <div class="col-sm-8">
                                                <select name="KategoriAdi" id="KategoriAdi" class="form-control fc-sm" required>
                                                    <option value="0">Seçiniz...</option>
                                                    <?php
                                                    if ($Kategoriler) {
                                                        foreach ($Kategoriler as $Kategori) { ?>
                                                            <option value="<?= $Kategori->KategoriID ?>"
                                                                <?php if ($Kategori->KategoriID == $Urun->Kategori_ID) echo "Selected" ?>>
                                                            <?= $Kategori->KategoriAdi ?></option>
                                                        <?php }
                                                    }?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label textRight">Ürün Kodu :</label>
                                            <div class="col-sm-8">
                                                <input name="Kodu" class="form-control fc-sm" value="<?=$Urun->Kodu ?>" required/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label textRight">Ürün Adı :</label>
                                            <div class="col-sm-8">
                                                <input name="UrunAdi" class="form-control fc-sm" value="<?=$Urun->UrunAdi ?>" required/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label textRight">Açıklama :</label>
                                            <div class="col-sm-8">
                                                <textarea name="Aciklama" class="form-control fc-sm" rows="2"> <?=$Urun->Aciklama ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label textRight">Anahtar Kelimeler :</label>
                                            <div class="col-sm-8">
                                                <textarea name="Keywords" class="form-control fc-sm" rows="2"> <?=$Urun->Keywords ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label textRight">Beden :</label>
                                            <div class="col-sm-8">
                                                <label class="form-control fc-sm">
                                                    <input type="checkbox" id="Beden" name="Beden" <?php if($Urun->Beden == 1) { echo "checked=checked"; } ?>" value="<?= $Urun->Beden; ?>" />&nbsp;Beden Var
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label textRight">Alış  Fiyatı :</label>
                                            <div class="col-sm-7">
                                                <input name="AlisFiyat" class="form-control fc-sm" value="<?=$Urun->AlisFiyat ?>" required/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label textRight">Satış Fiyatı :</label>
                                            <div class="col-sm-7">
                                                <input name="SatisFiyat" class="form-control fc-sm" value="<?=$Urun->SatisFiyat ?>" required/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label textRight">Birimi :</label>
                                            <div class="col-sm-7">
                                                <select name="Birim" class="form-control fc-sm" required>
                                                    <option value="">Seçiniz...</option>
                                                    <option value="TL" <?php if ($Urun->Birim=="TL") echo "Selected" ?> >Türk Lirası</option>
                                                    <option value="Euro" <?php if ($Urun->Birim=="Euro") echo "Selected" ?> >Euro</option>
                                                    <option value="Dolar" <?php if ($Urun->Birim=="Dolar") echo "Selected" ?> >Amerikan Doları</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label textRight">Miktar :</label>
                                            <div class="col-sm-7">
                                                <input name="Miktar" class="form-control fc-sm" value="<?=$Urun->Miktar ?>" required/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label textRight">Miadı :</label>
                                            <div class="col-sm-7">
                                                <input name="Miad" id="Miad" class="form-control fc-sm" value="<?= date("d.m.Y", strtotime($Urun->Miad))?>" required/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label textRight">Renk :</label>
                                            <div class="col-sm-7">
                                                <label class="form-control fc-sm">
                                                    <input type="checkbox" id="Renk" name="Renk" <?php if($Urun->Renk == 1) { echo "checked=checked"; } ?>" value="<?= $Urun->Renk; ?>" />&nbsp;Renk Var
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label textRight">Durumu :</label>
                                            <div class="col-sm-7">
                                                <label class="form-control fc-sm">
                                                    <input type="checkbox" id="Durum" name="Durum" <?php if($Urun->Durum == 1) { echo "checked=checked"; } ?>" value="<?= $Urun->Durum; ?>" />Aktif
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab_1_2">
                                <div class="row">
                                    <div class="col-md-12">
                                        <textarea name="Detay" id="Detay" class="form-control fc-sm" rows="5"> <?=$Urun->Detay ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 textCenter">
                        <input type="submit" class="btn btn-primary " value="Kaydet"></input>
                        <a href="<?php echo base_url("Admin\Urunler"); ?>" class="btn btn-danger">İptal</a>
                    </div>
                </div>
            </form>
        </div>
    </div><!-- mainpanel -->
</section>
<?php $this->load->view("includes/footer");?>
<script src="<?php echo base_url("assets") ?>/ckeditor/ckeditor.js"></script>

<script type="application/javascript">
    var baseurl = "<?php echo base_url('Admin/Urunler'); ?>/";
    $(document).ready(function() {
        CKEDITOR.replace('Detay');
        $("#Beden").live('change', function () {
            if ($(this).prop("checked")==true)
                $(this).val(1);
            else
                $(this).val(0);
        });
        $("#Renk").live('change', function () {
            if ($(this).prop("checked")==true)
                $(this).val(1);
            else
                $(this).val(0);
        });
        $("#Durum").live('change', function () {
            if ($(this).prop("checked")==true)
                $(this).val(1);
            else
                $(this).val(0);
        });
        $('#Miad').datetimepicker({
            dayOfWeekStart: 1,
            yearStart: 1900,
            lang: 'tr',
            timepicker: false,
            mask: true,
            format: 'd.m.Y'
        });
    });
</script>
</body>
</html>