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
            <h2><i class="fa fa-envelope"></i> İletişim Mesajları Listeleme</h2>
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
                        <th>MÜSTERİ ADI</th>
                        <th>DURUM</th>
                        </thead>
                        <tbody>
                        <?php  if ($Mesajlar) {
                            foreach ($Mesajlar as $Mesaj){ ?>
                                <tr data-id="<?=$Mesaj->RecID; ?>">
                                    <td><?=date("d.m.Y H:i:s",strtotime($Mesaj->Tarih))?></td>
                                    <td><?=$Mesaj->Konu; ?></td>
                                    <td><?=$Mesaj->AdSoyad; ?></td>
                                    <td>
                                        <?php
                                        if ( $Mesaj->Cevap > 0 )
                                            echo "<span class='label label-success'>Yanıtlandı</span>";
                                        else
                                            echo "<span class='label label-info'>Yanıtlanmadı</span>";
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
    var baseurl = "<?php echo base_url('Admin/Mesajlar'); ?>/";
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
            $("#btnDuzenle").attr("href",baseurl+"Duzenle/"+$(this).attr("data-id"));
            $("#btnSil").attr("href",baseurl+"Sil/"+$(this).attr("data-id"));
        });
    } );
</script>
</body>
</html>