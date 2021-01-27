<?php
session_start();


include '../config/koneksi.php';
?>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login </title>

    <!-- CSS Sendiri -->
    <link href="../assets/css/style.css" rel="stylesheet" />
    <!-- BOOTSTRAP STYLES-->
    <link href="../assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="../assets/css/font-awesome.css" rel="stylesheet" />
    <!-- MORRIS CHART STYLES-->
    <link href="../assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <!-- CUSTOM STYLES-->
    <link href="../assets/css/custom.css" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

</head>

<body>

    <div class="container">
        <div class="row text-center">
            <div class="col-md-12">
                <br /><br />
                <h2>Akses Admin</h2>

                <h5>Silahkan Login</h5>
                <br />
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong> Enters Details To Login</strong>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="POST">
                            <br />
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                                <input type="text" class="form-control" name="user" />
                            </div>
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                                <input type="password" class="form-control" name="pass" required="required" />
                            </div>

                            <div class="form-group">
                                <label class="checkbox-inline">
                                    <input type="checkbox" /> Remember me
                                </label>
                                <span class="pull-right">
                                    <a href="#">Forgot password ?</a>
                                </span>
                            </div>
                            <button class="btn btn-primary" name="login">Login</button>
                            <hr />
                            Not register ? <a href="#">clck here</a>
                        </form>


                        <?php
                        if (isset($_POST['login'])) {

                            $ambil =  $koneksi->query("SELECT * FROM admin WHERE username='$_POST[user]' AND password ='$_POST[pass]'");
                            $ygcocok = $ambil->num_rows;
                            if ($ygcocok == 1) {
                                $_SESSION['admin'] = $ambil->fetch_assoc();
                                echo "<div class='alert alert-info'>Login sukses</div>";
                                echo "<meta http-equiv='refresh' content='1;url=index.php'>";
                            } else {
                                echo "<div class='alert alert-danger'>Login gagal</div>";
                                echo "<meta http-equiv='refresh' content='1;url=login.php'>";
                            }
                        }
                        ?>

                    </div>
                </div>

            </div>

        </div>
    </div>
    <!-- JQUERY SCRIPTS -->
    <script src="../assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="../assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="../assets/js/jquery.metisMenu.js"></script>
    <!-- MORRIS CHART SCRIPTS -->
    <script src="../assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="../assets/js/morris/morris.js"></script>
    <!-- CUSTOM SCRIPTS -->
    <script src="../assets/js/custom.js"></script>

</body>

</html>