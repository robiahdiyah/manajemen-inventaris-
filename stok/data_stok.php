<div class="row">
    <div class="col-lg-12">
        <div class="page-header">
            <h1>Data Stok</h1>
            <div class="text-right" style="margin-top: -4%;">
                <a href="stok/cetak_stok.php" target="_blank" class="btn btn-default "><i class="fa fa-print "></i> Print </a>
            </div>
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
            <div class="text-right" style="margin-bottom: 1px;">
                <button style="background-color: darkcyan;
    color: #fff; 
    border: none; 
    border-radius: 5px; 
    padding: 10px 20px; 
    margin-top: 5px;
    font-size: 16px; 
    cursor: pointer; 
    transition: all 0.3s ease-in-out;" class=" btn-tambah-stok" onclick="window.location.href='?page=inputstok'">Tambah Stok</button>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <table width="100%" class="table table-striped table-bordered table-hover" cellpadding="0" cellspacing="0" id="dataTables-example">
                    <thead>
                        <?php
                        ?>
                        <tr>
                            <th>No</th>
                            <th>Nama Komponen</th>
                            <th>Project On Hand</th>
                            <th>Safety Stock</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;

                        if (is_array($st->tampil_data()) && count($st->tampil_data()) > 0) {

                            foreach ($st->tampil_data() as $row) {

                        ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $row['name'] ?></td>
                                    <td><?= $row['quantity'] ?></td>
                                    <td><?= $row['safety_stock'] ?></td>


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