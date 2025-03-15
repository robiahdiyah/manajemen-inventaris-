<?php 

class Class_mrp{
    function tampil_mrp(){
        include("config.php");

        $sql = "select * from mrp";

        $data = mysqli_query($conn, $sql);

        $data1 = mysqli_num_rows($data);
        if ($data1 == 0) {  

            echo "<div class='alert alert-danger'>Tidak ada data</div";
        } else {

            while ($d = mysqli_fetch_assoc($data)) {

                $hasil[] = $d;
            }
            return $hasil;
        }
    }
}

?>