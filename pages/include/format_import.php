<?php
include "../../config.php";
// Load file autoload.php
require '../../asset/lib/PHPOffice/vendor/autoload.php';
// Include librari PhpSpreadsheet
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();

// Settingan awal fil excel
$spreadsheet->getProperties()->setCreator('TB SUMBER REJEKI')
					   ->setLastModifiedBy('TB SUMBER REJEKI')
					   ->setTitle("FORMAT IMPORT Barang")
					   ->setSubject("data-barang")
					   ->setDescription("Format Import Data Barang")
					   ->setKeywords("Barang");

// Buat sebuah variabel untuk menampung pengaturan style dari header tabel
$style_col = [
    'font' => ['bold' => true],
    'alignment' => [
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
    ],
    'borders' => [
        'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
        'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
        'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
        'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]
    ]
];

// Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
$style_row = [
    'alignment' => [
        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
    ],
    'borders' => [
        'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
        'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
        'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
        'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]
    ]
];

// Buat header tabel nya pada baris ke 3
$spreadsheet->setActiveSheetIndex(0)->setCellValue('A1', "Barcode");
$spreadsheet->setActiveSheetIndex(0)->setCellValue('B1', "Nama Barang");
$spreadsheet->setActiveSheetIndex(0)->setCellValue('C1', "Supplier");
$spreadsheet->setActiveSheetIndex(0)->setCellValue('D1', "Kategori");
$spreadsheet->setActiveSheetIndex(0)->setCellValue('E1', "Satuan");
$spreadsheet->setActiveSheetIndex(0)->setCellValue('F1', "Harga Beli");
$spreadsheet->setActiveSheetIndex(0)->setCellValue('G1', "Harga Jual");
$spreadsheet->setActiveSheetIndex(0)->setCellValue('H1', "Stok");
$spreadsheet->setActiveSheetIndex(0)->setCellValue('J2', "Note : Pastikan penulisan Supplier,Kategori dan Satuan sesuai dengan data yang telah anda input didalam sistem");
$spreadsheet->setActiveSheetIndex(0)->setCellValue('J4', "Kategori :");
$spreadsheet->setActiveSheetIndex(0)->setCellValue('K4', "Satuan :");
$spreadsheet->setActiveSheetIndex(0)->setCellValue('L4', "Supplier :");


// Apply style header yang telah kita buat tadi ke masing-masing kolom header
$spreadsheet->getActiveSheet()->getStyle('A1')->applyFromArray($style_col);
$spreadsheet->getActiveSheet()->getStyle('B1')->applyFromArray($style_col);
$spreadsheet->getActiveSheet()->getStyle('C1')->applyFromArray($style_col);
$spreadsheet->getActiveSheet()->getStyle('D1')->applyFromArray($style_col);
$spreadsheet->getActiveSheet()->getStyle('E1')->applyFromArray($style_col);
$spreadsheet->getActiveSheet()->getStyle('F1')->applyFromArray($style_col);
$spreadsheet->getActiveSheet()->getStyle('G1')->applyFromArray($style_col);
$spreadsheet->getActiveSheet()->getStyle('H1')->applyFromArray($style_col);

// Set height baris ke 1, 2 dan 3
$spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(20);
$spreadsheet->getActiveSheet()->getRowDimension('2')->setRowHeight(20);
$spreadsheet->getActiveSheet()->getRowDimension('3')->setRowHeight(20);

// Buat query untuk menampilkan semua data siswa
if (isset($_POST['format'])) {
	$numrow = 2;
    $query = "SELECT * FROM `barang` LIMIT 2 ";
    $result = mysqli_query($connect,$query);
    while ($data = mysqli_fetch_assoc($result)) {
  	$spreadsheet->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $data['barcode']);
  	$spreadsheet->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data['nama']);
  	$spreadsheet->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data['suplierid']);
  	$spreadsheet->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $data['kategori']);
    $spreadsheet->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $data['satuan']);
    $spreadsheet->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $data['beli']);
    $spreadsheet->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $data['jual']);
    $spreadsheet->setActiveSheetIndex(0)->setCellValue('H'.$numrow, $data['stok']);

    // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
      $spreadsheet->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
      $spreadsheet->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
      $spreadsheet->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
      $spreadsheet->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
      $spreadsheet->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
      $spreadsheet->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row);
      $spreadsheet->getActiveSheet()->getStyle('G'.$numrow)->applyFromArray($style_row);
      $spreadsheet->getActiveSheet()->getStyle('H'.$numrow)->applyFromArray($style_row);
	
	$spreadsheet->getActiveSheet()->getStyle('A'.$numrow)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
  	$spreadsheet->getActiveSheet()->getStyle('B' .$numrow)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
	
	$spreadsheet->getActiveSheet()->getRowDimension($numrow)->setRowHeight(20);
	$numrow++;
}

$numrow = 5;
$query = "SELECT * FROM kategori ORDER BY kode ASC";
$result = mysqli_query($connect,$query);
while ($data = mysqli_fetch_assoc($result)) {
  $spreadsheet->setActiveSheetIndex(0)->setCellValue('J'.$numrow, $data['nama']);
  $numrow++;
}

$numrow = 5;
$query = "SELECT * FROM satuan ORDER BY kode ASC";
$result = mysqli_query($connect,$query);
while ($data = mysqli_fetch_assoc($result)) {
  $spreadsheet->setActiveSheetIndex(0)->setCellValue('K'.$numrow, $data['nama']);
  $numrow++;
}

$numrow = 5;
$query = "SELECT * FROM suplier ORDER BY kode ASC";
$result = mysqli_query($connect,$query);
while ($data = mysqli_fetch_assoc($result)) {
  $spreadsheet->setActiveSheetIndex(0)->setCellValue('L'.$numrow, $data['nama']);
  $numrow++;
}


// Set width kolom
$spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(25);
$spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(35);
$spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(35);
$spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(20);
$spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(10);
$spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(10);
$spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(10);
$spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(10);
$spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(25);
$spreadsheet->getActiveSheet()->getColumnDimension('K')->setWidth(10);
$spreadsheet->getActiveSheet()->getColumnDimension('L')->setWidth(35);

// Set orientasi kertas jadi LANDSCAPE
$spreadsheet->getActiveSheet()->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);

// Set judul file excel nya
$spreadsheet->getActiveSheet(0)->setTitle("FORMAT IMPORT BARANG");
$spreadsheet->setActiveSheetIndex(0);

// Proses file excel
// header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
// header('Content-Disposition: attachment; filename="Format Data Pembayaran.xlsx"'); // Set nama file excel nya
// header("Content-type: application/vnd-ms-excel");
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Disposition: attachment; filename=format-import-Barang.xlsx");
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');

}
?>