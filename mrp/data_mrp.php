<?php
include_once("config/Class_mrp.php");
$mr = new Class_mrp();
$hasil_mrp = [];

include("config/config.php");

if (isset($_POST['hitung'])) {
    $bulan = $_POST['bulan'];
    $minggu = $_POST['minggu'];
    
    // Validasi minggu
    if (!is_numeric($minggu) || $minggu < 1 || $minggu > 5) {
        echo "<script>alert('Minggu harus antara 1 sampai 5'); window.history.back();</script>";
        exit;
    }

    $hasil_mrp = $mr->fungsi_mrp($bulan, $minggu);
    echo "<script>alert('Perhitungan selesai');</script>";
}


?>

<div class="row">
    <div class="col-lg-12">
        <div class="page-header">
            <h1>Hasil Perhitungan MRP</h1>
            <!-- <div class="text-right" style="margin-top: -4%;">
                <a href="stok/cetak_stok.php" target="_blank" class="btn btn-default "><i class="fa fa-print "></i> Print </a>
            </div> -->
        </div>

    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Hasil Perhitungan MRP
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <!-- Form input bulan dan minggu -->
                <form method="post">
                    <label>Bulan:</label>
                    <input type="month" name="bulan" required>

                    <label>Minggu ke:</label>
                    <select name="minggu" required>
                        <option value="">Pilih Minggu</option>
                        <option value="1">Minggu 1</option>
                        <option value="2">Minggu 2</option>
                        <option value="3">Minggu 3</option>
                        <option value="4">Minggu 4</option>
                        <option value="5">Minggu 5</option>
                    </select>

                    <button type="submit" name="hitung">Hitung MRP</button>
                </form>



                <!-- Tabel hasil -->
                <table width="100%" class="table table-striped table-bordered table-hover" cellpadding="0" cellspacing="0" id="dataTables-example">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Komponen</th>
                            <th>Tanggal Pesanan</th>
                            <th>Gross Requirement</th>
                            <th>Projected On Hand</th>
                            <th>Net Requirement</th>
                            <th>Planned Order Receipt</th>
                            <th>Planned Order Release</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        if (is_array($hasil_mrp) && count($hasil_mrp) > 0) {
                            foreach ($hasil_mrp as $row) {
                        ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $row['name'] ?></td>
                                    <td><?= $row['month'] ?></td>
                                    <td><?= $row['gross_requirement'] ?></td>
                                    <td><?= $row['projected_on_hand'] ?></td>
                                    <td><?= $row['net_requirement'] ?></td>
                                    <td><?= $row['planned_order_receipt'] ?></td>
                                    <td><?= $row['planned_order_release'] ?></td>
                                </tr>
                        <?php
                            }
                        } else {
                            echo "<tr><td colspan='8' class='text-center'>Tidak ada data MRP untuk bulan ini</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>

                <!-- /.table-responsive -->

            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>

<!-- /.row -->