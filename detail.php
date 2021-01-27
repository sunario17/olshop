<?php
session_start();

include 'config/koneksi.php';
// mendapatkan id_produk dari url
$id_produk = $_GET["id"];
// query ambil data
$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
$detail = $ambil->fetch_assoc();

// echo "<pre>";
// print_r($detail);
// echo "</pre>";
?>
<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Detail Produk</title>

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
      <?php include 'menu.php'; ?>
      <!-- End Navbar -->

      <!-- contents -->
      <section class="contents">
            <div class="container">
                  <div class="row">
                        <div class="col-md-6">
                              <img src="assets/images/foto_produk/<?= $detail['foto_produk']; ?>" alt=" nama foto" class="img-responsive">
                        </div>
                        <div class="col-md-6">
                              <h2><?= $detail["nama_produk"]; ?></h2>
                              <h4>Rp. <?= number_format($detail["harga_produk"]); ?></h4>

                              <h5>Stok : <?= $detail["stok_produk"]; ?></h5>

                              <form method="POST">
                                    <div class="form-group">
                                          <div class="input-group">
                                                <input type="number" min="1" class="form-control" name="jumlah" max="<?= $detail["stok_produk"]; ?>">
                                                <div class="input-group-btn">
                                                      <button class="btn btn-primary" name="beli">Beli</button>
                                                </div>
                                          </div>
                                    </div>
                              </form>

                              <?php
                              // jk ada tombol beli
                              if (isset($_POST["beli"])) {
                                    // masukan jmlh yg  di inputkan
                                    $jumlah = $_POST["jumlah"];
                                    // masukkn di keranjng belanja
                                    $_SESSION["keranjang"]["$id_produk"] = $jumlah;


                                    echo "<script>alert('Produk telah masuk ke keranjang');</script>";
                                    echo "<script>location='keranjang.php';</script>";
                              }
                              ?>

                              <p><?= $detail['deskripsi_produk']; ?></p>
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