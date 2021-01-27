<?php
session_start();

include 'config/koneksi.php';
// jika tidak ada session pelanggan(blm login)
if (!isset($_SESSION["pelanggan"]) or empty($_SESSION["pelanggan"])) {
      echo "<script>alert('Silahkan login');</script>";
      echo "<script>location='login.php';</script>";
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

      <!-- <pre><?php print_r($_SESSION) ?></pre> -->

      <section class="riwayat">
            <div class="container">
                  <h3>Riwayat Belanja <?= $_SESSION["pelanggan"]["nama_pelanggan"] ?> </h3>

                  <table class="table table-bordered">
                        <thead>
                              <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th>Total</th>
                                    <th>Opsi</th>
                              </tr>
                        </thead>
                        <tbody>

                              <?php
                              $no = 1;
                              // mendapatkan id_pelanggan yg login dari session
                              $id_pelanggan = $_SESSION["pelanggan"]['id_pelanggan'];

                              $ambil =   $koneksi->query("SELECT * FROM pembelian WHERE id_pelanggan='$id_pelanggan'");
                              while ($pecah =  $ambil->fetch_assoc()) {
                              ?>
                                    <tr>
                                          <td><?= $no; ?></td>
                                          <td><?= $pecah["tanggal_pembelian"]; ?></td>
                                          <td>
                                                <?= $pecah["status_pembelian"]; ?>
                                                <br>
                                                <?php if (!empty($pecah['resi_pengiriman'])) : ?>
                                                      Resi : <?= $pecah['resi_pengiriman']; ?>
                                                <?php endif ?>
                                          </td>
                                          <td>Rp. <?= number_format($pecah["total_pembelian"]); ?></td>
                                          <td>
                                                <a href="nota.php?id=<?= $pecah["id_pembelian"]; ?>" class="btn btn-info btn-xs">Nota</a>

                                                <?php if ($pecah['status_pembelian'] == "pending") : ?>
                                                      <a href="pembayar.php?id=<?= $pecah["id_pembelian"]; ?>" class="btn btn-success btn-xs">
                                                            Input Pembayaran
                                                      </a>
                                                <?php else : ?>
                                                      <a href="lihat_pembayaran.php?id=<?= $pecah["id_pembelian"]; ?>" class="btn btn-warning btn-xs">Lihat Pembayaran</a>
                                                <?php endif; ?>
                                          </td>
                                    </tr>
                                    <?php $no++ ?>
                              <?php } ?>
                        </tbody>
                  </table>
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