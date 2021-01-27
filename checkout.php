<?php
session_start();

include 'config/koneksi.php';
// jika tidak ada session pelanggan (blm login), maka dilarikan ke menu login|login.php
if (!isset($_SESSION["pelanggan"])) {
      echo "<script>alert('Silahkan Login');</script>";
      echo "<script>location='login.php';</script>";
}

// echo "<pre>";
// print_r($_SESSION['keranjang']);
// echo "</pre>";
?>

<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Check Out</title>
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

      <section class="contents">
            <div class="container">
                  <h1>Keranjang Belanja</h1>
                  <hr>
                  <table class="table table-bordered">
                        <thead>
                              <tr>
                                    <th>No</th>
                                    <th>Produk</th>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                    <th>Subharga</th>
                              </tr>
                        </thead>
                        <tbody>
                              <?php $no = 1; ?>
                              <?php $totalbelanja = 0; ?>
                              <?php foreach ($_SESSION["keranjang"] as $id_produk => $jumlah) : ?>
                                    <!-- menampilkan produk yg sedang diperulangkan berdasarkan id_produk -->
                                    <?php
                                    $ambil =  $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
                                    $pecah = $ambil->fetch_assoc();
                                    $subharga = $pecah["harga_produk"] * $jumlah;
                                    // echo "<pre>";
                                    // print_r($pecah);
                                    // echo "</pre>";
                                    ?>
                                    <tr>
                                          <td><?= $no; ?></td>
                                          <td><?= $pecah["nama_produk"]; ?></td>
                                          <td>Rp. <?= number_format($pecah["harga_produk"]); ?></td>
                                          <td><?= $jumlah; ?></td>
                                          <td>Rp. <?= number_format($subharga); ?></td>

                                    </tr>
                                    <?php $no++; ?>
                                    <?php $totalbelanja += $subharga; ?>
                              <?php endforeach ?>
                        </tbody>
                        <tfoot>
                              <tr>
                                    <th colspan="4">Total Belanja</th>
                                    <th>Rp. <?= number_format($totalbelanja); ?></th>
                              </tr>
                        </tfoot>
                  </table>

                  <form method="POST">

                        <div class="row">
                              <div class="col-md-4">
                                    <div class="form-group">
                                          <input type="text" readonly value="<?= $_SESSION["pelanggan"]['nama_pelanggan'] ?>" class="form-control">
                                    </div>
                              </div>
                              <div class="col-md-4">
                                    <div class="form-group">
                                          <input type="text" readonly value="<?= $_SESSION["pelanggan"]['telepon_pelanggan'] ?>" class="form-control">
                                    </div>
                              </div>
                              <div class="col-md-4">
                                    <div class="form-group">
                                          <select class="form-control" name="id_ongkir">
                                                <option value=""> - Pilih Ongkos Kirim -</option>
                                                <?php
                                                $ambil = $koneksi->query("SELECT * FROM ongkir  ");
                                                while ($perongkir = $ambil->fetch_assoc()) {
                                                ?>
                                                      <option value="<?= $perongkir["id_ongkir"] ?>">
                                                            <?= $perongkir['nama_kota']; ?> -
                                                            Rp. <?= number_format($perongkir['tarif']) ?>
                                                      </option>
                                                <?php  } ?>
                                          </select>
                                    </div>
                              </div>
                        </div>
                        <div class="form-group">
                              <label for="alm">Alamat Lengkap Pengiriman</label>
                              <textarea class="form-control" name="alamat_pengiriman" id="alm" placeholder="alamat lengkap pengiriman(termasuk kode pos"></textarea>
                        </div>
                        <button class="btn btn-primary" name="checkout">Checkout</button>
                  </form>



                  <!-- Logic -->
                  <?php

                  if (isset($_POST["checkout"])) {
                        $id_pelanggan = $_SESSION["pelanggan"]["id_pelanggan"];
                        $id_ongkir = $_POST["id_ongkir"];
                        $tanggal_pembelian = date("Y-m-d");
                        $alamat_pengiriman = $_POST['alamat_pengiriman'];

                        $ambil =  $koneksi->query("SELECT * FROM ongkir where id_ongkir='$id_ongkir'");
                        $arrayongkir = $ambil->fetch_assoc();
                        $nama_kota = $arrayongkir['nama_kota'];
                        $tarif = $arrayongkir['tarif'];

                        $total_pembelian = $totalbelanja + $tarif;



                        // <!-- 1. menyimpan data ke tabel pembelian -->
                        $koneksi->query("INSERT INTO pembelian (id_pelanggan, id_ongkir, tanggal_pembelian, total_pembelian, nama_kota, tarif, alamat_pengiriman)
                        VALUES ('$id_pelanggan', '$id_ongkir', '$tanggal_pembelian', '$total_pembelian',' $nama_kota', '$tarif', '$alamat_pengiriman') ");

                        // -- // <!-- mendapatkan id_pembelian barusan terjadi -->
                        $id_pembelian_barusan = $koneksi->insert_id;

                        foreach ($_SESSION["keranjang"] as $id_produk => $jumlah) {

                              // -- // memendapatkan data produk berdasarkan id_produk
                              $ambil =   $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
                              $perproduk = $ambil->fetch_assoc();

                              $nama =    $perproduk['nama_produk'];
                              $harga =    $perproduk['harga_produk'];
                              $berat  =    $perproduk['berat_produk'];

                              $subberat =  $perproduk['berat_produk'] * $jumlah;
                              $subharga =  $perproduk['harga_produk'] * $jumlah;

                              $koneksi->query("INSERT INTO pembelian_produk (
                                       id_pembelian, id_produk, nama, harga, berat, subberat, subharga, jumlah)
                                       VALUES ('$id_pembelian_barusan', '$id_produk', '$nama', '$harga', '$berat', '$subberat', '$subharga', '$jumlah' )");

                              //    skrip update stok_produk
                              $koneksi->query("UPDATE produk SET stok_produk=stok_produk - $jumlah
                                                                  WHERE id_produk='$id_produk'");
                        }

                        // <!-- mengkosongkan keranjang -->

                        unset($_SESSION["keranjang"]);

                        // <!-- tampilan dialihkan ke halaman nota, nota dari pembelian barusan -->
                        echo "<script> alert('Pembelian Sukses'); </script>";
                        echo "<script>location = 'nota.php?id=$id_pembelian_barusan'; </script>";
                  }

                  ?>

            </div>
      </section>
      </br>



      <!-- <pre><?php print_r($_SESSION['pelanggan']) ?></pre>"; -->
      <!-- <pre><?php print_r($_SESSION['keranjang']) ?></pre>"; -->

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