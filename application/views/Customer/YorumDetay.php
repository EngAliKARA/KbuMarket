<?php $this->load->view('include_main/header');?>
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
                        <div class="form-group">
                            <label class="col-sm-4 control-label textRight">Yorum Baslik :</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control fc-sm" value="<?= $Yorum->Baslik; ?>" readonly="readonly"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label textRight">Ürün Adı :</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control fc-sm"
                                       value="<?php echo $Yorum->Kodu." - ".$Yorum->UrunAdi; ?>" readonly="readonly"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label textRight">Yorum Detay :</label>
                            <div class="col-sm-8">
                                <textarea rows="3" class="form-control fc-sm" readonly="readonly"><?=$Yorum->Yorum; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label textRight">Yorum Onay Açıklama :</label>
                            <div class="col-sm-8">
                                <textarea readonly="readonly" rows="3" class="form-control fc-sm"><?=$Yorum->YorumNeden; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label textRight">Durum :</label>
                            <div class="col-sm-8">
                                <label class="form-control fc-sm">
                                    <?php if ($Yorum->Durum == "0") echo "Belirsiz";
                                          else if ($Yorum->Durum =="1") echo "Onaylandı";
                                          else echo "Reddedildi";
                                    ?>
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 textCenter">
                                <a href="<?php echo base_url("Home\Yorumlar"); ?>" class="btn btn-primary">
                                   <i class="fa fa-backward"></i>&nbsp;&nbsp; Yorum Listesi
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('include_main/footer');?>
<script type="application/javascript">
    var baseurl = "<?php echo base_url('Home'); ?>/";

    $(document).ready(function() {
    });
</script>