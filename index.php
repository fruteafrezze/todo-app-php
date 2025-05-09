<?php
include 'auth.php';       
include 'database.php';   

$conn = koneksiDB();

$result = mysqli_query($conn, "SELECT * FROM activity_list ORDER BY id DESC");
echo "Selamat datang, " . $_SESSION['username'];

$limit = 3;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

$result = mysqli_query($conn, "SELECT * FROM activity_list ORDER BY id DESC LIMIT $limit OFFSET $offset");

$total_result = mysqli_query($conn, "SELECT COUNT(*) as total FROM activity_list");
$total_row = mysqli_fetch_assoc($total_result);
$total_data = $total_row['total'];
$total_page = ceil($total_data / $limit);
?>

<!DOCTYPE html>
<html>
<head>
    <title>To-Do List</title>
</head>
<body>
<h2>To-Do List</h2>

<form action="add.php" method="POST">
    <input type="text" name="title" placeholder="Apa yang mau kamu kerjain?" required style="width: 15%; height: 20px;">
    <button type="submit">Tambah</button>
</form>

<ul>
<?php while ($row = mysqli_fetch_assoc($result)): ?>
    <li>
        <?= $row['is_done'] ? "<s>" . htmlspecialchars($row['title']) . "</s>" : htmlspecialchars($row['title']) ?>
        <a href="complete.php?id=<?= $row['id'] ?>">[Selesai]</a>
        <a href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Yakin mau hapus?')">[Hapus]</a>
    </li>
<?php endwhile; ?>
</ul>

<div>
    <?php for ($i = 1; $i <= $total_page; $i++): ?>
        <a href="?page=<?= $i ?>"><?= $i ?></a>
    <?php endfor; ?>
</div>

<p><a href="logout.php">Logout</a></p>

</body>
</html>
