<?php
include_once("../config/Class_Barang.php");
$db = new Class_Barang();
include_once("../config/config.php");

$aksi = $_GET["aksi"];

// ===========================================================================================
// BARANG BARU
// ===========================================================================================

if ($aksi == "tambah") {

    $kode_barang = $_POST["kode_barang"];
    $nama_barang = $_POST["nama_barang"];
    // $spesifikasi = $_POST["spesifikasi"];
    // $lokasi_barang = $_POST["lokasi_barang"];
    // $kategori = $_POST["kategori"];

    // $kondisi = $_POST["kondisi"];
    // $jenis_barang = $_POST["jenis_barang"];
    // $sumber_dana = $_POST["sumber_dana"];
    // $keterangan = $_POST["keterangan"];

    // $stok = "0";
    // $jmlkeluar = "0";

    $db->input_barangbaru($kode_barang, $nama_barang);

    echo "<script>alert('Data barang tersimpan'); window.location.href='../index.php?page=databarang';</script>";
}

// ===========================================================================================
// PESANAN MASUK
// ===========================================================================================
else if ($aksi == "tambahpesananmasuk") {

    $product_id = $_POST["product_id"];
    $invoice = $_POST["invoice"];
    $quantity = $_POST["quantity"];
    $tgl_masuk = $_POST["tgl_masuk"];

    $db->input_barangmasuk($invoice, $product_id, $tgl_masuk, $quantity);

    echo "<script>alert('Barang masuk berhasil ditambahkan'); window.location.href='../index.php?page=inputpesananmasuk';</script>";
}


// ===========================================================================================
// FILTER BULAN
// ===========================================================================================
else if ($aksi == "filterbulan") {

    $bulan = $_POST["bulan"];
    $data = $db->tampil_pesananmasuk($bulan);

    if (empty($data)) {
        echo "<div class='alert alert-warning'>Tidak ada data untuk bulan tersebut.</div>";
    } else {
        echo "<table width='100%' class='table table-striped table-bordered table-hover'>";
        echo "<thead><tr><th>No</th><th>Nama Barang</th><th>Jumlah Masuk</th><th>Tanggal Masuk</th></tr></thead><tbody>";
        $no = 1;
        foreach ($data as $row) {
            echo "<tr>";
            echo "<td>$no</td>";
            echo "<td>{$row['name']}</td>";
            echo "<td>{$row['quantity']}</td>";
            echo "<td>{$row['bulan']}</td>";
            echo "</tr>";
            $no++;
        }
        echo "</tbody></table>";
    }
}

// ===========================================================================================
// PINJAM BARANG
// ===========================================================================================
else if ($aksi == "tambahdatapinjam") {
    $nomor_pinjam = $_POST["no_pinjam"];
    $tgl_pinjam = $_POST["tgl_pinjam"];
    $nama_barang = $_POST["nama_barang"];
    $jumlah_pinjam = $_POST["jumlah_pinjam"];
    $peminjam = $_POST["peminjam"];

    // Ambil kode_barang dari tbl_barang
    $kodebrg = mysqli_query($conn, "SELECT kode_barang FROM tbl_barang WHERE nama_barang='$nama_barang'");
    $kd = mysqli_fetch_assoc($kodebrg);
    $kode_barang = $kd["kode_barang"] ?? '';

    if (empty($kode_barang)) {
        die("Error: Kode barang tidak ditemukan untuk $nama_barang");
    }

    // Ambil stok barang dari tbl_stok
    $stok_barang = mysqli_query($conn, "SELECT jml_barangmasuk, jml_barangkeluar FROM tbl_stok WHERE kode_barang='$kode_barang'");
    $stok = mysqli_fetch_assoc($stok_barang);

    $jumlah_brg_masuk = $stok["jml_barangmasuk"] ?? 0;
    $jumlah_brg_keluar = $stok["jml_barangkeluar"] ?? 0;

    // Cek apakah jumlah yang dipinjam melebihi stok
    if ($jumlah_pinjam > $jumlah_brg_masuk) {
        echo "<script>alert('Jumlah barang yang dipinjam terlalu banyak! Stok tersedia: $jumlah_brg_masuk.'); window.location.href='../index.php?page=formpeminjaman';</script>";
    } else {
        // Simpan data peminjaman ke database
        $db->input_datapeminjaman($nomor_pinjam, $tgl_pinjam, $kode_barang, $nama_barang, $jumlah_pinjam, $peminjam);

        // Jalankan perhitungan MRP setelah data peminjaman berhasil disimpan
        if ($db->hitung_mrp($conn, $kode_barang, $jumlah_pinjam, $jumlah_brg_masuk, $jumlah_brg_keluar)) {
            echo "<script>alert('Data peminjaman dan perhitungan MRP berhasil disimpan!'); window.location.href='../index.php?page=peminjaman';</script>";
        } else {
            echo "<script>alert('Data peminjaman berhasil disimpan, tetapi perhitungan MRP gagal!'); window.location.href='../index.php?page=peminjaman';</script>";
        }
    }
}




// ===========================================================================================
// KEMBALI BARANG
// ===========================================================================================

else if ($aksi == "kembalibarang") {

    $no_pinjam = $_POST["no_pinjam"];
    $status = $_POST["status"];

    $query = mysqli_query($conn, "select * from tbl_pinjam a inner join tbl_barang b on a.kode_barang=b.kode_barang where a.nomor_pinjam='$no_pinjam'");
    $data = mysqli_fetch_array($query);

    $jumlah_pinjam = $data["jumlah_pinjam"];
    $kode_barang = $data["kode_barang"];
    $keterangan = $data["keterangan"];
    $jumlah_brg = $data["jumlah_brg"];

    $query2 = mysqli_query($conn, "select * from tbl_stok where kode_barang='$kode_barang'");
    $data2 = mysqli_fetch_array($query2);
    $barangkeluar = $data2["jml_barangkeluar"];

    $jumlah_barang = $jumlah_brg + $jumlah_pinjam;
    $stok = $barangkeluar - $jumlah_pinjam;

    if ($keterangan == "Sudah dikembalikan") {
        echo "<script>alert('Barang ini sudah dikembalikan sebelumnya!'); window.location.href='../barang.php?page=peminjaman';</script>";
    } else {
        $db->update_datapeminjaman($jumlah_barang, $kode_barang, $status, $no_pinjam, $stok);
        echo "<script>alert('Data barang dikembalikan ke stok'); window.location.href='../index.php?page=peminjaman';</script>";
    }
} else if ($aksi == "updatebarang") {
    $kode_barang = $_POST["kode_barang"];
    $nama_barang = $_POST["nama_barang"];
    // $spesifikasi = $_POST["spesifikasi"];
    // $lokasi = $_POST["lokasi_barang"];
    // $kategori = $_POST["kategori"];
    // $kondisi = $_POST["kondisi"];
    // $jenis = $_POST["jenis_barang"];
    // $sumber_dana = $_POST["sumber_dana"];

    // $query = $db->update_barang($nama_barang,$spesifikasi,$lokasi,$kategori,$kondisi,$jenis,$sumber_dana,$kode_barang);

    $query = mysqli_query($conn, "update tbl_barang a inner join tbl_stok e on a.kode_barang=e.kode_barang set 
        
        a.nama_barang='" . $nama_barang . "',
        e.nama_barang='" . $nama_barang . "' where a.kode_barang='" . $kode_barang . "' ");

    // mengambil data barang keluar/masuk
    $UPD = mysqli_query($conn, "select * from tbl_keluarbarang a inner join tbl_masukbarang b inner join tbl_pinjam c on a.kode_barang=b.kode_barang and b.kode_barang=c.kode_barang where a.kode_barang='" . $kode_barang . "' and  b.kode_barang='" . $kode_barang . "' and  c.kode_barang='" . $kode_barang . "' ");

    $cek = mysqli_fetch_array($UPD);

    if ($query) {
        if ($cek > 0) {
            $queryupdate  = mysqli_query($conn, "update tbl_keluarbarang a inner join tbl_masukbarang b inner join tbl_pinjam c on 
                a.kode_barang=b.kode_barang
                and b.kode_barang=c.kode_barang set a.nama_barang='" . $nama_barang . "',b.nama_barang='" . $nama_barang . "',c.nama_barang='" . $nama_barang . "' where a.kode_barang='" . $kode_barang . "' ");
            if ($queryupdate) {
                echo "<script>alert('Data berhasil diubah'); window.location.href='../index.php?pages=databarang';</script>";
            }
        }
        echo "<script>alert('Data berhasil diubah'); window.location.href='../index.php?pages=databarang';</script>";
    } else {
        echo "Gagal";
    }
}
