<h2>Ubah Produk</h2>
<?php
$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$_GET[id]'");
$pecah = $ambil->fetch_assoc();

// echo "<pre>";
// print_r($pecah);
// echo "</pre>";
?>

<?php
$datakategori = array();

$ambil = $koneksi->query("SELECT * FROM kategori");
while ($tiap = $ambil->fetch_assoc()) {
      $datakategori[] = $tiap;
}

// echo "<pre>";
// print_r($datakategori);
// echo "</pre>";
?>

<div class="pull-right">
      <a href="index.php?halaman=produk" class="btn btn-warning btn-xs"> <i class="glyphicon glyphicon-refresh"></i> Kembali</a>
</div>
<form method="POST" enctype="multipart/form-data">

      <div class="form-group">
            <label for="kategori">Kategori</label><select name="id_kategori" id="kategori" class="form-control">
                  <option value="">- Pilih Kategori -</option>
                  <?php foreach ($datakategori as $key => $value) : ?>
                        <option value="<?= $value["id_kategori"]; ?>" <?php if ($pecah["id_kategori"] == $value["id_kategori"]) {
                                                                              echo "selected";
                                                                        } ?>><?= $value["nama_kategori"]; ?>

                        </option>
                  <?php endforeach ?>
            </select>
      </div>
      <div class="form-group">
            <label>Nama Produk</label><input type="text" class="form-control" name="nama" value="<?= $pecah['nama_produk']; ?>">
      </div>
      <div class="form-group">
            <label>harga (Rp.)</label> <input type="number" class="form-control" name="harga" value="<?= $pecah['harga_produk']; ?>">
      </div>
      <div class=" form-group">
            <label>Berat (Gr)</label> <input type="number" class="form-control" name="berat" value="<?= $pecah['berat_produk']; ?>">
      </div>
      <div class=" form-group">
            <label>Stok</label> <input type="number" class="form-control" name="stok" value="<?= $pecah['stok_produk']; ?>">
      </div>
      <div class="form-group">
            <img src="../assets/images/foto_produk/<?= $pecah['foto_produk']; ?>" width="200">
      </div>
      <div class="form-group">
            <label>Ganti Foto</label> <input type="file" name="foto" class="form-control">
      </div>
      <div class="form-group">
            <label>Deskripsi</label> <textarea class="form-control" name="deskripsi" rows="10"><?= $pecah['deskripsi_produk']; ?></textarea>
      </div>
      <button class=" btn btn-primary" name="ubah"> <i class="glyphicon glyphicon-edit"></i> Ubah</button>
</form>

<?php
if (isset($_POST['ubah'])) {
      $namafoto = $_FILES['foto']['name'];
      $lokasifoto = $_FILES['foto']['tmp_name'];

      // jika foto diubah
      if (!empty($lokasifoto)) {

            move_uploaded_file($lokasifoto, "../assets/images/foto_produk/$namafoto");

            $koneksi->query("UPDATE produk SET nama_produk='$_POST[nama]', harga_produk=' $_POST[harga]', berat_produk= '$_POST[berat]', stok_produk= '$_POST[stok]', foto_produk='$namafoto', deskripsi_produk= '$_POST[deskripsi]' , id_kategori=$_POST[id_kategori]
            WHERE id_produk='$_GET[id]'");
      } else {
            $koneksi->query("UPDATE produk SET nama_produk='$_POST[nama]', harga_produk=' $_POST[harga]', berat_produk= '$_POST[berat]', stok_produk= '$_POST[stok]',deskripsi_produk= '$_POST[deskripsi]', id_kategori=$_POST[id_kategori]
            WHERE id_produk='$_GET[id]'");
      }
      echo "<script>alert('data produk telah diubah')</script>";
      echo "<script>location='index.php?halaman=produk'</script>";
}

?>