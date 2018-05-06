<?php $this->load->view('include_main/header');?>
<div class="main-panel">
    <div class="row">
        <div class="col-md-12">
            <div class="left-panel">
                <?php $this->load->view('include_main/sidemenu');
                ?>
            </div>
            <div class="right-panel">
                <div class="row">
                    <div class="col-md-12">
                        <?php if ($Sayfa) { ?>
                            <div class="pageheader">
                                <h2><i class="fa fa-file-o"></i> <?=$Sayfa->SayfaAdi; ?><span><?=$Sayfa->Tarih; ?></span></h2>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <?=$Sayfa->SayfaIcerik; ?>
                                </div>
                            </div>
                        <?php }?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('include_main/footer');?>
<script type="application/javascript">
    var baseurl = "<?php echo base_url('Home'); ?>/";
</script>