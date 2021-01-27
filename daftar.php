<?php
session_start();

include 'config/koneksi.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Daftar</title>

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
      <div class="container">
            <div class="row">
                  <div class="col-md-8 col-md-offset-2">
                        <div class="panel panel-default">
                              <div class="panel-heading">
                                    <h3 class="panel-title">Daftar Pelanggan</h3>
                              </div>
                              <div class="panel-body">
                                    <form method="POST" class="form-horizontal">
                                          <div class="form-group">
                                                <label for="nama" class="control-label col-md-3">Nama</label>
                                                <div class="col-md-7">
                                                      <input type="text" name="nama" id="nama" class="form-control" required>
                                                </div>
                                          </div>
                                          <div class="form-group">
                                                <label for="email" class="control-label col-md-3">Email</label>
                                                <div class="col-md-7">
                                                      <input type="text" name="email" id="email" class="form-control" required>
                                                </div>
                                          </div>
                                          <div class="form-group">
                                                <label for="pass" class="control-label col-md-3">Password</label>
                                                <div class="col-md-7">
                                                      <input type="text" name="password" id="pass" class="form-control" required>
                                                </div>
                                          </div>
                                          <div class="form-group">
                                                <label for="alamat" class="control-label col-md-3">Alamat</label>
                                                <div class="col-md-7">
                                                      <textarea name="alamat" id="alamat" rows="10" class="form-control" required></textarea>
                                                </div>
                                          </div>
                                          <div class="form-group">
                                                <label for="telp" class="control-label col-md-3" class="form-control">Telp/HP</label>
                                                <div class="col-md-7">
                                                      <input type="text" name="telepon" id="telp" required>
                                                </div>
                                          </div>
                                          <div class="form-group">
                                                <div class="col-md-7 col-md-offset-3">
                                                      <button class="btn btn-primary" name="daftar">Daftar</button>
                                                </div>
                                          </div>
                                    </form>

                                    <?php
                                    // jk ada tombol daftar(tombol di rekan)
                                    if (isset($_POST['daftar'])) {
                                          // mengmbil isian nama,email,pass,alm,telp
                                          $nama = $_POST["nama"];
                                          $email =   $_POST["email"];
                                          $pass = $_POST["password"];
                                          $alamat = $_POST["alamat"];
                                          $telp = $_POST["telepon"];
                                          // cek apkh email sdh di gunkn
                                          $ambil = $koneksi->query("SELECT * FROM pelanggan WHERE email_pelanggan='$email'");
                                          $ygcocok =   $ambil->num_rows;
                                          if ($ygcocok == 1) {
                                                echo "<script>alert('Pendaftaran gagal, email sudah digunakan');</script>";
                                                echo "<script>location='daftar.php';</script>";
                                          } else {
                                                // query ke insert ke tabel pelanggan
                                                $koneksi->query("INSERT INTO pelanggan(email_pelanggan, password_pelanggan, nama_pelanggan, telepon_pelanggan, alamat_pelanggan) VALUES ('$email', '$pass', '$nama', '$telp', '$alamat') ");
                                                echo "<script>alert('Pendaftaran sukses, silahkan login');</script>";
                                                echo "<script>location='login.php';</script>";
                                          }
                                    }
                                    ?>

                              </div>
                        </div>
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

      <body>

</html>