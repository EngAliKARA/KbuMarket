<div class="row">
    <div class="col-md-12">
        <ul class="vertical-menu">
            <?php if ($Sayfalar) {
                foreach ($Sayfalar as $Sayfa) { ?>
                    <li><a href="<?php echo base_url()."Home/Sayfa/".$Sayfa->ID; ?>" title="<?=$Sayfa->SayfaAdi?>">
                            <i class="fa fa-file-text"></i><span> &nbsp;&nbsp;<?=$Sayfa->SayfaAdi?></span></a></li>
                <?php }
            }?>
        </ul>
    </div>
</div>