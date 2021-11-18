<?php
// Load file connect.php
include_once("../../config.php");
// Load file autoload.php
require '../../asset/lib/PHPOffice/vendor/autoload.php';

// Include librari PhpSpreadsheet
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

if(isset($_POST['import_barang'])){
	$nama_file_baru = 'data-barang.xlsx';

	$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
              $spreadsheet = $reader->load('../../asset/lib/tmp/' . $nama_file_baru);
              $sheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

	$numrow = 1;
	foreach($sheet as $row){
		// Ambil data pada excel sesuai Kolom
		
		$barcode 	 = $row['A'];
		$nama_barang = $row['B'];
		$suplier 	 = $row['C'];
		$kategori 	 = $row['D'];
		$satuan 	 = $row['E'];
		$harga_beli  = $row['F'];
		$harga_jual  = $row['G'];
		$stok  		 = $row['H'];

		// Cek jika semua data tidak diisi
		if($barcode == "" && $nama_barang == "" && $suplier == "" && $kategori == "" && $satuan == "" && $harga_beli == "" && $harga_jual == "" && $stok == "")
		continue;

		if($numrow > 1){
			$result = $connect->query("INSERT INTO barang (barcode,nama,suplierid,kategori,satuan,beli,jual,expired,stok, status,edit,kasir)
            VALUES 
            ('$barcode','$nama_barang','$suplier','$kategori','$satuan','$harga_beli','$harga_jual','','$stok','aktif','buka','admin')");
		}

		$numrow++;
	}
}

header('Location:../../home?p=barang&status=sukses');
?>
