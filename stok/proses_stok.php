<?php
include_once("../config/Class_Stok.php");
$st = new Class_Stok();
include_once("../config/config.php");

$aksi = $_GET["aksi"];

// ===========================================================================================
// INPUT STOK
// ===========================================================================================
if ($aksi == "tambahstok") {
    include_once("../config/config.php");

    $component_id = $_POST["component_id"];
    $quantity_masuk = $_POST["quantity"];
    $safety_stok_masuk = $_POST["safety_stock"];

    // Tambah atau update inventory
    $cek = mysqli_query($conn, "SELECT * FROM inventory WHERE component_id = '$component_id'");
    if (mysqli_num_rows($cek) > 0) {
        mysqli_query($conn, "UPDATE inventory SET quantity = quantity + $quantity_masuk WHERE component_id = '$component_id'");
    } else {
        mysqli_query($conn, "INSERT INTO inventory (component_id, quantity) VALUES ('$component_id', $quantity_masuk)");
    }

    // Update atau insert safety stock pada components
    $cek2 = mysqli_query($conn, "SELECT * FROM components WHERE id = '$component_id'");
    if (mysqli_num_rows($cek2) > 0) {
        mysqli_query($conn, "UPDATE components SET safety_stock = safety_stock + $safety_stok_masuk WHERE id = '$component_id'");
    } else {
        mysqli_query($conn, "INSERT INTO components (id, name, safety_stock) VALUES ('$component_id', 'Komponen Baru', $safety_stok_masuk)");
    }


    echo "<script>alert('Stok berhasil ditambahkan'); window.location.href='../index.php?page=inputstok';</script>";
}
