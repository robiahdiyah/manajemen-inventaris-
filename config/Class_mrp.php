<?php


class Class_mrp
{

    // Menampilkan data MRP
    function tampil_mrp()
    {
        include("config.php");

        $sql = "select * from mrp_results";

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

    // menghitung MRP
    function fungsi_mrp($bulan, $minggu_terpilih)
    {
        include("config.php");

        $tahun = substr($bulan, 0, 4);
        $bln   = substr($bulan, 5, 2);
        $bulan_sql = "$tahun-$bln-01";
        $bulan_text = date("F Y", strtotime($bulan_sql));

        $hasil = [];

        // Ambil semua pesanan pada bulan itu
        $sql_orders = "SELECT *, DAY(bulan) as hari FROM orders 
                   WHERE MONTH(bulan) = '$bln' AND YEAR(bulan) = '$tahun'";
        $res_orders = mysqli_query($conn, $sql_orders);

        // Kelompokkan quantity per minggu
        $order_per_minggu = [];
        $tanggal_per_minggu = [];

        while ($row = mysqli_fetch_assoc($res_orders)) {
            $hari = $row['hari'];
            $minggu_ke = ceil($hari / 7);
            $tgl_pesanan = $row['bulan'];

            if (!isset($order_per_minggu[$minggu_ke])) {
                $order_per_minggu[$minggu_ke] = 0;
                $tanggal_per_minggu[$minggu_ke] = [];
            }
            $order_per_minggu[$minggu_ke] += $row['quantity'];
            $tanggal_per_minggu[$minggu_ke][] = $row['bulan'];
        }

        if (!isset($order_per_minggu[$minggu_terpilih])) {
            return [];
        }

        $quantity = $order_per_minggu[$minggu_terpilih];
        $tgl_pesanan = min($tanggal_per_minggu[$minggu_terpilih]);

        // ✅ Cek apakah hasil MRP untuk minggu dan bulan ini sudah ada
        $sql_cek_sudah_ada = "SELECT * FROM mrp_results JOIN components ON mrp_results.component_id = components.id WHERE month = '$tgl_pesanan' AND week = '$minggu_terpilih'";
        $res_cek_sudah_ada = mysqli_query($conn, $sql_cek_sudah_ada);
        if (mysqli_num_rows($res_cek_sudah_ada) > 0) {
            // Data sudah ada, ambil dan tampilkan kembali
            while ($row = mysqli_fetch_assoc($res_cek_sudah_ada)) {
                $hasil[] = [
                    'component_id' => $row['component_id'],
                    'name' => $row['name'], // opsional: bisa ambil nama dari components jika perlu
                    'month' => $row['month'],
                    'week' => $row['week'],
                    'gross_requirement' => $row['gross_requirement'],
                    'projected_on_hand' => $row['projected_on_hand'],
                    'net_requirement' => $row['net_requirement'],
                    'planned_order_receipt' => $row['planned_order_receipt'],
                    'planned_order_release' => $row['planned_order_release'],
                ];
            }
            return $hasil;
        }

        // Jika belum ada → lakukan perhitungan MRP seperti biasa
        $sql = "SELECT * FROM product_components JOIN components ON product_components.component_id = components.id";
        $res = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_assoc($res)) {
            $component_id = $row['component_id'];
            $name = $row['name'];
            $qty_per_product = $row['quantity_per_product'];

            $gross = $qty_per_product * $quantity;

            $stok_sql = "SELECT inventory.quantity as stock_qty, components.safety_stock 
                     FROM inventory 
                     JOIN components ON inventory.component_id = components.id
                     WHERE inventory.component_id = '$component_id'";
            $stok_res = mysqli_query($conn, $stok_sql);
            $stok_row = mysqli_fetch_assoc($stok_res);
            $on_hand = $stok_row ? $stok_row['stock_qty'] : 0;
            $safety_stock = $stok_row ? $stok_row['safety_stock'] : 0;

            $net = max($gross - $on_hand, 0);
            if ($minggu_terpilih > 1 && $gross > $on_hand && $safety_stock > 0) {
                $net += $safety_stock;

                // Hitung berapa banyak safety stock yang benar-benar digunakan
                $digunakan = min($safety_stock, $net - max($gross - $on_hand, 0));
                $safety_stock_baru = max($safety_stock - $digunakan, 0);

                // Update safety stock di tabel components
                $sql_update_safety = "UPDATE components SET safety_stock = '$safety_stock_baru' WHERE id = '$component_id'";
                mysqli_query($conn, $sql_update_safety);
            }


            $stok_baru = max($on_hand - $gross, 0);
            $receipt = $net;
            $release = $net;

            $sql_update_inventory = "UPDATE inventory SET quantity = '$stok_baru' WHERE component_id = '$component_id'";
            mysqli_query($conn, $sql_update_inventory);

            $sql_insert = "INSERT INTO mrp_results 
            (component_id, month, week, gross_requirement, projected_on_hand, net_requirement, planned_order_receipt, planned_order_release)
            VALUES ('$component_id', '$tgl_pesanan', '$minggu_terpilih', '$gross', '$on_hand', '$net', '$receipt', '$release')";
            mysqli_query($conn, $sql_insert);

            $hasil[] = [
                'component_id' => $component_id,
                'name' => $name,
                'month' => $tgl_pesanan,
                'week' => $minggu_terpilih,
                'gross_requirement' => $gross,
                'projected_on_hand' => $on_hand,
                'net_requirement' => $net,
                'planned_order_receipt' => $receipt,
                'planned_order_release' => $release,
            ];
        }

        return $hasil;
    }
}
