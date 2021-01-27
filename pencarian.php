<?php
include 'config/koneksi.php';

$keyword = $_POST["keyword"];
$semuadata = array();
$ambil = $koneksi->query("SELECT * FROM produk WHERE nama_produk LIKE '%$keyword%'
                                                                      OR deskripsi_produk LIKE '%$keyword%'");
while ($pecah = $ambil->fetch_assoc()) {
      $semuadata[] = $pecah;
}
// var_dump($semuadata);
// die;
?>

<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Pencarian </title>

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
            <h3>Hasil Pencarian : <?= $keyword; ?></h3>

            <?php if (empty($semuadata)) : ?>
                  <div class="alert alert-danger">Produk <strong><?= $keyword; ?></strong> tidak di temukan</div>
            <?php endif ?>

            <div class="row">
                  <?php foreach ($semuadata as $key => $value) : ?>

                        <div class="col-md-3">
                              <div class="thumbnail">
                                    <img src="assets/images/foto_produk/<?= $value["foto_produk"]; ?>" alt="gambar produk" class="img-responsive">
                                    <div class="caption">
                                          <h3><?= $value['nama_produk']; ?></h3>
                                          <h5>Rp. <?= number_format($value['harga_produk']); ?></h5>
                                          <a href="beli.php?id=<?= $value['id_produk']; ?>" class="btn btn-primary">Beli</a>
                                          <a href="detail.php?id=<?= $value['id_produk']; ?>" class="btn btn-default">Detail</a>
                                    </div>
                              </div>
                        </div>
                  <?php endforeach ?>
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