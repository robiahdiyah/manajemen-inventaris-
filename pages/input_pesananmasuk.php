<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Pesanan Masuk</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Input Pesanan Masuk
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-6">
                        <form action="pages/proses_barang.php?aksi=tambahpesananmasuk" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>No. Invoice</label>
                                <input type="text" name="invoice" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Nama Barang</label>
                                <select name="product_id" class="form-control" required>
                                    <option value="">Pilih Barang</option>
                                    <?php foreach ($db->barang() as $brg) { ?>
                                        <option value="<?= $brg['id'] ?>"><?= $brg['name'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Jumlah Pesanan</label>
                            <input type="text" placeholder="Masukan jumlah masuk" name="quantity" class="form-control" required pattern="[0-9]+">
                        </div>
                        <div class="form-group">
                            <label>Tanggal Masuk</label>
                            <input type="date" placeholder="Tanggal Masuk" name="tgl_masuk" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" name="submit" value="Simpan" class="btn btn-default" style="background-color: #333; color: #fff;">Submit</button>
                            <a href='?page=databarang' class="btn btn-default">Batal</a>
                        </div>
                    </div>
                    </form>
                </div>
                <!-- /.col-lg-6 (nested) -->
            </div>
            <!-- /.row (nested) -->
        </div>
        <!-- /.panel-body -->
    </div>
    <!-- /.panel -->
</div>
<!-- /.col-lg-12 -->
</div>
<!-- /.row -->