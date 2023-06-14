<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Data Barang</title>
    <?php include "style.php"; ?>
</head>
<body>
    <div class="container mt-4">

    <?php 
    include "koneksi.php";

    if(!isset($_GET['id'])) {
        header("Location:view.php");
    }
    $id = $_GET['id'];
    $sql = "SELECT * FROM barang WHERE id = $id";
    $query = mysqli_query($kon, $sql);
    $barang = mysqli_fetch_assoc($query);
    if (mysqli_num_rows($query) < 1) {
        die("Data tidak ditemukan");
    }
    ?>

    <h4>Input Data Barang</h4>
        <form action="aksi-update.php" method="POST" class="w-50 pt-3" enctype="multipart/form-data">
            <input type="hidden" class="form-control" name="id" id="id" value="<?php echo $barang['id']; ?>">
            <input type="hidden" class="form-control" name="gambarLama" id="id" value="<?php echo $barang['gambar_barang']; ?>">

            <div class="form-group mb-3">
                <label for="nama" class="form-label">Nama Barang :</label>
                <input type="text" class="form-control" name="nama" id="nama"  value="<?php echo $barang['nama_barang']; ?>">
            </div>
            <div class="form-group mb-3">
                <p class="form-label">Jenis Barang :</p>
                <?php $jenis_barang = $barang['jenis_barang']; ?>
                <label><input type="radio" name="jenis_barang" value="Makanan" class="me-2" 
                <?php echo ($jenis_barang == 'Makanan') ? "checked" : "" ?>>Makanan</label>
                <label><input type="radio" name="jenis_barang" value="Peralatan Dapur" class="me-2"
                <?php echo ($jenis_barang == 'Peralatan Dapur') ? "checked" : "" ?>>Peralatan Dapur</label>
                <label><input type="radio" name="jenis_barang" value="Peralatan Mandi" class="me-2"
                <?php echo ($jenis_barang == 'Peralatan Mandi') ? "checked" : "" ?>>Peralatan Mandi</label>
            </div>
            <div class="form-group mb-3">
                <label for="harga" class="form-label">Harga Barang :</label>
                <input type="text" class="form-control" id="harga" name="harga" value="<?php echo $barang['harga']; ?>">
            </div>
            <div class="form-group mb-3">
                <label for="stok" class="form-label">Stok Barang :</label>
                <input type="text" class="form-control" id="stok" name="stok" value="<?php echo $barang['stok_barang']; ?>">
            </div>
            <div class="form-group">
                <label for="stok" class="form-label">Gambar Barang :</label>
                <img src="img/<?php echo $barang['gambar_barang'] ?>">
                <input type="file" class="form-control" id="gambar" name="gambar">
            </div>
            <div class="d-grid gap-2 d-md-block mt-3 float-end">
                <input type="button" class="btn btn-secondary" value="Kembali" onclick="history.back(-1)">
                <input type="submit" class="btn btn-primary" value="Simpan" name="simpan">
            </div>
        </form>
    </div>
</body>
</html>

