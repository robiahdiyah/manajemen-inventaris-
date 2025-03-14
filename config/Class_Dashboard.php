<?php 
/**
* 
*/
class Class_Dashboard
{
    
   function getDataDashboard()
    {
        include("config.php");

        $sql = "SELECT 
    (SELECT COUNT(*) FROM tbl_barang) AS total_barang,
    (SELECT SUM(jml_barangmasuk) FROM tbl_stok) AS jml_barangmasuk,
    (SELECT SUM(jml_barangkeluar) FROM tbl_stok) AS jml_barangkeluar,
    (SELECT SUM(total_barang) FROM tbl_stok) AS total_barang";

        $data = mysqli_query($conn,$sql);

        // Periksa apakah query berhasil
        if (!$data) {
            die("Error query: " . mysqli_error($conn));
        }

        $row = mysqli_fetch_assoc($data);

        return [
            'total_barang' => $row['total_barang'] ?? 0,
            'jml_barangmasuk' => $row['jml_barangmasuk'] ?? 0,
            'jml_barangkeluar' => $row['jml_barangkeluar'] ?? 0,
            'total_barang' => $row['total_barang'] ?? 0,
        ];
    }
}
 ?>