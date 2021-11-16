<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h5 class="m-0 font-weight-bold text-primary">Laporan Penjualan</h5>
  </div><br>
  <div class="card-body" >
       <?php if (isset($_POST['statistik'])) { 
        $awal = $_POST['awal']; 
        $akhir = $_POST['akhir'];
          echo'
              <h4 class="text-center">Laporan Statistik Penjualan</h4>
              <h5 class="text-center" style="font-size:14px">'. tgl_indo($_POST["awal"]) .' - '. tgl_indo($_POST['akhir']) .' </h5>'; 
        ?>
        <?php 
        $nama    = $connect->query("SELECT nama FROM statis_lap WHERE tgl BETWEEN '$awal' AND '$akhir' "); 
        $jumlah  = $connect->query("SELECT jumlah FROM statis_lap WHERE tgl BETWEEN '$awal' AND '$akhir' "); 
        ?>

        <div class="container">
            <canvas id="myChart" height="120"></canvas>
        </div>


        <table class="table" id="datatable" style="font-size: 12px">
          <thead>
            <tr>
              <th class="text-center">No</th>
              <th>Barcode</th>
              <th>Nama Barang</th>
              <th>Jumlah Transaksi</th>
              <th>Jumlah Terjual</th>
            </tr>
          </thead>
          <tbody>
          <?php 

            $no=1;
            $sql = $connect->query("SELECT * FROM statis_lap WHERE tgl BETWEEN '$awal' AND '$akhir' ORDER BY jumlah DESC");
            while ($dt = $sql->fetch_object()) { 
              echo '     
                <tr>
                  <td align="center">'.$no++.'</td> 
                  <td>'.$dt->barcode.'</td> 
                  <td>'.$dt->nama.'</td> 
                  <td>'.$dt->total_terjual.'</td> 
                  <td>'.$dt->jumlah.'</td> 
                </tr>';
          } ?>
          </tbody>

            

        </table>


      <?php } ?>





      </div>

  </div>
        <script>
            var ctx = document.getElementById("myChart");
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: [<?php while ($b = $nama->fetch_object()) { echo '"' . $b->nama . '",';}?>],
                    datasets: [{
                            label: 'Total Penjualan',
                            data: [<?php while ($p = $jumlah->fetch_object()) { echo '"' . $p->jumlah . '",';}?>],
                            backgroundColor:
                                'rgba(255, 99, 132, 0.2)',
                            borderWidth: 1
                        }]
                },
                options: {
                    scales: {
                        yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                },
                                gridLines: {
                                  color: "rgb(234, 236, 244)",
                                  zeroLineColor: "rgb(234, 236, 244)",
                                  drawBorder: false,
                                  borderDash: [2],
                                  zeroLineBorderDash: [2]
                                }
                              }]
                            },            
                            legend: {
                              display: false
                            }

                         }
             });
        </script>
