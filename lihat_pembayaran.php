<?php
session_start();

include 'config/koneksi.php';

$id_pembelian = $_GET["id"];

$ambil = $koneksi->query("SELECT * FROM pembayaran pb
            LEFT JOIN pembelian pl ON pb.id_pembelian=pl.id_pembelian
            WHERE pl.id_pembelian='$id_pembelian' ");
$detbay = $ambil->fetch_assoc();

// echo "<pre>";
// print_r($detbay);
// echo "</pre>";
// jika belum ada data pembayaran
if (empty($detbay)) {
      echo "<script>alert('Belum ada data pembayaran');</script>";
      echo "<script>location='riwayat.php';</script>";
      exit();
}

//jika data pelanggan yg bayar tidak sesuai dengan pelanggan yg login
// echo "<pre>";
// print_r($_SESSION);
// echo "</pre>";
if ($_SESSION["pelanggan"]['id_pelanggan'] !== $detbay["id_pelanggan"]) {
      echo "<script>alert('Anda tidak berhak melihat pembayaran orang lain');</script>";
      echo "<script>location='riwayat.php';</script>";
      exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title> halaman Riwayat</title>

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

      <?php
      include 'menu.php'
      ?>

      <div class="container">
            <h3>Lihat Pembayaran</h3>
            <div class="row">
                  <div class="col-md-6">
                        <table class="table">
                              <tr>
                                    <th>Nama</th>
                                    <td><?= $detbay["nama"]; ?></td>
                              </tr>
                              <tr>
                                    <th>Bank</th>
                                    <td><?= $detbay["bank"]; ?></td>
                              </tr>
                              <tr>
                                    <th>Tanggal</th>
                                    <td><?= $detbay["tanggal"]; ?></td>
                              </tr>
                              <tr>
                                    <th>Jumlah</th>
                                    <td>Rp. <?= number_format($detbay["jumlah"]); ?></td>
                              </tr>
                        </table>
                  </div>
                  <div class="col-md-6">
                        <img src="assets/images/bukti_pembayaran/<?= $detbay["bukti"]; ?>" alt=" bukti " class=" img-responsive">
                  </div>
            </div>
      </div>

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