<h2>Halaman Pembelian</h2>
<hr>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Pelanggan</th>
            <th>Tanggal</th>
            <th> Status Pembelian</th>
            <th>Total</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; ?>
        <?php $ambil = $koneksi->query("SELECT * FROM pembelian pb JOIN pelanggan pl ON pb.id_pelanggan=pl.id_pelanggan"); ?>
        <?php while ($pecah = $ambil->fetch_assoc()) {

            // echo "<pre>";
            // print_r($pecah["status_pembelian"]);
            // echo "</pre>";
        ?>

            <tr>
                <td><?= $no; ?></td>
                <td><?= $pecah['nama_pelanggan']; ?></td>
                <td><?= $pecah['tanggal_pembelian']; ?></td>
                <td><?= $pecah['status_pembelian']; ?></td>
                <td><?= $pecah['total_pembelian']; ?></td>
                <td>
                    <a href="index.php?halaman=detail&id=<?= $pecah['id_pembelian']; ?>" class="btn btn-info btn-xs">Detail</a>

                    <?php if ($pecah['status_pembelian'] !== "pending") :  ?>
                        <a href="index.php?halaman=pembayaran&id=<?= $pecah['id_pembelian']; ?>" class="btn btn-success btn-xs">Pembayaran</a>
                    <?php endif ?>
                </td>
            </tr>
            <?php $no++; ?>
        <?php } ?>
    </tbody>
</table>