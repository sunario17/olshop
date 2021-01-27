<?php
session_start();

include 'config/koneksi.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Nota Pembelian</title>

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
      <!-- navbar -->
      <?php
      include 'menu.php';
      ?>
      <!-- End Navbar -->

      <section class="konten">
            <div class="container">

                  <!-- nota disini copas saja dari nota yg ada di admin -->
                  <h2>Detail Pembelian</h2>
                  <div class="pull-right">
                        <a href="index.php" class="btn btn-warning btn-xs"> <i class="glyphicon glyphicon-refresh"></i> Kembali</a>
                  </div>
                  <?php
                  $ambil = $koneksi->query("SELECT * FROM pembelian pb JOIN pelanggan pl
                                ON pb.id_pelanggan=pl.id_pelanggan
                                WHERE pb.id_pembelian='$_GET[id]'");
                  $detail = $ambil->fetch_assoc();
                  ?>
                  <!-- <h1>Data orang yang beli $detail</h1>
                  <pre><?php print_r($detail); ?></pre>

                  <h1>Data orang yg login di session</h1>
                  <pre><?php print_r($_SESSION); ?></pre> -->

                  <!-- jika pelanggan yg beli tidak sama dengan pelanggan yg login, maka dilarikan ke hal.riwayat karena dia tidak berhak melihat nota orang lain -->
                  <!-- pelanggan yg beli harus pelanggan yg login -->
                  <?php
                  //mendapatkan id_pelanggan yg beli
                  $idpelangganygbeli = $detail["id_pelanggan"];

                  // mendapatkan id_pelanggan yg login
                  $idpelangganyglogin =  $_SESSION["pelanggan"]["id_pelanggan"];

                  if ($idpelangganygbeli !== $idpelangganyglogin) {
                        echo "<script>alert('Jangan nakal');</script>";
                        echo "<script>location='riwayat.php';</script>";
                        exit();
                  }
                  ?>

                  <div class="row">
                        <div class="col-md-4">
                              <h3>Pembelian</h3>
                              <strong class="alert-danger bg-color-red ">No. Pembelian: <?= $detail['id_pembelian']; ?></strong><br>
                              Tanggal : <?= $detail['tanggal_pembelian']; ?><br>
                              Total : Rp. <?= number_format($detail['total_pembelian']); ?>
                        </div>
                        <div class="col-md-4">
                              <h3>Pelanggan</h3>
                              <strong class="alert-danger bg-color-red ">Nama Pelanggan : <?= $detail['nama_pelanggan']; ?></strong>
                              <p>
                                    No. Telepon : <?= $detail['telepon_pelanggan']; ?><br>
                                    Email : <?= $detail['email_pelanggan']; ?>
                              </p>
                        </div>
                        <div class="col-md-4">
                              <h3>Pengiriman</h3>
                              <strong class="alert-danger bg-color-red ">Lokasi Pengiriman : <?= $detail['nama_kota']; ?></strong><br>
                              Ongkos Kirim : Rp. <?= number_format($detail['tarif']); ?><br>
                              Alamat Lengkap Pengiriman : <?= $detail['alamat_pengiriman']; ?>
                        </div>
                  </div>

                  <table class="table table-bordered">
                        <thead>
                              <tr>
                                    <th>No</th>
                                    <th>Nama Produk</th>
                                    <th>Harga</th>
                                    <th>Berat</th>
                                    <th>Jumlah</th>
                                    <th>Subberat</th>
                                    <th>Subtotal</th>
                              </tr>
                        </thead>
                        <tbody>
                              <?php $no = 1; ?>
                              <?php $ambil = $koneksi->query("SELECT * FROM pembelian_produk WHERE  id_pembelian='$_GET[id]'"); ?>
                              <?php while ($pecah = $ambil->fetch_assoc()) { ?>
                                    <!-- <pre><?= print_r($pecah); ?>)</pre> -->
                                    <tr>
                                          <td><?= $no; ?></td>
                                          <td><?= $pecah['nama']; ?></td>
                                          <td>Rp. <?= number_format($pecah['harga']); ?></td>
                                          <td><?= $pecah['berat']; ?> Gr.</td>
                                          <td> <?= $pecah['jumlah']; ?></td>
                                          <td> <?= $pecah['subberat']; ?> Gr.</td>
                                          <td> Rp. <?= number_format($pecah['subharga']); ?></td>

                                    </tr>
                                    <?php $no++; ?>
                              <?php } ?>
                        </tbody>
                  </table>

                  <div class="row">
                        <div class="col-md-7">
                              <div class="alert alert-info">
                                    <p>
                                          Silahkan melakukan pembayaran Rp. <?= number_format($detail['total_pembelian']); ?> ke <br>
                                          <strong>BANK MANDIRI 198899800 AN. SUNARIO</strong>
                                    </p>
                              </div>
                        </div>
                  </div>


            </div>
      </section>

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