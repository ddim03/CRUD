<?php 
include "koneksi.php";

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

if (isset($_POST['simpan'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $jenis_barang = $_POST['jenis_barang'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    if($_FILES['gambar']['error'] == 4) {
        $gambar = $_POST['gambarLama'];
    } else {
        $gambar = upload();
    }

    $sql = "UPDATE barang SET 
            nama_barang = '$nama',
            jenis_barang = '$jenis_barang',
            harga = '$harga',
            stok_barang = '$stok',
            gambar_barang = '$gambar' WHERE id = $id";
    
    $query = mysqli_query($kon, $sql);
    if ($query) {
        header("Location:barang.php");
    } else {
        die("Gagal menyimpan perubahan");
    }
} else {
    die("Akses ditolak");
}

?>