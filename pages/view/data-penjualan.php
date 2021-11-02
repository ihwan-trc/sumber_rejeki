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
                  <a href="?p=form-penjualan" class="btn btn-dark btn-sm"><span class="icon text-white-50"><i class="fas fa-folder-open"></i></span><span class="text"></span><strong>Tambah data </strong></a><p />

                <table class="table" id="dataTable" width="100%" cellspacing="0" style="font-size: 12px;">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>No. Struk</th>
                      <th>Tanggal </th>
                      <th>Total</th>
                      <th>Tunai</th>
                      <th>Kembali</th>
                      <th style="text-align : center">Kasir</th>
                      <th style="text-align : center">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      $no=1;
                      $result = $connect->query("SELECT * FROM penjualan");
                      $nums   = $result->num_rows;
                      while ($data = $result->fetch_object()) { 
                    ?>
                    <tr>
                      <td width="10px" class="text-center"><?= $no ?></td>
                      <td><?= $data->id ?></td>
                      <td><?= $data->tgl ?></td>
                      <td><?= $data->total_harga ?></td>
                      <td><?= $data->total_bayar ?></td>
                      <td><?= $data->kembali ?></td>
                      <td><?= $data->kasir ?></td>
                      <td class="text-center">
                        <a href="?p=detail-penjualan&&id=<?= $data->id ?>" class='btn btn-info btn-sm'  title="Detail"><span class='fa fa-eye'></span></a>
                          
                        <a href="pages/view/struk?kode=<?= $data->id ?>" class='btn btn-primary btn-sm'  title="Cetak">
                          <span class='fa fa-print'></span>
                        </a>
                      </td>
                    </tr>
                  <?php $no++; } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

