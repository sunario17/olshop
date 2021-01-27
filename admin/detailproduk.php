<?php

$id_produk = $_GET["id"];

$ambil = $koneksi->query("SELECT * FROM produk p LEFT JOIN kategori k ON p.id_kategori=k.id_kategori
                        WHERE id_produk='$id_produk'");
$detailproduk =  $ambil->fetch_assoc();

$fotoproduk = array();
$ambilfoto = $koneksi->query("SELECT * FROM produk_foto  WHERE id_produk='$id_produk'");
while ($tiap =  $ambilfoto->fetch_assoc()) {
      $fotoproduk[] = $tiap;
}

// echo "<pre>";
// // print_r($detailproduk);
// print_r($fotoproduk);
// echo "</pre>";
?>
<h2>Detail Produk</h2>
<hr>
<div class="pull-right">
      <a href="index.php?halaman=produk" class="btn btn-warning btn-xs" style="margin-bottom: 10px;"> <i class="glyphicon glyphicon-refresh"></i> Kembali</a>
</div>

<table class="table">
      <tr>
            <th>Kategori</th>
            <td><?= $detailproduk["nama_kategori"]; ?></td>
      </tr>
      <tr>
            <th>Produk</th>
            <td><?= $detailproduk["nama_produk"]; ?></td>
      </tr>
      <tr>
            <th>Harga</th>
            <td><?= number_format($detailproduk["harga_produk"]); ?></td>
      </tr>
      <tr>
            <th>Berat</th>
            <td><?= $detailproduk["berat_produk"]; ?></td>
      </tr>
      <tr>
            <th>Deskripsi</th>
            <td><?= $detailproduk["deskripsi_produk"]; ?></td>
      </tr>
      <tr>
            <th>Stok</th>
            <td><?= $detailproduk["stok_produk"]; ?></td>
      </tr>

</table>

<div class="row">

      <?php foreach ($fotoproduk as $key => $value) : ?>
            <div class="col-md-3 text-center">
                  <img src="../assets/images/foto_produk/<?= $value["nama_produk_foto"]; ?>" alt="nama_produk_foto" class="img-responsive"><br>
                  <a href="index.php?halaman=hapusfotoproduk&idfoto=<?= $value["id_produk_foto"] ?>&idproduk=<?= $id_produk ?>" onclick="return confirm('Yakin akan menghapus data')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Hapus</a>
            </div>
      <?php endforeach ?>
</div>

<form action="" method="POST" enctype="multipart/form-data">
      <div class="form-group">
            <label>File Foto</label>
            <input type="file" name="fotomu">
      </div>
      <button class="btn btn-primary" name="simpan" value="simpan"><i class="glyphicon glyphicon-saved"></i> Simpan</button>
</form>

<?php
if (isset($_POST["simpan"])) {
      $lokasifoto =  $_FILES["fotomu"]["tmp_name"];
      $namafoto = $_FILES["fotomu"]["name"];

      $namafoto =   date("YmdHis") . $namafoto;

      // upload
      move_uploaded_file($lokasifoto, "../images/foto_produk/" . $namafoto);

      $koneksi->query("INSERT INTO produk_foto(id_produk, nama_produk_foto) VALUES ('$id_produk', '$namafoto')");

      echo "<script>alert('foto produk berhasil di simpan')</script>";
      echo "<script>location='index.php?halaman=detailproduk&id=$id_produk';</script>";
}
?>