<h2>Detail Pembelian</h2>
<?php
$ambil = $koneksi->query("SELECT * FROM pembelian pb JOIN pelanggan pl
                                ON pb.id_pelanggan=pl.id_pelanggan
                                WHERE pb.id_pembelian='$_GET[id]'");
$detail = $ambil->fetch_assoc();
?>
<!-- <pre><?= print_r($detail); ?></pre> -->





<div class="row">
    <div class="col-md-4">
        <h3>Pembelian</h3>
        <p>
            Tanggal : <?= $detail['tanggal_pembelian']; ?><br>
            Total : <?= number_format($detail['total_pembelian']); ?><br>
            Status : <?= $detail['status_pembelian']; ?>
        </p>
    </div>
    <div class="col-md-4">
        <h3>Pelanggan</h3>
        <strong><?= $detail['nama_pelanggan']; ?></strong> <br>
        <p>
            <?= $detail['telepon_pelanggan']; ?><br>
            <?= $detail['email_pelanggan']; ?>
        </p>
    </div>
    <div class="col-md-4">
        <h3>Pengiriman</h3>
        <strong><?= $detail["nama_kota"]; ?></strong> <br>
        <p>
            Tarif : Rp. <?= number_format($detail["tarif"]); ?><br>
            Alamat : <?= $detail["alamat_pengiriman"]; ?>
        </p>
    </div>
</div>

<table class="table table-bordered">
    <tr>
        <th>No</th>
        <th>Nama Produk</th>
        <th>harga</th>
        <th>Jumlah</th>
        <th>Subtotal</th>
    </tr>
    <tbody>
        <?php $no = 1; ?>
        <?php $ambil = $koneksi->query("SELECT * FROM pembelian_produk pp JOIN produk p
                            ON pp.id_produk=p.id_produk
                            WHERE pp.id_pembelian='$_GET[id]'"); ?>
        <?php while ($pecah =  $ambil->fetch_assoc()) { ?>
            <!-- <pre><?= print_r($pecah); ?>)</pre> -->
            <tr>
                <td><?= $no; ?></td>
                <td><?= $pecah['nama_produk']; ?></td>
                <td><?= number_format($pecah['harga_produk']); ?></td>
                <td> <?= $pecah['jumlah'] ?></td>
                <td>
                    Rp. <?= number_format($pecah['harga_produk'] * $pecah['jumlah']); ?>
                </td>
            </tr>
            <?php $no++; ?>
        <?php } ?>
    </tbody>
</table>