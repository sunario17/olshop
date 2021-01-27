<!-- navbar -->
<nav class="navbar navbar-default">
      <div class="container">
            <ul class="nav navbar-nav">
                  <li><a href="index.php">Home</a></li>
                  <li><a href="keranjang.php">Keranjang</a></li>
                  <!-- jika sudah login(ada session pelanggan) -->
                  <?php if (isset($_SESSION["pelanggan"])) : ?>
                        <li><a href="riwayat.php">Riwayat Belanja</a></li>
                        <li><a href="logout.php">Logout</a></li>
                        <!-- selain itu atau blm login|| blm ada session pelanggan-->
                  <?php else : ?>
                        <li><a href="login.php">Login</a></li>
                        <li><a href="daftar.php">Daftar</a></li>
                  <?php endif ?>

                  <li><a href="checkout.php">Checkout</a></li>
            </ul>

            <form action="pencarian.php" method="POST" class="navbar-form navbar-right ">
                  <input type="text" class="form-control" name="keyword" size="25" id="keyword" placeholder="masukkan keyword pencarian.." autocomplete="off" autofocus>
                  <button class="btn btn-primary" id="tombol-cari">Cari</button>
                  <!-- <img src="assets/img/loader.gif" alt="gif" class="loader"> -->

            </form>
            <div>

</nav>
<!-- End Navbar -->