DROP VIEW dat_barang

CREATE VIEW dat_barang AS
SELECT `kode`,`barcode`,`nama`,`suplierid`,`kategori`,`satuan`,`beli`,`jual`,`expired`,`stok` 
FROM barang
WHERE STATUS='aktif'



CREATE VIEW data_barang AS
SELECT `kode`,`barcode`,`nama`,`suplierid`,`kategori`,`satuan`,`beli`,`jual`,`expired`,`stok` 
FROM barang

SELECT * FROM data_barang


UPDATE barang SET STATUS='aktif'



CREATE VIEW expire AS
SELECT
  `barang`.`kode`              AS `kode`,
  `barang`.`barcode`           AS `barcode`,
  `barang`.`nama`              AS `nama`,
  `barang`.`suplierid`         AS `suplierid`,
  `barang`.`kategori`          AS `kategori`,
  `barang`.`satuan`            AS `satuan`,
  `barang`.`beli`              AS `beli`,
  `barang`.`jual`              AS `jual`,
  `barang`.`expired`           AS `expired`,
  `barang`.`stok`              AS `stok`,
  `barang`.`status`            AS `STATUS`,
  `barang`.`edit`              AS `edit`,
  
  (TO_DAYS(CURDATE()) - TO_DAYS(`db_sumber_rejeki`.`barang`.`expired`)) AS `selisih`,
  CURDATE()                     AS `tgl_sekarang`
FROM `barang` WHERE STATUS='aktif'

DROP VIEW expire

SELECT * FROM expire


SELECT barang.nama, COUNT(qty), SUM(subtotal) FROM barang, detail, penjualan WHERE barang.kode = detail.`kode_barang` AND detail.id=penjualan.id 
AND tgl= '2021-10-23' GROUP BY barang.`nama`;


SELECT MONTH(tgl) AS bulan, SUM(total_harga) AS total_penjualan
FROM penjualan
GROUP BY MONTH(tgl)


SELECT YEAR(tgl) ,MONTH(tgl) FROM penjualan WHERE   GROUP BY MONTH(tgl)






SELECT MONTH(tgl) AS tahun_bulan, COUNT(*) AS jumlah_bulanan, SUM(total_harga)
FROM  penjualan WHERE kasir='bone'AND tgl LIKE '%2020%'
GROUP BY MONTH(tgl);


SELECT SUM(total_harga) AS total FROM penjualan WHERE tgl=CURDATE()
`penjualan`
SELECT DATE_FORMAT(CURDATE(tgl),"%m") FROM penjualan

SELECT SUM(total_harga) AS total FROM penjualan GROUP BY MONTH(tgl);



SELECT CONCAT(YEAR(tgl),'/',MONTH(tgl)) AS tahun_bulan, SUM(total_harga) AS total
FROM penjualan
WHERE CONCAT(YEAR(tgl),'/',MONTH(tgl))=CONCAT(YEAR(NOW()),'/',MONTH(NOW()))
GROUP BY YEAR(tgl),MONTH(tgl);


UPDATE suplier
SET 
  nama = 'nama',
  kota = 'kota',
  telp = 'telp',
  email = 'email',
  alamat = 'alamat'
WHERE kode = 'kode';






SELECT MONTH(tgl) AS bulan, SUM(total_harga) FROM  penjualan WHERE kasir='bone' AND tgl LIKE '%2021%' GROUP BY MONTH(tgl);


SELECT SUM(total_harga) AS penjualan FROM  penjualan WHERE MONTH(tgl) = '04' AND YEAR(tgl)='2021'




SELECT * FROM expire ORDER BY selisih ASC


SELECT COUNT(kode) AS total FROM barang WHERE MONTH(expired) = '04' AND YEAR(expired)='2021'




UPDATE data_apotek SET `nama` = 'nama',`alamat` = 'alamat',`telp` = 'telp',`so` = 'so',`info` = 'info'



SELECT CONCAT(YEAR(tgl),'/',MONTH(tgl)) AS tahun_bulan, SUM(total_harga) AS total FROM penjualan 
WHERE CONCAT(YEAR(tgl),'/',MONTH(tgl))=CONCAT(YEAR(NOW()),'/',MONTH(NOW())) GROUP BY YEAR(tgl),MONTH(tgl)


SELECT SUM(total_harga) FROM penjualan WHERE tgl BETWEEN '2021-04-01' AND '2021-04-31'



SELECT MONTH(NOW())