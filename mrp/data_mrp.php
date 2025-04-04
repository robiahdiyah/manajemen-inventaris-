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
                Stok Barang
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <table width="100%" class="table table-striped table-bordered table-hover" cellpadding="0" cellspacing="0" id="dataTables-example">
                    <thead>
                        <?php
                        ?>
                        <tr>
                            <th>No</th>
                            <th>Kode Barang</th>
                            <!-- <th>Nama Barang</th> -->
                            <th>Jumlah Barang Masuk</th>
                            <th>Jumlah Barang Keluar</th>
                            <th>Safety Stok</th>
                            <th>Net Requirement</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;

                        if (is_array($mr->tampil_mrp()) && count($mr->tampil_mrp()) > 0) {

                            foreach ($mr->tampil_mrp() as $row) {

                        ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $row['kode_barang'] ?></td>
                                    <td><?= $row['jml_barangmasuk'] ?></td>
                                    <td><?= $row['jml_barangkeluar'] ?></td>
                                    <td><?= $row['safety_stock'] ?></td>
                                    <td><?= $row['net_requirements'] ?></td>
                                    <td><?= $row['tanggal_input_mrp'] ?></td>

                                </tr>
                        <?php }
                        } ?>
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