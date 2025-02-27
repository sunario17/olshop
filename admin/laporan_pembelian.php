<?php
$semuadata = array();
$tgl_mulai = "-";
$tgl_selesai = "-";

if (isset($_POST["kirim"])) {
      $tgl_mulai =  $_POST["tglm"];
      $tgl_selesai =  $_POST["tgls"];
      $ambil =   $koneksi->query("SELECT * From pembelian pm LEFT JOIN pelanggan pl ON
                       pm.id_pelanggan=pl.id_pelanggan
                       WHERE tanggal_pembelian BETWEEN '$tgl_mulai' AND '$tgl_selesai'");
      while ($pecah =     $ambil->fetch_assoc()) {
            $semuadata[] = $pecah;
      }
}
// var_dump($semuadata);
// die;
?>

<h2>Laporan Pembelian dari <?= $tgl_mulai; ?> hingga <?= $tgl_selesai; ?></h2>
<hr>

<form method="post">
      <div class="row">

            <div class="col-md-5">
                  <div class="form-group">
                        <label for="tglm">Tanggal Mulai</label>
                        <input type="date" name="tglm" id="tglm" class="form-control" value="<?= $tgl_mulai; ?>">
                  </div>
            </div>

            <div class="col-md-5">
                  <div class="form-group">
                        <label for="tgls">Tanggal Selesai</label>
                        <input type="date" name="tgls" id="tgls" class="form-control" value="<?= $tgl_selesai; ?>">
                  </div>
            </div>

            <div class=" col-md-2">
                  <label>&nbsp;</label> <br>
                  <button class="btn btn-primary" name="kirim"><i class="glyphicon glyphicon-eye-open"></i> Lihat</button>
            </div>
      </div>
</form>

<table class="table table-bordered">
      <thead>
            <tr>
                  <th>No</th>
                  <th>Pelanggan</th>
                  <th>Tanggal</th>
                  <th>Jumlah</th>
                  <th>Status</th>
            </tr>
      </thead>
      <tbody>
            <?php $total = 0; ?>
            <?php foreach ($semuadata as $key => $value) : ?>
                  <?php $total += $value['total_pembelian'] ?>
                  <tr>
                        <td><?= $key + 1; ?></td>
                        <td><?= $value["nama_pelanggan"]; ?></td>
                        <td><?= $value["tanggal_pembelian"]; ?></td>
                        <td>Rp. <?= number_format($value["total_pembelian"]); ?></td>
                        <td><?= $value["status_pembelian"]; ?></td>
                  </tr>
            <?php endforeach ?>
      </tbody>
      <tfoot>
            <tr>
                  <th colspan="3">Total</th>
                  <th>Rp. <?= number_format($total); ?></th>
                  <th></th>
            </tr>
      </tfoot>
</table>