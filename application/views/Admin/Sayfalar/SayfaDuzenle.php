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
            <h2><i class="fa fa-file-text"></i> Sayfa Düzenleme</h2>
            <div class="breadcrumb-wrapper">
                <span class="label">Burdasınız :</span>
                <ol class="breadcrumb">
                    <li><a href="<?php echo base_url("Admin\Home"); ?>">Admin</a></li>
                    <li class="active"><a href="<?php echo base_url("Admin\Sayfalar"); ?>">Sayfalar</a></li>
                </ol>
            </div>
        </div>

        <div class="contentpanel">
            <div class="row">
                <div class="col-md-12">
                    <?php if ($Sayfa) { ?>
                        <form method="post" action="<?php echo base_url('Admin/Sayfalar/Guncelle'); ?>">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label textRight">Sayfa Adı :</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control fc-sm" name="SayfaAdi" required
                                                   value="<?= $Sayfa->SayfaAdi; ?>"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label textRight">Konum / Sıra :</label>
                                        <div class="col-sm-4">
                                            <select class="form-control fc-sm" name="Konum">
                                                <option value="Yukarı" <?php if ($Sayfa->Konum=="Yukarı") echo "Selected"; ?>>Yukarı</option>
                                                <option value="Sağ" <?php if ($Sayfa->Konum=="Sağ") echo "Selected"; ?>>Sağ</option>
                                                <option value="Aşağı" <?php if ($Sayfa->Konum=="Aşağı") echo "Selected"; ?>>Aşağı</option>
                                                <option value="Sol" <?php if ($Sayfa->Konum=="Sol") echo "Selected"; ?>>Sol</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="number" class="form-control fc-sm" name="Sira" required value="<?= $Sayfa->Sira; ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label textRight">Durumu :</label>
                                        <div class="col-sm-7">
                                            <select name="Durum" class="form-control fc-sm">
                                                <option value="1" <?php if ($Sayfa->Durum=="1") echo "Selected"; ?>>Aktif ( Yayında )</option>
                                                <option value="0" <?php if ($Sayfa->Durum=="0") echo "Selected"; ?>>Pasif</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                        <textarea name="SayfaIcerik" id="SayfaIcerik" class="form-control fc-sm"
                                                  rows="5"><?= $Sayfa->SayfaIcerik; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 textCenter">
                                    <input type="hidden" name="ID" value="<?=$Sayfa->ID?>"/>
                                    <input type="submit" class="btn btn-primary " value="Kaydet"></input>
                                    <a href="<?php echo base_url("Admin\Sayfalar"); ?>" class="btn btn-danger">İptal</a>
                                </div>
                            </div>
                        </form>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div><!-- mainpanel -->
</section>

<?php $this->load->view("includes/footer"); ?>
<script src="<?php echo base_url("assets") ?>/ckeditor/ckeditor.js"></script>
<script type="application/javascript">
    var baseurl = "<?php echo base_url('Admin/Sayfalar'); ?>/";
    $(document).ready(function () {
        CKEDITOR.replace('SayfaIcerik');
    });
</script>
</body>
</html>