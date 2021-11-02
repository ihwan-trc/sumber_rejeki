<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h5 class="m-0 font-weight-bold text-primary">Detail Transaksi</h5>
  </div>
  <div class="card-body" >
  <?php 
    if (isset($_GET['id'])) {
      $id=$_GET['id']; 
  ?>
    <div class="row">
      <div class="col-10 mt-1 mb-1">
        <table class="font-weight-bold" style=" font-size: 14px;">
          <?php 
              $no=1;
              $sql = $connect->query("SELECT * FROM penjualan WHERE id='$id'");
                while ($dt = $sql->fetch_object()){ 
            ?>
          <tr>
            <td>No.Transaksi</td>
            <td class="text-center" width="10%">:</td>
            <td class="text-left text-danger"> <?= $dt->id ?></td>
          </tr>
          <tr>
            <td>Tanggal</td>
            <td class="text-center" width="10%">:</td>
            <td class="text-left"> <?= tgl_indo($dt->tgl) ?></td>
          </tr>
          <tr>
            <td>Kasir</td>
            <td class="text-center" width="10%">:</td>
            <td class="text-left"> <?= $dt->kasir ?></td>
          </tr>
          <?php } ?>
        </table>
      </div>
      <div class="float-right">
          <a href="pages/view/struk?kode=<?= $id ?>"  class="btn btn-primary btn-sm">
            <i class="fa fa-print"> </i> Cetak Transaksi
          </a>
      </div>
    </div>
      <table class="table table-keytable" style="font-size: 12px">
        <thead>
        </thead>
        <tbody>
          <tr bgcolor="#2F4F4F" style="color : white">
            <td>No</td>
            <td>Barcode</td>
            <td>Nama barang</td>
            <td>Satuan</td>
            <td>Harga</td>
            <td>Qty</td>
            <td>Subtotal</td>
          </tr>
          <?php 
          $no=1;
            $sql = $connect->query("SELECT * FROM detail, barang WHERE barang.kode = detail.kode_barang AND id='$id'");
                while ($dt = $sql->fetch_object()){ ?>
          <tr class="text-danger">
            <td><?= $no++ ?></td>
            <td><?= $dt->barcode ?></td>
            <td><?= $dt->nama ?></td>
            <td><?= $dt->satuan ?></td>
            <td>Rp. <?= number_format($dt->harga) ?></td>
            <td><?= $dt->qty ?></td>
            <td>Rp. <?= number_format($dt->subtotal) ?></td>
          </tr>
          <?php } ?>

      <?php $que = $connect->query("SELECT total_harga, kembali, total_bayar FROM penjualan WHERE id ='$id' ");
              $e = $que->fetch_object();
      ?>
        <tr bgcolor="#DCDCDC">
          <td colspan="5" rowspan="3"></td>
          <td >Grand Total</td>
          <td class="text-danger font-weight-bold">: Rp. <?php echo number_format($e->total_harga) ?></td>
        </tr>
        <tr bgcolor="#DCDCDC">
          <td>Total Bayar</td>
          <td class="text-danger font-weight-bold"> : Rp. <?php echo number_format($e->total_bayar) ?></td>
        </tr>
        <tr bgcolor="#DCDCDC">
          <td>Kembali</td>
          <td class="text-danger font-weight-bold"> : Rp. <?php echo number_format($e->kembali) ?></td>
        </tr>

        <tr>
          <td height="40px" colspan="6" ></td>
        </tr>
        <tr>
      <?php } ?>
      </tbody>
    </table>
  </div>
</div>