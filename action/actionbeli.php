<?php
    include '../config.php';
    session_start();

//data barang ---------------------------------------------------------------------------------------------------------------------------------------
    if ($_GET['act']=='edit-cart-pembelian'){
    	$id = $_POST['id'];
        $suplier = $_POST['suplier'];
        $query=$connect->query("SELECT * FROM detail_beli WHERE id='$id'");
            while($data=$query->fetch_object())
            {
                $kode_barang = $data->kode_barang;
                $harga = $data->harga;
                $diskon = $data->diskon;
                $qty = $data->qty;
                $subtotal = $data->subtotal;
                $pot = $data->pot;

                $query1=$connect->query("SELECT * FROM barang WHERE kode='$kode_barang'");
                while($data1=$query1->fetch_object())
                {
                    $barcode = $data1->barcode;
                    $nama = $data1->nama;
                    $satuan = $data1->satuan;
                    $jual = $data1->jual;
                    $beli = $data1->beli;

                    $que=$connect->query("SELECT subtotal, count(kode_barang) AS total, SUM(qty) AS upqty FROM temp_edit_beli WHERE kode_barang='$kode_barang'");
	                while($data1=$que->fetch_object())
	                {
	                    $total  = $data1->total;
	                    $upqty  = $data1->upqty;
	                    $h_awal = $data1->subtotal;

	                    $tot_qty    = $qty+$upqty;
	                    $qtyup      = $upqty+$qty;
	                    $sub        = $beli*$qtyup;
	                    @$harga_dis = (($sub*$disc)/100);
	                    $bayar      = $sub-$harga_dis;
	                }

                    if ($total==0 ) {
                    $sql = $connect->query("INSERT INTO temp_edit_beli
                        (id,kode_barang,barcode,nama,satuan,beli,jual,diskon,qty,subtotal,pot)
                        VALUES 
                        ('$id','$kode_barang','$barcode','$nama','$satuan','$harga','$jual','$diskon','$qty','$subtotal','$pot')");
	                }else{
	                	$sql = $connect->query("UPDATE temp_edit_beli SET kode_barang='$kode_barang',barcode='$barcode', nama='$nama', satuan='$satuan', beli='$beli', jual='$jual', diskon='$diskon', qty='$qty', subtotal='$subtotal', pot='$pot' WHERE kode_barang='$kode_barang' ");
	                }
                }
            }
        
        echo "<script>document.location.href='../home?p=form-edit-pembelian&id=$id';</script>";

    }elseif ($_GET['act']=='edit-hbeli-cart-beli') {

        $id   = $_POST['id'];
        $kode   = $_POST['kode'];
        $hbeli    = str_replace(".", "", $_POST['hbeli']);
        $qty   = $_POST['qty'];
        $subtotal = $hbeli*$qty;

        $edithbeli = $connect->query("UPDATE temp_edit_beli SET beli='$hbeli', subtotal='$subtotal' WHERE kode_barang='$kode' ");

        if ($edithbeli) {
            echo "<script>document.location.href='../home?p=form-edit-pembelian&id=$id';</script>";
        }else
            echo "Gagal";

    }elseif ($_GET['act']=='edit-hjual-cart-beli') {

        $kode   = $_POST['kode'];
        $id   = $_POST['id'];
        $hjual    = str_replace(".", "", $_POST['hjual']);

        $edithjual = $connect->query("UPDATE temp_edit_beli SET jual='$hjual' WHERE kode_barang='$kode' ");

        if ($edithjual) {
            echo "<script>document.location.href='../home?p=form-edit-pembelian&id=$id';</script>";
        }else
            echo "Gagal";

    }elseif ($_GET['act']=='edit-qty-cart-beli') {

        $kode   = $_POST['kode'];
        $id   = $_POST['id'];
        $qtyupdate = $_POST['qty'];
        $sub    = $_POST['harga']*$qtyupdate;

        $query_editqty = $connect->query("UPDATE temp_edit_beli SET qty='$qtyupdate', subtotal='$sub' WHERE kode_barang='$kode' ");

        if ($query_editqty) {
            echo "<script>document.location.href='../home?p=form-edit-pembelian&id=$id';</script>";
        }else
            echo "Gagal";

    }elseif ($_GET['act']=='del-cart-pembelian') {

        $kode = $_GET['data'];
        $id = $_GET['id'];

        $sql  = $connect->query("DELETE FROM temp_edit_beli WHERE kode_barang = '$kode'");

        if ($sql) {
            echo "<script>document.location.href='../home?p=form-edit-pembelian&id=$id';</script>";
        }else
            echo "Gagal";

    }elseif($_GET['act']=='add-cart-pembelian'){

        date_default_timezone_set("Asia/Jakarta");
            $use = $_SESSION['username'];
            if (isset($_POST['pilih'])) {
                $kodebarang = $_POST['kode_barang'];
                $f1o=$connect->query("SELECT * FROM barang WHERE kode='$kodebarang' ");
            }else{
                $barcode = $_POST['barcode'];
                $f1o=$connect->query("SELECT * FROM barang WHERE nama='$barcode' OR barcode='$barcode'");
            }
            $qty = 1;
            $disc = 0;
            $pot = 0;
            $id = $_POST['id'];
            $tanggal    = date("y-m-d");
            
            while($data = $f1o->fetch_object())
            {
                $kode12  = $data->kode;
                $barcode = $data->barcode;
                $nama    = $data->nama;
                $satuan  = $data->satuan;
                $hbeli   = $data->beli;
                $hjual   = $data->jual;
                $stok    = $data->stok;
          

                $que=$connect->query("SELECT subtotal, count(kode_barang) AS total, SUM(qty) AS upqty FROM temp_edit_beli WHERE kode_barang='$kode12'");
                while($data1=$que->fetch_object())
                {
                    $total  = $data1->total;
                    $upqty  = $data1->upqty;
                    $h_awal = $data1->subtotal;

                    $tot_qty    = $qty+$upqty;
                    $qtyup      = $upqty+$qty;
                    $sub        = $hbeli*$qtyup;
                    @$harga_dis = (($sub*$disc)/100);
                    $bayar      = $sub-$harga_dis;
                }

                if ($total==0 ) {
                    $sql = $connect->query("INSERT INTO temp_edit_beli
                        (id,kode_barang,barcode,nama,satuan,beli,jual,diskon,qty,subtotal,pot)
                        VALUES 
                        ('$id','$kode12','$barcode','$nama','$satuan','$hbeli','$hjual','$disc','$qty','$sub','$pot')");
                }else {
                    $update = $qty+$upqty;
                    $query4 = $connect->query("UPDATE temp_edit_beli SET qty='$update', subtotal='$bayar', diskon='$disc' WHERE kode_barang='$kode12' ");
                }
            }
            echo "<script>document.location.href='../home?p=form-edit-pembelian&id=$id';</script>";

    }elseif ($_GET['act']=='simpan-pembelian') {
	    date_default_timezone_set("Asia/Jakarta");

	    $kode_trans = $_POST['kode_trans'];
	  //   $stokbeli = $connect->query("SELECT * FROM detail_beli WHERE id='$kode_trans'");
		 //    while ($beli = $stokbeli->fetch_object()) {
			//     $qtybeli = $beli->qty;
			//     $kodebeli = $beli->kode_barang;

	  //   	$querystok = $connect->query("SELECT * FROM barang WHERE kode='$kodebeli'");
		 //    	while ($stokbrg = $querystok->fetch_object()) {
			// 	    $qtybrg = $stokbrg->stok;
			// 	    $stok = $qtybrg - $qtybeli;
			// 	    $queryupstok = $connect->query("UPDATE barang SET stok='$stok' WHERE kode='$kodebeli'");
			// 	}
			// }
		
			$kode_trans = $_POST['kode_trans'];
			$res        = $connect->query("SELECT SUM(subtotal) AS total, sum(pot) AS pot FROM temp_edit_beli");
	    	$ex         = $res->fetch_object();
	        $pot        = $ex->pot;

	        $kode_trans = $_POST['kode_trans'];
	        $tanggal    = date("y-m-d");
	        $jatuh_tempo= $_POST['jatuh_tempo'];
	        $status     = $_POST['status'];
	        $total1     = $_POST['input_total'];
	        $total      = str_replace(".", "", $total1);
	        $bayar      = $_POST['input_bayar'];
	        $bayar_t    = str_replace(".", "", $bayar);
	        $kem        = $_POST['input_kembali'];
	        $kembali    = $bayar_t-$total;
	        $kasir      = $_POST['created'];
	        $suplier    = $_POST['suplier'];
	        if ($status == 'Lunas') {
	            $hutang = 0;
	            $kembalian = $kembali;
	        }elseif ($status == 'Belum Lunas') {
	            $hutang = $kembali;
	            $kembalian = 0;
	        }

    	$result = $connect->query("SELECT * FROM temp_edit_beli");
	        while ($data = $result->fetch_object()) {
		        $kode       = $data->kode_barang;
		        $harga      = $data->beli;
		        $jual       = $data->jual;
		        $diskon     = $data->diskon;
		        $qty        = $data->qty;
		        $subtotal   = $data->subtotal;
		        $pot        = $data->pot;

        		$sql4 = $connect->query("SELECT * FROM detail_beli WHERE kode_barang = '$kode' AND id='$kode_trans'");
	        		while ($data1 = $sql4->fetch_object()) {
	        			$kdbrg= $data1->kode_barang;
	            		$qtybli = $data1->qty;
                        $idbeli = $data1->id;
                       //  var_dump($kode);
                       // var_dump($kdbrg);
	        		}
 
                    if ($kode == $kdbrg) {
                        $simpan = $connect->query("UPDATE detail_beli SET harga='$harga', diskon='$diskon', qty='$qty', subtotal='$subtotal', pot='$pot' WHERE kode_barang='$kode' AND id='$kode_trans'  ");
                    }elseif ($kode != $kdbrg) {
                        $simpan = $connect->query("INSERT INTO detail_beli
                        (id,kode_barang,harga,diskon,qty,subtotal,pot)
                        VALUES 
                        ('$kode_trans','$kode','$harga','$diskon','$qty','$subtotal','$pot')");
                    }

                    // $sqlup=$connect->query("SELECT * FROM barang WHERE kode = '$kdbrg' ");
                    //     while ($data = $sqlup->fetch_object()) {
                    //      $stokbrg = $data->stok;
                    //      $adstok = $stokbrg + $qtybli;

                    //      $connect->query("UPDATE barang SET beli='$harga', jual='$jual', stok = '$adstok' WHERE kode = '$kdbrg'");
                    //     }  
        	}


                     

		$query = $connect->query("UPDATE pembelian SET nota='$kode_trans', tgl='$tanggal', jatuh_tempo='$jatuh_tempo', status='$status', total_hbeli='$total', bayar='$bayar_t', kembalian='$kembalian', kasir='$kasir', suplier='$suplier',hutang='$hutang' WHERE id='$kode_trans'");

        $connect->query("DELETE FROM temp_edit_beli");

        if (isset($_POST['simpan'])) {
            echo "<meta http-equiv='refresh' content='0; url=../home?p=pembelian&&status=sukses'>";
        }elseif (isset($_POST['simpan_cetak'])) {
            echo "<meta http-equiv='refresh' content='0; url=../pages/view/struk?kode=$kode_trans'>";
        }
    }
 ?>