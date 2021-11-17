<?php 

if($_SESSION['level']!="Admin" AND $_SESSION['level']!="Kasir" ){
  
  // header("location:../../error/page_403.html");  
echo "<META HTTP-EQUIV='Refresh'
CONTENT='0; URL=?p=404.php'>";
}

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
        <strong>Success!</strong> 
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

     <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Data Penjualan</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">

                  <div class="my-2"></div>
                  <a href="?p=form-penjualan" class="btn btn-dark btn-sm" title="tambah"><span class="icon text-white-50"><i class="fas fa-folder-open"></i></span><span class="text"></span><strong>Tambah data </strong></a><p />

                <table class="table" id="dataTable" width="100%" cellspacing="0" style="font-size: 12px;">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>No.Transaksi</th>
                      <th>Tanggal </th>
                      <th>Total</th>
                      <th>Status</th>
                      <th>Hutang</th>
                      <th>Jatuh Tempo</th>
                      <th>Pelanggan</th>
                      <th style="text-align : center">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      $no=1;
                      $result = $connect->query("SELECT * FROM penjualan");
                      $nums   = $result->num_rows;
                      while ($data = $result->fetch_object()) { 
                        if ($data->hutang != 0) {
                          $hutang = "Rp." .number_format($data->hutang);
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
                        <a href="?p=detail-penjualan&id=<?= $data->id ?>" title="detail">
                          <?= $data->id ?>
                        </a>
                      </td>
                      <td><?= date("d/m/Y",strtotime($data->tgl)); ?></td>
                      <td><?= number_format($data->total_harga) ?></td>
                      <td><?= $data->status ?></td>
                      <td class="text-danger"><?= $hutang ?></td>
                      <td><?= $jatuh_tempo ?></td>
                      <td><?= $data->customer ?></td>
                      <td class="text-center">
                        <div class="row">
                          <a href="pages/view/struk?kode=<?= $data->id ?>&status=<?= $data->status ?>" target="blank" class='btn btn-primary btn-sm'  title="Cetak">
                            <span class='fa fa-print'></span>
                          </a> &nbsp;
                          <form action="action/actionjual?act=edit-cart-penjualan" method="POST" name="form_penjualan">
                            <input type="hidden" name="id" value="<?= $data->id ?>">
                            <input type="hidden" name="customer" value="<?= $data->customer ?>">
                            <button type="submit" class="btn btn-sm btn-info" title="edit"><span class="fa fa-edit"></span></button>
                          </form> &nbsp;

                          <form action="action/action?act=delete-penjualan" method="POST" name="form_penjualan">
                            <input type="hidden" name="id" value="<?= $data->id ?>">
                            <button type="submit" class="btn btn-sm btn-danger" title="hapus"><span class="fa fa-trash"></span></button>
                          </form>
                        </div>
                      </td>
                    </tr>
                  <?php $no++; } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

