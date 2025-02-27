<?php
$datakategori = array();

$ambil = $koneksi->query("SELECT * FROM kategori");
while ($tiap = $ambil->fetch_assoc()) {
    $datakategori[] = $tiap;
}

// echo "<pre>";
// print_r($datakategori);
// echo "</pre>";
?>

<h2>Tambah Produk</h2>
<div class="pull-right">
    <a href="index.php?halaman=produk" class="btn btn-warning btn-xs"> <i class="glyphicon glyphicon-refresh"></i> Kembali</a>
</div>

<form method="POST" enctype="multipart/form-data">

    <div class="form-group">
        <label for="kategori">Kategori</label><select name="id_kategori" id="kategori" class="form-control">
            <option value="">- Pilih Kategori -</option>
            <?php foreach ($datakategori as $key => $value) : ?>
                <option value="<?= $value["id_kategori"]; ?>"><?= $value["nama_kategori"]; ?></option>

            <?php endforeach ?>
        </select>
    </div>
    <div class="form-group">
        <label>Nama</label><input type="text" class="form-control" name="nama">
    </div>
    <div class="form-group">
        <label>harga (Rp.)</label> <input type="number" class="form-control" name="harga">
    </div>
    <div class="form-group">
        <label>Berat (Gr)</label> <input type="number" class="form-control" name="berat">
    </div>
    <div class="form-group">
        <label>Deskripsi</label> <textarea class="form-control" name="deskripsi" rows="10"></textarea>
    </div>
    <div class="form-group">
        <label>Foto</label>
        <div class="letak-input" style="margin-bottom: 10px;">
            <input type="file" class="form-control" name="foto[]">
        </div>
        <span class="btn btn-primary btn-tambah"><i class="fa fa-plus"></i>
        </span>

        <div class="form-group">
            <label>Stok</label> <input type="number" class="form-control" name="stok">
        </div>
        <button class="btn btn-primary" name="save"><i class="glyphicon glyphicon-saved"></i> Simpan</button>
</form>
<?php
if (isset($_POST['save'])) {
    $namanamafoto =  $_FILES['foto']['name'];
    $lokasilokasifoto = $_FILES['foto']['tmp_name'];

    // generate nama baru
    $namafilebaru = uniqid();
    $namafilebaru .= '.';
    $namafilebaru .= $ekstensiGambar;

    move_uploaded_file($lokasilokasifoto[0], "../assets/images/foto_produk/" . $namanamafoto[0]);

    $koneksi->query("INSERT INTO produk
    (nama_produk, harga_produk, berat_produk, stok_produk, foto_produk, deskripsi_produk, id_kategori )
    VALUES ('$_POST[nama]', '$_POST[harga]', '$_POST[berat]', '$_POST[stok]', '$namanamafoto[0]', '$_POST[deskripsi]', $_POST[id_kategori])");

    // mendapatkan id_produk_barusan
    $id_produk_barusan = $koneksi->insert_id;

    foreach ($namanamafoto as $key => $tiap_nama) {
        $tiap_lokasi = $lokasilokasifoto[$key];
        move_uploaded_file($tiap_lokasi, "../assets/images/foto_produk/" . $tiap_nama);

        // simpan ke mySQL (tapi kita perlu tau id_produknya berapa?)
        $koneksi->query("INSERT INTO produk_foto(id_produk, nama_produk_foto)
                        VALUES ('$id_produk_barusan', '$tiap_nama')");
    }

    echo "<div class='alert alert-info'>Data Tersimpan</div>";
    echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=produk'>";
}
?>
<script>
    $(document).ready(function() {
        $(".btn-tambah").on("click", function() {
            $(".letak-input").append("<input type='file' class='form-control' name='foto[]'>");
        })
    })
</script>