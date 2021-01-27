<?php
session_start();

include 'config/koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Halaman Utama</title>

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

      <!-- < !--contents-->
      <section class="contents">
            <div class="container" id="container">
                  <h1> Produk Terbaru </h1>
                  <div class="row">
                        <?php $ambil = $koneksi->query("SELECT * FROM produk "); ?>
                        <?php while ($perproduk = $ambil->fetch_assoc()) { ?>

                              <div class="col-md-3">
                                    <div class="thumbnail">
                                          <img src="assets/images/foto_produk/<?= $perproduk['foto_produk']; ?>" alt="nama foto">
                                          <div class="caption">
                                                <h3> <?= $perproduk['nama_produk']; ?> </h3>
                                                <h5> Rp.<?= number_format($perproduk['harga_produk']); ?> </h5> <a href="beli.php?id=<?= $perproduk['id_produk']; ?>" class="btn btn-primary"> Beli </a> <a href="detail.php?id=<?= $perproduk['id_produk']; ?>" class="btn btn-default"> Detail </a>
                                          </div>
                                    </div>
                              </div> <?php } ?> </div>
            </div>
      </section>
      <!--End Contents-->

      <!-- < !--BOOTSTRAP SCRIPTS-->
      <script script src="assets/js/bootstrap.min.js">
      </script>
      <!-- METISMENU SCRIPTS -->
      <script src="assets/js/jquery.metisMenu.js"></script>
      <!-- MORRIS CHART SCRIPTS -->
      <script src="assets/js/morris/raphael-2.1.0.min.js"></script>
      <script src="assets/js/morris/morris.js"></script>
      <!-- CUSTOM SCRIPTS -->
      <script src="assets/js/custom.js"></script>

</body>

</html>