<?php

$ambil = $koneksi->query("SELECT * FROM  pelanggan WHERE id_pelanggan='$_GET[id]'");
$pecah = $ambil->fetch_assoc();
$fotopelanggan = $pecah['foto_pelanggan'];
if (file_exists("../assets/images/foto_pelanggan/$fotopelanggan")) {
      unlink("../assets/images/foto_pelanggan/$fotopelanggan");
}


$koneksi->query("DELETE FROM pelanggan WHERE id_pelanggan='$_GET[id]'");

echo "<script>alert('pelanggan terhapus')</script>";
echo "<script>location='index.php?halaman=pelanggan'</script>";
