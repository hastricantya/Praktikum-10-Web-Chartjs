<?php 
// alamat server database
$host       = "localhost";
// user database
$user       = "root";
// default password xampp kosong
$password   = "";
// nama database penjualan yang ingin diakses
$database   = "db_penjualan";
// perintah melakukan koneksi ke database disimpan divariabel koneksi
$koneksi    = mysqli_connect($host, $user, $password, $database);
?>