CREATE VIEW data_exp AS
SELECT *, CURRENT_DATE() AS sekarang, DATEDIFF(CURRENT_DATE(), expired) AS selisih
FROM barang
WHERE STATUS='aktif'

SELECT kode,nama, COUNT(nama) duplikat FROM barang GROUP BY nama HAVING COUNT(duplikat)>1
