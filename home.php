<?php include 'config.php';
session_start();

if(!isset($_SESSION['username'])){
die(

 header('location: index.html')
);

}
?>

<?php include 'pages/include/tgl_indo.php'; ?>
<?php include 'pages/modul/terbilang.php'; ?>
<?php include 'pages/modul/tgl_indo.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>TB. Sumber Rejeki</title>
  <link rel="icon" href="img/icon.png" type="image/png">
  <link rel="stylesheet" href="asset/css/jquery-ui.css">
 <!-- Custom fonts for this template -->
  <link href="asset/icon/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link href="asset/fontawesome-free/css/all.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  
  <link rel="stylesheet" href="asset/css/select2.min.css"/>
  
  <link rel="stylesheet" href="asset/css/allert.css"/>

  <!-- Custom styles for this template -->
  <link href="asset/css/sb-admin-2.min.css" rel="stylesheet">
  <link href="asset/css/stylesheet.css" rel="stylesheet">

  <link rel="stylesheet" href="asset/css/border-list.css">

  <!-- <link href="css/style.css" rel="stylesheet"> -->
  <!-- <script type="text/javascript" src="asset/js/jquery.js"></script> -->
  <!-- Custom styles for this page -->
  <link href="asset/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
 <style type="text/css">
   .sembunyikan{
  display: none;
  }

  figure{
  width: 5rem;
  height: 5rem;
  clip-path: circle(50% at 50% 50%);
  cursor: pointer;
  position: relative;
}

.img {
  margin-top: 10px;
  width: 100%;
  height: 100%;
  transform: scale(0.75);
  transition: all 0.4s ease;
}


figure:hover .img{
  transform: scale(0.5);
  filter: blur(1px) brightness(70%);
}

figure:hover figcaption{
  opacity: 1;
  transform: translate(-50%, -50%);
}
 </style>

  <script src="js/Chart.bundle.js"></script>


  <script src="asset/js/jquery-1.10.2.js"></script>
  <script src="asset/js/jquery-ui.js"></script>

  <script>
    $(function() {
      $( "#skills" ).autocomplete({
        source : 'pages/modul/search-barang.php'
      });
    });
    </script>

<script type="text/javascript">


  
</script>

<!--   <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
  <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <script type="text/javascript" src="bootstrap.min.js"></script>
 -->


  <!-- <script  src="js/jquery.js" type="text/javascript"></script> -->

   <script type="text/javascript">

     window.onload = function() { jam(); }

     function jam() {

      var e = document.getElementById('jam'),
          d = new Date(), h, m, s;
          h = d.getHours();
          m = set(d.getMinutes());
          s = set(d.getSeconds());
          e.innerHTML = h +':'+ m +':'+ s;
      setTimeout('jam()', 1000);
     }
     function set(e) {
      e = e < 10 ? '0'+ e : e;
      return e;
     }
    </script>
<!-- 
<script type="text/javascript">
  function hari_ini(){
  $hari = date ('D');
 
  switch($hari){
    case 'Sun':
      $hari_ini = "Minggu";
    break;
 
    case 'Mon':     
      $hari_ini = "Senin";
    break;
 
    case 'Tue':
      $hari_ini = "Selasa";
    break;
 
    case 'Wed':
      $hari_ini = "Rabu";
    break;
 
    case 'Thu':
      $hari_ini = "Kamis";
    break;
 
    case 'Fri':
      $hari_ini = "Jumat";
    break;
 
    case 'Sat':
      $hari_ini = "Sabtu";
    break;
    
    default:
      $hari_ini = "Tidak di ketahui";   
    break;
  }
 
  return "<b>" . $hari_ini . "</b>";
 
}

    </script>
 -->
 

</head>
<?php $user = $_SESSION['username']; ?>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav sidebar bg-gradient-primary sidebar-dark accordion" id="accordionSidebar" >

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="?p=dashboard">
        <div class="sidebar-brand-icon">
          <img src="img/icon.png" width="50">
        </div>
        <div class="sidebar-brand-text text-center"><img src="img/brand.png" width="160" height="50"></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="?p=dashboard">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Interface
      </div>

      <?php if ($_SESSION['level']=='Admin'): { ?>
            <li class="nav-item">
              <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                <i class="fa fa-database"></i>
                <span>Master Data</span>
              </a>
              <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                  <h6 class="collapse-header">Master Data :</h6>
                  <a class="collapse-item" href="?p=barang">Data Barang</a>
                  <a class="collapse-item" href="?p=suplier">Data Suplier</a>
                  <a class="collapse-item" href="?p=satuan">Data Satuan</a>
                  <a class="collapse-item" href="?p=kategori">Data Kategori</a>
                </div>
              </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
              <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-exchange-alt"></i>
                <span>Transaksi</span>
              </a>
              <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                  <h6 class="collapse-header">Transaksi :</h6>
                  <a class="collapse-item" href="?p=penjualan">Penjualan</a>
                  <a class="collapse-item" href="?p=pembelian">Pembelian</a>
                </div>
              </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
              Addons
            </div>

            <li class="nav-item">
              <a class="nav-link" href="?p=stok-opname">
                <i class="fas fa-fw fa-table"></i>
                <span>Stok opname</span></a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="?p=report">
                <i class="fa fa-area-chart"></i>
                <span>Laporan</span></a>
            </li>

            <li class="nav-item">
              <a class="nav-link " href="?p=user">
                <i class="fa fa-user"></i>
                <span>User</span></a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="?p=pengaturan">
                <i class="fas fa-fw fa-cog fa-spin"></i>
                <span>Pengaturan</span></a>
            </li>

     <?php } ?>
  <!-- ========================================================================KASIR================================ -->
      <?php elseif ($_SESSION['level'] == 'Kasir') : {  ?>
            <li class="nav-item">
              <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-cog"></i>
                <span>Master Data</span>
              </a>
              <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                  <h6 class="collapse-header">Master Data :</h6>
                  <a class="collapse-item" href="?p=barang">Data Barang</a>
                  <a class="collapse-item" href="?p=suplier">Data Suplier</a>
                  <a class="collapse-item" href="?p=satuan">Data Satuan</a>
                  <a class="collapse-item" href="?p=kategori">Data Kategori</a>
                </div>
              </div>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="?p=penjualan">
                <i class="fas fa-fw fa-table"></i>
                <span>Penjualan</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
              Addons
            </div>

            <li class="nav-item">
              <a class="nav-link" href="?p=stok-opname">
                <i class="fas fa-fw fa-table"></i>
                <span>Stok opname</span></a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="?p=expire">
                <i class="fas fa-fw fa-table"></i>
                <span>Expire</span></a>
            </li>

      <?php } ?>
<!-- ========================================================================KASIR================================ -->
      <?php elseif ($_SESSION['level'] == 'Kasir') : {  ?>
            <li class="nav-item">
              <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-cog"></i>
                <span>Master Data</span>
              </a>
              <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                  <h6 class="collapse-header">Master Data :</h6>
                  <a class="collapse-item" href="?p=barang">Data Barang</a>
                  <a class="collapse-item" href="?p=suplier">Data Suplier</a>
                  <a class="collapse-item" href="?p=satuan">Data Satuan</a>
                  <a class="collapse-item" href="?p=kategori">Data Kategori</a>
                </div>
              </div>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="?p=penjualan">
                <i class="fas fa-fw fa-table"></i>
                <span>Penjualan</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
              Addons
            </div>

            <li class="nav-item">
              <a class="nav-link" href="?p=stok-opname">
                <i class="fas fa-fw fa-table"></i>
                <span>Stok opname</span></a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="?p=expire">
                <i class="fas fa-fw fa-table"></i>
                <span>Expire</span></a>
            </li>

      <?php } ?>

      <?php else: ?>
        
      <?php endif ?>

      <!-- Nav Item - Pages Collapse Menu -->

      <!-- Nav Item - Tables -->
      <li class="nav-item">
        <a href="#" class="nav-link" data-toggle="modal" data-target="#logoutModal">
          <i class="fas fa-fw fa-power-off"></i>
          <span>Log out</span></a>
      </li>
      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <!-- <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow"> -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Search -->
          <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
          </form>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>

            <!-- Nav Item - Alerts -->
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="?p=form-penjualan" id="alertsDropdown">
                <!-- <i class="fas fa-cash-register"></i> -->
                <figure>
                  <img class="img" src="img/pos.png">
                </figure>
              </a>
            </li>

            <!-- Nav Item - Messages -->
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline" id="jam" style="color : purple;"></span>

                <!-- Counter - Messages -->
              </a>
            </li>

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php $sql  = $connect->query("SELECT * FROM user WHERE username = '$user' ");
                      $data = $sql->fetch_object(); 
                      if ($_SESSION['level'] == 'Admin') {
                        $img = "admin.png";
                      }else{
                        $img = "user.png";
                      }
                ?> 
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $data->nama ?></span>
                <img class="img-profile rounded-circle" src="img/<?= $img ?>">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <!-- <a class="dropdown-item" href="#">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  Settings
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                  Activity Log
                </a> -->
              <!--   <div class="dropdown-divider"></div> -->
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
        <?php $getpage = $_GET['p'] ?>

     
          <?php if ($getpage == 'barang'){

                    include 'pages/view/data-barang.php';
          
          }elseif ($getpage == 'barang') {

                    include 'pages/view/data-barang.php';

          }elseif ($getpage == 'suplier') {

                    include 'pages/view/data-suplier.php';

          }elseif ($getpage == 'kategori') {
            
                    include 'pages/view/data-kategori.php';
          
          }elseif ($getpage == 'satuan') {
            
                    include 'pages/view/data-satuan.php';
          
          }elseif ($getpage == 'penjualan') {
            
                    include 'pages/view/data-penjualan.php';
          
          }elseif ($getpage == 'pembelian') {
            
                    include 'pages/view/data-pembelian.php';
          
          }elseif ($getpage == 'stok-opname') {
            
                    include 'pages/view/stok-opname.php';

          }elseif ($getpage == 'form-penjualan') {
            
                    include 'pages/view/form-penjualan.php';
          
          }elseif ($getpage == 'form-pembelian') {
            
                    include 'pages/view/form-pembelian.php';
          
          }elseif ($getpage == 'expire') {
            
                    include 'pages/view/data-expire.php';
          
          }elseif ($getpage == 'dashboard') {
            
                    include 'pages/view/beranda.php';
          
          }elseif ($getpage == 'pengaturan') {
            
                    include 'pages/view/pengaturan.php';

          }elseif ($getpage == 'report') {
            
                    include 'pages/view/laporan.php';
          
          }elseif ($getpage == 'report-pembelian') {
            
                    include 'pages/report/pembelian.php';

          }elseif ($getpage == 'report-penjualan') {
            
                    include 'pages/report/penjualan.php';

          }elseif ($getpage == 'report-hutangbeli') {
            
                    include 'pages/report/hutangbeli.php';

          }elseif ($getpage == 'report-hutangjual') {
            
                    include 'pages/report/hutangjual.php';

          }elseif ($getpage == 'user') {
            
                    include 'pages/view/user.php';
          
          }elseif ($getpage == 'report-statistik-penjualan') {
            
                    include 'pages/report/statistik-penjualan.php';
          
          }elseif ($getpage == 'report-stok-barang') {
            
                    include 'pages/report/stok-barang.php';

          }elseif ($getpage == 'detail-penjualan') {
            
                    include 'pages/view/detail-penjualan.php';

          }elseif ($getpage == 'detail-pembelian') {
            
                    include 'pages/view/detail-pembelian.php';

          }elseif ($getpage == 'form-edit-pembelian') {
            
                    include 'pages/view/form-edit-pembelian.php';

          }elseif ($getpage == 'form-edit-penjualan') {
            
                    include 'pages/view/form-edit-penjualan.php';

          }else 
                    include '404.php'
          

          ?>
     

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->


      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; TB.Sumber Rejeki 2021 V-1.0</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Yakin Keluar?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Klik tombol "Logout" jika Anda ingin mengakhiri sesi Anda saat ini.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="logout.php">Logout</a>
        </div>
      </div>
    </div>
  </div>


  <!-- Bootstrap core JavaScript-->
  <!-- <script src="asset/jquery/jquery.min.js"></script> -->

  <script src="asset/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- <script src="asset/js/rupiah.js"></script> -->

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- rupiah format -->
  <script type="text/javascript"  src="asset/js/rupiah.js"></script>
  <!-- end rupiah format -->

  <!-- Page level plugins -->
  <script src="asset/datatables/jquery.dataTables.min.js"></script>

  <script src="asset/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="asset/js/demo/datatables-demo.js"></script>
  <!-- <script type="text/javascript" src="js/jquery.js"></script> -->

  <script src="js/script.js"></script>

  <script src="asset/js/select2.min.js"></script>


 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script type="text/javascript">

$('#selection2').select2({
          placeholder: 'Pilih barang dulu',

 ajax: {

    url: "pages/modul/search-barang.php",

    type: "GET",

    dataType: 'json',

    delay: 250,

    data: function (params) {

      return {

        q: params.term, // search term

      };

    },

    processResults: function(data){

        return { results: data };

      },

    cache: true

  },

  minimumInputLength: 3,

});

</script>

</body>

</html>
