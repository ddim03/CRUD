<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barang</title>

    <?php include "style.php"; ?>

</head>

<body>
    <div class="container mt-4">
        <h4>Daftar Barang</h4>
        <a href="create.php" class="btn btn-sm btn-success">Tambah data</a>
        <table class="table table-bordered mt-3">
            <thead class="text-center">
                <tr>
                    <th>NO</th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Jenis</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <?php
            include "koneksi.php";
            $batas = 5;
            $halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
            $halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;

            $prev = $halaman - 1;
            $next = $halaman + 1;

            $sql = mysqli_query($kon, "SELECT * FROM barang ORDER BY id DESC");
            $jumlah_data = mysqli_num_rows($sql);
            $total_hlm = ceil($jumlah_data / $batas);

            $hasil = mysqli_query($kon, "SELECT * FROM barang LIMIT $halaman_awal, $batas");
            $no = $halaman_awal + 1;
            while ($data = mysqli_fetch_array($hasil)) {
            ?>
                <tbody>
                    <tr>
                        <td class="text-center"><?php echo $no++ ?></td>
                        <td><?php echo $data["id"] ?></td>
                        <td><?php echo $data["nama_barang"] ?></td>
                        <td><?php echo $data["jenis_barang"] ?></td>
                        <td><?php echo $data["harga"] ?></td>
                        <td><?php echo $data["stok_barang"] ?></td>
                        <td><img src="img/<?php echo $data["gambar_barang"] ?>"></td>
                        <td class="text-center">
                            <a class="btn btn-sm btn-warning" href="update.php?id=<?php echo htmlspecialchars($data['id']); ?>" role="button">Update</a>
                            <a class="btn btn-sm btn-danger" href="hapus.php?id=<?php echo htmlspecialchars($data['id']); ?>" role="button">Delete</a>
                        </td>
                    </tr>
                </tbody>
            <?php
            }
            ?>
        </table>
        <nav class="mt-4">
            <ul class="pagination justify-content-center">
                <li class="page-item">
                    <a class="page-link" <?php if ($halaman > 1) {
                                                echo "href='?halaman=$prev'";
                                            } ?>>Previous</a>
                </li>
                <?php
                for ($i = 1; $i <= $total_hlm; $i++) {
                ?>
                    <li class="page-item"><a class="page-link" href="?halaman=<?php echo $i; ?>"><?php echo $i ?></a></li>
                <?php
                }
                ?>
                <li class="page-item">
                    <a class="page-link" <?php if ($halaman < $total_hlm) {
                                                echo "href='?halaman=$next'";
                                            } ?>>Next</a>
                </li>
            </ul>
        </nav>
    </div>
</body>

</html>