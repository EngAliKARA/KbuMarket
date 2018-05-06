<footer>
    <div class="row">
        <div class="col-md-12 textCenter">
            <strong class="footer-title"><?=$Settings->TamAdi; ?></strong>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?=$Settings->Telefon; ?><br/><?=$Settings->Email; ?>
        </div>
        <div class="col-md-6">
            <?=$Settings->Adres; ?><br/><?=$Settings->Sehir; ?>
        </div>
    </div>
</footer>
</div>
</div>
</div>
</section>
<?php $this->load->view('includes/include_script');?>

<script type="application/javascript">
    var mesaj = "<?=$this->session->flashdata("Message");?>";
    if (mesaj!="") {
        var Kod = "<?=$this->session->flashdata("Kod");?>";
        MessageBoxShow("KBU ONLINE SHOPİNG", mesaj, Kod, Kod);
    }

</script>
<script type="text/javascript">
    jQuery(document).ready(function($) {
        jQuery('.stellarnav').stellarNav({
            theme: 'kbu'
        });
    });
</script>
