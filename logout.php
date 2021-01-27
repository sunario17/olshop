<?php
session_start();

// tambahan dari WPU (penghancur session)
$_SESSION = [];
session_unset();
// Menghancurkan $_SESSION["pelanggan"]
session_destroy();

echo "<script>alert('anda telah logout');</script>";
echo "<script>location='index.php';</script>";
