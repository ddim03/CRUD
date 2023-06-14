<?php 

include "koneksi.php";

if (isset($_GET['id'])) {
    $id = htmlspecialchars($_GET['id']);

    $sql = "DELETE FROM barang WHERE id=$id";
    $hasil = mysqli_query($kon, $sql);

    if ($hasil) {
        header("Location:barang.php");
    } else {
        echo "<div class='alert alert-danger'>Data gagal dihapus</div>";
    }
}

?>