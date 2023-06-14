<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Barang</title>
    <?php include "style.php"; ?>
</head>

<body>
    <div class="container-sm mt-4">
        <?php
        include "koneksi.php";
        function input($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        function upload() {
            $namaFile = $_FILES['gambar']['name'];
            $ukuranFile = $_FILES['gambar']['size'];
            $error = $_FILES['gambar']['error'];
            $tmpName = $_FILES['gambar']['tmp_name'];

            $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
            $ekstensiGambar = explode('.', $namaFile);
            $ekstensiGambar = strtolower(end($ekstensiGambar));

            if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
                echo "<div class='alert alert-danger'>File yang diupload bukan gambar</div>";
                return;
            }

            if($ukuranFile > 1000000) {
                echo "<div class='alert alert-danger'>File yang diupload terlalu besar</div>";
                return;
            }

            move_uploaded_file($tmpName, 'img/' . $namaFile);
            return $namaFile;
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = input($_POST["id"]);
            $nama = input($_POST["nama"]);
            $jenis = input($_POST["jenis_barang"]);
            $harga = input($_POST["harga"]);
            $stok = input($_POST["stok"]);
            $gambar = upload();
            

            $sql = "INSERT INTO barang (id, nama_barang, jenis_barang, harga, stok_barang, gambar_barang) VALUES ('$id', '$nama', '$jenis', '$harga', '$stok', '$gambar')";

            $hasil = mysqli_query($kon, $sql);

            if ($hasil) {
                header("Location:barang.php");
            } else {
                echo "<div class='alert alert-danger'>Data Gagal Disimpan</div>";
            }
        }
        ?>
        <h4>Input Data Barang</h4>
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" enctype="multipart/form-data" class="w-50 pt-3">
            <div class="form-group mb-3">
                <label for="id" class="form-label">Kode Barang :</label>
                <input type="text" class="form-control" name="id" id="id" required>
            </div>
            <div class="form-group mb-3">
                <label for="nama" class="form-label">Nama Barang :</label>
                <input type="text" class="form-control" name="nama" id="nama" required>
            </div>
            <div class="form-group mb-3">
                <p class="form-label">Jenis Barang :</p>
                <label><input type="radio" name="jenis_barang" value="Makanan" class="me-2">Makanan</label>
                <label><input type="radio" name="jenis_barang" value="Peralatan Dapur" class="me-2">Peralatan Dapur</label>
                <label><input type="radio" name="jenis_barang" value="Peralatan Mandi" class="me-2">Peralatan Mandi</label>
            </div>
            <div class="form-group mb-3">
                <label for="harga" class="form-label">Harga Barang :</label>
                <input type="text" class="form-control" id="harga" name="harga" required>
            </div>
            <div class="form-group mb-3">
                <label for="stok" class="form-label">Stok Barang :</label>
                <input type="text" class="form-control" id="stok" name="stok" required>
            </div>
            <div class="form-group">
                <label for="gambar" class="form-label">Gambar Barang :</label>
                <input type="file" class="form-control" id="gambar" name="gambar" required>
            </div>
            <div class="d-grid gap-2 d-md-block mt-3 float-end">
                <a href="barang.php" role="button" class="btn btn-secondary">Kembali</a>
                <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</body>

</html>