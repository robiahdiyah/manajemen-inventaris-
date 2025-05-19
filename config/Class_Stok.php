<?php

/**
 * 
 */
class Class_Stok
{

    function tampil_data()
    {
        include("config.php");

        $sql = "select * from inventory JOIN components ON inventory.component_id = components.id";

        $data = mysqli_query($conn, $sql);

        $data1 = mysqli_num_rows($data);
        if ($data1 == 0) {

            echo "<div class='alert alert-danger'>Tidak ada data</div>";
        } else {

            while ($d = mysqli_fetch_assoc($data)) {

                $hasil[] = $d;
            }
            return $hasil;
        }
    }

    function tampil_stok()
    {
        include("config.php");

        $sql = "select * from components JOIN inventory ON components.id = inventory.component_id";

        $data = mysqli_query($conn, $sql);

        while ($d = mysqli_fetch_assoc($data)) {

            $hasil[] = $d;
        }
        return $hasil;
    }
}
