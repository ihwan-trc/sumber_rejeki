<?php 
  error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
?>

<!DOCTYPE html>
<html lang="en">
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
<?php
include "../../config.php"; 
include "../modul/tgl_indo.php";
$query = $connect->query("SELECT * FROM data_toko");
    while ($data = mysqli_fetch_assoc($query)) {
      $nama = $data['nama'];
      $info = $data['info'];
      $alamat = $data['alamat'];
      $telp = $data['telp'];
    }
 ?>
  <title><?= $nama ?></title>
  <link rel="icon" href="../../img/icon.png" type="image/png">
  <link href="../../asset/css/sb-admin-2.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../../asset/css/border-list.css">
</head>
<body>
  <center>
    <div id=halaman>
      <table width="100%">
          <tr>
              <td width="30%" align="right"><img src="../../img/icon.png" width="70" height="70"></td>
              <td width="40%">
              <center>
                <font size="4"><b><?= $nama ?></b></font><br>
                <font size="2"><?= $info ?></font><br>
                <font size="2"><?= $alamat ?> Telp : <?= $telp ?></font>
              </center>
              </td>
              <td width="30%"></td>
          </tr>
      </table>
      <hr>
      <div class="text-center">
        <h6>Hutang Pembelian</h6>
        <?php $date = date('Y-m-d'); ?>
        <h5 style="font-size: 14px; font-weight: bold;  text-align: center;">Periode : <?php echo tanggal_indo($date, true); ?></h5>
      </div><br>

      <table class="table" id="dataTable" width="100%" cellspacing="0" style="font-size: 12px;">
        <thead>
          <tr>
            <th>No</th>
            <th>No.Faktur</th>
            <th>Supplier</th>
            <th>Kasir</th>
            <th>Tanggal Pembelian</th>
            <th>Jatuh Tempo</th>
            <th>Hutang</th>
          </tr>
        </thead>
        <tbody>
          <?php 
            $no=1;
            $result = $connect->query("SELECT * FROM pembelian WHERE status='Belum Lunas' ORDER BY id ASC");
            $nums   = $result->num_rows;
            while ($data = $result->fetch_object()) { 
              $total += $data->total_hbeli; 
                $total_hutang += $data->hutang; 
              if ($data->hutang != 0) {
                $hutang =number_format($data->hutang);
              }else{
                $hutang = '';
              }
              if ($data->jatuh_tempo != "0000-00-00") {
                $jatuh_tempo = date("d/m/Y",strtotime($data->jatuh_tempo));
              }else{
                $jatuh_tempo = "";
              }
          ?>
          <tr>
            <td width="10px" class="text-center"><?= $no ?></td>
            <td><?= $data->nota ?></td>
            <td><?= $data->suplier ?></td>
            <td><?= $data->kasir ?></td>
            <td><?= date("d/m/Y",strtotime($data->tgl)); ?></td>
            <td><?= $jatuh_tempo; ?></td>
            <td><?= $hutang ?></td>
          </tr>
        <?php $no++; } ?>
        </tbody>
        <tfoot>
          <tr>
            <td colspan="6" class="text-center"><b>Total</b></td>
            <td><b><?= number_format($total_hutang) ?></b></td>
          </tr>
        </tfoot>
      </table>
      
       <table align="left">
       <tr>
           <td>
            <?php 
            date_default_timezone_set('Asia/Jakarta');
            $tanggal = date('d/m/Y h:i');
           ?>
            <font size="2">Cetak : <?= $tanggal; ?></font>
           </td>
       </tr>
   </table>
  </div>
</center>
</body>
</html>
<script type="text/javascript">
  window.print();
</script>
