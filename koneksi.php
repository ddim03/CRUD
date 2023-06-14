<?php
    $kon = mysqli_connect("localhost", "root", "", "data");
    if(!$kon) {
        die("Gagal terhubung : ".mysqli_connect_error());
    }
?>