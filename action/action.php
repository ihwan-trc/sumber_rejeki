<?php
    include '../config.php';
    session_start();

//    $user = $_SESSION['username'];

//data barang ---------------------------------------------------------------------------------------------------------------------------------------
    if ($_GET['act']=='add-barang'){

        $kode = $_POST['kode'];
        $barcode = $_POST['barcode'];
        $nama    = $_POST['nama'];
        $suplier = $_POST['suplier'];
        $kat     = $_POST['kategori'];
        $sat     = $_POST['satuan'];
        $beli    = $_POST['hbeli'];
        $jual    = $_POST['hjual'];
        $expire  = $_POST['expire'];
        $stok    = $_POST['stok'];

        $harga_beli    = str_replace(".", "", $beli);
        $harga_jual    = str_replace(".", "", $jual);
        $stok1         = str_replace(".", "", $stok);

        $sql = $connect->query("INSERT INTO barang (kode, barcode, nama, suplierid, kategori, satuan, beli, jual , expired, stok, status, edit)
            VALUES ('$kode','$barcode','$nama','$suplier','$kat','$sat','$harga_beli','$harga_jual','$expire','$stok1','aktif','buka')");
        if ($sql) {
            header("location:../home?p=barang&&status=sukses");
        }else
            header("location:../home?p=barang&&status=gagal");


//END data barang ---------------------------------------------------------------------------------------------------------------------------------------

    }elseif($_GET['act']=='up-barang'){
        $kode    = $_POST['kode'];
        $barcode    = $_POST['barcode'];
        $nama    = $_POST['nama'];
        $suplier = $_POST['suplier'];
        $kat     = $_POST['kategori'];
        $sat     = $_POST['satuan'];
        $beli    = $_POST['hbeli'];
        $jual    = $_POST['hjual'];
        $expire  = $_POST['expired'];
        $stok    = $_POST['stok'];
        $status  = 'aktif';
        $edit    = 'buka';

        $harga_beli    = str_replace(".", "", $beli);
        $harga_jual    = str_replace(".", "", $jual);
        $stok1         = str_replace(".", "", $stok);

        $level = $_SESSION['level'];

        if ($level == 'Admin') {
            $sql = $connect->query("
                UPDATE barang
                SET barcode        = '$barcode',
                    nama        = '$nama',
                    suplierid   = '$suplier',
                    kategori    = '$kat',
                    satuan      = '$sat',
                    beli        = '$harga_beli',
                    jual        = '$harga_jual',
                    expired     = '$expire',
                    stok        = '$stok',
                    status      = '$status',
                    edit        = '$edit'
                WHERE kode      = '$kode';
            ");
        }else{
            $sql = $connect->query("
                UPDATE barang
                SET barcode     = '$barcode',
                    nama        = '$nama',
                    suplierid   = '$suplier',
                    kategori    = '$kat',
                    satuan      = '$sat',
                    beli        = '$harga_beli',
                    jual        = '$harga_jual',
                    expired     = '$expire',
                    stok        = '$stok'
                WHERE kode      = '$kode';
            ");

        }


        if ($sql) {
            header("location:../home?p=barang&&status=sukses");
        }else
            header("location:../home?p=barang&&status=gagal");



    }elseif($_GET['act']=='del-barang'){

        $kode = $_GET['kode'];
        $query1=$connect->query("SELECT * FROM detail WHERE kode_barang='$kode'");
        $num1 = mysqli_num_rows($query1);
        $query2=$connect->query("SELECT * FROM detail_beli WHERE kode_barang='$kode'");
        $num2 = mysqli_num_rows($query2);

        if ($num1 != NULL || $num2 != NULL) {
            echo "<script type='text/javascript'>alert('Data sudah digunakan dalam transaksi tidak bisa dihapus')</script>";
            echo "<script>document.location.href='../home?p=barang';</script>";
        }else{
             $sql = $connect->query("DELETE FROM barang WHERE kode = '$kode'");
            header("location:../home?p=barang&&status=sukses");
        }

    }elseif($_GET['act']=='add-sup'){

    	$ko = $_POST['kode'];
    	$na = $_POST['nama'];
    	$lok = $_POST['lokasi'];
    	$tel = $_POST['telp'];
    	$em = $_POST['email'];
    	$al = $_POST['alamat'];

		$connect->query("INSERT INTO suplier (kode,nama,kota,telp,email,alamat) VALUES ('$ko','$na','$lok','$tel','$em','$al');");
    	if ($connect) {
            header("location:../home?p=suplier&&status=sukses");
    	}else
            header("location:../home?p=suplier&&status=gagal");



    }elseif ($_GET['act']=='up-sup') {
        $kode = $_POST['kode'];
        $na = $_POST['nama'];
        $lok = $_POST['lokasi'];
        $tel = $_POST['telp'];
        $em = $_POST['email'];
        $al = $_POST['alamat'];

        $sql = $connect->query("UPDATE suplier SET nama = '$na', kota = '$lok', telp = '$tel', email = '$em', alamat = '$al' WHERE kode = '$kode'");
        if ($sql) {
            header("location:../home?p=suplier&&status=sukses");
        }else{
            header("location:../home?p=suplier&&status=gagal");
        }

    }elseif ($_GET['act']=='del-sup') {

        $kode = $_GET['kode'];
        $query1=$connect->query("SELECT * FROM suplier WHERE kode='$kode'");
        while($data = $query1->fetch_object()){
            $nama = $data->nama;
            $query2=$connect->query("SELECT * FROM pembelian WHERE suplier='$nama'");
            $num = mysqli_num_rows($query2);
            if ($num != NULL) {
            echo "<script type='text/javascript'>alert('Data sudah digunakan dalam transaksi tidak bisa dihapus')</script>";
            echo "<script>document.location.href='../home?p=suplier';</script>";
            }else{
                $sql = $connect->query("DELETE FROM suplier WHERE kode = '$kode'");
                header("location:../home?p=suplier&&status=sukses");
            }
        }

    }elseif($_GET['act']=='add-kategori'){

        $na = $_POST['nama'];

        $query = $connect->query("INSERT INTO kategori VALUES ('','$na');");
        if ($query) {
            header("location:../home?p=kategori&&status=sukses");
        }else{
            header("location:../home?p=kategori&&status=gagal");
        }

    }elseif ($_GET['act']=='del-kategori') {

        $kode = $_GET['kode'];

        $sql = $connect->query("DELETE FROM kategori WHERE kode = '$kode'");
        if ($sql) {
            header("location:../home?p=kategori&&status=sukses");
        }else{
            header("location:../home?p=kategori&&status=gagal");
        }

    }elseif ($_GET['act']=='up-kategori') {

        $kode = $_POST['kode'];
        $nama = $_POST['nama'];

        $sql = $connect->query("UPDATE kategori SET nama = '$nama' WHERE kode = '$kode'");
        if ($sql) {
            header("location:../home?p=kategori&&status=sukses");
        }else{
            header("location:../home?p=kategori&&status=gagal");

        }

    }elseif($_GET['act']=='add-satuan'){

        $na = $_POST['nama'];

        $query = $connect->query("INSERT INTO satuan VALUES ('','$na');");
        if ($query) {
            header("location:../home?p=satuan&&status=sukses");
        }else{
            header("location:../home?p=satuan&&status=gagal");
        }
    }elseif ($_GET['act']=='del-satuan') {

        $kode = $_GET['kode'];

        $sql = $connect->query("DELETE FROM satuan WHERE kode = '$kode'");
        if ($sql) {
            header("location:../home?p=satuan&&status=sukses");
        }else{
            header("location:../home?p=satuan&&status=gagal");

        }

    }elseif ($_GET['act']=='up-satuan') {

        $kode = $_POST['kode'];
        $nama = $_POST['nama'];

        $sql = $connect->query("UPDATE satuan SET nama = '$nama' WHERE kode = '$kode'");
        if ($sql) {
            header("location:../home?p=satuan&&status=sukses");
        }else{
            header("location:../home?p=satuan&&status=gagal");
        }

    }elseif($_GET['act']=='add-cart-penjualan'){

        date_default_timezone_set("Asia/Jakarta");
            $use = $_SESSION['username'];
            if (isset($_POST['pilih'])) {
                $kodebarang = $_POST['kode_barang'];
                $f1o=$connect->query("SELECT * FROM barang WHERE kode='$kodebarang'");
            }else{
                $barcode = $_POST['barcode'];
                $f1o=$connect->query("SELECT * FROM barang WHERE nama like '%".$barcode."%' OR barcode like '%".$barcode."%'");
            }
            $qty = 1;
            $disc = 0;
            
            $tanggal    = date("y-m-d");
            
            while($data = $f1o->fetch_object())
            {
                $kode12  = $data->kode;
                $nama    = $data->nama;
                $hjual   = $data->jual;
                $stok    = $data->stok;
                $barcode = $data->barcode;
                $satuan  = $data->satuan;
          

                $que=$connect->query("SELECT subtotal, count(kode_barang) AS total, SUM(qty) AS upqty FROM temp WHERE kode_barang='$kode12'");
                while($data1=$que->fetch_object())
                {
                    $total  = $data1->total;
                    $upqty  = $data1->upqty;
                    $h_awal = $data1->subtotal;

                    $tot_qty    = $qty+$upqty;
                    $qtyup      = $upqty+$qty;
                    $sub        = $hjual*$qtyup;
                    @$harga_dis = (($sub*$disc)/100);
                    $bayar      = $sub-$harga_dis;
                }

            // if ($qty<=$stok) {
                if ($total==0 ) {
                    $sql = $connect->query("INSERT INTO temp(`kode_barang`,`harga`,`diskon`,`qty`,`subtotal`,nama,barcode,satuan, pot)

                    VALUES ('$kode12','$hjual','$disc','$qty','$bayar', '$nama' ,'$barcode' ,'$satuan' ,'$harga_dis');");
                }else {
                    $update = $qty+$upqty;
                    $query4 = $connect->query("UPDATE temp SET qty='$update', subtotal='$bayar', diskon='$disc' WHERE kode_barang='$kode12' ");
                }
            // }else{
            //     echo "<script type='text/javascript'>alert('Stok Tidak Cukup')</script>";
            // }

            }
            echo "<script>document.location.href='../home?p=form-penjualan';</script>";

    }elseif ($_GET['act']=='edit-qty-cart') {

        $kode   = $_POST['kode'];
        $qtyupdate = $_POST['qty'];
        $sub    = $_POST['harga']*$qtyupdate;

        $query_editqty = $connect->query("UPDATE temp SET qty='$qtyupdate', subtotal='$sub' WHERE kode_barang='$kode' ");

        if ($query_editqty) {
            echo "<script>document.location.href='../home?p=form-penjualan';</script>";
        }else
            echo "Gagal";

    }elseif ($_GET['act']=='edit-disc-cart') {

        $kode   = $_POST['kode'];
        $discupdate = str_replace('%', '', $_POST['disc']);
        $sub    = $_POST['harga'];
        @$harga_dis = (($sub*$discupdate)/100);

        $query_editdisc = $connect->query("UPDATE temp SET diskon='$discupdate', subtotal='$harga_dis' WHERE kode_barang='$kode' ");

        if ($query_editdisc) {
            echo "<script>document.location.href='../home?p=form-penjualan';</script>";
        }else
            echo "Gagal";
            
    }elseif ($_GET['act']=='del-cart-penjualan') {

        $kode = $_GET['data'];

        $sql  = $connect->query("DELETE FROM temp WHERE kode_barang = '$kode'");

        if ($sql) {
            echo "<script>document.location.href='../home?p=form-penjualan';</script>";
        }else
            echo "Gagal";

    }elseif ($_GET['act']=='simpan-penjualan') {

    date_default_timezone_set("Asia/Jakarta");
    $user   = $_SESSION['username'];
    $res    = $connect->query("SELECT SUM(subtotal) AS total, sum(pot) AS pot FROM temp");
    $ex     = $res->fetch_object();

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
        $customer_post   = $_POST['customer'];
        if ($customer_post == "" ) {
            $customer = "Umum";
        }else{
            $customer = $customer_post;
        }
        if ($status == 'Lunas') {
            $hutang = 0;
            $kembalian = $kembali;
        }elseif ($status == 'Belum Lunas') {
            $hutang = $kembali;
            $kembalian = 0;
        }

    $query = $connect->query("INSERT INTO penjualan (id, customer, tgl, jatuh_tempo, status, total_harga, total_bayar, kembali, kasir, hutang)
         VALUES ('$kode_trans','$customer','$tanggal','$jatuh_tempo','$status','$total','$bayar_t','$kembalian','$kasir','$hutang')");

      $result = $connect->query("SELECT * FROM temp");

        while ($data = $result->fetch_object()) {

        $kode       = $data->kode_barang;
        $harga      = $data->harga;
        $diskon     = $data->diskon;
        $qty        = $data->qty;
        $subtotal   = $data->subtotal;
        $pot        = $data->pot;

        $simpan = $connect->query("INSERT INTO detail (id,kode_barang, harga, diskon, qty, subtotal, pot)
            VALUES ('$kode_trans','$kode','$harga','$diskon','$qty','$subtotal','$pot')");

        $sql4 = $connect->query("SELECT * FROM barang WHERE kode = '$kode'");
        while ($data1 = $sql4->fetch_object()) {
            $stok = $data1->stok;
            $ad = $stok - $qty;

            $connect->query("UPDATE barang SET stok = '$ad' WHERE kode = '$kode'");

            }

        }

         $connect->query("DELETE FROM temp");

         if (isset($_POST['simpan'])) {
            echo "<meta http-equiv='refresh' content='0; url=../home?p=form-penjualan&&status=sukses'>";
         }elseif (isset($_POST['simpan_cetak'])) {
            echo "<meta http-equiv='refresh' content='0; url=../pages/view/struk?kode=$kode_trans'>";
         }

    }elseif ($_GET['act']=='delete-penjualan') {
        $kode_trans = $_POST['id'];
        $query = $connect->query("SELECT * FROM detail WHERE id='$kode_trans'");
        while ($data1 = $query->fetch_object()) {
            $kode = $data1->kode_barang;
            $stokbeli = $data1->qty;

            $query2 = $connect->query("SELECT * FROM barang WHERE kode='$kode'");
            while ($data = $query2->fetch_object()) {
                $kode2 = $data->kode;
                $stok = $data->stok;
                $stokup = $stok + $stokbeli;

                $update = $connect->query("UPDATE barang SET stok = '$stokup' WHERE kode = '$kode2'");
            }
        }

        $sql = $connect->query("DELETE FROM penjualan WHERE id = '$kode_trans'");
        $sql2 = $connect->query("DELETE FROM detail WHERE id = '$kode_trans'");
        echo "<meta http-equiv='refresh' content='0; url=../home?p=penjualan&&status=sukses'>";

  // ====================================pembelian=========================

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
          

                $que=$connect->query("SELECT subtotal, count(kode_barang) AS total, SUM(qty) AS upqty FROM temp_beli WHERE kode_barang='$kode12'");
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
                    $sql = $connect->query("INSERT INTO temp_beli(`kode_barang`,`beli`,`jual`,`diskon`,`qty`,`subtotal`,nama,barcode,satuan, pot)

                    VALUES ('$kode12','$hbeli','$hjual','$disc','$qty','$bayar', '$nama' ,'$barcode' ,'$satuan' ,'$harga_dis');");
                }else {
                    $update = $qty+$upqty;
                    $query4 = $connect->query("UPDATE temp_beli SET qty='$update', subtotal='$bayar', diskon='$disc' WHERE kode_barang='$kode12' ");
                }
            }
            echo "<script>document.location.href='../home?p=form-pembelian';</script>";

    }elseif ($_GET['act']=='edit-hbeli-cart-beli') {

        $kode   = $_POST['kode'];
        $hbeli    = str_replace(".", "", $_POST['hbeli']);
        $qty   = $_POST['qty'];
        $subtotal = $hbeli*$qty;

        $edithbeli = $connect->query("UPDATE temp_beli SET beli='$hbeli', subtotal='$subtotal' WHERE kode_barang='$kode' ");

        if ($edithbeli) {
            echo "<script>document.location.href='../home?p=form-pembelian';</script>";
        }else
            echo "Gagal";

    }elseif ($_GET['act']=='edit-hjual-cart-beli') {

        $kode   = $_POST['kode'];
        $hjual    = str_replace(".", "", $_POST['hjual']);

        $edithjual = $connect->query("UPDATE temp_beli SET jual='$hjual' WHERE kode_barang='$kode' ");

        if ($edithjual) {
            echo "<script>document.location.href='../home?p=form-pembelian';</script>";
        }else
            echo "Gagal";

    }elseif ($_GET['act']=='edit-qty-cart-beli') {

        $kode   = $_POST['kode'];
        $qtyupdate = $_POST['qty'];
        $sub    = $_POST['harga']*$qtyupdate;

        $query_editqty = $connect->query("UPDATE temp_beli SET qty='$qtyupdate', subtotal='$sub' WHERE kode_barang='$kode' ");

        if ($query_editqty) {
            echo "<script>document.location.href='../home?p=form-pembelian';</script>";
        }else
            echo "Gagal";

    }elseif ($_GET['act']=='del-cart-pembelian') {

        $kode = $_GET['data'];

        $sql  = $connect->query("DELETE FROM temp_beli WHERE kode_barang = '$kode'");

        if ($sql) {
            echo "<script>document.location.href='../home?p=form-pembelian';</script>";
        }else
            echo "Gagal";

    }elseif ($_GET['act']=='simpan-pembelian') {

    date_default_timezone_set("Asia/Jakarta");
    $user   = $_SESSION['username'];
    $res    = $connect->query("SELECT SUM(subtotal) AS total, sum(pot) AS pot FROM temp_beli");
    $ex     = $res->fetch_object();

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

    $query = $connect->query("INSERT INTO pembelian (id, nota, tgl, jatuh_tempo, status, total_hbeli, bayar, kembalian, kasir, suplier,hutang)
         VALUES ('$kode_trans','$kode_trans','$tanggal','$jatuh_tempo','$status','$total','$bayar_t','$kembalian','$kasir','$suplier','$hutang')");

      $result = $connect->query("SELECT * FROM temp_beli");

        while ($data = $result->fetch_object()) {

        $kode       = $data->kode_barang;
        $harga      = $data->beli;
        $jual       = $data->jual;
        $diskon     = $data->diskon;
        $qty        = $data->qty;
        $subtotal   = $data->subtotal;
        $pot        = $data->pot;

        $simpan = $connect->query("INSERT INTO detail_beli (id,kode_barang, harga, diskon, qty, subtotal, pot)
            VALUES ('$kode_trans','$kode','$harga','$diskon','$qty','$subtotal','$pot')");

        $sql4 = $connect->query("SELECT * FROM barang WHERE kode = '$kode'");
        while ($data1 = $sql4->fetch_object()) {
            $stok = $data1->stok;
            $ad = $stok + $qty;

            $connect->query("UPDATE barang SET beli='$harga', jual='$jual', stok = '$ad' WHERE kode = '$kode'");

            }

        }

         $connect->query("DELETE FROM temp_beli");

         if (isset($_POST['simpan'])) {
            echo "<meta http-equiv='refresh' content='0; url=../home?p=form-pembelian&&status=sukses'>";
         }elseif (isset($_POST['simpan_cetak'])) {
            echo "<meta http-equiv='refresh' content='0; url=../pages/view/struk?kode=$kode_trans'>";
         }
    }elseif ($_GET['act']=='delete-pembelian') {
        $kode_trans = $_POST['id'];
        $query = $connect->query("SELECT * FROM detail_beli WHERE id='$kode_trans'");
        while ($data1 = $query->fetch_object()) {
            $kode = $data1->kode_barang;
            $stokbeli = $data1->qty;

            $query2 = $connect->query("SELECT * FROM barang WHERE kode='$kode'");
            while ($data = $query2->fetch_object()) {
                $kode2 = $data->kode;
                $stok = $data->stok;
                $stokup = $stok - $stokbeli;

                $update = $connect->query("UPDATE barang SET stok = '$stokup' WHERE kode = '$kode2'");
            }
        }

        $sql = $connect->query("DELETE FROM pembelian WHERE id = '$kode_trans'");
        $sql2 = $connect->query("DELETE FROM detail_beli WHERE id = '$kode_trans'");
        echo "<meta http-equiv='refresh' content='0; url=../home?p=pembelian&&status=sukses'>";

  // ====================================opname=========================

    }elseif ($_GET['act']=='stok-opname') {
        date_default_timezone_set("Asia/Jakarta");
        $date = date('Y-m-d H:i:s');
            $val  = $_POST['kode_barang'];
            $kode = intval($val);

            $stok       = $_POST['bil1'];
            $nyata      = $_POST['bil2'];
            $selisih    = $_POST['total'];
            $ket        = $_POST['ket'];

        $sql = $connect->query("INSERT INTO opnma(`kode_barang`,`stok`,`nyata`,`selisih`,`keterangan`,`waktu`)
            VALUES ('$kode','$stok','$nyata','$selisih','$ket','$date');");

        $update = $connect->query("UPDATE barang SET stok = '$nyata' WHERE kode = '$kode'");

        header('Location: ' . $_SERVER['HTTP_REFERER']);

    }elseif ($_GET['act']=='up-pengaturan') {
        $nama     = $_POST['nama'];
        $telp     = $_POST['telp'];
        $alamat   = $_POST['alamat'];
        $info     = $_POST['info'];
        $so       = $_POST['so'];
        $edit     = $_POST['edit'];

        echo $nama ."<br>";
        echo $telp ."<br>";
        echo $alamat ."<br>";
        echo $info ."<br>";
        echo $so ."<br>";
        echo $edit ."<br>";
        if (empty($edit)) {

        } else {
            $connect->query("UPDATE barang SET edit = '$edit' ");
        }



        $sql = $connect->query("UPDATE data_apotek SET
            nama    = '$nama',
            alamat  = '$alamat',
            telp    = '$telp',
            so      = '$so',
            info    = '$info'

        ");

        if ($sql) {
            header("location:../home?p=pengaturan&&status=sukses");
        }else{
            header("location:../home?p=pengaturan&&status=gagal");
        }


    }elseif ($_GET['act']=='add-user') {
        $username = $_POST['user'];
        $nama     = $_POST['nama'];
        $level    = $_POST['level'];
        $alamat   = $_POST['alamat'];
        $pass     = $_POST['pass'];

        $sql = $connect->query("INSERT INTO user (username, nama, password, akses, alamat)
                VALUES ('$username','$nama', '$pass','$level','$alamat')");
        if ($sql) {
            header("location:../home?p=user&&status=sukses");
        }else{
            header("location:../home?p=user&&status=gagal");
        }

    }elseif ($_GET['act']=='del-user') {
        $username = $_GET['kode'];

        $sql = $connect->query("DELETE FROM user WHERE username = '$username'");
        if ($sql) {
            header("location:../home?p=user&&status=sukses");
        }else{
            header("location:../home?p=user&&status=gagal");
        }

    }elseif ($_GET['act']=='edit-user') {
        $username = $_POST['user'];
        $nama     = $_POST['nama'];
        $level    = $_POST['level'];
        $alamat   = $_POST['alamat'];
        $pass     = $_POST['pass'];

        $sql = $connect->query("UPDATE user SET nama='$nama', akses='$level', alamat='$alamat', password='$pass' WHERE username = '$username' ");
        if ($sql) {
            header("location:../home?p=user&&status=sukses");
        }else{
            header("location:../home?p=user&&status=gagal");
        }
    }

?>
