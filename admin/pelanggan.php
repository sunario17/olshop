<h2>Halaman Pelanggan</h2>
<hr>
<div class="pull-right">
    <a href="index.php?halaman=tambahpelanggan" class="btn btn-primary btn-sm" style="margin-bottom: 10px;"><i class="glyphicon glyphicon-plus"></i> Tambah Pelanggan</a>
</div>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>E-mail</th>
            <th>foto</th>
            <th>Telepon</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; ?>
        <?php $ambil = $koneksi->query("SELECT * FROM pelanggan") ?>
        <?php while ($pecah = $ambil->fetch_assoc()) { ?>
            <tr>
                <td><?= $no; ?></td>
                <td><?= $pecah['nama_pelanggan']; ?></td>
                <td><?= $pecah['email_pelanggan']; ?></td>
                <td>
                    <img src="../assets/images/foto_pelanggan/<?= $pecah['foto_pelanggan']; ?>" width="100">
                </td>
                <td><?= $pecah['telepon_pelanggan']; ?></td>
                <td align="center ">
                    <a href="index.php?halaman=ubahpelanggan&id=<?= $pecah['id_pelanggan']; ?>" class="btn btn-warning  btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a>
                    <a href="index.php?halaman=hapuspelanggan&id=<?= $pecah['id_pelanggan']; ?>" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Hapus</a>
                </td>
            </tr>
            <?php $no++ ?>
        <?php } ?>
    </tbody>
</table>