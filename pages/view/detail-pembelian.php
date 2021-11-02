<?php 
    if (isset($_GET['id'])) {
      $id=$_GET['id']; 
  ?>
<div class="card shadow mb-4">
  <div class="row">
  <div class="card-header py-3 col-10">
    <h5 class="m-0 font-weight-bold text-primary">Detail Transaksi Pembelian</h5>
  </div>
  <div class="mt-3">
      <a href="pages/view/struk_pembelian?kode=<?= $id ?>"  class="btn btn-primary btn-sm">
        <i class="fa fa-print"> </i> Cetak Transaksi
      </a>
  </div>
  </div>
  <div class="card-body" >
    <div class="row">
      <div class="col-9 mt-1 mb-1">
        <table class="font-weight-bold" style=" font-size: 14px;">
          <?php 
              $sql = $connect->query("SELECT * FROM pembelian WHERE id='$id'");
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

          <table class="font-weight-bold col-3" style=" font-size: 14px;">
          <?php 
              $sql = $connect->query("SELECT * FROM pembelian WHERE id='$id'");
                while ($dt = $sql->fetch_object()){ 
            ?>
          <tr>
            <td width="35%">Supplier</td>
            <td class="text-center" width="10%">:</td>
            <td class="text-left text-primary"> <?= $dt->suplier ?></td>
          </tr>
          <tr>
            <td width="35%">Status</td>
            <td class="text-center" width="10%">:</td>
            <td class="text-left text-danger"> <?= $dt->status ?></td>
          </tr>
          <?php 
              if ($dt->status != 'Lunas') {
                echo "<tr>
                        <td width='35%'>Jatuh Tempo</td>
                        <td class='text-center' width='10%'>:</td>
                        <td class='text-left text-danger'>$dt->jatuh_tempo</td>
                      </tr>";
              }else{
                echo "";
              }
            }
           ?>
        </table>
      <!-- </div> -->
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
            <td>Harga (hpp)</td>
            <!-- <td>Harga Jual</td> -->
            <td>Qty</td>
            <td>Subtotal</td>
          </tr>
          <?php 
          $no=1;
            $sql = $connect->query("SELECT * FROM detail_beli, barang WHERE barang.kode = detail_beli.kode_barang AND id='$id'");
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

      <?php $que = $connect->query("SELECT * FROM pembelian WHERE id ='$id' ");
              $e = $que->fetch_object();
      ?>
        <tr bgcolor="#DCDCDC">
          <td colspan="5" rowspan="3"></td>
          <td >Grand Total</td>
          <td class="text-danger font-weight-bold">: Rp. <?= number_format($e->total_hbeli) ?></td>
        </tr>
        <tr bgcolor="#DCDCDC">
          <td>Total Bayar</td>
          <td class="text-danger font-weight-bold"> : Rp. <?= number_format($e->bayar) ?></td>
        </tr>
        <?php 
          if ($e->status == "Belum Lunas") {
            $td = "Kekurangan";
            $nominal = number_format($e->hutang);
          }elseif ($e->status == "Lunas") {
            $td = "Kembali";
            $nominal = number_format($e->kembalian);
          }
         ?>
        <tr bgcolor="#DCDCDC">
          <td><?= $td ?></td>
          <td class="text-danger font-weight-bold"> : Rp. <?= $nominal ?></td>
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