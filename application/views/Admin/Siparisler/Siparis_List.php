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
            <h2><i class="fa fa-rocket"></i> Sipariş Listeleme</h2>
            <div class="breadcrumb-wrapper">
                <span class="label">Burdasınız :</span>
                <ol class="breadcrumb">
                    <li><a href="<?php echo base_url("Admin\Home"); ?>">Admin</a></li>
                    <li class="active"><a href="<?php echo base_url("Admin\Siparisler"); ?>">Siparişler</a></li>
                </ol>
            </div>
        </div>

        <div class="contentpanel">
            <div class="row">
                <div class="col-md-12">
                    <a onclick="SiparisDurumGuncelle()" class="btn btn-xxs btn-primary" href="#"><i class="fa fa-refresh"></i> Seçili Sipariş Durum Güncelle</a>
                    <a id="btnSiparisDetay" class="btn btn-xxs btn-info" href="#"><i class="fa fa-suitcase"></i> Seçili Sipariş Detayı</a>
                    <a id="btnSil" class="btn btn-xxs btn-danger" href="#"><i class="fa fa-trash-o"></i> Seçili Ürün Sil</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table" id="tblSiparisList">
                        <thead>
                        <th>SİPARİŞ NO</th>
                        <th>MÜŞTERİ ADI SOYADI</th>
                        <th>TARİH</th>
                        <th>BEDEN</th>
                        <th>RENK</th>
                        <th>MİKTAR</th>
                        <th>SATIŞ FİYATI</th>
                        </thead>
                        <tbody>
                        <?php
                        if ($Siparisler) {
                            foreach ($Siparisler as $Siparis){ ?>
                                <tr data-id="<?=$Siparis->SiparisID?>" class="<?php
                                if ($Siparis->SiparisDurumu=="Teslim Edildi") {echo "delivered"; }
                                if ($Siparis->SiparisDurumu=="Kargoda") {echo "cargo"; }
                                ?>">
                                    <td><?=$Siparis->SiparisID ?></td>
                                    <td><?=$Siparis->AdSoyad ?></td>
                                    <td><?=date("d.m.Y H:i:s",strtotime($Siparis->Tarih))?></td>
                                    <td><?=$Siparis->OdemeTuru ?></td>
                                    <td><?=$Siparis->OdemeDurumu ?></td>
                                    <td><?=$Siparis->SiparisDurumu ?></td>
                                    <td><?=$Siparis->FaturaTelefon ?></td>
                                </tr>
                            <?php }
                        }?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div><!-- mainpanel -->
</section>
<div class="modal fade" id="spGuncelle" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Sipariş Durum Güncellemesi</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <form method="post" enctype="multipart/form-data" action="<?php echo base_url("Admin/Siparisler/Guncelle"); ?>">
                            <div class="form-group">
                                <label class="col-sm-3 control-label textRight">Durum :</label>
                                <div class="col-sm-8">
                                    <select class="form-control fc-sm" name="SiparisDurumu">
                                        <option value="">Seçiniz...</option>
                                        <option value="Hazırlanıyor">Hazırlanıyor</option>
                                        <option value="Kargoya Verildi">Kargoya Verildi</option>
                                        <option value="Teslim Edildi">Teslim Edildi</option>
                                        <option value="Sipariş Red Edildi">Sipariş Red Edildi</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">
                                </div>
                                <div class="col-sm-3">
                                    <input type="hidden" name="SiparisID" id="SiparisID" value="0"/>
                                    <button class="btn btn-sm btn-block btn-orange"><i class="fa fa-check"></i>&nbsp;Güncelle</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- modal-content -->
    </div><!-- modal-dialog -->
</div><!-- modal -->
<?php $this->load->view("includes/footer");?>
<script type="application/javascript">
    var baseurl = "<?php echo base_url('Admin/Siparisler'); ?>/";
    function SiparisDurumGuncelle() {
        if ($("#tblSiparisList tbody .SelRow").length > 0) {
            var ROW = document.getElementById("tblSiparisList").getElementsByClassName("SelRow")[0];
            $("#SiparisID").val(ROW.cells[0].innerHTML);
            $("#spGuncelle").modal("show");
        }
        else
            alert("Lütfen Sipariş Seçiniz...");
    }
    $(document).ready(function() {
        $("#tblSiparisList").dataTable({
            bDestroy: true,
            bFilter: true,
            bLengthChange: true,
            bPaginate: true,
            bInfo: false,
            bSort: true,
            aLengthMenu: [[10, 20,50,100,-1], [10,20,50,100,'All']],
        });
        $("#tblSiparisList tbody tr").live('click', function () {
            if (this.firstChild.className == "dataTables_empty")
                return false;
            $("#tblSiparisList .SelRow").removeClass("SelRow");
            $(this).addClass("SelRow");
            $("#btnSiparisDetay").attr("href",baseurl+"Detay/"+$(this).attr("data-id"));
            $("#btnSil").attr("href",baseurl+"Sil/"+$(this).attr("data-id"));
        });
    } );
</script>
</body>
</html>