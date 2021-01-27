<h2>Tambah Pelanggan</h2>
<div class="pull-right">
    <a href="index.php?halaman=pelanggan" class="btn btn-warning btn-xs"> <i class="glyphicon glyphicon-refresh"></i> Kembali</a>
</div>

<form method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label>Nama</label><input type="text" class="form-control" name="nama">
    </div>
    <div class="form-group">
        <label>E-mail</label> <input type="text" class="form-control" name="email">
    </div>
    <div class="form_group">
        <label>Telp/No Hp</label> <input type="number" class="form-control" name="telepon">
    </div>
    <div class="form-group">
        <label>Foto</label> <input type="file" class="form-control" name="foto">
    </div>
    <button class="btn btn-primary" name="save">Simpan</button>
</form>




<?php
if (isset($_POST['save'])) {
    $nama =  $_FILES['foto']['name'];
    $lokasi = $_FILES['foto']['tmp_name'];
    move_uploaded_file($lokasi, "../assets/images/foto_pelanggan/" . $nama);
    $koneksi->query("INSERT INTO pelanggan
    (nama_pelanggan, email_pelanggan, foto_pelanggan, telepon_pelanggan)
    VALUES ('$_POST[nama]', '$_POST[email]', '$nama', '$_POST[telepon]')");

    echo "<div class='alert alert-info'>Data Tersimpan</div>";
    echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=pelanggan'>";
}
?>