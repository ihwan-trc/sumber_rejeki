<?php

include '../../config.php';
//get search term
$searchTerm = $_GET['term'];
//get matched data from skills table
$query = $connect->query("SELECT * FROM barang WHERE status = 'aktif' AND nama LIKE '%$searchTerm%' OR kode LIKE '%$searchTerm%' OR barcode LIKE '%$searchTerm%' ORDER BY nama DESC limit 15");
while ($row = $query->fetch_assoc()) {
    $data[] = $row['kode']." | ".$row['nama'];
}
//return json data
echo json_encode($data);
?>



