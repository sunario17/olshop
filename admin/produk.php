<h2>Data Produk</h2>
<hr>
<div class="pull-right">
    <a href="index.php?halaman=tambahproduk" class="btn btn-primary btn-sm" style="margin-bottom: 10px;"><i class="glyphicon glyphicon-plus"></i> Tambah Produk</a>
</div>


<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Kategori</th>
            <th>Nama</th>
            <th>Harga</th>
            <th>Berat</th>
            <th>Stok</th>
            <th>Foto</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; ?>
        <?php $ambil = $koneksi->query("SELECT * FROM produk LEFT JOIN kategori ON  produk.id_kategori=kategori.id_kategori"); ?>
        <?php while ($pecah = $ambil->fetch_assoc()) { ?>
            <tr>
                <td><?= $no;  ?></td>
                <td><?= $pecah['nama_kategori']; ?></td>
                <td><?= $pecah['nama_produk']; ?></td>
                <td><?= number_format($pecah['harga_produk']);  ?></td>
                <td><?= $pecah['berat_produk']; ?></td>
                <td><?= $pecah['stok_produk']; ?></td>
                <td>
                    <img src="../assets/images/foto_produk/<?= $pecah['foto_produk']; ?>" width="100">
                </td>
                <td align="center">
                    <a href="index.php?halaman=ubahproduk&id=<?= $pecah['id_produk']; ?>" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a>
                    <a href="index.php?halaman=hapusproduk&id=<?= $pecah['id_produk']; ?>" onclick="return confirm('Yakin akan menghapus data')" class=" btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Hapus</a>
                    <a href="index.php?halaman=detailproduk&id=<?= $pecah['id_produk']; ?>" class=" btn btn-info btn-xs"><i class="glyphicon glyphicon-eyes"></i> Detail</a>
                </td>
            </tr>
            <?php $no++; ?>
        <?php } ?>
    </tbody>
</table>