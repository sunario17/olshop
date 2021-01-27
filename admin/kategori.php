<h2>Data Kategori</h2>
<hr>
<div class="pull-right">
      <a href="" class="btn btn-primary btn-sm" style="margin-bottom: 10px;"> <i class="glyphicon glyphicon-plus"></i> Tambah Data</a>
</div>

<?php
$semuadata = array();
$ambil = $koneksi->query("SELECT * FROM kategori");
while ($tiap = $ambil->fetch_assoc()) {

      $semuadata[] = $tiap;
}

// var_dump($semuadata);
// die;
?>
<table class="table table-bordered">

      <thead>
            <tr>
                  <th>No</th>
                  <th>Kategori</th>
                  <th>Aksi</th>
            </tr>
      </thead>
      <tbody>
            <?php foreach ($semuadata as $key => $value) : ?>
                  <tr>
                        <td><?= $key + 1; ?></td>
                        <td>
                              <?= $value["nama_kategori"]; ?>
                        </td>
                        <td>
                              <a href="" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a>
                              <a href="" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Hapus</a>
                        </td>
                  </tr>
            <?php endforeach ?>
      </tbody>
</table>