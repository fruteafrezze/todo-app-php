<?php
include 'database.php';
$title = $_POST['title'];
mysqli_query($conn, "INSERT INTO activity_list (title) VALUES ('$title')");
header("Location: index.php");
?>