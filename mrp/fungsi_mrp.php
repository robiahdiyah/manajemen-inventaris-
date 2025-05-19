<?php
include_once("../config/Class_mrp.php");
$mr = new Class_mrp();
include_once("../config/config.php");

$aksi = $_GET["aksi"];

// ===========================================================================================
// HITUNG MRP
// ===========================================================================================
if ($aksi == "hitungmrp") {

    $bulan = $_POST['bulan'];
    $minggu = $_POST['minggu'];
    print_r($minggu);

    $mr->fungsi_mrp($bulan, $minggu);
    echo "DEBUG: Jalankan fungsi MRP untuk bulan $bulan dan minggu $minggu<br>";
    echo "<script>alert('Perhitungan selesai'); window.location.href='../index.php?page=mrp';</script>";
}
