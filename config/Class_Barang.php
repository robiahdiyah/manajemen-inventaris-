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

    function tampil_pesananmasuk($bulan = null)
    {
        include("config.php");

        if ($bulan) {
            $tahun = substr($bulan, 0, 4);
            $bln   = substr($bulan, 5, 2);

            $sql = "SELECT * FROM orders 
                JOIN products ON orders.product_id = products.id 
                WHERE MONTH(orders.bulan) = '$bln' AND YEAR(orders.bulan) = '$tahun'";
        } else {
            $sql = "SELECT * FROM orders 
                JOIN products ON orders.product_id = products.id";
        }

        $data = mysqli_query($conn, $sql);
        $hasil = [];

        while ($d = mysqli_fetch_assoc($data)) {
            $hasil[] = $d;
        }

        return $hasil;
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

        $sql = "select * from products";

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

    function input_barangmasuk($invoice, $product_id, $tgl_masuk, $quantity,)
    {
        include("config.php");
        // Menyimpan barang masuk
        $sql = "INSERT INTO orders (invoice, product_id, bulan, quantity)
        VALUES ('$invoice', '$product_id', '$tgl_masuk', '$quantity')";

        mysqli_query($conn, $sql);
    }


    function input_datapeminjaman($nomor_pinjam, $tgl_pinjam, $kode_barang, $nama_barang, $jumlah_pinjam, $peminjam)
    {
        include("config.php");

        $sql = "INSERT INTO tbl_keluarbarang (no_pinjam ,kode_barang, nama_barang, tgl_pinjam, peminjam, jumlah_pinjam)
        VALUES ('$nomor_pinjam','$kode_barang', '$nama_barang', '$tgl_pinjam', '$peminjam', '$jumlah_pinjam')";
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
        $total_barang = ($stok['jml_barangmasuk'] ?? 0) - $new_jml_keluar;

        // Update tbl_stok
        $sql3 = "UPDATE tbl_stok SET jml_barangkeluar = '$new_jml_keluar', total_barang = '$total_barang' WHERE kode_barang = '$kode_barang'";
        $data3 = mysqli_query($conn, $sql3);

        if (!$data3) {
            die("Error update stok: " . mysqli_error($conn));
        }
    }

    function hitung_mrp($conn, $kode_barang, $jumlah_pinjam)
    {
        // Ambil data stok dari tbl_stok
        $query = "SELECT jml_barangmasuk, jml_barangkeluar, total_barang FROM tbl_stok WHERE kode_barang = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "s", $kode_barang);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (!$result) {
            die("Error: Query gagal dijalankan - " . mysqli_error($conn));
        }

        $stok = mysqli_fetch_assoc($result);

        if (!$stok) {
            die("Error: Data stok tidak ditemukan untuk kode barang $kode_barang");
        }

        $jumlah_brg_masuk = $stok["jml_barangmasuk"] ?? 0;
        $jumlah_brg_keluar = $jumlah_pinjam;
        $safety_stock = $stok["total_barang"] ?? 0;

        // Hitung stok saat ini
        $current_stock = $jumlah_brg_masuk - $jumlah_brg_keluar;

        // Hitung Net Requirements
        $net_requirements = max(0, $jumlah_pinjam - $current_stock + $safety_stock);

        // Simpan hasil perhitungan ke tabel MRP
        $insert_mrp = "INSERT INTO mrp (kode_barang, jml_barangkeluar, jml_barangmasuk, safety_stock, net_requirements, tanggal_input_mrp)
                   VALUES (?, ?, ?, ?, ?, NOW())";

        $stmt_insert = mysqli_prepare($conn, $insert_mrp);
        mysqli_stmt_bind_param($stmt_insert, "siiii", $kode_barang, $jumlah_brg_keluar, $jumlah_brg_masuk, $safety_stock, $net_requirements);

        if (mysqli_stmt_execute($stmt_insert)) {
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
