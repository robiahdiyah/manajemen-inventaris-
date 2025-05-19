<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Stok Komponen</h1>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Input Stok Komponen
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-6">
                        <form action="stok/proses_stok.php?aksi=tambahstok" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Nama Komponen</label>
                                <select name="component_id" class="form-control" required>
                                    <option value="">Pilih Komponen</option>
                                    <?php foreach ($st->tampil_stok() as $stk_item) { ?>
                                        <option value="<?= $stk_item['component_id'] ?>"><?= $stk_item['name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Jumlah Project On Hand</label>
                                <input type="number" name="quantity" class="form-control" required pattern="[0-9]+">
                            </div>
                            <div class="form-group">
                                <label>Jumlah Safety Stok</label>
                                <input type="number" name="safety_stock" class="form-control" pattern="[0-9]+">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="?page=databarang" class="btn btn-default">Batal</a>
                            </div>
                        </form>

                    </div>
                </div> <!-- /.col-lg-6 -->
            </div> <!-- /.panel-body -->
        </div> <!-- /.panel -->
    </div> <!-- /.col-lg-12 -->
</div> <!-- /.row -->