        <?php 
          $getpage = $_GET['p'];

          if ($getpage == 'dashboard') {
              include 'pages/view/beranda.php';

          // master data
          }elseif ($getpage == 'barang'){
              include 'pages/view/data-barang.php';

          }elseif ($getpage == 'suplier') {
              include 'pages/view/data-suplier.php';

          }elseif ($getpage == 'satuan') {
              include 'pages/view/data-satuan.php';

          }elseif ($getpage == 'kategori') {
              include 'pages/view/data-kategori.php';

          }elseif ($getpage == 'importbarang') {
              include 'pages/view/importbarang.php';
          
          // transaksi
          // penjualan
          }elseif ($getpage == 'penjualan') {
              include 'pages/view/data-penjualan.php';

          }elseif ($getpage == 'detail-penjualan') {
              include 'pages/view/detail-penjualan.php';

          }elseif ($getpage == 'form-edit-penjualan') {
              include 'pages/view/form-edit-penjualan.php';

          }elseif ($getpage == 'form-penjualan') {
              include 'pages/view/form-penjualan.php';

          // pembelian
          }elseif ($getpage == 'pembelian') {
              include 'pages/view/data-pembelian.php';

          }elseif ($getpage == 'detail-pembelian') {
              include 'pages/view/detail-pembelian.php';

          }elseif ($getpage == 'form-edit-pembelian') {
              include 'pages/view/form-edit-pembelian.php';

          }elseif ($getpage == 'form-pembelian') {
              include 'pages/view/form-pembelian.php';

          // ==============================================
          }elseif ($getpage == 'stok-opname') {
              include 'pages/view/stok-opname.php';

          }elseif ($getpage == 'expire') {
              include 'pages/view/data-expire.php';
          // ==============================================

          // laporan
          }elseif ($getpage == 'report') {
              include 'pages/view/laporan.php';
          
          }elseif ($getpage == 'report-pembelian') {
              include 'pages/report/pembelian.php';

          }elseif ($getpage == 'report-penjualan') {
              include 'pages/report/penjualan.php';

          }elseif ($getpage == 'report-stok-barang') {
              include 'pages/report/stok-barang.php';

          }elseif ($getpage == 'report-statistik-penjualan') {
              include 'pages/report/statistik-penjualan.php';

          }elseif ($getpage == 'report-hutangbeli') {
              include 'pages/report/hutangbeli.php';

          }elseif ($getpage == 'report-hutangjual') {
              include 'pages/report/hutangjual.php';


          // setting
          }elseif ($getpage == 'pengaturan') {
              include 'pages/view/pengaturan.php';

          }elseif ($getpage == 'user') {
              include 'pages/view/user.php';

          // petunjuk
          }elseif ($getpage == 'petunjuk') {
              include 'pages/view/petunjuk.php';

          }else {
            include '404.php';
          }   
        ?>