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
    echo '<div class="alert alert-success alert-white rounded">
            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">×</button>
            <div class="icon">
                <i class="fa fa-check"></i>
            </div>
            <strong>Transaksi Berhasil!</strong> 
          </div>';
  
  }elseif ($get_stat=='gagal') {
    echo '<div class="alert alert-danger alert-white rounded">
            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">×</button>
            <div class="icon">
                <i class="fa fa-times-circle"></i>
            </div>
            <strong>Gagal!</strong> 
          </div>';
  } 

} ?>
<?php
  date_default_timezone_set("Asia/Jakarta");

  $sql = $connect->query("SELECT COUNT(id) AS count FROM Pembelian WHERE tgl = '". date('Y-m-d') ."' ");
  $dt  = $sql->fetch_object();
  $kode = date('ymhis');

  $user = $_SESSION['username'];
  $sql  = $connect->query("SELECT * FROM user WHERE username = '$user' ");
  $data = $sql->fetch_object(); 
  $nama = $data->nama;
?>

 <div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary text-center">Transaksi Pembelian (Tambah Stok)</h6>
    <div class="row">
      <div class="col-9 mt-1">
        <table class="font-weight-bold">
          <tr>
            <td style="border-top-left-radius: 5px;border-bottom-left-radius: 5px; font-size: 12px;">No.Transaksi</td>
            <td class="text-danger" style="border-top-left-radius: 5px;border-bottom-left-radius: 5px; font-size: 12px;">&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo "$kode".$dt->count+1; ?></td>
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
      <!-- <div class="float-right">
        <table class="font-weight-bold">
          <tr>
            <td style="border-top-left-radius: 5px;border-bottom-left-radius: 5px; font-size: 12px;">Supplier</td>
            <td style="border-top-left-radius: 5px;border-bottom-left-radius: 5px; font-size: 12px;">&nbsp;&nbsp;:
              <select class="" style="font-size: 12px"> -->
                <?php
                  // $res = $connect->query('SELECT * FROM suplier'); 
                  // while ($data = $res->fetch_object()) {
                   ?>
                    <!-- <option value="<?= $data->nama ?>"><?= $data->nama ?></option> -->
                <?php
                 // }
                  ?> 
              <!-- </select>
            </td>
          </tr>
        </table>
      </div> -->
    </div>
    <hr class="border-bottom-primary">
    <div class="mt-4">
    <form method="POST" name="form_pembelian">
      <div class="row">
        <div class="col-4">
          <div class="input-group">
            <input type="hidden" name="id" value="<?= $no_transaksi; ?>">
            <input type="hidden" name="qty">
            <input type="hidden" name="diskon">
            <input type="hidden" name="barang-kode">
            <input type="text" name="barcode" class="form-control"  placeholder="Barcode / Nama Barang" style="border-top-left-radius: 5px;border-bottom-left-radius: 5px; font-size: 12px;" autofocus="" required>
            <span class="input-group-btn">
              <button type="submit" class="btn btn-primary" name="cari" style="border-bottom-right-radius : 5px; border-bottom-left-radius : 0px;border-top-left-radius : 0px; font-size: 12px">
                <span class="fa fa-search"></span>
              </button>
            </span>
          </div>
        </div> 
        <div class="col-4">
          <?php 
          if (isset($_GET['status'])) {
            $get_stat = $_GET['status'];
            if ($get_stat== 2) { ?>
                <div class='alert-warning alert-white' style="">
                  <span class='icon'><i class='fa fa-times-circle'></i></span>
                    <small>Data > 1 klik "Data barang"!</small> 
                </div>
            <?php }elseif ($get_stat== 3){ ?>
                <div class='alert-danger alert-white' style="">
                  <span class='icon'><i class='fa fa-times-circle'></i></span>
                    <small>Data tidak ditemukan!</small> 
                </div>
            <?php } 
          } ?>
        </div>  
        <div class="col-4">
          <span class="input-group-btn">
            <button type="button" class="btn btn-sm btn-success font-weight-bold" style="float: right;" data-toggle="modal" data-target=".bs-example-modal-lg">Data Barang</button>
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
            <th width="10%">HPP</th>
            <th width="10%">Harga Jual</th>
            <th width="10%" style=" text-align: center;">Qty</th>
            <th class="font-weight-bold" width="10%">Subtotal HPP</th>
            <th width="1%" align="center">Aksi</th>
          </tr>
        </thead>
          <?php
            $no=1;
            $result = $connect->query("SELECT * FROM temp_beli");
            $nums   = $result->num_rows;
          ?>
        <tbody>
          <?php while ($data = $result->fetch_object()) { ?>
               <tr>
                <td align="center" style="background-color : #DCDCDC"><?= $no ?></td>
                <td><?= $data->barcode ?></td>
                <td><?= $data->nama ?></td>
                <td><?= $data->satuan ?></td>
                <td>
                  <form action="action/action?act=edit-hbeli-cart-beli" method="POST" align="center">
                    <input type="hidden" name="kode" value="<?= $data->kode_barang ?>">
                    <input type="hidden" name="hbeli" value="<?= $data->beli ?>">
                    <input type="hidden" name="qty" value="<?= $data->qty ?>">
                    <input width="10%" type="text" min="0" name="hbeli" class="form-control text-xs" value="<?= number_format($data->beli) ?>">
                  </form>
                </td>
                <td>
                  <form action="action/action?act=edit-hjual-cart-beli" method="POST" align="center">
                    <input type="hidden" name="kode" value="<?= $data->kode_barang ?>">
                    <input type="hidden" name="hjual" value="<?= $data->jual ?>">
                    <input width="10%" type="text" min="0" name="hjual" class="form-control text-xs" value="<?= number_format($data->jual) ?>">
                  </form>
                </td>
                <td align="center">
                  <form action="action/action?act=edit-qty-cart-beli" method="POST" align="center">
                    <input type="hidden" name="kode" value="<?= $data->kode_barang ?>">
                    <input type="hidden" name="harga" value="<?= $data->beli ?>">
                    <input type="text" min="0" name="qty" class="form-control text-xs text-center" value="<?= $data->qty ?>">
                  </form>
                </td>
                <td class="font-weight-bold" style="background-color : #DCDCDC">Rp. <?= number_format($data->subtotal) ?></td>
                <td><a href="action/action?act=del-cart-pembelian&&data=<?= $data->kode_barang ?>" class="fa fa-trash" title="Hapus"></a></td>
              </tr>
        <?php $no++; } ?>

          <?php
            $result = $connect->query("SELECT SUM(subtotal) AS total FROM temp_beli");
            $data   = $result->fetch_object();

          ?>
              <tr >
                <td colspan='7' style="color : red" align="center"><strong>Total Harga</strong></td>
                <td  style='color : red'><strong>Rp. <?= number_format($data->total) ?></strong></td>
                <td></td>
              </tr>
              <tr>
                <td colspan="8"></td>
              </tr>
            </tbody>
          </table>
          


          <div style="float: right; line-height: 1px">
            <form action="action/action.php?act=simpan-pembelian" class="form-horizontal form-label-left" method="post" style="font-size: 14px" id="myForm">
              <input type="hidden" name="created" value="<?= $nama ?>">
              <div class="form-group mb-0">
                <label class="control-label col-md-9 col-sm-3 col-xs-12"> Grand Total <span class="required"></span></label>
                  <div class="col-md-12">
                    <input type="text" name="input_total" id="input-total" required="required" class="form-control" style="color : red; font-size: 12px" readonly value=" "/>
                    <input type="hidden" name="kode_trans" value="<?php echo "$kode".$dt->count+1; ?>"/>
                  </div>
              </div>
              <div class="form-group mb-0">
                <label class="control-label col-md-9 col-sm-3 col-xs-12" for="suplier"> Supplier <span class="required"></span></label>
                  <div class="col-md-12">
                    <select class="form-control" style="font-size: 12px" name="suplier">
                      <?php
                        $res = $connect->query('SELECT * FROM suplier'); 
                        while ($ds = $res->fetch_object()) { ?>
                        <option value="<?= $ds->nama ?>"><?= $ds->nama ?></option>
                     <?php } ?>
                    </select>
                  </div>
              </div>
               
              <div class="form-group mb-2">
                <label class="control-label col-md-9 col-sm-3 col-xs-12"><span class="required"></span></label>
                <div class="col-md-12">
                  <input type="checkbox" name="status" href="#" id="tunai" value="Lunas"> Tunai</a>
                  <input type="checkbox" name="status" href="#" id="hutang" value="Belum Lunas"> Hutang</a>
                </div>
              </div>

                <div class="form-group" id="jatuh-tempo">
                  <label class="control-label col-md-9"> Jatuh Tempo<span class="required"></span></label>
                  <div class="col-md-12 col-sm-6 col-xs-12">
                    <div class="input-group">
                      <?php $date  = date('Y-m-01'); ?>
                      <input type="date" class="form-control" name="jatuh_tempo" style="border-top-left-radius :  5px; border-bottom-left-radius :  5px; font-size: 14px;">
                      <span class="input-group-btn">
                        <div  class="btn btn-primary" style="border-bottom-right-radius : 5px; border-bottom-left-radius : 0px;border-top-left-radius : 0px; font-size: 14px"><span class="fa fa-calendar"></span>
                        </div>
                      </span>
                    </div>
                  </div>
                </div>

              <div class="form-group mb-0 inputbayar">
                <label class="control-label col-md-9"> Bayar<span class="required"></span></label>
                  <div class="col-md-12" id="input">
                    <input type="text" name="input_bayar" autocomplete="off" id="input-bayar" required="required" class="form-control" style="color : red; font-size: 12px" />
                  </div>
              </div>

              <div class="form-group mb-0" id="kurang">
                <label class="control-label col-md-9 col-sm-3 col-xs-12" for="first-name"> Kekurangan <span class="required"></span></label>
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
    kembali = bayar - total;
   // if (total > bayar) kembali = 0;
   $('#input-kembali').val(formatAngka(kembali));
  });
</script>

        </div>
      </div>
    </div>
  </div>

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
                <th>Supplier</th>
                <th>Harga Beli</th>
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
            <td><?= $data->suplierid ?></td>
            <td>Rp. <?= number_format($data->beli) ?>,-</td>
            <td>Rp. <?= number_format($data->jual) ?>,-</td>
            <td><?= $data->stok ?></td>
            <td>
              <form action="action/action?act=add-cart-pembelian" method="POST">
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

<script>
  var form = $('#myForm');
    cek_tunai = $('#tunai');
    cek_hutang = $('#hutang');
    tempo = $('#jatuh-tempo');
    kurang = $('#kurang');
    bayar = $('.inputbayar');

    bayar.hide();
    tempo.hide();
    kurang.hide();

    cek_tunai.on('click', function() {
        if($(this).is(':checked')) {
          bayar.show();
          bayar.find('input').attr('required', true);
        } else {
          bayar.hide();
          bayar.find('input').attr('required', false);
        }
    })
    cek_hutang.on('click', function() {
        if($(this).is(':checked')) {
          tempo.show();
          tempo.find('input').attr('required', true);
          bayar.show();
          bayar.find('input').attr('required', true);
          kurang.show();
          kurang.find('input').attr('required', true);
        } else {
          tempo.hide();
          tempo.find('input').attr('required', false);
          bayar.hide();
          bayar.find('input').attr('required', false);
          kurang.hide();
          kurang.find('input').attr('required', false);
        }
    })
</script>

<?php 
    if (isset($_POST['cari'])) {
      $idcari = $_POST['id'];
      $barcodecari = $_POST['barcode'];
      $cari=$connect->query("SELECT * FROM barang WHERE nama like '%".$barcodecari."%' OR barcode like '%".$barcodecari."%'");
      $row_cnt = $cari->num_rows;
      
        if ($row_cnt == 1){
          while($data = $cari->fetch_object()){
              $kodecari = $data->kode;
              $barcari = $data->barcode;
              $namacari = $data->nama; ?>
            <form action="action/action?act=add-cart-pembelian" method="POST" id="formcart">
              <input type="hidden" name="id" value="<?= $no_transaksi; ?>">
              <input type="hidden" name="kode_barang" value="<?= $kodecari; ?>">
              <input type="hidden" name="barcode" value="<?= $barcari; ?>">
              <input type="hidden" name="nama" value="<?= $namacari; ?>">
            </form> <?php }
        }elseif ($row_cnt > 1){
            echo "<meta http-equiv='refresh' content='0; url=home?p=form-pembelian&status=2'>";
        }elseif($row_cnt < 1){
            echo "<meta http-equiv='refresh' content='0; url=home?p=form-pembelian&status=3'>";
        }
    }
   ?>
   <script>
    document.getElementById("formcart").submit();
   </script>
