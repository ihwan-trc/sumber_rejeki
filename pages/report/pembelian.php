<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
if (isset($_POST['pembelian'])) {
	$awal = $_POST['awal'];
	$akhir = $_POST['akhir'];
?>
<div class="card shadow mb-4">
	<div class="card-body">
		<div class="table-responsive">
			<a href="pages/report/pembelian_print.php?awal=<?= $awal ?>&akhir=<?= $akhir ?>"  class="btn btn-primary btn-sm" target="blank">
			  <i class="fa fa-print"> </i> Cetak Laporan
			</a>
			<h4 class="text-center">Laporan pembelian</h4>
			<h5 class='text-center' style='font-size:14px'><?= tgl_indo($awal); ?> - <?= tgl_indo($akhir);?> </h5> 

			<table class="table" id="dataTable" width="100%" cellspacing="0" style="font-size: 12px;">
			  <thead>
			    <tr>
			      <th>No</th>
			      <th>No.Faktur</th>
			      <th>Tanggal Pembelian </th>
			      <th>Supplier</th>
			      <th>Status</th>
			      <th>Hutang</th>
			      <th>Jatuh Tempo</th>
			      <th>Kasir</th>
			      <th>Total</th>
			    </tr>
			  </thead>
			  <tbody>
			    <?php 
			      $no=1;
			      $result = $connect->query("SELECT * FROM pembelian WHERE tgl BETWEEN '$awal' AND '$akhir' ORDER BY id ASC");
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
			      <td>
			      	<a href="?p=detail-pembelian&id=<?= $data->id ?>" title="detail">
			  			<?= $data->nota ?>
			      	</a>
			      </td>
			      <td><?= date("d/m/Y",strtotime($data->tgl)); ?></td>
			      <td><?= $data->suplier ?></td>
			      <td><?= $data->status ?></td>
			      <td><?= $hutang ?></td>
			      <td><?= $jatuh_tempo; ?></td>
			      <td><?= $data->kasir ?></td>
			      <td><?= number_format($data->total_hbeli) ?></td>
			    </tr>
			  <?php $no++; } ?>
			  </tbody>
			  <tfoot>
		      <tr>
		        <td colspan="5" class="text-center"><b>Total</b></td>
		        <td><b><?= number_format($total_hutang) ?></b></td>
		        <td></td>
		        <td></td>
		        <td><b><?= number_format($total) ?></b></td>
		      </tr>
		    </tfoot>
			</table>
		</div>
	</div>
</div>
<?php } ?>