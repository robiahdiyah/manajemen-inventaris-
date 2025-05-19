<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Data Pesanan </h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Data Pesanan Masuk
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <form id="formFilterBulan">
                    <label>PILIH BULAN</label>
                    <input type="month" name="bulan" required>
                    <input type="submit" value="FILTER">
                </form>

                <!-- Container untuk isi tabel -->
                <div id="tabelPesananMasuk">
                    <?php
                    $data = $db->tampil_pesananmasuk(); // default: tampil semua
                    if (is_array($data) && count($data) > 0) {
                    ?>
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>No. Invoice</th>
                                    <th>Nama Barang</th>
                                    <th>Jumlah Masuk</th>
                                    <th>Tanggal Masuk</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($data as $row) {
                                ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $row['invoice'] ?></td>
                                        <td><?= $row['name'] ?></td>
                                        <td><?= $row['quantity'] ?></td>
                                        <td><?= $row['bulan'] ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    <?php
                    } else {
                        echo "<div class='alert alert-warning'>Tidak ada data tersedia.</div>";
                    }
                    ?>
                </div>
            </div>
            <script>
                document.getElementById("formFilterBulan").addEventListener("submit", function(e) {
                    e.preventDefault(); // cegah reload halaman

                    const formData = new FormData(this);

                    fetch("pages/proses_barang.php?aksi=filterbulan", {
                            method: "POST",
                            body: formData
                        })
                        .then(res => res.text())
                        .then(html => {
                            document.getElementById("tabelPesananMasuk").innerHTML = html;
                        })
                        .catch(err => {
                            document.getElementById("tabelPesananMasuk").innerHTML = "<div class='alert alert-danger'>Terjadi kesalahan saat memuat data.</div>";
                        });
                });
            </script>


            <!-- /.table-responsive -->

        </div>
        <!-- /.panel-body -->
    </div>
    <!-- /.panel -->
</div>
<!-- /.col-lg-12 -->
</div>
<!-- /.row -->