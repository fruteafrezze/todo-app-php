<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "to_do_list";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
