<?php include 'database.php'; ?>
<h2>To-Do List</h2>

<form action="add.php" method="POST">
    <input type="text" name="title" required>
    <button type="submit">Tambah</button>
</form>

<ul>
<?php
$result = mysqli_query($conn, "SELECT * FROM activity_list");
while ($row = mysqli_fetch_assoc($result)) {
    echo "<li>" . ($row['is_done'] ? "<s>{$row['title']}</s>" : $row['title']) .
        " <a href='complete.php?id={$row['id']}'>[Selesai]</a> 
          <a href='delete.php?id={$row['id']}'>[Hapus]</a></li>";
}
?>
</ul>
