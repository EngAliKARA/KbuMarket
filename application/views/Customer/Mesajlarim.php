
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
                        <button class="btn btn-xxs btn-success"onclick="MesajOlustur()"><i class="fa fa-plus"></i> Yeni Mesaj</button>
                        <a class="btn btn-xxs btn-info" id="btnDuzenle" href="#"><i class="fa fa-refresh"></i> Seçili Mesaj Görüntüle</a>
                        <a class="btn btn-xxs btn-danger" id="btnSil" href="#"><i class="fa fa-trash-o"></i> Seçili Mesaj Sil</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table" id="tblMesajList">
                            <thead>
                                <th>KAYIT TARİHİ</th>
                                <th>MESAJ KONU</th>
                                <th>DURUM</th>
                            </thead>
                            <tbody>
                            <?php  if ($Mesajlar) {
                                foreach ($Mesajlar as $Mesaj){ ?>
                                    <tr data-id="<?=$Mesaj->RecID; ?>">
                                        <td><?=date("d.m.Y H:i:s",strtotime($Mesaj->Tarih))?></td>
                                        <td><?=$Mesaj->Konu; ?></td>
                                        <td>
                                            <?php
                                            if ($Mesaj->Cevap>0)
                                                echo "<span class='label label-success'>Cevaplandı</span>";
                                            else
                                                echo "<span class='label label-info'>Cevaplanmadı</span>";
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
<div class="modal fade" id="myMesaj" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Yeni İletişim mesajı Oluştur</h4>
            </div>
            <div class="modal-body">
                <div class="row">
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
                                <label class="col-sm-3 control-label textRight">Mesaj :</label>
                                <div class="col-sm-8">
                                    <textarea rows="7" class="form-control fc-sm" name="Mesaj"
                                              placeholder="Mesaj İçeriği" required></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">
                                </div>
                                <div class="col-sm-3">
                                    <input type="hidden" name="UstID" value="0"/>
                                    <button class="btn btn-sm btn-block btn-orange"><i class="fa fa-check"></i>&nbsp;Mesajı
                                        Gönder
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- modal-content -->
    </div><!-- modal-dialog -->
</div><!-- modal -->
<?php $this->load->view('include_main/footer');?>
<script type="application/javascript">
    function MesajOlustur() {
        $("#myMesaj").modal("show");
        return false;
    }
    var baseurl = "<?php echo base_url('Home'); ?>/";
    $(document).ready(function() {
        $("#tblMesajList").dataTable({
            bDestroy: true,
            bFilter: true,
            bLengthChange: true,
            bPaginate: true,
            bInfo: false,
            bSort: true,
            aLengthMenu: [[10, 20,50,100,-1], [10,20,50,100,'All']],
        });
        $("#tblMesajList tbody tr").live('click', function () {
            if (this.firstChild.className == "dataTables_empty")
                return false;
            $("#tblMesajList .SelRow").removeClass("SelRow");
            $(this).addClass("SelRow");
            $("#btnDuzenle").attr("href",baseurl+"MesajDetay/"+$(this).attr("data-id"));
            $("#btnSil").attr("href",baseurl+"MesajSil/"+$(this).attr("data-id"));
        });
    });
</script>