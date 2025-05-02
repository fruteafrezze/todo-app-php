<?php
include 'database.php';
$id = $_GET['id'];
mysqli_query($conn, "UPDATE activity_list SET is_done = 1 WHERE id = $id");
header("Location: index.php");
?>