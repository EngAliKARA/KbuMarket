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
            <h2><i class="fa fa-cogs"></i> Ayar Düzenleme</h2>
            <div class="breadcrumb-wrapper">
                <span class="label">Burdasınız :</span>
                <ol class="breadcrumb">
                    <li><a href="<?php echo base_url("Admin\Home"); ?>">Admin</a></li>
                    <li class="active"><a href="<?php echo base_url("Admin\Ayarlar"); ?>">Ayarlar</a></li>
                </ol>
            </div>
        </div>

        <div class="contentpanel">
            <div class="row">
                <form method="post" action="<?php echo base_url('Admin/Ayarlar/Guncelle'); ?>">
                    <div class="row">
                        <div class="col-md-12">
                            <ul class="nav nav-tabs nav-dark">
                                <li class="active"><a href="#tab_1_1" data-toggle="tab"><strong>Genel Ayarlar</strong></a></li>
                                <li class=""><a href="#tab_1_2" data-toggle="tab"><strong>İletişim Ayarları</strong></a></li>
                                <li class=""><a href="#tab_1_3" data-toggle="tab"><strong>Mail Ayarlar</strong></a></li>
                            </ul>
                            <div class="tab-content mb30">
                                <div class="tab-pane active" id="tab_1_1">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label textRight">Kayıt No :</label>
                                                <div class="col-sm-4">
                                                    <input type="text"  class="form-control fc-sm" name="ID" value="<?=$Ayar->ID ?>" readonly="readonly"/>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label textRight">Adı :</label>
                                                <div class="col-sm-8">
                                                    <input type="text"  class="form-control fc-sm" name="Adi" value="<?=$Ayar->Adi?>" required/>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label textRight">Tam Adı :</label>
                                                <div class="col-sm-8">
                                                    <input type="text"  class="form-control fc-sm" name="TamAdi" value="<?=$Ayar->TamAdi ?>" required/>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label textRight">Açıklama :</label>
                                                <div class="col-sm-8">
                                                    <textarea name="Aciklama" class="form-control fc-sm" rows="3">
                                                        <?=$Ayar->Aciklama ?>
                                                    </textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label textRight">Anahtar Kelimeler :</label>
                                                <div class="col-sm-8">
                                                    <textarea name="Keywords" class="form-control fc-sm" rows="3">
                                                        <?=$Ayar->Keywords ?>
                                                    </textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane " id="tab_1_2">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label textRight">Telefon :</label>
                                                <div class="col-sm-8">
                                                    <input type="text"  class="form-control fc-sm phone" name="Telefon" value="<?=$Ayar->Telefon ?>" />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label textRight">Email :</label>
                                                <div class="col-sm-8">
                                                    <input type="text"  class="form-control fc-sm" name="Email" value="<?=$Ayar->Email ?>" required/>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label textRight">Vergi No :</label>
                                                <div class="col-sm-8">
                                                    <input type="text"  class="form-control fc-sm" name="VergiNo" value="<?=$Ayar->VergiNo ?>"/>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label textRight">Adres :</label>
                                                <div class="col-sm-8">
                                                    <textarea name="Adres" class="form-control fc-sm" rows="2">
                                                        <?=$Ayar->Adres ?>
                                                    </textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label textRight">Şehir :</label>
                                                <div class="col-sm-8">
                                                    <input type="text"  class="form-control fc-sm" name="Sehir" value="<?=$Ayar->Sehir ?>" />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label textRight">Durum :</label>
                                                <div class="col-sm-8">
                                                    <label class="form-control fc-sm">
                                                        <input type="checkbox" id="Aktif" name="Aktif" <?php if($Ayar->Aktif == 1) { echo "checked=checked"; } ?>" value="<?= $Ayar->Aktif ?>" />Aktif
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label textRight">Facebook Adresi :</label>
                                                <div class="col-sm-8">
                                                    <input type="text"  class="form-control fc-sm" name="Facebook" value="<?=$Ayar->Facebook ?>" />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label textRight">Twitter Adresi :</label>
                                                <div class="col-sm-8">
                                                    <input type="text"  class="form-control fc-sm" name="Twitter" value="<?=$Ayar->Twitter ?>" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane " id="tab_1_3">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label textRight">Smtp Server :</label>
                                                <div class="col-sm-8">
                                                    <input type="text"  class="form-control fc-sm" name="SmtpServer"value="<?= $Ayar->SmtpServer ?>" required/>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label textRight">SmtpEmail :</label>
                                                <div class="col-sm-8">
                                                    <input type="text"  class="form-control fc-sm" name="SmtpEmail" value="<?= $Ayar->SmtpEmail ?>" required/>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label textRight">Smtp Şifre :</label>
                                                <div class="col-sm-8">
                                                    <input type="text"  class="form-control fc-sm" name="SmtpSifre" value="<?= $Ayar->SmtpSifre?>" required/>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label textRight">Smtp Port :</label>
                                                <div class="col-sm-8">
                                                    <input type="text"  class="form-control fc-sm" name="SmtpPort" value="<?= $Ayar->SmtpPort?>" required/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 textCenter">
                            <input type="submit" class="btn btn-primary " value="Güncelle"></input>
                            <a href="<?php echo base_url("Admin\Ayarlar"); ?>" class="btn btn-danger">İptal</a>
                        </div>
                    </div>
                </form>
            </div><!-- row -->
        </div>
    </div><!-- mainpanel -->
</section>

<?php $this->load->view("includes/footer");?>
<script src="<?php echo base_url("assets") ?>/ckeditor/ckeditor.js"></script>

<script type="application/javascript">
    $(document).ready(function() {
        CKEDITOR.replace('Hakkimizda');
        CKEDITOR.replace('Iletisim');
        $("#Aktif").live('change', function () {
            if ($("#Aktif").prop("checked")==true)
                $(this).val(1);
            else
                $(this).val(0);
        });
        $(".phone").mask("(999) 999-9999");
    });
</script>
</body>
</html>