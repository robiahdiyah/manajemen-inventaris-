<?php

/**
 * 
 */
class Class_Barang
{

    // =====================================================================================
    // AMBIL DATA
    // ======================================================================================
    function hitung_data()
    {
        include("config.php");

        $sql = "select * from tbl_barang a inner join tbl_stok c on a.kode_barang=c.kode_barang";

        $data = mysqli_query($conn, $sql);

        $data1 = mysqli_num_rows($data);
        if ($data1 == 0) {

            // echo "<div class='alert alert-danger'>Tidak ada data</div>";
        } else {

            while ($d = mysqli_fetch_assoc($data)) {

                $hasil[] = $d;
            }
            return $hasil;
        }
    }

    function tampil_data()
    {
        include("config.php");

        $sql = "select * from tbl_barang";

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

    function tampil_barangmasuk()
    {
        include("config.php");

        $sql = "select * from tbl_barang a inner join tbl_masukbarang b inner join tbl_stok c on a.kode_barang=b.kode_barang and a.kode_barang=c.kode_barang inner join tbl_supplier d on b.kode_supplier=d.kode_supplier ORDER BY b.tgl_masuk DESC";

        // echo $sql;
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

    function tampil_peminjaman()
    {
        include("config.php");

        $sql = "select * from tbl_pinjam order by nomor_pinjam DESC";

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

    function tampil_barangkeluar()
    {
        include("config.php");

        $sql = "select * from tbl_keluarbarang";

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


    // mengambil nama dan id_supplier
    function supplier()
    {
        include("config.php");

        $sql = "select * from tbl_supplier order by kode_supplier";

        $data = mysqli_query($conn, $sql);

        while ($d = mysqli_fetch_assoc($data)) {

            $hasil[] = $d;
        }
        return $hasil;
    }

    // mengambil nama dan kode_barang
    function barang()
    {
        include("config.php");

        $sql = "select * from tbl_barang order by kode_barang";

        $data = mysqli_query($conn, $sql);

        while ($d = mysqli_fetch_assoc($data)) {

            $hasil[] = $d;
        }
        return $hasil;
    }

    // ======================================================================================
    // INPUT DATA
    // ======================================================================================

    function input_barangbaru($kode_barang, $nama_barang)
    {
        // $kode_barang = addslashes($kode_barang);
        $nama_barang = addslashes($nama_barang);

        include("config.php");

        $sql1 = "insert into tbl_barang values('$kode_barang','$nama_barang')";
        // echo $sql1;
        $data1 = mysqli_query($conn, $sql1);


        $sql2 = "insert into tbl_stok values('$kode_barang','$nama_barang')";
        // echo $sql2;
        $data2 = mysqli_query($conn, $sql2);
    }

    function input_barangmasuk($id_barangmasuk, $kode_barang, $nama_barang, $tgl, $jumlah, $kode_supplier)
    {
        include("config.php");

        // Menyimpan barang masuk
        $sql1 = "INSERT INTO tbl_masukbarang (id_barangmasuk, kode_barang, nama_barang, tgl, jumlah, kode_supplier)
             VALUES ('$id_barangmasuk', '$kode_barang', '$nama_barang', '$tgl', '$jumlah', '$kode_supplier')";
        $data1 = mysqli_query($conn, $sql1);

        // Ambil jumlah stok yang sudah ada di tbl_stok
        $sql_get_stok = "SELECT jml_barangmasuk, jml_barangkeluar FROM tbl_stok WHERE kode_barang = '$kode_barang'";
        $result = mysqli_query($conn, $sql_get_stok);
        $stok = mysqli_fetch_assoc($result);

        $new_jml_masuk = ($stok['jml_barangmasuk'] ?? 0) + $jumlah;
        $total_barang = $new_jml_masuk - ($stok['jml_barangkeluar'] ?? 0);

        // Update tbl_stok
        $sql2 = "UPDATE tbl_stok 
             SET jml_barangmasuk = '$new_jml_masuk', 
                 total_barang = '$total_barang' 
             WHERE kode_barang = '$kode_barang'";
        $data2 = mysqli_query($conn, $sql2);

        // Update tbl_barang
        $sql3 = "UPDATE tbl_barang 
             SET jumlah_brg = '$total_barang' 
             WHERE kode_barang = '$kode_barang'";
        $data3 = mysqli_query($conn, $sql3);
    }


    function input_datapeminjaman($nomor_pinjam, $tgl_pinjam, $kode_barang, $nama_barang, $jumlah_pinjam, $peminjam)
    {
        include("config.php");

        $sql = "INSERT INTO tbl_keluarbarang (kode_barang, nama_barang, tgl_pinjam, peminjam, jumlah_pinjam)
        VALUES ('$kode_barang', '$nama_barang', '$tgl_pinjam', '$peminjam', '$jumlah_pinjam')";
        $data = mysqli_query($conn, $sql);

        if (!$data) {
            die("Error pada query tbl_keluarbarang: " . mysqli_error($conn));
        }

        $sql1 = "INSERT INTO tbl_pinjam (nomor_pinjam, tgl_pinjam, kode_barang, nama_barang, jumlah_pinjam, peminjam)
         VALUES ('$nomor_pinjam', '$tgl_pinjam', '$kode_barang', '$nama_barang', '$jumlah_pinjam', '$peminjam')";
        $data1 = mysqli_query($conn, $sql1);

        if (!$data1) {
            die("Error pada query tbl_pinjam: " . mysqli_error($conn));
        }


        // Update stok di tbl_stok
        $sql_get_stok = "SELECT jml_barangmasuk, jml_barangkeluar FROM tbl_stok WHERE kode_barang = '$kode_barang'";
        $result = mysqli_query($conn, $sql_get_stok);
        $stok = mysqli_fetch_assoc($result);

        $new_jml_keluar = ($stok['jml_barangkeluar'] ?? 0) + $jumlah_pinjam;
        // $total_barang = ($stok['jml_barangmasuk'] ?? 0) - $new_jml_keluar;

        // Update tbl_stok
        $sql3 = "UPDATE tbl_stok SET jml_barangkeluar = '$new_jml_keluar' WHERE kode_barang = '$kode_barang'";
        $data3 = mysqli_query($conn, $sql3);

        if (!$data3) {
            die("Error update stok: " . mysqli_error($conn));
        }
    }

    function hitung_mrp($conn, $kode_barang, $jumlah_pinjam)
    {
        // Ambil data stok dari tbl_stok
        $query = "SELECT jml_barangmasuk, jml_barangkeluar, safety_stock FROM tbl_stok WHERE kode_barang='$kode_barang'";
        $result = mysqli_query($conn, $query);

        if (!$result) {
            die("Error: Query gagal dijalankan - " . mysqli_error($conn));
        }

        $stok = mysqli_fetch_assoc($result);

        if (!$stok) {
            die("Error: Data stok tidak ditemukan untuk kode barang $kode_barang");
        }

        $jumlah_brg_masuk = $stok["jml_barangmasuk"] ?? 0;
        $jumlah_brg_keluar = $stok["jml_barangkeluar"] ?? 0;
        $safety_stock = $stok["safety_stock"] ?? 0;

        // Hitung Net Requirements
        $net_requirements = max(0, $jumlah_pinjam - ($jumlah_brg_masuk - $jumlah_brg_keluar) + $safety_stock);

        // Simpan hasil perhitungan ke tabel MRP
        $insert_mrp = "INSERT INTO mrp (kode_barang, jml_barangkeluar, jml_barangmasuk, safetystok, net_requirements, tanggal_input_mrp)
                   VALUES ('$kode_barang', '$jumlah_brg_keluar', '$jumlah_brg_masuk', '$safety_stock', '$net_requirements', NOW())";

        if (mysqli_query($conn, $insert_mrp)) {
            return true;
        } else {
            echo "Error: " . mysqli_error($conn); // Untuk debugging jika terjadi error
            return false;
        }
    }




    // ======================================================================================
    // UPDATE DATA
    // ======================================================================================

    function update_datapeminjaman($jumlah_brg, $kode_barang, $keterangan, $no_pinjam, $stok)
    {
        include("config.php");
        $sql1 = "update tbl_barang set jumlah_brg='" . $jumlah_brg . "' where kode_barang='" . $kode_barang . "'";
        // echo $sql1;

        $data1 = mysqli_query($conn, $sql1);

        $sql2 = "update tbl_pinjam set keterangan='" . $keterangan . "' where nomor_pinjam='" . $no_pinjam . "'";
        // echo $sql2;

        $data2 = mysqli_query($conn, $sql2);

        $sql3 = "update tbl_stok set jml_barangkeluar='" . $stok . "' where kode_barang='" . $kode_barang . "'";
        // echo $sql3;

        $data3 = mysqli_query($conn, $sql3);
    }

    function edit_barang($kode_barang)
    {
        include("config.php");

        $sql = "select * from tbl_barang where kode_barang='" . $kode_barang . "'";

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

    function update_barang($nama_barang, $kode_barang)
    {
        include("config.php");

        $sql = "update tbl_barang a inner join tbl_stok e on a.kode_barang=e.kode_barang set 
        
        a.nama_barang='" . $nama_barang . "',
        e.nama_barang='" . $nama_barang . "' where a.kode_barang='" . $kode_barang . "' ";

        // echo $sql;
        $data = mysqli_query($conn, $sql);
    }
    // ======================================================================================
    // HAPUS DATA
    // ======================================================================================


    function hapus($id)
    {
        include("config.php");

        $sql1 = "delete from tbl_barang where kode_barang='" . $id . "' ";
        $data1 = mysqli_query($conn, $sql1);

        $sql2 = "delete from tbl_stok where kode_barang= '" . $id . "' ";
        $data2 = mysqli_query($conn, $sql2);

        $sql3 = "delete from tbl_pinjam where kode_barang= '" . $id . "' ";
        $data3 = mysqli_query($conn, $sql3);

        $sql4 = "delete from tbl_masukbarang where kode_barang= '" . $id . "' ";
        $data4 = mysqli_query($conn, $sql4);

        $sql5 = "delete from tbl_keluarbarang where kode_barang= '" . $id . "' ";
        $data5 = mysqli_query($conn, $sql5);
    }
}
