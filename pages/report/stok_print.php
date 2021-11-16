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
        <h6>Laporan Stok</h6>
        <?php $date = date('Y-m-d'); ?>
        <h5 style="font-size: 14px; font-weight: bold;  text-align: center;">Periode : <?php echo tanggal_indo($date, true); ?></h5>
      </div><br>

        <?php $result = $connect->query("SELECT * FROM barang ORDER BY kode ASC"); ?>
      <table class="table" id=""  width="100%" cellspacing="0" style="font-size: 12px">
        <thead>
          <tr>
            <th>No</th>
            <th>Barcode</th>
            <th>Nama Barang</th>
            <th>Kategori</th>
            <th>Satuan</th>
            <th>Pembelian</th>
            <th>Penjualan</th>
            <th>Stok Akhir</th>
          </tr>
        </thead>
        <tbody>
          <?php $no=1; while ($data = $result->fetch_object()) {
            $kode_barang = $data->kode;
            $resultbeli = $connect->query("SELECT SUM(qty) AS jumlah FROM detail_beli WHERE kode_barang='$kode_barang'");
            while ($databeli =$resultbeli->fetch_object()) {
              $qtybeli = $databeli->jumlah;
            }
            $resultjual = $connect->query("SELECT SUM(qty) AS jumlah FROM detail WHERE kode_barang='$kode_barang'");
            while ($datajual =$resultjual->fetch_object()) {
              $qtyjual = $datajual->jumlah;
            }

            echo '
              <tr>
                <td>'.$no++.'</td>
                <td>'.$data->barcode.'</td>
                <td>'.$data->nama.'</td>
                <td>'.$data->kategori.'</td>
                <td>'.$data->satuan.'</td>
                <td>'.$qtybeli.'</td>
                <td>'.$qtyjual.'</td>
                <td>'.$data->stok.'</td>
              </tr>
            ';

          } ?>
            
          </tr>
        </tbody>
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
