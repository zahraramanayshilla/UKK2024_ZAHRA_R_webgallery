<?php
session_start();
include "koneksi.php";
//like
$fotoid = $_GET['fotoid'];
$userid = $_SESSION['userid'];

$likecek =  mysqli_query($koneksi, "SELECT * FROM likefoto WHERE fotoid='$fotoid' AND userid='$userid'");
if (mysqli_num_rows($likecek) == 1) {
    while ($row = mysqli_fetch_array($likecek)) {
        $likeid = $row['likeid'];
        $result = mysqli_query($koneksi, "DELETE FROM likefoto   WHERE likeid='$likeid'");
        echo "<script>
        location.href= '../home.php';
        </script>";
    }
} else {

    $tanggal_like1 = date('Y-m-d');

    $result = mysqli_query($koneksi, "INSERT INTO likefoto VALUES ('','$fotoid','$userid','$tanggal_like1')");

    echo "<script>
    location.href= '../home.php';
    </script>";
}


?>
