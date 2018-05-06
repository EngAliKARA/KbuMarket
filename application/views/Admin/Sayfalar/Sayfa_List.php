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
            <h2><i class="fa fa-file-text"></i> Sayfa Listeleme</h2>
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
                    <a class="btn btn-xxs btn-primary" href="<?= base_url('Admin/Sayfalar/Yeni')?>"><i class="fa fa-plus"></i> Yeni Sayfa</a>
                    <a class="btn btn-xxs btn-info" id="btnDuzenle" href="#"><i class="fa fa-refresh"></i> Seçili Sayfa Düzenle</a>
                    <a class="btn btn-xxs btn-danger" id="btnSil" href="#"><i class="fa fa-trash-o"></i> Seçili Sayfa Sil</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table" id="tblSayfaList">
                        <thead>
                        <th>KAYIT TARİHİ</th>
                        <th>SAYFA ADI</th>
                        <th>KONUMU</th>
                        <th>SIRA</th>
                        <th>DURUM</th>
                        </thead>
                        <tbody>
                        <?php  if ($Sayfalar) {
                            foreach ($Sayfalar as $Sayfa){ ?>
                                <tr data-id="<?=$Sayfa->ID; ?>">
                                    <td><?=date("d.m.Y H:i:s",strtotime($Sayfa->Tarih))?></td>
                                    <td><?=$Sayfa->SayfaAdi; ?></td>
                                    <td><?= $Sayfa->Konum; ?></td>
                                    <td><?= $Sayfa->Sira; ?></td>
                                    <td>
                                        <?php
                                        if ($Sayfa->Durum==1)
                                            echo "<span class='label label-success'>Aktif</span>";
                                        else
                                            echo "<span class='label label-info'>Pasif</span>";
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
    </div><!-- mainpanel -->
</section>

<?php $this->load->view("includes/footer");?>
<script type="application/javascript">
    var baseurl = "<?php echo base_url('Admin/Sayfalar'); ?>/";
    $(document).ready(function() {

        $("#tblSayfaList").dataTable({
            bDestroy: true,
            bFilter: true,
            bLengthChange: true,
            bPaginate: true,
            bInfo: false,
            bSort: true,
            aLengthMenu: [[10, 20,50,100,-1], [10,20,50,100,'All']],
        });
        $("#tblSayfaList tbody tr").live('click', function () {
            if (this.firstChild.className == "dataTables_empty")
                return false;
            $("#tblSayfaList .SelRow").removeClass("SelRow");
            $(this).addClass("SelRow");
            $("#btnDuzenle").attr("href",baseurl+"Duzenle/"+$(this).attr("data-id"));
            $("#btnSil").attr("href",baseurl+"Sil/"+$(this).attr("data-id"));
        });
    } );
</script>
</body>
</html>