<?php

if($_SESSION['level']!="Admin" AND $_SESSION['level']!="Kasir" ){

echo "<META HTTP-EQUIV='Refresh'
CONTENT='0; URL=pages/error/index.html'>";
}
$date = date('ymd');

?>
<?php
if (isset($_GET['status'])) {
  $get_stat = $_GET['status'];
  if ($get_stat=='sukses') {
    echo '    <div class="alert alert-success alert-white rounded">
        <button type="button" data-dismiss="alert" aria-hidden="true" class="close">×</button>
        <div class="icon">
            <i class="fa fa-check"></i>
        </div>
        <strong>Transaksi Berhasil!</strong> 
    </div>';
  
  }elseif ($get_stat=='gagal') {
    echo '    <div class="alert alert-danger alert-white rounded">
        <button type="button" data-dismiss="alert" aria-hidden="true" class="close">×</button>
        <div class="icon">
            <i class="fa fa-times-circle"></i>
        </div>
        <strong>Gagal!</strong> 
        
    </div>    
';
  } 

} ?>
<?php
  date_default_timezone_set("Asia/Jakarta");
  $sql = $connect->query("SELECT COUNT(id) AS count FROM Penjualan WHERE tgl = '". date('Y-m-d') ."' ");
  $dt  = $sql->fetch_object();
  $kode = date('ymhis');

  $user = $_SESSION['username'];
  $sql  = $connect->query("SELECT * FROM user WHERE username = '$user' ");
  $data = $sql->fetch_object(); 
  $nama = $data->nama;

  $result = $connect->query("SELECT SUM(subtotal) AS total FROM temp");
  $data   = $result->fetch_object();
?>

 <div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary text-center">Transaksi Penjualan</h6>
    <div class="row">
      <div class="col-9 mt-1">
        <table class="font-weight-bold">
          <tr>
            <td style="border-top-left-radius: 5px;border-bottom-left-radius: 5px; font-size: 12px;">No.Transaksi</td>
            <td style="border-top-left-radius: 5px;border-bottom-left-radius: 5px; font-size: 12px;">&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo "$kode".$dt->count+1; ?></td>
          </tr>
          <tr>
            <td style="border-top-left-radius: 5px;border-bottom-left-radius: 5px; font-size: 12px;">Tanggal</td>
            <td style="border-top-left-radius: 5px;border-bottom-left-radius: 5px; font-size: 12px;">&nbsp;&nbsp;:&nbsp;&nbsp;<?= date('d/m/Y')?></td>
          </tr>
          <tr>
            <td style="border-top-left-radius: 5px;border-bottom-left-radius: 5px; font-size: 12px;">Kasir</td>
            <td style="border-top-left-radius: 5px;border-bottom-left-radius: 5px; font-size: 12px;">&nbsp;&nbsp;:&nbsp;&nbsp;<?= $nama ?></td>
          </tr>
        </table>
      </div>
      <div class="border-left-success shadow float-right">
        <div class="card-body">
          <h6 class="h5 mb-0 font-weight-bold text-danger">Total :&nbsp;&nbsp;&nbsp; Rp. <?= number_format($data->total) ?>,-
          </h6>
        </div>
      </div>
    </div>
    <hr class="border-bottom-primary">
    <div class="mt-4">
    <form action="action/action?act=add-cart-penjualan" method="POST" name="form_penjualan">
      <div class="col-4">
        <div class="input-group">
          <input type="hidden" name="qty">
          <input type="hidden" name="diskon">
          <input type="hidden" name="barang-kode">
          <input type="text" name="barcode" class="form-control"  placeholder="Barcode / Nama Barang" style="border-top-left-radius: 5px;border-bottom-left-radius: 5px; font-size: 12px;" autofocus="">
          <span class="input-group-btn">
            <button type="button" class="btn btn-primary" style="border-bottom-right-radius : 5px; border-bottom-left-radius : 0px;border-top-left-radius : 0px; font-size: 12px" data-toggle="modal" data-target=".bs-example-modal-lg"><span class="fa fa-search"></span></button>
          </span>
          </div>
        </div>
      </form>
    </div>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <div class="my-2"></div>
      <table class="table table-responsive" style="font-size: 12px;" width="100%">
        <thead>
          <tr>
            <th width="1%">No</th>
            <th>Barcode</th>
            <th>Nama Barang</th>
            <th>Satuan</th>
            <th>Harga</th>
            <th width="10%" style=" text-align: center;">Qty</th>
            <!-- <th width="10%">Disc</th> -->
            <th>Subtotal</th>
            <th width="1%" align="center">Aksi</th>
          </tr>
        </thead>
          <?php
            $no=1;
            $result = $connect->query("SELECT * FROM temp");
            $nums   = $result->num_rows;
          ?>
        <tbody>
          <?php while ($data = $result->fetch_object()) { ?>
               <tr>
                <td align="center" style="background-color : #DCDCDC"><?= $no ?></td>
                <td><?= $data->barcode ?></td>
                <td><?= $data->nama ?></td>
                <td><?= $data->satuan ?></td>
                <td>Rp. <?= number_format($data->harga) ?>,-</td>
                <td align="center">
                  <form action="action/action?act=edit-qty-cart" method="POST" align="center">
                    <input type="hidden" name="kode" value="<?= $data->kode_barang ?>">
                    <input type="hidden" name="harga" value="<?= $data->harga ?>">
                    <input type="text" min="0" name="qty" class="form-control text-xs text-center" value="<?= $data->qty ?>">
                  </form>
                </td>
                <td>Rp. <?= number_format($data->subtotal) ?>,-</td>
                <td><a href="action/action?act=del-cart-penjualan&&data=<?= $data->kode_barang ?>" class="fa fa-trash"></a></td>
              </tr>
        <?php $no++; } ?>

          <?php
            $result = $connect->query("SELECT SUM(subtotal) AS total FROM temp");
            $data   = $result->fetch_object();

          ?>
              <tr >
                <td colspan='6' style="color : red" align="center"><strong>Total Harga</strong></td>
                <td  style='color : red'><strong>Rp. <?= number_format($data->total) ?>,-</strong></td>
                <td></td>
              </tr>
              <tr>
                <td colspan="8"></td>
              </tr>
            </tbody>
          </table>
          


          <div style="float: right; line-height: 1px">
            <form action="action/action.php?act=simpan-penjualan" class="form-horizontal form-label-left" method="post" style="font-size: 14px">

              <div class="form-group mb-0">
                <label class="control-label col-md-9 col-sm-3 col-xs-12" for="first-name"> Grand Total <span class="required"></span></label>
                  <div class="col-md-12">
                    <input type="text" name="input_total" id="input-total" required="required" class="form-control" style="color : red; font-size: 12px" readonly value=" "/>
                    <input type="hidden" name="kode_trans"  readonly value="<?php echo "$kode".$dt->count+1; ?>"/>
                  </div>
              </div>

              <div class="form-group mb-0">
                <label class="control-label col-md-9"> Bayar<span class="required"></span></label>
                  <div class="col-md-12" id="input">
                    <input type="text" name="input_bayar" autocomplete="off" id="input-bayar" required="required" class="form-control" style="color : red; font-size: 12px" />
                  </div>
              </div>

              <div class="form-group mb-0">
                <label class="control-label col-md-9 col-sm-3 col-xs-12" for="first-name"> Kembali <span class="required"></span></label>
                  <div class="col-md-12">
                    <input type="text" name="input_kembali" id="input-kembali" required="required" class="form-control" readonly style="color : red; font-size: 12px"/>
                  </div>
              </div>

              <div class="control-label col-md-12 col-sm-3 col-xs-12 mb-0" >
                <button class="btn btn-success btn-sm" type="submit" name="simpan">
                  Simpan
                </button>
                <button class="btn btn-primary btn-sm" type="submit" name="simpan_cetak">
                  Simpan+Cetak
                </button>
              </div>
            </form>

 <script>
 // memformat angka ribuan
function formatAngka(angka) {
 if (typeof(angka) != 'string') angka = angka.toString();
 var reg = new RegExp('([0-9]+)([0-9]{3})');
 while(reg.test(angka)) angka = angka.replace(reg, '$1.$2');
 return angka;
}

// nilai total ditulis langsung, bisa dari hasil perhitungan lain
var total = <?= $data->total ?>,
 bayar = 0;
 kembali = 0;

// masukkan angka total dari variabel
$('#input-total').val(formatAngka(total));

// tambah event keypress untuk input bayar
$('#input-bayar').on('keypress', function(e) {
 var c = e.keyCode || e.charCode;
 switch (c) {
  case 8: case 9: case 27: case 13: return;
  case 65:
   if (e.ctrlKey === true) return;
 }
 if (c < 48 || c > 57) e.preventDefault();
}).on('keyup', function() {
 var inp = $(this).val().replace(/\./g, '');

 // set nilai ke variabel bayar
 bayar = new Number(inp);
 $(this).val(formatAngka(inp));

 // set kembalian, validasi
 if (bayar > total) kembali = bayar - total;
 if (total > bayar) kembali = 0;
 $('#input-kembali').val(formatAngka(kembali));
});
</script>


 

        </div>
      </div>
    </div>
  </div>



  <!----------------------------------------------------------------------------------------------------------------- -->

<!-- modal view data barang ------------------------------------------------------------------------------------------- -->
     <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" style="font-size: 10px">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-body">
          <table id="list-jual" class="table" width="100%" >
            <thead>
              <tr>
                <th>No</th>
                <th>Barcode</th>
                <th>Nama Barang</th>
                <th>Satuan</th>
                <th>Kategori</th>
                <th>Harga Jual</th>
                <th>Stok</th>
                <th>Pilih</th>
              </tr>
            </thead>
        <tbody>
          <?php
            $no=1;
              $res = $connect->query('SELECT * FROM data_barang'); 
              while ($data = $res->fetch_object()) {   ?>
          <tr>
            <td align="center" style="background-color : #DCDCDC"><?= $no ?></td>
            <td><?= $data->barcode ?></td>
            <td><?= $data->nama ?></td>
            <td><?= $data->satuan ?></td>
            <td><?= $data->kategori ?></td>
            <td>Rp. <?= number_format($data->jual) ?>,-</td>
            <td><?= $data->stok ?></td>
            <td>
              <form action="action/action?act=add-cart-penjualan" method="POST">
                <input type="hidden" name="kode_barang" value="<?= $data->kode ?>">
                <button type="submit" class='btn btn-dark btn-sm' name="pilih">Pilih</button>
              </form>
            </td>
          </tr>
          <?php $no++; } ?>
        </tbody>
      </table>
          </div>
        </div>
      </div>
    </div>
<!-- end view data barang --------------------------------------------------------------------------------------------- -->