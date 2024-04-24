<?php
session_start();
include "koneksi.php";

//koemntar
$fotoid = $_POST['fotoid'];
$userid = $_SESSION['userid'];
$isikomentar = $_POST['isikomentar'];
$tanggalkomentar = date('Y-m-d');

$result = mysqli_query($koneksi, "INSERT INTO komentar VALUES('','$fotoid','$userid','$isikomentar','$tanggalkomentar')");

echo "<script>
alert('Komentar berhasil dikirim');
location.href= '../home.php';
</script>";
