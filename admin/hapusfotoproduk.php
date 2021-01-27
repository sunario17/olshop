<?php


$id_foto = $_GET["idfoto"];
$id_produk = $_GET["idproduk"];


// ambil dulu datanya
$ambilfoto = $koneksi->query("SELECT * FROM produk_foto WHERE  id_produk_foto= '$id_foto'");
$detaifoto = $ambilfoto->fetch_assoc();

$namafilefoto = $detaifoto["nama_produk_foto"];

// // hapus file foto dari folder
unlink("../assets/images/foto_produk/" . $namafilefoto);

// menghapus data di mySQL
$koneksi->query("DELETE FROM produk_foto WHERE  id_produk_foto= '$id_foto'");

echo "<script>alert('foto produk berhasil di hapus')</script>";
echo "<script>location='index.php?halaman=detailproduk&id=$id_produk';</script>";
