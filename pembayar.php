<?php
session_start();

include 'config/koneksi.php';

// jika tidak ada session pelanggan(blm login)
if (!isset($_SESSION["pelanggan"]) or empty($_SESSION["pelanggan"])) {
      echo "<script>alert('Silahkan login');</script>";
      echo "<script>location='login.php';</script>";
      exit();
}

// mendapatkan id_pembelian dari url
$idpem = $_GET["id"];
$ambil = $koneksi->query("SELECT * FROM pembelian WHERE id_pembelian='$idpem'");
$detpem = $ambil->fetch_assoc();

// echo "<pre>";
// print_r($detpem);
// print_r($_SESSION);
// echo "</pre>";

// mendapatkan id_pelanggan yg beli
$id_pelanggan_beli = $detpem["id_pelanggan"];
// mendapatkan id_pelanggan yg login
$id_pelanggan_login = $_SESSION["pelanggan"]["id_pelanggan"];

if ($id_pelanggan_login !== $id_pelanggan_beli) {
      echo "<script>alert('Jangan nakal');</script>";
      echo "<script>location='riwayat.php';</script>";
      exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Halaman Pembayaran</title>

      <!-- CSS Sendiri -->
      <link href="assets/css/style.css" rel="stylesheet" />
      <!-- BOOTSTRAP STYLES-->
      <link href="assets/css/bootstrap.css" rel="stylesheet" />
      <!-- FONTAWESOME STYLES-->
      <link href="assets/css/font-awesome.css" rel="stylesheet" />
      <!-- MORRIS CHART STYLES-->
      <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
      <!-- CUSTOM STYLES-->
      <link href="assets/css/custom.css" rel="stylesheet" />
      <!-- GOOGLE FONTS-->
      <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
      <!-- JQUERY SCRIPTS -->
      <script src="assets/js/jquery-1.10.2.js"></script>

</head>

<body>
      <?php include 'menu.php'; ?>

      <div class="container">
            <h2>Konfirmasi Pembayaran</h2>
            <p>Kirim bukti pembayaran Anda disini</p>
            <div class="alert alert-info">Total tagihan Anda <strong>Rp. <?= number_format($detpem["total_pembelian"]); ?></strong></div>


            <form method="post" enctype="multipart/form-data">
                  <div class="form-group">
                        <label for="nama">Nama Penyetor</label>
                        <input type="text" name="nama" id="nama" class="form-control">
                  </div>
                  <div class="form-group">
                        <label for="bank">Bank</label>
                        <input type="text" name="bank" id="bank" class="form-control">
                  </div>
                  <div class="form-group">
                        <label for="jumlah">Jumlah</label>
                        <input type="number" name="jumlah" id="jumlah" class="form-control" min="1">
                  </div>
                  <div class="form-group">
                        <label for="bukti">Foto Bukti</label>
                        <input type="file" name="bukti" id="bukti" class="form-control">
                        <p class="text-danger">foto bukti harus JPG maksimal 2MB</p>
                  </div>
                  <button class="btn btn-primary" name="kirim">Kirim</button>
            </form>
      </div>

      <?php
      // jika ada tombol kirim (ditekan)
      if (isset($_POST["kirim"])) {
            // upload dulu foto bukti
            $namabukti =   $_FILES["bukti"]["name"];
            $lokasibukti =  $_FILES["bukti"]["tmp_name"];
            $namafiks = date("YmdHis") . $namabukti;
            move_uploaded_file($lokasibukti, "assets/images/bukti_pembayaran/$namafiks");

            $nama = $_POST["nama"];
            $bank =  $_POST["bank"];
            $jumlah = $_POST["jumlah"];
            $tanggal = date("Y-m-d");

            //  Simpan Pembayaran
            $koneksi->query("INSERT INTO pembayaran(id_pembelian, nama, bank, jumlah, tanggal, bukti)
            VALUES ('$idpem', '$nama', '$bank', '$jumlah', '$tanggal', '$namafiks')");

            // Update dong data pembeliannya dari pending menjadi sudah kirim pembayaran
            $koneksi->query("UPDATE pembelian SET status_pembelian='Sudah kirim pembayaran'
                                     WHERE id_pembelian='$idpem'");
            echo "<script>alert('Terimakasih sudah mengirimkan bukti pembayaran');</script>";
            echo "<script>location='riwayat.php';</script>";
      }
      ?>

      <!-- BOOTSTRAP SCRIPTS -->
      <script src="assets/js/bootstrap.min.js"></script>
      <!-- METISMENU SCRIPTS -->
      <script src="assets/js/jquery.metisMenu.js"></script>
      <!-- MORRIS CHART SCRIPTS -->
      <script src="assets/js/morris/raphael-2.1.0.min.js"></script>
      <script src="assets/js/morris/morris.js"></script>
      <!-- CUSTOM SCRIPTS -->
      <script src="assets/js/custom.js"></script>


</body>

</html>