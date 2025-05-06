<?php
function koneksiDB(){
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db   = "to_do_list";

    $conn = new mysqli($host, $user, $pass, $db);

    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }
    return $conn;
}
?>
