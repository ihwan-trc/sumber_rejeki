<div class="widget-program-box mg-tb-30">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="hpanel widget-int-shape responsive-mg-b-30">
                    <div class="panel-body">
                        <div class="text-center content-box">
                            <h2 class="m-b-sm">Pembelian</h2>
                            <p class="font-bold text-info"></p>
                            <div class="m icon-box">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <p class="small mg-t-box">
                                Informasi Laporan Pembelian.                                    
                            </p>
                            <a href="#" class="btn btn-info widget-btn-4 btn-sm" data-toggle="modal" data-target="#modalPembelian" style="color : white">Lihat Laporan</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="hpanel widget-int-shape responsive-mg-b-30">
                    <div class="panel-body">
                        <div class="text-center content-box">
                            <h2 class="m-b-xs">Penjualan</h2>
                            <p class="font-bold text-success"></p>
                            <div class="m icon-box">
                                <i class="fa fa-line-chart"></i>
                            </div>
                            <p class="small mg-t-box">
                                Informasi Laporan Penjualan.
                            </p>
                            <a href="#" class="btn btn-info widget-btn-4 btn-sm" data-toggle="modal" data-target="#modalPenjualan" style="color : white">Lihat Laporan</a>
                            <a href="?p=report-penjualan" class="btn btn-success widget-btn-4 btn-sm" style="color : white">Lihat Laporan</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="hpanel widget-int-shape responsive-mg-b-30">
                    <div class="panel-body">
                        <div class="text-center content-box">
                            <h2 class="m-b-sm">Laporan Kadaluarsa</h2>
                            <p class="font-bold text-info"></p>
                            <div class="m icon-box">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <p class="small mg-t-box">
                                Informasi Laporan Kadaluarsa.                                    
                            </p>
                            <a href="?p=expire" class="btn btn-success widget-btn-4 btn-sm" style="color : white">Lihat Laporan</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="hpanel widget-int-shape responsive-mg-b-30 res-tablet-mg-t-30 dk-res-t-pro-30">
                    <div class="panel-body">
                        <div class="text-center content-box">
                            <h2 class="m-b-xs">Statistik Penjualan</h2>
                            <p class="font-bold text-warning"></p>
                            <div class="m icon-box">
                                <i class="fa fa-bar-chart"></i>
                            </div>
                            <p class="small mg-t-box">
                                Informasi Statistik Penjualan.
                            </p>
                            <a href="?p=report-statistik-penjualan" class="btn btn-warning widget-btn-3 btn-sm" style="color : white">Lihat Laporan</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="hpanel widget-int-shape res-tablet-mg-t-30 dk-res-t-pro-30">
                    <div class="panel-body">
                        <div class="text-center content-box">
                            <h2 class="m-b-xs">Laporan Stok</h2>
                            <p class="font-bold text-danger"></p>
                            <div class="m icon-box">
                                <i class="fa fa-sort-amount-asc"></i>
                            </div>
                            <p class="small mg-t-box">
                                Informasi Laporan Stok.
                            </p>
                            <a href="?p=report-stok-barang" class="btn btn-danger widget-btn-4 btn-sm" style="color : white">Lihat Laporan</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalPembelian" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Laporan Pembelian</h5>
        <button type="button" class="close"  data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" >
      <form method="POST" action="home?p=report-pembelian">
        <div class="row">
            <div class="form-group col-sm-6">
              <label for="exampleFormControlInput1">Tanggal Mulai</label>
              <input type="date" class="form-control" name="awal" required="">
            </div>
            <div class="form-group col-sm-6">
              <label for="exampleFormControlInput1">Tanggal Akhir</label>
              <input type="date" class="form-control" name="akhir" required="">
            </div>
        </div>
        <!-- <div class="form-group">
          <label for="exampleFormControlInput1">Kasir</label>
          <select class="form-control" style="font-size: 12px" name="kasir">
            <option>Semua</option> -->
            <?php 
                //  $res = $connect->query('SELECT * FROM user'); 
                //  while ($data = $res->fetch_object()) {   
                //     echo"<option value='$data->nama'>$data->nama</option>";
                // } 
            ?> 
           <!--  </select>
        </div> -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary btn-sm" name="pembelian">Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="modalPenjualan" >
  <div class="modal-role-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Laporan Penjualan</h5>
      </div>
        <div class="modal-body">
            kokk
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary btn-sm" name="penjualan">Submit</button>
      </div> 
    </div>
  </div>
</div>