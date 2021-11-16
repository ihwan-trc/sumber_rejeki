<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
?>
<div class="card shadow mb-4">
  <div class="card-body">
    <div class="table-responsive">
      <a href="pages/report/hutangjual_print"  class="btn btn-primary btn-sm" target="blank">
        <i class="fa fa-print"> </i> Cetak Laporan
      </a>
      <h4 class="text-center">Hutang Penjualan</h4>
      <?php $date = date('Y-m-d'); ?>
      <h5 style="font-size: 14px; font-weight: bold;  text-align: center;">Periode : <?php echo tanggal_indo($date, true); ?></h5>
      <table class="table" id="dataTable" width="100%" cellspacing="0" style="font-size: 12px;">
        <thead>
          <tr>
            <th>No</th>
            <th>No.Transaksi</th>
            <th>Pelanggan</th>
            <th>Kasir</th>
            <th>Tanggal Pembelian</th>
            <th>Jatuh Tempo</th>
            <th>Hutang</th>
          </tr>
        </thead>
        <tbody>
          <?php 
            $no=1;
            $result = $connect->query("SELECT * FROM penjualan WHERE status='Belum Lunas' ORDER BY id ASC");
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
            <td><?= $data->id ?></td>
            <td><?= $data->customer ?></td>
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
    </div>
  </div>
</div>