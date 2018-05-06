
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
                        <a class="btn btn-xxs btn-info" id="btnDuzenle" href="#"><i class="fa fa-refresh"></i> Seçili Yorum Görüntüle</a>
                        <a class="btn btn-xxs btn-danger" id="btnSil" href="#"><i class="fa fa-trash-o"></i> Seçili Yorum Sil</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table" id="tblYorumList">
                            <thead>
                            <th>KAYIT TARİHİ</th>
                            <th>YORUM BAŞLIK</th>
                            <th>ÜRÜN ADI</th>
                            <th>DURUM</th>
                            </thead>
                            <tbody>
                            <?php  if ($Yorumlar) {
                                foreach ($Yorumlar as $Yorum){ ?>
                                    <tr data-id="<?=$Yorum->YorumID; ?>">
                                        <td><?=date("d.m.Y H:i:s",strtotime($Yorum->Tarih))?></td>
                                        <td><?=$Yorum->Baslik; ?></td>
                                        <td><?php echo $Yorum->Kodu." - ".$Yorum->UrunAdi; ?></td>
                                        <td>
                                            <?php
                                            if ($Yorum->Durum==1)
                                                echo "<span class='label label-success'>Onaylandı</span>";
                                            else if ($Yorum->Durum==2)
                                                echo "<span class='label label-danger'>Reddedildi</span>";
                                            else
                                                echo "<span class='label label-info'>Belirsiz</span>";
                                            ?>
                                        </td>
                                    </tr>
                                <?php }
                            }?>
                            </tbody>
                        </table>
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
        $("#tblYorumList").dataTable({
            bDestroy: true,
            bFilter: true,
            bLengthChange: true,
            bPaginate: true,
            bInfo: false,
            bSort: true,
            aLengthMenu: [[10, 20,50,100,-1], [10,20,50,100,'All']],
        });
        $("#tblYorumList tbody tr").live('click', function () {
            if (this.firstChild.className == "dataTables_empty")
                return false;
            $("#tblYorumList .SelRow").removeClass("SelRow");
            $(this).addClass("SelRow");
            $("#btnDuzenle").attr("href",baseurl+"YorumDetay/"+$(this).attr("data-id"));
            $("#btnSil").attr("href",baseurl+"YorumSil/"+$(this).attr("data-id"));
        });
    });
</script>