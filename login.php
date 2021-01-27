<?php
session_start();


include 'config/koneksi.php';
?>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
      <meta charset="utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <title>Login </title>

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

      <div class="container">
            <div class="row ">
                  <div class="col-md-4">
                        <div class="panel panel-default">
                              <div class="panel-heading">
                                    <h3 class="panel-title"> Login Pelanggan</h3>
                              </div>
                              <div class="panel-body">
                                    <form method="post">
                                          <div class="form-group ">
                                                <label>Email</label>
                                                <input type="email" class="form-control" name="email">
                                          </div>
                                          <div class="form-group ">
                                                <label>Password</label>
                                                <input type="password" class="form-control" name="password">
                                          </div>

                                          <button class="btn btn-primary " name="login">Login</button>
                                    </form>

                              </div>
                        </div>
                  </div>
            </div>
      </div>

      <?php
      //  <!-- jika ada tombol login (tombol login di tekan) -->
      if (isset($_POST['login'])) {

            $email = $_POST["email"];
            $pass = $_POST["password"];
            // lakukan query cek akun di tabel pelanggan di db
            $ambil =  $koneksi->query("SELECT * FROM pelanggan
                   WHERE email_pelanggan='$email' AND password_pelanggan ='$pass'");
            // ngitung akun yg terambil
            $ygcocok = $ambil->num_rows;
            // jk satu akun yg cocok, maka di loginkn
            if ($ygcocok == 1) {

                  // anda sukses login
                  // mendapatkan akun dalam bentuk array
                  $akun = $ambil->fetch_assoc();
                  // simpan di session pelanggan
                  $_SESSION['pelanggan'] = $akun;
                  echo "<script>alert('Anda sukses login');</script>";

                  // jika sudah belanja
                  if (isset($_SESSION["keranjang"]) or  !empty($_SESSION["keranjang"])) {
                        // larikan ke halaman checkout
                        echo "<script>location='checkout.php';</script>";
                  } else {
                        // jika belum belanja larikan kehalaman riwayat
                        echo "<script>location='riwayat.php';</script>";
                  }
            } else {
                  // larikan ke halaman login
                  echo "<script>alert('anda gagal login, periksa akun anda');</script>";
                  echo "<script>location='login.php';</script>";
            }
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