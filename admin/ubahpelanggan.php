<h2>Ubah Pelanggan</h2>
<?php
$ambil = $koneksi->query("SELECT * FROM pelanggan WHERE id_pelanggan='$_GET[id]'");
$pecah = $ambil->fetch_assoc();

// echo "<pre>";
// print_r($pecah);
// echo "</pre>";
?>
<div class="pull-right">
      <a href="index.php?halaman=pelanggan" class="btn btn-warning btn-xs"> <i class="glyphicon glyphicon-refresh"></i> Kembali</a>
</div>
<form method="POST" enctype="multipart/form-data">
      <div class="form-group">
            <label>Nama Pelanggan</label><input type="text" class="form-control" name="nama" value="<?= $pecah['nama_pelanggan']; ?>">
      </div>
      <div class=" form_group">
            <label>E-mail</label> <input type="text" class="form-control" name="email" value="<?= $pecah['email_pelanggan']; ?>">
      </div>
      <div class="form-group">
            <img src="../assets/images/foto_pelanggan/<?= $pecah['foto_pelanggan']; ?>" width="200" style="margin-top: 10px;">
      </div>
      <div class="form-group">
            <label>Ganti Foto</label> <input type="file" name="foto" class="form-control">
      </div>
      <div class="form-group">
            <label>Telp/No Hp</label> <textarea class="form-control" name="telepon" rows="10"><?= $pecah['telepon_pelanggan']; ?></textarea>
      </div>
      <button class=" btn btn-primary" name="ubah"><i class="glyphicon glyphicon-edit"></i> Ubah</button>
</form>

<?php
if (isset($_POST['ubah'])) {
      $namafoto = $_FILES['foto']['name'];
      $lokasifoto = $_FILES['foto']['tmp_name'];


      if (!empty($lokasifoto)) {

            move_uploaded_file($lokasifoto, "../assets/images/foto_pelanggan/$namafoto");

            $koneksi->query("UPDATE pelanggan SET nama_pelanggan='$_POST[nama]', email_pelanggan=' $_POST[email]',
            foto_pelanggan='$namafoto', telepon_pelanggan= '$_POST[telepon]'  WHERE id_pelanggan='$_GET[id]'");
      } else {
            $koneksi->query("UPDATE pelanggan SET nama_pelanggan='$_POST[nama]', email_pelanggan=' $_POST[email]',
           telepon_pelanggan= '$_POST[telepon]'  WHERE id_pelanggan='$_GET[id]'");
      }
      echo "<script>alert('data pelanggan telah diubah')</script>";
      echo "<script>location='index.php?halaman=pelanggan'</script>";
}
?>