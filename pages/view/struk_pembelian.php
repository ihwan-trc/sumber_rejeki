<?php include '../../config.php'; ?>


<?php $get_struk = $_GET['kode']; ?>
 

<!DOCTYPE html>
<html>
<head>
	<title>Struk Penjualan</title>
	<style type="text/css">
		.isi-struk{
			font-family: Rockwell Extra , Rockwell , monospace; font-size: 14px; height: 10px; padding-left: 20px; padding-right: 10px;
		}
	</style>
</head>
<body>
<?php 
      date_default_timezone_set("Asia/Jakarta");

	  $date = date('d/m/Y h:i:s');
	  $result = $connect->query("SELECT * FROM data_toko");
	  $data   = $result->fetch_object(); 
?>
<h3 style="text-align: center; line-height: 1px"><?= $data->nama ?></h3>
<p style="text-align : center; height: 10px; font-size: 12px" ><?= $data->alamat ?></p>
<p style="text-align : center; height: 8px; font-size: 12px"><?= $data->telp ?></p>
<p style="text-align : center; height: 5px; font-size: 12px"><?= $date; ?></p>
<!-- <h4 style="text-align: center; height: 5px">Nota Penjualan</h4> -->
<hr>
<table border="0" class="isi-struk" style="border-collapse: collapse;" width="100%">
<?php $sql = $connect->query("SELECT id, nama,qty,harga,subtotal FROM detail_beli, barang WHERE barang.`kode` = detail_beli.`kode_barang` AND id = '$get_struk' ");  while ($dt = $sql->fetch_object()) { ?>
	<tr>
		<td colspan="3"><?= $dt->nama ?></td>
	</tr>
	<tr style="text-align: right;">
	<tr style="text-align: right;">
		<td width="30px" style="min-width: 30px; max-width: 30px"><?= $dt->qty ?></td>
		<td width="120px" style="min-width: 120px; max-width: 120px;"><?= number_format($dt->harga) ?></td>
		<td width="120px" style="min-width: 120px; max-width: 120px;"><?= number_format($dt->subtotal) ?></td>
	</tr>
<?php } ?>
</table>
<hr>
<table border="0" class="isi-struk" style="border-collapse: collapse;" width="100%">
<?php $res = $connect->query("SELECT * FROM pembelian WHERE id = '$get_struk' ");
	  $exe = $res->fetch_object(); 
?>
	<tr style="text-align: right;">
		<td width="20%" style="min-width: 30%; max-width: 30px"></td>
		<td width="40%" style="min-width: 20%; max-width: 120px;">Sub total :</td>
		<td width="40%" style="min-width: 50%; max-width: 120px;"><?= number_format($exe->total_hbeli) ?></td>
	</tr>
	<tr style="text-align: right;">
		<td width="20%" style="min-width: 30%; max-width: 30px"></td>
		<td width="40%" style="min-width: 20%; max-width: 120px;">Grand total :</td>
		<td width="40%" style="min-width: 50%; max-width: 120px;"><?= number_format($exe->total_hbeli) ?></td>
	</tr>
	<tr style="text-align: right;">
		<td width="20%" style="min-width: 30%; max-width: 30px"></td>
		<td width="40%" style="min-width: 20%; max-width: 120px;">Cash :</td>
		<td width="40%" style="min-width: 50%; max-width: 120px;"><?= number_format($exe->bayar) ?></td>
	</tr>
	<tr style="text-align: right;">
		<td width="20%" style="min-width: 30%; max-width: 30px"></td>
		<td width="40%" style="min-width: 20%; max-width: 120px;">Kembali :</td>
		<td width="40%" style="min-width: 50%; max-width: 120px;"><?= number_format($exe->bayar-$exe->total_hbeli) ?></td>
	</tr>


</table>
<hr style="height: 0px">
<!-- <p style="height:  0px; font-size: 12px">Info : </p> -->
<p style="font-size: 12px"><?php echo $data->info ?></p>
<hr>
<p align="center" style="height: 15px; font-size: 12px">Terima Kasih</p>

	<!-- <script>
		window.print();
	</script> -->
<!-- <script>
	document.location.href='../../home?p=form-pembeliann&&status=sukses';
</script> -->

<!-- <p style="font-family: Georgia, serif; font-size: 14px; line-height:  1px;">Buahvita 100ml</p>
<pre class="isi-struk">12                   12.000                   12.000</pre>
<pre class="isi-struk">2                     1.000                   12.000</pre>
 --></body>
</html>