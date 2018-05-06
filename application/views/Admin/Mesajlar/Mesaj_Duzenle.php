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
            <h2><i class="fa fa-envelope"></i>Mesajlar Görüntüleme ve Yanıtlama</h2>
            <div class="breadcrumb-wrapper">
                <span class="label">Burdasınız :</span>
                <ol class="breadcrumb">
                    <li><a href="<?php echo base_url("Admin\Home"); ?>">Admin</a></li>
                    <li class="active"><a href="<?php echo base_url("Admin\Mesajlar"); ?>">Mesajlar</a></li>
                </ol>
            </div>
        </div>

        <div class="contentpanel">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-xxs btn-success"onclick="MesajYanitla()"><i class="fa fa-plus"></i> Mesajı Yanıtla</button>
                            <a class="btn btn-xxs btn-info"  href="<?=base_url()?>/Admin/Mesajlar"><i class="fa fa-backward"></i> Mesaj Listesine Dön</a>
                        </div>
                    </div>
                    <div class="row" id="MesajYanit">
                        <div class="col-md-12">
                            <form method="post" enctype="multipart/form-data" action="<?php echo base_url('Admin/Mesajlar/Yanitla'); ?>">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label textRight">Yanıtınız :</label>
                                    <div class="col-sm-8">
                                    <textarea rows="7" class="form-control fc-sm" name="Mesaj"
                                              placeholder="Yanıt İçeriği" required></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3">
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="hidden" name="UstID" value="<?= $Mesaj->RecID; ?>"/>
                                        <button class="btn btn-sm btn-block btn-orange"><i class="fa fa-check"></i>&nbsp;Mesajı
                                            Gönder
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="nots nots-orange box-container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <stron class="review-author"><?= $Mesaj->AdSoyad; ?> :</stron>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-9">
                                        <strong class="review-subject"><?= $Mesaj->Konu; ?></strong>
                                    </div>
                                    <div class="col-sm-3 textRight">
                                        <strong class="review-date"><?= date("d.m.Y H:i", strtotime($Mesaj->Tarih)) ?></strong>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <p class="review-text"><?= $Mesaj->Mesaj; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if ($Mesaj->Sub) {
                        foreach ($Mesaj->Sub as $Sm) { ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="nots <?php if ($Sm->CustomerID == 0) echo "nots-info"; else echo "nots-pink"; ?> box-container">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <stron class="review-author">
                                                    <?php
                                                    if ($Sm->CustomerID == 0) echo "KBU ONLINE SHOPPING :";
                                                    else echo $Sm->AdSoyad." :";
                                                    ?>
                                                </stron>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-9">
                                                <strong class="review-subject"><?= $Sm->Konu; ?></strong>
                                            </div>
                                            <div class="col-sm-3 textRight">
                                                <strong class="review-date"><?= date("d.m.Y  H:i", strtotime($Sm->Tarih)) ?></strong>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <p class="review-text"><?= $Sm->Mesaj; ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <?php if ($Sm->CustomerID == 0) { ?>
                                                    <a class="btn btn-xxs btn-danger" id="btnSil" href="<?php echo base_url()."Admin/Mesajlar/YanitSil/".$Sm->RecID; ?>">
                                                        <i class="fa fa-trash-o"></i></a>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php }
                    } ?>
                </div><!-- col-sm-5 -->
            </div><!-- row -->
        </div>
    </div><!-- mainpanel -->
</section>

<?php $this->load->view("includes/footer");?>
<script type="application/javascript">
    $("#MesajYanit").hide();
    function MesajYanitla() {
        $("#MesajYanit").show();
    }
    $(document).ready(function() {
        $("#Aktif").live('change', function () {
            if ($("#Aktif").prop("checked")==true)
                $(this).val(1);
            else
                $(this).val(0);
        });
    });
</script>
</body>
</html>