<?php $this->load->view('include_main/header'); ?>
<div class="main-panel">
    <div class="row">
        <div class="col-md-12">
            <div class="left-panel">
                <?php $this->load->view('include_main/CustomerMenu');
                ?>
            </div>
            <div class="right-panel">
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-xxs btn-success"onclick="MesajYanitla()"><i class="fa fa-plus"></i> Mesajı Yanıtla</button>
                        <a class="btn btn-xxs btn-info"  href="<?=base_url()?>/Home/Mesajlar"><i class="fa fa-backward"></i> Mesaj Listesine Dön</a>
                    </div>
                </div>
                <div class="row" id="MesajYanit">
                    <div class="col-md-12">
                        <form method="post" enctype="multipart/form-data" action="<?php echo base_url('Home/MesajKaydet'); ?>">
                            <div class="form-group">
                                <label class="col-sm-3 control-label textRight">Konu :</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control fc-sm" name="Konu" required
                                           placeholder="Konu"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label textRight">Cevabınız :</label>
                                <div class="col-sm-8">
                                    <textarea rows="7" class="form-control fc-sm" name="Mesaj"
                                              placeholder="Cevap İçeriği" required></textarea>
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
                        <div class="row">
                            <div class="col-md-12">
                                <div class="nots nots-orange box-container">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <stron class="review-author">Mesajınız :</stron>
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
                                                        else echo "Sizin Yanıtınız :";
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
                                                    <?php if ($Sm->CustomerID > 0) { ?>
                                                    <a class="btn btn-xxs btn-danger" id="btnSil" href="<?php echo base_url()."Home/MesajYanitSil/".$Sm->RecID; ?>">
                                                        <i class="fa fa-trash-o"></i></a>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php }
                        } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('include_main/footer'); ?>
<script type="application/javascript">
    $("#MesajYanit").hide();
    function MesajYanitla() {
        $("#MesajYanit").show();
    }
    var baseurl = "<?php echo base_url('Home'); ?>/";
    $(document).ready(function () {
    });
</script>