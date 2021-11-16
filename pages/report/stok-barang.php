<div class="card shadow mb-4">
  <div class="card-body">
    <div class="table-responsive">
      <a href="pages/report/stok_print.php"  class="btn btn-primary btn-sm" target="blank">
        <i class="fa fa-print"> </i> Cetak Laporan
      </a>
      <h4 class="text-center">Laporan Stok</h4>
      <?php $date = date('Y-m-d'); ?>
      <h5 style="font-size: 14px; font-weight: bold;  text-align: center;">Periode : <?php echo tanggal_indo($date, true); ?></h5>
      <br>


      <?php $result = $connect->query("SELECT * FROM barang ORDER BY kode ASC"); ?>
      <table class="table" id="dataTable"  width="100%" cellspacing="0" style="font-size: 12px">
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
    </div>
  </div>
</div>
